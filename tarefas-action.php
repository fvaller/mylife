<?php

    //arquivos necesarios
    include_once("incs/function.php");
    include_once("incs/conexao.php");

    // Pega o ID do projeto passando o nome
    $projeto = tarefas_projetos_get_id($projeto_url);

    $acao = anti_injection($_GET['acao']);

    $id   = (int) $_REQUEST['id'];


    // define para onde vai ser redirecionado apos a acao
    $destino = $_REQUEST['pagina_uri'];
    if($destino == ''){$destino = '/mylife/tarefas';}


    // valores Tarefas
    $t_id_projeto = $_POST['projeto'];
    $t_tarefa     = $_POST['tarefa'];
    $t_status     = $_POST['status'];
    $t_prioridade = $_POST['prioridade'];
    //$t_nota       = htmlspecialchars($_POST['notatarefa'], ENT_QUOTES);
    $t_nota       = $_POST['notatarefa'];

    if($_POST['prazo'] != ''){
      $t_prazo = data_mysql($_POST['prazo']);
    }else{$t_prazo = "NULL";}



    // valores projetos
    $p_projeto = $_POST['projeto'];
    $p_class   = $_POST['class'];
    $p_status  = $_POST['status'];


    // FILTROS
    if($projeto == 2){ $acao = 'hoje'; }
    if($projeto == 3){ $acao = 'proximos'; }

    switch($acao)
    {

    // TAREFAS
     case 'inserir' :
     if(!empty($t_tarefa))
     {
       if($t_id_projeto == 2){$t_id_projeto = 1; $t_prazo = date("Y-m-d");}
       if($t_id_projeto == 3){$t_id_projeto = 1;}
       $sql = "INSERT INTO tarefas (id_projeto, tarefa, status, data, prazo, prioridade ) VALUES ('$t_id_projeto', '$t_tarefa', '1', NOW(), '$t_prazo', '$t_prioridade' ) ";
       $result = mysql_query($sql);

       //insere uma tarefa
       $tarefa_id = mysql_insert_id();
       if($t_nota != ''){
         mysql_query("INSERT INTO tarefas_notas (id_tarefas, nota, data) VALUES ('$tarefa_id', '$t_nota', NOW() )");
       }

       header("Location: " . $destino . "/?msg=201");
     }else{
       header("Location: " . $destino . "/?erro=101");
     }
     break;

     case 'editar' :
     $sql = "UPDATE tarefas SET id_projeto = '$t_id_projeto', tarefa = '$t_tarefa', status = '$t_status', prazo = '$t_prazo', prioridade = '$t_prioridade' WHERE id_tarefas = '$id' ";
     $result = mysql_query($sql);

     tarefas_notas_exist($id,$t_nota);
     if($t_nota != ''){
       $result2 = mysql_query("UPDATE tarefas_notas SET nota = '$t_nota' WHERE id_tarefas = '$id' ");
     }

     header("Location: " . $destino . "/?msg=202");
     break;

     case 'ckeck' : //marca como resolvido
     $sql = "UPDATE tarefas SET status = '2' WHERE id_tarefas = '$id' ";
     $result = mysql_query($sql);
     header("Location: " . $destino . "/?msg=202");
     break;

     case 'deletar' :
     tarefas_notas_excluir($id);
     $sql = "DELETE FROM tarefas WHERE id_tarefas = '$id' ";
     $result = mysql_query($sql);
     header("Location: " . $destino . "/?msg=203");
     break;


     // PROJETOS
     case 'inserir-projeto' :
     if(!empty($p_projeto)){
       $sql = "INSERT INTO tarefas_projeto (projeto, class, status) VALUES ('$p_projeto', '$p_class', '$p_status') ";
       $result = mysql_query($sql);
       header("Location: " . $destino . "/?msg=201");
     }else{
       header("Location: " . $destino . "/?erro=101");
     }
     break;

     case 'editar-projeto' :
     $sql = "UPDATE tarefas_projeto SET projeto = '$p_projeto', class = '$p_class', status = '$p_status' WHERE id_projeto = '$id' ";
     $result = mysql_query($sql);
     header("Location: " . $destino . "/?msg=202");
     break;

     case 'excluir-projeto' :
     tarefas_projeto_remover($id);
     $sql = "DELETE FROM tarefas_projeto WHERE id_projeto = '$id' ";
     $result = mysql_query($sql);
     header("Location: " . $destino . "/?msg=203");
     break;


     // FILTROS
     case 'hoje' :
     $hoje = date("Y-m-d");
     $sql = "SELECT * FROM tarefas WHERE status = '1' AND prazo <= '$hoje' AND prazo != '0000-00-00' ORDER BY id_tarefas DESC";
     $result = mysql_query($sql);
     break;

     case 'proximos' :
     $hoje = date("Y-m-d");
     $sql = "SELECT * FROM tarefas WHERE status = '1' AND prazo > '$hoje' ORDER BY id_tarefas DESC";
     $result = mysql_query($sql);
     break;


     default :
     $sql = "SELECT * FROM tarefas WHERE id_projeto = '$projeto' AND status = '1' ORDER BY id_tarefas DESC";
     $result = mysql_query($sql);
     break;
    }


?>