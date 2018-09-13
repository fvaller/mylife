<?php

    //arquivos necesarios
    include_once("incs/conexao.php");

    $return_arr = array();

    $sql = mysql_query("SELECT * FROM financas_cat WHERE categoria LIKE '%".$_GET['term']."%' ");

    while($row = mysql_fetch_array($sql)){

      $row_array['id'] = $row['id_financas_cat'];
      $row_array['value'] = $row['categoria'];

      array_push($return_arr, $row_array);

    }

    //mysql_close();

    echo json_encode($return_arr);


?>