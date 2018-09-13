<div id="corpo">

      <div class="top">

          <div class="left">
            <h2>Projetos</h2>
          </div>

          <div class="right">
              <ul>
                <li><a href="#">In&iacute;cio</a></li>
                <li><a href="#info">Projetos</a></li>
                <li><a href="">Configura&ccedil;&otilde;es</a></li>
              </ul>
          </div>
          <div class="clear"></div>
      </div>


      <div class="comandos">

       <?php if(isset($_GET['editar'])){ ?>
        <?php
           $id = $_GET['id'];
           $row = mysql_fetch_row(mysql_query("SELECT * FROM tarefas_projetos WHERE id_projetos = '$id'"));
        ?>
          <form action="" method="post" >
            <p>
              <label>Projeto</label>
              <input type="text" name="projeto" value="<?php echo $row[1] ?>"  />
            </p>
            <p>
              <label>Cass CSS</label>
              <input type="text" name="class" value="<?php echo $row[2] ?>"  />
            </p>
            <p>
              <label>Status</label>
              <select name="status">
                <option value="<?php echo $row[3] ?>"><?php echo $row[3] ?></option>
                <option value="1">Ativo</option>
                <option value="2">Finalizado</option>
                <option value="0">Desabilitado</option>
              </select>
            </p>

            <input type="text" name="" class="campos" size="90" />
            <input type="submit" name="" value="Ok" class="button gray medium" />
          </form>
        <?php } ?>

      </div><!-- #comandos -->

      <?php

        include("incs/conexao.php");
        include("incs/function.php");

        $result = mysql_query("SELECT * FROM tarefas_projeto ");

      ?>

      <div class="conteudo">
        <table id="tb-principal">
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
            <td width="5"><a rel="facebox" href="?editar&id=<?php echo $row['id_projeto']; ?>" >[Editar]</a></td>
          </tr>
          <?php
            } //while
          ?>

          </tbody>
        </table>
      </div>

</div>