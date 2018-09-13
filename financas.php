<?php

  // Pega o mes selecionado
  $mes_url = $url[2];


  // pega qual o projeto selecionado para passar as variaveis pelo metodo GET
  // por padrao seleciona o projeto diversos
  if(empty($mes_url))
  {
    $mes_url = get_mes(date("m"));
    $PAGINA_URI = SITE_URL . '/financas/';
  }
  else
  {
    $PAGINA_URI = SITE_URL . '/financas/' . $mes_url;
  }


?>

    <!-- Mensagens ao usuario -->
     <?php include_once("msgs.php"); ?>

      <div class="top">

          <div class="left">
            <h3 class="titulo-projeto"><?php echo ucfirst($pagina); ?></h3>
          </div>

          <div class="right">
              <ul>
                <li><a href="">In&iacute;cio</a></li>
              </ul>
          </div>
          <div class="clear"></div>
      </div>


      <div class="comandos">
        <div id="tarefas">
          <form action="<?php echo SITE_URL; ?>/financas-action.php?acao=inserir" method="post" >
              <input type="hidden" name="pagina_uri" value="<?php echo $PAGINA_URI; ?>"  />

              <div class="left" style="margin-right: 10px;">
                <label>Lan&ccedil;amento</label>
                <select name="lancamento" size="1" class="campos">
                  <option value="1" >Credito</option>
                  <option value="2" selected="selected">Debito</option>
                </select>
              </div>
              <div class="left" style="margin-right: 10px;">
                <label>Data</label>
                <input name="data" id="prazo2" value="<?php echo date("d/".financas_get_mes($mes_url)."/Y"); ?>" class="campos" size="10" />
              </div>
              <div class="left" style="margin-right: 10px;">
                <label>Descri&ccedil;&atilde;o</label>
                <input type="text" name="descricao" size="50" class="campos" />
              </div>
              <div class="left" style="margin-right: 10px;">
                <label>Categoria</label>
                <input type="text" name="categoria" id="categoria" class="campos" />
                <input type="hidden" name="id_categoria" id="id_categoria" />
              </div>
              <div class="left">
                <label>Valor</label>
                <input type="text" name="valor" size="10" class="campos" />
              </div>
              <div class="left">
                <label>&nbsp;</label>
                <input type="submit" name="" value="Ok" class="button gray medium" />
              </div>
              <div class="clear"></div>

        </div><!-- /tarefas -->

      </div><!-- #comandos -->

      <!-- Menu de meses -->
      <div class="" style="margin: 0px 0;">
        <ul class="meses">
          <li><a href="<?php echo SITE_URL; ?>/financas/janeiro" <?php echo menu_select('janeiro',$mes_url); ?> >Janeiro</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas/fevereiro" <?php echo menu_select('fevereiro',$mes_url); ?>>Fevereiro</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas/marco" <?php echo menu_select('marco',$mes_url); ?>>Mar&ccedil;o</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas/abril" <?php echo menu_select('abril',$mes_url); ?>>Abril</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas/maio" <?php echo menu_select('maio',$mes_url); ?>>Maio</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas/junho" <?php echo menu_select('junho',$mes_url); ?>>Junho</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas/julho" <?php echo menu_select('julho',$mes_url); ?>>Julho</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas/agosto" <?php echo menu_select('agosto',$mes_url); ?>>Agosto</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas/setembro" <?php echo menu_select('setembro',$mes_url); ?>>Setembro</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas/outubro" <?php echo menu_select('outubro',$mes_url); ?>>Outubro</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas/novembro" <?php echo menu_select('novembro',$mes_url); ?>>Novembro</a></li>
          <li><a href="<?php echo SITE_URL; ?>/financas/dezembro" <?php echo menu_select('dezembro',$mes_url); ?>>Dezembro</a></li>
        </ul>
      </div>

<?php

  // Responsavel pelas consultas
  include("financas-action.php");

?>

      <div class="conteudo">
        <table id="tb-geral">
          <thead>
            <tr>
              <td>D/C</td>
              <td>Descri&ccedil;&atilde;o</td>
              <td>Data / Venc.</td>
              <td>Categoria</td>
              <td>Valor (R$)</td>
              <td colspan="3">A&ccedil;&atilde;o</td>
            </tr>
          </thead>

          <tbody>
          <?php
            //entradas
            $C_total = 0;
            $D_total = 0;
            while($row = mysql_fetch_assoc($result)){
          ?>
          <tr>
            <td style="width: 10px;"><?php echo financas_dc_status($row['lancamento']); ?></td>
            <td style="width: 400px;"><?php echo $row['descricao']; ?></td>
            <td style="width: 90px;"><?php echo data_ajustar($row['data']); ?></td>
            <td style="width: 90px;"><?php echo financas_categorias_getnome($row['id_financas_cat']); ?></td>
            <td style="width: 70px;"><?php echo moeda($row['valor']); ?></td>
            <td width="5"><a class="link" href="<?php echo SITE_URL; ?>/financas-edit.php?id=<?php echo $row['id_financas']; ?>&url=<?php echo url_sem_espaco($PAGINA_URI); ?>" ><img src="<?php echo SITE_URL; ?>/images/acao-edit.png" title="Editar" /></a></td>
            <td width="5"><a href="javascript:void();" onclick="javascript:confirma('<?php echo SITE_URL; ?>/financas-action.php?acao=deletar&id=<?php echo $row['id_financas']; ?>&pagina_uri=<?php echo $PAGINA_URI; ?>');" ><img src="<?php echo SITE_URL; ?>/images/acao-del.gif" title="Deletar" /></a></td>
          </tr>
          <?php

            // soma os creditos
            if($row['lancamento'] == 1){
              $C_total = $C_total + $row['valor'];
            }
            //soma os debitos
            if($row['lancamento'] == 2){
              $D_total = $D_total + $row['valor'];
            }

            } //while
          ?>
          <!-- Entradas -->
           <tr style="background: #F7F7F7; font-weight: bold; color: #009900; ">
             <td colspan="4"><p style="text-align: right">Total Entradas</p></td>
             <td><?php echo moeda($C_total); ?></td>
             <td colspan="3" rowspan="2" style="color: #0066CC"><strong><?php echo moeda($C_total - $D_total); ?></strong></td>
           </tr>

           <!-- Saidas -->
           <tr style="background: #F7F7F7; font-weight: bold; color: #CC0000;">
             <td colspan="4"><p style="text-align: right">Total Saidas</p></td>
             <td><?php echo moeda($D_total); ?></td>
           </tr>

          </tbody>
        </table>
      </div>