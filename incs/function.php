<?php

 date_default_timezone_set("America/Fortaleza");



//AntiInject
function anti_injection($sql){
  $sql = preg_replace(sql_regcase("/(http|www|wget|from|select|insert|delete|where|.dat|.txt|.gif|drop table|show tables| or |#|\*|--|\\\\)/"),"",$sql);
  $sql = trim($sql);
  $sql = strip_tags($sql);
  $sql = addslashes($sql);
  return $sql;
}

//tranforma data tipo DD/MM/AAAA para AAAA-MM-DD
function data_mysql($data_dma){
  //trasforma data para inclusao no MySQL
  if(!empty($data_dma)){
    $data_array = split("/",$data_dma);
    $data = $data_array[2] ."-".$data_array[1]."-".$data_array[0];
    return $data;
  }else{
    return NULL;
  }
}

function limitador($palavras,$texto) {
  $texto = explode(" ", $texto);
  $texto = preg_replace("/<(\/)?p>/i", "", $texto);
  for($i=0; $i<$palavras; $i++) {
    $texto_ok = $texto_ok." ".$texto[$i];
  }
  $texto_ok = trim($texto_ok);
  $texto_ok = $texto_ok."";
  //$texto_ok = trim($texto_ok);
  return "$texto_ok [...]";
}

function ajustar_data($valor){
  setlocale(LC_ALL, 'portuguese', 'pt_BR', 'pt_br', 'ptb_BRA');
  $data = strftime("%d %B %Y", strtotime($valor));
  //$data = date("d F Y", strtotime($valor));
  //$hora = date("G:i", strtotime($valor));
  //return $hora . ' ' . $data;
  return $data;
}


function menu_select($valor, $link){
  if($valor == $link){
    return 'class="select"';
  }
}

//FUNÇÃO PARA CHAMAR A PAGINA
function pagina($id){
 $id = anti_injection($id);
 $result = mysql_query("SELECT * FROM paginas WHERE idpags = '$id'");
 $row = mysql_fetch_assoc($result);

 $id        = $row['idpags'];     //0
 $descricao = $row['descricao'];  //1
 $titulo    = $row['titulo'];     //2
 $conteudo  = $row['conteudo'];   //3

 return array( $id, $descricao, $titulo, $conteudo );
}


function tarefas_data($data){
  $hj  = date("d/m/Y");

  if(($data != NULL) AND ($data != '0000-00-00'))
  {
    $new_data = date("d/m/Y", strtotime($data));

    if($new_data == $hj){
      return '<strong>(Hoje)</strong>';
    }
    elseif($new_data == $hj+1){
      return '<strong>(Amanh&atilde;)</strong>';
    }
    elseif($new_data == $hj-1){
      return '<strong>(Ontem)</strong>';
    }
    else{
      return $new_data;
    }
  }

}

function data_ajustar($data, $tipo = 1){
  if($tipo == 1){
    $new_data = date("d/m/Y", strtotime($data));
  }
  elseif($tipo == 2){
    $new_data = date("d/m/Y H:i:s", strtotime($data));
  }
  return $new_data;
}

function formata_data($data){
  if(($data == NULL) OR ($data == '0000-00-00')){
     //nada
  }else{
  $new_data = date("d/m/Y", strtotime($data));
  $hora = date("H:i:s", strtotime($data));
  if($h) return $new_data .' ' . $hora;
  return $new_data;
  }
}

function tarefas_projetos_get_id($projeto){
 $result = mysql_query("SELECT * FROM tarefas_projeto WHERE projeto = '$projeto'");
 $row = mysql_fetch_assoc($result);

 return $row['id_projeto'];
}

function tarefas_projeto_cont($id, $status = 1){

   if($id == 2)
   {
      $hoje = date("Y-m-d");
      $sql = mysql_query("SELECT COUNT(*) FROM tarefas WHERE status = '$status' AND prazo <= '$hoje' AND prazo != '0000-00-00' ");
      $total = mysql_fetch_row($sql);

      if($total[0] > '0'){
        return ' <span class="num">'.$total[0].'</span>';
      }
   }
   elseif($id == 3)
   {
      $hoje = date("Y-m-d");
      $sql = mysql_query("SELECT COUNT(*) FROM tarefas WHERE status = '$status' AND prazo > '$hoje' ");
      $total = mysql_fetch_row($sql);

      if($total[0] > '0'){
        return ' <span class="num">'.$total[0].'</span>';
      }
   }
   else
   {
      $sql = mysql_query("SELECT COUNT(*) FROM tarefas WHERE id_projeto = '$id' AND status = '$status' ");
      $total = mysql_fetch_row($sql);

      if($total[0] > '0'){
        return ' <span class="num">'.$total[0].'</span>';
      }
   }

}



