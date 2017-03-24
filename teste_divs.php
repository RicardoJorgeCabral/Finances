<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once '.dat/config.php';
require_once '.dat/funcs.php';
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php print WEB_TITLE; ?></title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
  </head>
  <body>    
    <div class="header1"> HEADER </div>
    <div class="master_container">     
      <div class="leftnav"> Painel da esquerda<br /> </div>
      <div class="center_div">
        <?php get_div_menu(); /* topnav */?>
        <div class="content">
          Content goes here...<br />
          <?php for ($i=0;$i<20;$i++) { print "XXX<br />"; } ?> 
        </div>
      </div>      
    </div> 
    <div class="footer1">RODAPÉ</DIV>
  </body>
</html>
