<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Hello!</title>
</head>

<body>

<?php

  echo $_GET['secao'];
  echo $_GET['data'];

?>

<?php

  //1. verificar se um verdadeiro "arquivo" existe ..
  if(file_exists($DOCUMENT_ROOT.$REQUEST_URI) and ($SCRIPT_FILENAME!=$DOCUMENT_ROOT.$REQUEST_URI) and ($REQUEST_URI!="/")){
    $url=$REQUEST_URI;
    include($DOCUMENT_ROOT.$url);
    exit();
  }


  // 2. não, vá em frente e verifique se há dinâmica. conteúdos se
  $url=strip_tags($REQUEST_URI);
  $url_array=explode("/",$url);
  array_shift($url_array); // o primeiro é vazia de qualquer forma


  if(empty($url_array)){
    // temos um pedido para o índice de
    include("includes/inc_index.php");
    exit();
  }

  // Olha, se alguma coisa no banco de dados corresponde ao pedido
  // Este é um protótipo vazio. Coloque a solução aqui).
  if(check_db($url_array)==true()){
    do_some_stuff(); output_some_content();
    exit();
  }


  // 3. nada em DB ou erro 404;!
  else{
  header("HTTP/1.1 404 Not Found");
  exit();
  }

?>



</body>

</html>
