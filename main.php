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
      <?php get_div_left_nav($userName); ?>
      <div>
        <?php get_div_menu(); ?>
        <div class="content">
          Content goes here...
      <?php
      // put your code here
      ?>
        </div>
      </div>
    <?php get_div_footer(); ?>
    </div>
  </body>
</html>
