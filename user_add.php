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
if (strlen($userName)<1) {
  logout();
}
if (is_admin()==0) {
  main_form();
}

( (isset($_POST["txtOp"])) && (strlen($_POST["txtOp"])>0) ) ? $pOp = filter_var($_POST["txtOp"]) : $pOp = "";
( (isset($_POST["txtLogin"])) && (strlen($_POST["txtLogin"])>0) ) ? $pLogin = filter_var($_POST["txtLogin"]) : $pLogin = "";
( (isset($_POST["txtNome"])) && (strlen($_POST["txtNome"])>0) ) ? $pNome = filter_var($_POST["txtNome"]) : $pNome = "";
( (isset($_POST["txtPasswd"])) && (strlen($_POST["txtPasswd"])>0) ) ? $pPasswd = filter_var($_POST["txtPasswd"]) : $pPasswd = "";
( (isset($_POST["txtPasswd1"])) && (strlen($_POST["txtPasswd1"])>0) ) ? $pPasswd1 = filter_var($_POST["txtPasswd1"]) : $pPasswd1 = "";
( (isset($_POST["txtNotas"])) && (strlen($_POST["txtNotas"])>0) ) ? $pNotas = filter_var($_POST["txtNotas"]) : $pNotas = "";
  
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
              <td><a href="javascript:{}" onclick="document.getElementsByName('form1')[0].submit(); return false;"><img src="img/check.png" width="30" height="30" /></a></td>
              <td><div class="responseButton"><a href="javascript:{}" onclick="document.getElementsByName('form1')[0].submit(); return false;">Adicionar</a></div></td>
              <td><a href="main.php"><img src="img/exit_door.png" width="30" height="30" /></a></td> 
              <td><div class="responseButton"><a href="users.php">Sair</a></div></td>
            </tr>
          </table>
        </div>   
          <hr>
          <form action="user_add.php" name="form1" method="POST">
            <table border="0" cellpadding="2">
              <tr>
                <td>Login:</td>
                <td><input type="text" name="txtLogin" value="<?php echo $pLogin; ?>" size="20" /></td>                
              </tr>
              <tr>
                <td>Nome:</td>
                <td><input type="text" name="txtNome" value="<?php echo $pNome; ?>" size="80" /></td>
              </tr>
              <tr>
                <td>Password:</td>
                <td><input type="password" name="txtPasswd" value="" size="80" /></td>
              </tr>
              <tr>
                <td>Repetir Password:</td>
                <td><input type="password" name="txtPasswd1" value="" size="80" /></td>
              </tr>
              <tr>
                <td>Notas:</td>
                <td><textarea name="txtNotas" rows="6" cols="80"><?php echo $pNotas; ?>
                  </textarea> 
                  <input type="hidden" name="txtOp" value="INS" />
                </td>
              </tr>
            </table>
          </form>
        </div>
      </div>    
    </div>
    <?php get_div_footer(); ?>
    <?php
    $ok = 0;
    if (strcmp($pOp,"INS")==0) {
      
      if (strlen($pLogin)==0) {
        show_message("O campo login é obrigatório...");
        print "<script>document.getElementsByName('txtLogin')[0].focus();</script>";
      }
      elseif (strlen($pPasswd)==0) {
        show_message("O campo password é obrigatório...");
        print "<script>document.getElementsByName('txtPasswd')[0].focus();</script>";
      }
      elseif (strlen($pNome)==0){
        show_message("O campo nome é obrigatório...");
        print "<script>document.getElementsByName('txtNome')[0].focus();</script>";        
      }
      elseif (strcmp($pPasswd,$pPasswd1)!=0) {
        show_message("As passwords não são iguais!");
      }
      else {
        $user = new user(0,$pLogin,$pPasswd,$pNome,$pNotas);
        if ($user->exists()!=0) {
          show_message("Já existe um login com o mesmo nome!");
        }
        else {
          $user->update();   
          redirect("users.php");
        }
      }
    }
    ?>
  </body>
</html>