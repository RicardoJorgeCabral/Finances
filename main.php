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
if (strlen($userName)<1) 
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php print $web_title; ?></title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php get_div_header(); ?>
    <div class="master_container">      
      <div class="leftnav">
        <p>Bemvindo, <?php echo $userName; ?>.</p>
        <div class="responseButton">
        <a href="logout.php">Sair</a>
        </div>
      </div>
      <div class="topnav" id="myTopnav">
        <a href="movements.php">Movements</a>
        <a href="users.php">Users</a>
        <a href="logout.php">Logout</a>
      </div>
    <?php
    // put your code here
    ?>
    <?php get_div_footer(); ?>
    </div>
  </body>
</html>