// lista todos os projetos
function tarefas_projetos_list($op, $link = 'diversos'){

  $sql_p = mysql_query("SELECT * FROM tarefas_projeto WHERE status = '1' ");

  if($op == 'option')
  {
    while($row = mysql_fetch_assoc($sql_p))
    {
      echo '<option value="' . $row['id_projeto'] . '">' . $row['projeto'] . '</option>';
    }
  } //option

  //EXIBE EM FORMA DE LISTA
  if($op == 'li')
  {
    while($row = mysql_fetch_assoc($sql_p))
    {
      //se maior q 3 inserir descricao de projeto
      if($aux == 3){
       echo '<li class="proj"></li>';
      }
      if (strtolower($row['projeto']) == $link)
      {
        echo '<li><a class="'.$row['class'].' select" href="' . SITE_URL .'/tarefas/'. strtolower($row['projeto']) . '"><span style="float: left">' . $row['projeto'] .'</span><span style="float: right">'. tarefas_projeto_cont($row['id_projeto']) . '</span><div class="clear"></div></a></li>';
      }
      else
      {
        echo '<li><a class="'.$row['class'].'" href="' . SITE_URL .'/tarefas/'. strtolower($row['projeto']) . '"><span style="float: left">' . $row['projeto'] .'</span><span style="float: right">'. tarefas_projeto_cont($row['id_projeto']) . '</span><div class="clear"></div></a></li>';
      }

      $aux++;
    } // while
  } //li
}


function tarefas_projetos_get($id,$i){
 $id = anti_injection($id);
 $result = mysql_query("SELECT * FROM tarefas_projeto WHERE id_projeto = '$id'");
 $row = mysql_fetch_assoc($result);

 $p1 = $row['id_projeto'];
 $p2 = $row['projeto'];

 $dados = array( $p1, $p2 );

 return $dados[$i];
}


function tarefas_status($status){
  if($status == 1){
   return $img = '<img src="' . SITE_URL . '/images/ok.png" title="Marcar como resolvido" />';
  }else{
    return $img = '<img src="' . SITE_URL . '/images/check.png" title="Resolvido" />';
  }
}

/**
* função para remover espaços em branco das URL
* se charmar as paginas com espaços por ajax gera um erro
*
* para receber é chamada a mesma função com $op = 2
* removendo o caracteres inseridos nos espaços
*/
function url_sem_espaco($url,$op = 1){
  if($op == 1){
    $url = str_replace(' ', '-', $url);
    return $url;
  }
  if($op == 2){
    $url = str_replace('-', " ", $url);
    return $url;
  }
}

function tarefas_projeto_remover($id){
  $result = mysql_query("SELECT * FROM tarefas WHERE id_projeto = '$id'");
  $total = mysql_num_rows($result);

  if ($total > 0){
    $del_tarefas = "DELETE FROM tarefas WHERE id_projeto = '$id' ";
    mysql_query($del_tarefas);
  }
}

function tarefas_select($id){
  $aux = 'selected="selected"';
  echo '<option value="1"'; if($id == 1){echo $aux;} echo '>Ativar</option>';
  echo '<option value="2"'; if($id == 2){echo $aux;} echo '>Desativar</option>';
}

function tarefas_notas($id_tarefa){
  $result = mysql_query("SELECT * FROM tarefas_notas WHERE id_tarefas = '$id_tarefa'");
  $total = mysql_num_rows($result);
  $row = mysql_fetch_assoc($result);

  if ($total > 0){
    $link = '<a href="javascript:void(0);" class="tooltip"><img src="'.SITE_URL.'/images/info.png" width="16" height="16" alt="" />';
    $nota = '<span>'.nl2br(limitador(15,$row['nota'])).'<hr class="hr1" /><strong><img src="'.SITE_URL.'/images/note.png" width="16" height="16" style="vertical-align: middle;" /> Nota em '.ajustar_data($row['data']).'</strong></span></a>';
    return $link . $nota;
  }

}

