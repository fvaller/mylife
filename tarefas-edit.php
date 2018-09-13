<script language="JavaScript" type="text/javascript">
  $(document).ready(function(){

    $(".facebox").colorbox({width:"750px"});

    $("#prazo").datepicker($.datepicker.regional['pt-BR']);

    $("#n").click(function(){
       $("#display-note").css("display", "block");
    });

  });

</script>

<script language="JavaScript" type="text/javascript">
  function limp(){
    document.frm.prazo.value='';
  }
</script>

<?php
  //necesario pelo ajax
  define("SITE_URL", 'http://localhost/mylife');
  include_once("incs/conexao.php");
  include_once("incs/function.php");

  $PAGINA_URI = url_sem_espaco($_GET['url'],2);


?>

<div id="corpo">

      <div class="top">

          <div class="left">
            <h2>Tarefas</h2>
          </div>

          <div class="right">
              <ul>
                <li><a href="<?php echo SITE_URL; ?>/tarefas">Voltar</a></li>
              </ul>
          </div>
          <div class="clear"></div>
      </div>


        <div class="comandos">
        <?php
           $id = $_GET['id'];
           $dados = mysql_fetch_row(mysql_query("SELECT * FROM tarefas WHERE id_tarefas = '$id'"));
        ?>
          <form class="frm-geral" action="<?php echo SITE_URL; ?>/tarefas-action.php?acao=editar" name="frm" method="post" >
            <input type="hidden" name="id" value="<?php echo $dados[0]; ?>"  />
            <input type="hidden" name="pagina_uri" value="<?php echo $PAGINA_URI; ?>"  />

            <p>
              <label>Tarefa</label>
              <input type="text" name="tarefa" id="f" class="campos" size="100%" value="<?php echo $dados[2]; ?>" style="" />
            </p>
            <div class="left mr20">
              <p>
                <label>Projetos</label>
                <select name="projeto" class="campos" style="min-width: 200px;">
                <option selected="selected" value="<?php echo $dados[1]; ?>" ><?php echo tarefas_projetos_get($dados[1],1); ?></option>
                <?php echo tarefas_projetos_list('option'); ?>
                </select>
              </p>
            </div>
            <div class="left mr20">
              <p>
                <label>Prazo </label>
                <input type="text" name="prazo" id="prazo" class="campos" readonly="readonly" size="20" value="<?php echo formata_data($dados[5]); ?>" /><br />
                <a style="color: #444;text-decoration: none; font-size: 10px;" href="javascript:void(0);" onclick="javascript:limp();">^ Limpar</a>

              </p>
            </div>
            <div class="left mr20">
              <p>
                <label>Prioridade</label>
                <select name="prioridade" class="campos">
                  <option selected="selected" value="<?php echo $dados[6]; ?>" ><?php echo $dados[6]; ?></option>
                  <option value="" >Sem</option>
                  <option value="1" >Importante</option>
                  <option value="2" >Urgente</option>
                  <option value="3" >Circustancial</option>
                </select>
              </p>
            </div>
            <div class="left">
              <p>
                <label>Status</label>
                <select name="status" class="campos">
                  <option selected="selected" value="<?php echo $dados[3]; ?>" ><?php echo $dados[3]; ?></option>
                  <option value="1" >Pendente</option>
                  <option value="2" >Resolvido</option>
                </select>

              </p>
            </div>
            <div class="clear"></div>
            <?php
              $aux = tarefas_notas_get($dados[0]);
              if($aux != ''){
            ?>
              <p>
                <label>Nota</label>
                <textarea name="notatarefa" style="width: 520px; height: 100px;" ><?php echo tarefas_notas_get($dados[0]); ?></textarea>
              </p>
            <?php }else{ ?>
            <p>
              <a href="javascript:void(0);" id="n" style="color: #555;text-decoration: none;vertical-align: middle">
                <img src="<?php echo SITE_URL; ?>/images/add.png" width="12" height="12" alt="" style="" /> Adicionar Nota
              </a>
            </p>

            <p style="display: none" id="display-note">
              <label>Nota</label>
              <textarea name="notatarefa" style="width: 520px; height: 100px;" ><?php echo nl2br(tarefas_notas_get($dados[0])); ?></textarea>
            </p>
            <?php } ?>

            <p><hr /><input type="submit" name="" value=" Gravar " class="button gray medium" /></p>
          </form>

        </div>

</div>