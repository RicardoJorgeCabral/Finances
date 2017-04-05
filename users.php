<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once '.dat/config.php';
require_once '.dat/funcs.php';

session_start();
$userName = valid_session();
if (strlen($userName)<1) {
  logout();
}
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php print WEB_TITLE; ?></title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php get_div_header(); ?>
    <div class="master_container">      
      <!-- SIDEBAR ---------------------------------------------------------------------------->
      <div class="leftnav">
        <p>Autenticado como <?php echo $userName; ?>.</p>
        <?php get_div_menu(); ?>
        
      </div>
      <!-- SIDEBAR ---------------------------------------------------------------------------->
      <div class="center_div">
        <div class="content">        
        <?php
        // put your code here        
        $userLogin = filter_var($_SESSION["ULOGIN"]);
        $userID = filter_var($_SESSION["UID"]);        
        if ($userLogin=="admin") {
          // Going to show all the users and edit and change them.
        ?>
        <div class="div_topmenu">
          <table border=0">            
            <tr>
              <td><a href="user_add.php"><img src="img/add.jpg" width="30" height="30" /></a></td>
              <td><div class="responseButton"><a href="user_add.php">Adicionar</a></div></td>
              <td><a href="main.php"><img src="img/exit_door.png" width="30" height="30" /></a></td>
              <td><div class="responseButton"><a href="main.php">Sair</a></div></td>
            </tr>
          </table>
        </div>          
          <hr>
          <table border="0" cellpadding="2">
                <tr>
                  <td class="table_title" colspan="4">Lista de Utilizadores</td>
                </tr>
                <tr>
                  <td class="table_header">&nbsp;</td>                  
                  <td class="table_header">Login
                    <a href="users.php?order=1&type=1"><img src="img/arrow_down.png" width="13" height="13" /></a>
                    <a href="users.php?order=1&type=0"><img src="img/arrow_up.png" width="13" height="13" /></a>                    
                  </td>
                  <td class="table_header">Nome
                    <a href="users.php?order=2&type=1"><img src="img/arrow_down.png" width="13" height="13" /></a>                    
                    <a href="users.php?order=2&type=0"><img src="img/arrow_up.png" width="13" height="13" /></a>
                  </td>
                  <td class="table_header">Notas</td>
                </tr>
                <?php                
                $sqlstm = "SELECT * FROM users ORDER BY ";
                $order=0;
                $type=1;
                if (isset($_GET["order"])) {
                  $order = filter_input(INPUT_GET,"order");
                }
                if (isset($_GET["type"])) {
                  $type = filter_input(INPUT_GET,"type");
                }
                
                switch ($order) {
                  case 0 : $sqlstm.=" login"; break;
                  case 1 : $sqlstm.=" login"; break;
                  case 2 : $sqlstm.=" name"; break;
                }
                
                switch ($type) {
                  case 1 : $sqlstm.=" ASC"; break;
                  case 0 : $sqlstm.=" DESC"; break;
                }
                
                
                $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER , DB_PASSWORD);
                $query = $pdo->query($sqlstm);
                foreach ($query as $row) {
                  print "<tr>\n";
                  print "<td><a href=\"user_edt.php?id=$row[0]\"><img src=\"img/edit.gif\" /></a></td><td>$row[1]</td><td>$row[3]</td><td>$row[4]</td>\n";
                  print "</tr>\n";
                }
                $query=null;
                $pdo=null;
                ?>
            </table>

        <?php
        }
        else {
          // Only manages the current user (Password,  Name, Notes)
          // Maybe redirect to a page with predefined data
        }
        ?>
        </div>
      </div>
    </div>
    <?php get_div_footer(); ?>
  </body>
</html>

