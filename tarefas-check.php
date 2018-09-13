<script language="JavaScript" type="text/javascript">
  $(document).ready(function(){
    $(".facebox").colorbox({width:"750px"});
  });
</script>

<?php
  //necesario pelo ajax
  define("SITE_URL", 'http://localhost/mylife');
  include_once("incs/conexao.php");
  include_once("incs/function.php");

  $projeto_url = url_sem_espaco($_GET['projeto_url'], 2);
  $PAGINA_URI  = url_sem_espaco($_GET['pagina_uri'],2);

?>
<div id="corpo">

      <div class="top">

          <div class="left">
            <h2 style="font-size: 18px;">Tarefas Resolvidas</h2>
          </div>

          <div class="right">
              <ul>
                <li><a href="<?php echo SITE_URL; ?>/tarefas">Voltar</a></li>
              </ul>
          </div>
          <div class="clear"></div>
      </div>

      <div class="conteudo">
          <table id="tb-geral">
            <thead>
              <tr>
                <td></td>
                <td>Descricao</td>
                <td>Status</td>
                <td>Projeto</td>
                <td>Data</td>
                <td>Triade</td>
                <td>Nota</td>
                <td colspan="2">A&ccedil;&otilde;es</td>
              </tr>
            </thead>
            <tbody>
            <?php
              $projeto_check = tarefas_projetos_get_id($projeto_url);
              $result_check = mysql_query("SELECT * FROM tarefas WHERE id_projeto = '$projeto_check' AND status = '2' ORDER BY id_tarefas DESC");
              while($row = @mysql_fetch_assoc($result_check)){
            ?>
            <tr>
              <td width="30"><a href="javascript:void();" onclick="javascript:ckeck('<?php echo SITE_URL; ?>/tarefas-action.php?acao=ckeck&id=<?php echo $row['id_tarefas']; ?>&pagina_uri=<?php echo $PAGINA_URI; ?>');" ><?php echo tarefas_status($row['status']); ?></a></td>
              <td><p align="left"><?php echo $row['tarefa']; ?></p></td>
              <td width="3"><?php echo $row['status']; ?></td>
              <td width="120"><?php echo tarefas_projetos_get($row['id_projeto'],1); ?></td>
              <td width="10"><?php echo formata_data($row['data']); ?></td>
              <td width="5"><?php echo tarefas_prioridade($row['prioridade']); ?></td>
              <td><?php echo tarefas_notas($row['id_tarefas']); ?></td>
              <td width="5"><a class="facebox" href="<?php echo SITE_URL; ?>/tarefas-edit.php?id=<?php echo $row['id_tarefas']; ?>&url=<?php echo url_sem_espaco($PAGINA_URI); ?>" ><img src="<?php echo SITE_URL; ?>/images/acao-edit.png" title="Editar" /></a></td>
              <td width="5"><a href="javascript:void();" onclick="javascript:confirma('<?php echo SITE_URL; ?>/tarefas-action.php?acao=deletar&id=<?php echo $row['id_tarefas']; ?>&pagina_uri=<?php echo $PAGINA_URI; ?>');" ><img src="<?php echo SITE_URL; ?>/images/acao-del.gif" title="Deletar" /></a></td>
            </tr>
            <?php
              } //while
            ?>

            </tbody>
          </table>

      </div>

</div>
