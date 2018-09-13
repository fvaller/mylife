<?php

  // Pega o projeto selecionado
  $projeto_url = str_replace("%20", ' ', $url[2]); // removendo espaço
  if($projeto_url == '')
  {
    $projeto_url = 'diversos';
  }


  // pega qual o projeto selecionado para passar as variaveis pelo metodo GET
  // por padrao seleciona o projeto diversos
  if(empty($projeto_url))
  {
    $PAGINA_URI = SITE_URL . '/tarefas/diversos';
  }
  else
  {
    $PAGINA_URI = SITE_URL . '/tarefas/' . $projeto_url .'';
  }


?>

<?php

  // Responsavel pelas consultas
  include("tarefas-action.php");

?>
      <!-- Mensagens ao usuario -->
     <?php include_once("msgs.php"); ?>

     <div class="left">
       <div class="projetos">
         <h2></h2>
         <ul>
           <?php echo tarefas_projetos_list('li',$projeto_url); ?>
         </ul>
         <a href="<?php echo SITE_URL; ?>/tarefas-projetos.php" class="link" id="t-proj" >Add Projetos</a>
       </div>
     </div>


     <div class="right" style="width: 750px;">

       <div class="top">
         <div class="left">
           <h3 class="titulo-projeto"><?php echo ajuste_nomes($projeto_url); ?></h3>
         </div>

         <div class="right">
           <ul style="display: none">
             <li><strong>Exibir por:</strong></li>
             <li><a href="#">Todos</a></li>
             <li><a href="#">Prioridade</a></li>
             <li><a href="#">Nome</a></li>
             <li></li>
           </ul>
         </div>
       <div class="clear"></div>
       </div>

       <div class="box-tarefa">
          <div id="tarefas">
            <form action="<?php echo SITE_URL; ?>/tarefas-action.php?acao=inserir" method="post" >
              <input type="hidden" name="pagina_uri" value="<?php echo $PAGINA_URI; ?>"  />
              <input type="hidden" name="projeto" value="<?php echo tarefas_projetos_get_id($projeto_url); ?>"  />

              <div class="left" style="margin-right: 10px;">
                <label>Tarefa <small style="font-size: 9px; color: #444;">[Alt+1]</small></label>
                <input type="text" name="tarefa" id="t-focus" tabindex="1" class="field-tarefa campos"  /><br />
                <p style="display: block;"><a tabindex="2" style="color: #444; text-decoration: none;" href="<?php echo SITE_URL; ?>/tarefas-mais.php?&url=<?php echo url_sem_espaco($PAGINA_URI); ?>" class="link2" id="tmais"><img src="<?php echo SITE_URL; ?>/images/mais.png" width="16" height="16" style="vertical-align: middle;" />Mais dados</a> <small style="font-size: 9px; color: #444;">[Alt+2]</small></p>
              </div>
              <div class="ringt">
                <label>&nbsp;</label>
                <input type="submit" tabindex="3" name="" value="Ok" class="button gray medium" />
              </div>

              <div class="clear"></div>
            </form>
          </div>
        </div><!-- #comandos -->

      <div class="conteudo">
        <table id="tb-principal">
          <thead>
            <tr>
              <td colspan="2"><p style="text-align: left; padding-left: 10px">Tarefas</p></td>
              <td colspan="2">A&ccedil;&otilde;es</td>
            </tr>
          </thead>

          <tbody>
          <?php
            while($row = mysql_fetch_assoc($result)){
          ?>
          <tr>
            <td width="30"><a href="javascript:void();" onclick="javascript:ckeck('<?php echo SITE_URL; ?>/tarefas-action.php?acao=ckeck&id=<?php echo $row['id_tarefas']; ?>&pagina_uri=<?php echo $PAGINA_URI; ?>');" ><?php echo tarefas_status($row['status']); ?></a></td>
            <td >
              <div class="left"><p align="left"><?php echo $row['tarefa']; ?></p></div>
              <div class="right"><p style="font-size: 10px; color: #444; padding-right:10px;"><?php echo tarefas_data($row['prazo']); ?></p></div>
              <div class="clear"></div>
            </td>
            <td width="5"><?php echo tarefas_prioridade($row['prioridade']); ?></td>
            <td><?php echo tarefas_notas($row['id_tarefas']); ?></td>
            <td width="5"><a class="link" href="<?php echo SITE_URL; ?>/tarefas-edit.php?id=<?php echo $row['id_tarefas']; ?>&url=<?php echo url_sem_espaco($PAGINA_URI); ?>" ><img src="<?php echo SITE_URL; ?>/images/acao-edit.png" title="Editar" /></a></td>
            <td width="5"><a href="javascript:void();" onclick="javascript:confirma('<?php echo SITE_URL; ?>/tarefas-action.php?acao=deletar&id=<?php echo $row['id_tarefas']; ?>&pagina_uri=<?php echo $PAGINA_URI; ?>');" ><img src="<?php echo SITE_URL; ?>/images/acao-del.gif" title="Deletar" /></a></td>
          </tr>
          <?php
            } //while
          ?>

          </tbody>
        </table>

      </div><!-- /conteudo -->

      <br />
      <div class="info">

        <?php if(($projeto_url != 'hoje') AND ($projeto_url != 'proximos')){ ?>

        <span><a href="<?php echo SITE_URL; ?>/tarefas-check.php?projeto_url=<?php echo url_sem_espaco($projeto_url); ?>&pagina_uri=<?php echo url_sem_espaco($PAGINA_URI); ?>" class="link">Tarefas resolvidas <?php echo tarefas_projeto_cont(tarefas_projetos_get_id($projeto_url),2) ?></a></span>

        <?php } ?>

      </div>


      </div><!-- /right -->

      <div class="clear"></div>