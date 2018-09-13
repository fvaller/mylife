<?php


  if(isset($_REQUEST['erro']))
  {
    $msg = $_REQUEST['erro'];
  }
  else
  {
    $msg = $_REQUEST['msg'];
  }

  switch($msg)
  {
    // modulo Tarefas
    case '101' :
    echo '<div class="info_div" id="fail"><span class="ico_cancel">Preencha todos os campos</span></div>';
    break;

    case '102' :
    echo '<div class="info_div" id="fail"><span class="ico_cancel">Selecione um projeto valido</span></div>';
    break;

    case '201' :
    echo '<div class="info_div" id="success"><span class="ico_success">Registro inserido com sucesso!</span></div>';
    break;

    case '202' :
    echo '<div class="info_div" id="success"><span class="ico_success">Registro editado com sucesso!</span></div>';
    break;

    case '203' :
    echo '<div class="info_div" id="success"><span class="ico_success">Registro exluido!</span></div>';
    break;

  }



?>