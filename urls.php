<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Hello!</title>
</head>

<body>

<?php

  //Código retirado do A List Apart
  $DOCUMENT_ROOT   = $_SERVER['DOCUMENT_ROOT'];   //   /home/fernandovaller/www/
  $REQUEST_URI     = $_SERVER['REQUEST_URI'];     //   /mylife/
  $SCRIPT_FILENAME = $_SERVER['SCRIPT_FILENAME']; //   /home/fernandovaller/www/mylife/index.php

  //verifica se arquivo existe
  if(file_exists($DOCUMENT_ROOT.$REQUEST_URI) and ($SCRIPT_FILENAME!=$DOCUMENT_ROOT.$REQUEST_URI) and ($REQUEST_URI!="/")){
      $url=$REQUEST_URI;
      include($DOCUMENT_ROOT.$url);
      exit();
  }

  $url = strip_tags($REQUEST_URI);
  $url_array = explode("/", $url);
  array_shift($url_array); //o primeiro índice sempre será vazio

  if(empty($url_array)){
    include("site_index.php");
    exit();
  }



?>

</body>

</html>
