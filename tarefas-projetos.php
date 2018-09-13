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


?>

<div id="corpo">

      <div class="top">

          <div class="left">
            <h2>Projetos</h2>
          </div>

          <div class="right">
              <ul>
                <li><a href="<?php echo SITE_URL; ?>/tarefas">Voltar</a></li>
              </ul>
          </div>
          <div class="clear"></div>
      </div>




       <?php if(isset($_GET['editar'])){ ?>
        <?php

           $id = $_GET['id'];
           $row_e = mysql_fetch_row(mysql_query("SELECT * FROM tarefas_projeto WHERE id_projeto = '$id'"));
        ?>
         <div class="comandos">
          <form class="frm-geral"  action="<?php echo SITE_URL; ?>/tarefas-action.php?acao=editar-projeto" method="post" >

            <input type="hidden" name="id" value="<?php echo $row_e[0] ?>"  />

            <div class="left" style="margin-right: 10px;">
              <label>Projeto</label>
              <input type="text" name="projeto" value="<?php echo $row_e[1] ?>" class="campos" />
            </div>
            <div class="left" style="margin-right: 10px;">
              <label>Cass CSS</label>
              <input type="text" name="class" value="<?php echo $row_e[2] ?>" class="campos" />
            </div>
            <div class="left" style="margin-right: 10px;">
              <label>Status</label>
              <select name="status" class="campos">
              <?php
                if($row_e[3] == 1){
                  echo '<option value="1" selected="selected"> Ativar </option>';
                  echo '<option value="2" > Desativar </option>';
                }else{
                  echo '<option value="1" > Ativar </option>';
                  echo '<option value="2" selected="selected"> Desativar </option>';
                }
              ?>
              </select>
              <input type="submit" name="" value="Gravar" class="button gray medium" />
            </div>

            <div class="clear"></div>
          </form>
          </div><!-- #comandos -->
        <?php }else{ ?>
         <div class="comandos">
          <form class="frm-geral" action="<?php echo SITE_URL; ?>/tarefas-action.php?acao=inserir-projeto" method="post" >

            <div class="left" style="margin-right: 10px;">
              <label>Projeto</label>
              <input type="text" name="projeto" value="" class="campos" />
            </div>
            <div class="left" style="margin-right: 10px;">
              <label>Cass CSS</label>
              <input type="text" name="class" value="" class="campos" />
            </div>
            <div class="left" style="margin-right: 10px;">
              <label>Status</label>
              <select name="status" class="campos">
                <option value="1"> Ativar </option>
                <option value="2"> Desativar </option>
              </select>
              <input type="submit" name="" value="Inserir" class="button gray medium" />
            </div>

            <div class="clear"></div>
          </form>
          </div><!-- #comandos -->
        <?php } ?>


      <?php

        $result = mysql_query("SELECT * FROM tarefas_projeto ");

      ?>

      <div class="conteudo">
        <table id="tb-geral">
          <thead>
            <tr>
              <td>id</td>
              <td>Projeto</td>
              <td>Class CSS</td>
              <td>Status</td>
              <td colspan="2">A&ccedil;&otilde;es</td>
            </tr>
          </thead>

          <tbody>
          <?php
            while($row = @mysql_fetch_assoc($result)){
          ?>
          <tr>
            <td><?php echo $row['id_projeto']; ?></td>
            <td><?php echo $row['projeto']; ?></td>
            <td><?php echo $row['class']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td width="5"><a class="facebox" href="<?php echo SITE_URL; ?>/tarefas-projetos.php?editar&id=<?php echo $row['id_projeto']; ?>" ><img src="<?php echo SITE_URL; ?>/images/acao-edit.png" title="Editar" /></a></td>
            <td width="5"><a href="javascript:void();" onclick="javascript:confirma('<?php echo SITE_URL; ?>/tarefas-action.php?acao=excluir-projeto&id=<?php echo $row['id_projeto']; ?>');"><img src="<?php echo SITE_URL; ?>/images/acao-del.gif" title="Deletar" /></a></td>

          </tr>
          <?php
            } //while
          ?>

          </tbody>
        </table>
      </div>

</div>