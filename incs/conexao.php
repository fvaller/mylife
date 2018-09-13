<?php
  
  $HOST = "localhost";  $USER = "root"; $SENHA = "root2017"; $BD = "mylife";

  $conecta = mysql_connect($HOST,$USER,$SENHA) or print (mysql_error());
  mysql_select_db($BD, $conecta) or print(mysql_error());

?>
