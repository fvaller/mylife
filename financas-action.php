<?php

    //arquivos necesarios
    include_once("incs/function.php");
    include_once("incs/conexao.php");

    //Aчуo a ser execultada
    if(!empty($mes_url)){
      $mes = financas_get_mes($mes_url);
      $acao = 'select-mes';
    }

    if(isset($_GET['acao'])){
      $acao = anti_injection($_GET['acao']);
    }


    $id   = (int) $_REQUEST['id'];


    //REDIRECIONAMENTOS
    // define para onde vai ser redirecionado apos a acao
    $destino = $_REQUEST['pagina_uri'];
    if($destino == ''){$destino = '/mylife/financas';}


    //DADOS FORMULARIOS
    $f_lancamento = $_POST['lancamento'];
    $f_data       = data_mysql($_POST['data']);
    $f_descricao  = $_POST['descricao'];
    $f_categoria  = $_POST['id_categoria'];
    $f_valor      = str_replace(",", ".", $_POST['valor']) ;


    switch($acao)
    {

    // TAREFAS
     case 'inserir' :
     if(!empty($f_descricao))
     {
       $sql = "INSERT INTO financas (id_financas_cat, descricao, valor, data, lancamento) VALUES ( '$f_categoria', '$f_descricao','$f_valor', '$f_data', '$f_lancamento' ) ";
       $result = mysql_query($sql);

       header("Location: " . $destino . "/?msg=201");
     }else{
       header("Location: " . $destino . "/?msg=101");
     }
     break;


     case 'deletar' :
     $sql = "DELETE FROM financas WHERE id_financas = '$id' ";
     $result = mysql_query($sql);
     header("Location: " . $destino . "/?msg=203");
     break;


     //Filtro de meses
     case 'select-mes' :
     $sql = "SELECT * FROM financas WHERE MONTH(data) = '$mes' ORDER BY lancamento ASC, data ASC";
     $result = mysql_query($sql);
     $total = mysql_num_rows($result);
     break;


     default :
     $sql = "SELECT * FROM financas ORDER BY data ASC";
     $result = mysql_query($sql);
     $total = mysql_num_rows($result);
     break;

    }


?>