function tarefas_notas_get($id_tarefa){
  $result = mysql_query("SELECT * FROM tarefas_notas WHERE id_tarefas = '$id_tarefa'");
  $total = mysql_num_rows($result);
  $row = mysql_fetch_assoc($result);

  if ($total > 0){
    return $row['nota'];
  }

}

function tarefas_notas_exist($id_tarefa, $nota){
  $result = mysql_query("SELECT * FROM tarefas_notas WHERE id_tarefas = '$id_tarefa'");
  $total = mysql_num_rows($result);

  if(($total == 0) AND ($nota != '')){
   $result2 = mysql_query("INSERT INTO tarefas_notas (id_tarefas, data) VALUES ('$id_tarefa', NOW() )");
  }

}

function tarefas_prioridade($num){
  switch($num){
    case 1 : return '<img src="'.SITE_URL.'/images/p1.png" width="16" height="16" alt="" />'; break;
    case 2 : return '<img src="'.SITE_URL.'/images/p2.png" width="16" height="16" alt="" />'; break;
    case 3 : return '<img src="'.SITE_URL.'/images/p3.png" width="16" height="16" alt="" />'; break;
  }
}

function tarefas_notas_excluir($id){
  $result = mysql_query("SELECT * FROM tarefas_notas WHERE id_tarefas = '$id'");
  $total = mysql_num_rows($result);

  if ($total > 0){
    $sql = "DELETE FROM tarefas_notas WHERE id_tarefas = '$id' ";
    mysql_query($sql);
  }
}

function ajuste_nomes($str){

  $new_str = ucwords($str);

  return $new_str;
}


/*
* FUNÇÕES MODULO: FINANÇAS
*
*/
// lista todos os projetos
function financas_categorias_list($op){

  $sql_p = mysql_query("SELECT * FROM financas_cat ");

  if($op == 'option')
  {
    while($row = mysql_fetch_assoc($sql_p))
    {
      echo '<option value="' . $row['id_financas_cat'] . '">' . $row['categoria'] . '</option>';
    }
  } //option

}

function financas_categorias_getnome($id){
  $sql = mysql_query("SELECT * FROM financas_cat WHERE id_financas_cat = '$id' ");
  $row = mysql_fetch_row($sql);
  return $row[1];
}


//FUNCAO PARA AJUSTAR VALOR DE 10.000,00 PARA 10000.00
function moeda_ajuste($valor) {
		$valor = str_replace(".", "", $valor);
		$valor = str_replace(",", ".", $valor);
	    return $valor;
}

//FUNCAO PARA AJUSTAR VALOR DE 10000.00 PARA 10.000,00
function moeda($valor) {
  $valor = str_replace(",", "", $valor);
  $valor = number_format($valor, 2, ',', '.');
  return $valor;
}

function financas_dc_status($valor){
  if($valor == 1){
    $new_valor = '<img src="'.SITE_URL.'/images/credito.png" width="16" height="16" border="0" title="Credito" />';
  }elseif($valor == 2){
    $new_valor = '<img src="'.SITE_URL.'/images/debito.png" width="16" height="16" border="0" title="Debito" />';
  }
  return $new_valor;
}

function financas_get_mes($mes){
  switch($mes)
  {
  case 'janeiro'  : return '01'; break;
  case 'fevereiro': return '02'; break;
  case 'marco'    : return '03'; break;
  case 'abril'    : return '04'; break;
  case 'maio'     : return '05'; break;
  case 'junho'    : return '06'; break;
  case 'julho'    : return '07'; break;
  case 'agosto'   : return '08'; break;
  case 'setembro' : return '09'; break;
  case 'outubro'  : return '10'; break;
  case 'novembro' : return '11'; break;
  case 'dezembro' : return '12'; break;
  }
}

function get_mes($mes){

  switch($mes){
    case 1 : $r = 'janeiro'; break;
    case 2 : $r = 'fevereiro'; break;
    case 3 : $r = 'marco'; break;
    case 4 : $r = 'abril'; break;
    case 5 : $r = 'maio'; break;
    case 6 : $r = 'junho'; break;
    case 7 : $r = 'julho'; break;
    case 8 : $r = 'agosto'; break;
    case 9 : $r = 'setembro'; break;
    case 10 : $r = 'outubro'; break;
    case 11 : $r = 'novembro'; break;
    case 12 : $r = 'dezembro'; break;
  }
  return $r;
}




?>