<?php
require_once 'config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_div_header() {
    print "<div class=\"header1\">\n";
    print "Financial Manager\n";
    print "</div>\n";
}

function get_div_footer() {
    print "<div class=\"footer1\">\n";
    print "2017 - Ricardo Cabral &copy;\n";
    print "</div>\n";
}



function logout() {
  header("Location: logout.php");
  die();
}
?>