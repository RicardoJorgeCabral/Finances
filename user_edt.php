<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once '.dat/config.php';
require_once '.dat/funcs.php';
require_once '.classes/user.php';

session_start();
$userName = valid_session();
if (strlen($userName) < 1) {
  logout();
}

if (is_admin()==0) {
  main_form();
}

( (isset($_GET["id"])) && (strlen($_GET["id"])>0) ) ? $pID = filter_var($_GET["id"]) : $pID = 0;



if ($pID == 0) {
  main_form();
}

$user = new user(0,null,null,null,null);
$user->getByID($pID);

if ($user->getId()==0) {
  main_form();
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
        <div class="div_topmenu">
          <table border=0">            
            <tr>
              <td><a href=""><img src="img/check.png" width="30" height="30" /></a></td>
              <td><div class="responseButton"><a href="">Guardar</a></div></td>
              <td><a href=""><img src="img/cross.png" width="30" height="30" /></a></td>
              <td><div class="responseButton"><a href="">Eliminar</a></div></td>
              <td><a href="users.php"><img src="img/exit_door.png" width="30" height="30" /></a></td>
              <td><div class="responseButton"><a href="main.php">Sair</a></div></td>
            </tr>
          </table>
        </div>        
          <hr>
          <form name="form1" action="user_edt" method="POST">
            <table border="0" cellpadding="2">
              <tr>
                <td>Login:</td>
                <td><input type="text" name="txtLogin" value="<?php echo $user->getLogin(); ?>" size="20" readonly="readonly" /></td>                
              </tr>
              <tr>
                <td>Nome:</td>
                <td><input type="text" name="txtNome" value="<?php echo $user->getName(); ?>" size="80" /></td>
              </tr>
              <tr>
                <td>Mudar Password:</td>
                <td><input type="password" name="txtPasswd" value="" size="80" /></td>
              </tr>
              <tr>
                <td>Repetir Password:</td>
                <td><input type="password" name="txtPasswd1" value="" size="80" /></td>
              </tr>
              <tr>
                <td>Notas:</td>
                <td><textarea name="txtNotas" rows="6" cols="80"><?php echo $user->getNotes(); ?>
                  </textarea> 
                  <input type="hidden" name="txtID" value="<?php echo $user->getId(); ?>" />
                </td>
              </tr>
            </table>
            
          </form>
          Content goes here...
          <?php
          // put your code here
          ?>
        </div>
      </div>    
    </div>
    <?php get_div_footer(); ?>
  </body>
</html>