<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>MyLife - Gerencie os processos de sua vida</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/estilo-reset.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/estilo-bottons.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/estilo-site.css" type="text/css" />
  <script language="JavaScript" src="<?php echo SITE_URL; ?>/js/jquery-1.4.2.js" type="text/javascript"></script>

   <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/colorbox.css" type="text/css" />
   <script language="JavaScript" src="<?php echo SITE_URL; ?>/js/jquery.colorbox.js" type="text/javascript"></script>
   <script language="JavaScript" type="text/javascript">
     $(document).ready(function(){
       //$("a[rel='facebox']").colorbox({width:"750px"});
       $(".link").colorbox({width:"75%", height:"90%"});
       $(".link2").colorbox({height:"90%"});

       $('#t-focus').focus();
     });

   </script>

   <!-- jQuery UI -->
   <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/redmond/jquery-ui-1.8.6.custom.css" type="text/css" />
   <script language="JavaScript" src="<?php echo SITE_URL; ?>/js/jquery-ui-1.8.6.custom.min.js" type="text/javascript"></script>

   <!-- Datepicker -->
   <script language="JavaScript" src="<?php echo SITE_URL; ?>/js/jquery.ui.datepicker-pt-BR.js" type="text/javascript"></script>
   <script language="JavaScript" type="text/javascript">
   $(function() {
        $("#prazo").datepicker($.datepicker.regional['pt-BR']);
        $("#prazo2").datepicker($.datepicker.regional['pt-BR']);
   });
   </script>

   <!-- Autocomplet -->
   <script language="JavaScript" src="<?php echo SITE_URL; ?>/js/jquery.ui.autocomplete.min.js" type="text/javascript"></script>
   <script>
/*     $(document).ready(function() {
       var availableTags = [
			"Salario",
			"Unitriade",
            "outro",
            "Casa",
            "Alimentação",
            "Moto"
		];
		$( "input#categoria" ).autocomplete({
			source: availableTags
		});

     });*/

		$(function() {
			$("#categoria").autocomplete({
				source: "<?php echo SITE_URL; ?>/financas_cats.php",
				minLength: 1,
                select: function(event, ui) {
					$('#id_categoria').val(ui.item.id);
				}
			});
		});

   </script>


   <!-- Diversas -->
  <script language="JavaScript" type="text/javascript">
  $(document).ready(function(){
    $('.info_div').click(function(){
      $(this).css("display", "none");
    })

  });

  // confirma acao
  function confirma(str){
    var resposta = confirm("Deseja realmente excluir esse registro?");
    if(resposta){
      location.href = str;
    }else
      return false;
  }

  function ckeck(str){
    location.href = str;
  }
 </script>

   <!-- Teclas de atalho -->
  <script language="JavaScript" src="<?php echo SITE_URL; ?>/js/jquery.hotkeys-0.7.9.js" type="text/javascript"></script>
  <script language="JavaScript" type="text/javascript">

    $(document).bind('keydown', 'Alt+1', function(){
       $('#t-focus').focus();
    });

    $(document).bind('keydown', 'Alt+2', function(){
      $("#tmais").click();
    });

    $(document).bind('keydown', 'Alt+p', function(){
      $("#t-proj").click();
    });

  </script>

  <!-- Modulo Financeiro -->
  <script language="JavaScript" type="text/javascript">
  $(document).ready(function(){
    $("a.tab").click(function () {
    	$(".active").removeClass("active");
    	$(this).addClass("active");
    	$(".content").hide();
    	var content_show = $(this).attr("rel");
    	$("#"+content_show).show();
        return false;
    });
  });
  </script>


</head>

<body>

  <div id="site">

  <div style="border-bottom: 1px solid #DDD; margin-bottom: 20px; ">
    <div class="left" style="width: 300px;">
      <div id="topo">
        <h1 id="logo"><a href="<?php echo SITE_URL; ?>/">MyLife</a><small><sup>{Beta}</sup></small> </h1>
        <span>Gerenciando sua vida</span>
      </div><!-- #topo -->
    </div>
    <div class="right" style="padding-top: 20px;">
      <div id="nav-bar">
        <ul>
          <li><a href="<?php echo SITE_URL; ?>/tarefas">Tarefas</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas">Finan&ccedil;as</a></li>
        </ul>
      </div><!-- #nav-bar -->
    </div>
    <div class="clear"></div>

  </div>
