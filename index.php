<?php

  // arquivos utilizados em todo sitema
  include("incs/function.php");
  include("incs/conexao.php");

  // Recebe a URL passada pelo navegador
  $url = explode("/", $_SERVER["REQUEST_URI"]);

  //retira o primeiro elemento
  array_shift($url);

  // Trata o array $url com anti injection
  $aux = 0;
  foreach($url as $url2)
  {
    $url[$aux] = anti_injection($url2);
    $aux++;
  }

  //print_r($url);

  define("SITE_URL", 'http://localhost/mylife');


?>


<?php include("incs/topo.php"); ?>


    <div id="corpo">

    <?php

      // Script responsavel pelas inclusao das paginas
      // Verifique o nivel da $url[0,1...]
      $pagina = $url[1];

      if(empty($pagina)) // Se $pagina vazia
      {
        include("tarefas.php");
      }
      elseif(file_exists($pagina . '.php')) // Se $pagina existir
      {
        include($pagina . '.php');
      }
      else
      {
        include("404.php"); // Se $pagina não encontrada
      }


    ?>


    </div><!-- $corpo -->


<?php include("incs/rodape.php"); ?>

