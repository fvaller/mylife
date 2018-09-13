<script language="JavaScript" type="text/javascript">
  $(document).ready(function(){

    $(".facebox").colorbox({width:"750px"});

    $("#prazo").datepicker($.datepicker.regional['pt-BR']);

  });

</script>

<?php
  //necesario pelo ajax
  define("SITE_URL", 'http://localhost/mylife');
  include_once("incs/conexao.php");
  include_once("incs/function.php");

  $PAGINA_URI = url_sem_espaco($_GET['url'],2);

  $id_tarefa = $_GET['id'];

?>

<div id="corpo">

        <div class="comandos">

          <form class="frm-geral" action="<?php echo SITE_URL; ?>/tarefas-action.php?acao=editar" name="frm" method="post" >
            <input type="hidden" name="id" value=""  />
            <input type="hidden" name="pagina_uri" value=""  />

            <p>
              <label>Nota</label>
              <textarea name="notatarefa" style="width: 520px; height: 100px;" ><?php echo tarefas_notas_get($id_tarefa)  ?></textarea>
            </p>

            <p><input type="submit" name="" value="Ok" class="button gray medium" /></p>
          </form>

        </div>

</div>