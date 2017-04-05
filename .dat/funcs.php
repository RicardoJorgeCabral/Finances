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

function get_div_left_nav($user_name) {
  print "<div class=\"leftnav\">\n";
  print "<p>Bemvindo, $user_name.</p>\n";
  //print "<div class=\"responseButton\">\n";
  //print "<a href=\"logout.php\">Sair</a>\n";
  //print "</div>\n";
  print "</div>\n";
}

function get_div_menu() {
  print "<div class=\"topnav\" id=\"myTopnav\">\n";
  print "<table>\n";
  print "<tr><td><a href=\"movements.php\">Movements</a></td></tr>\n";  
  print "<tr><td><a href=\"users.php\">Users</a></td></tr>\n";
  print "<tr><td><a href=\"logout.php\">Logout</a></td></tr>\n";
  print "</table>\n";
  print "</div>\n";
}

function valid_session() {
  $valid = "";
  if (isset($_SESSION["UID"])) {
    $user_id = filter_var($_SESSION["UID"]);
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
    $query = $pdo->prepare("SELECT name FROM users WHERE id=?");
    $query->execute([$user_id]);
    if ($row = $query->fetch()) {
      $valid=$row["name"];
    }
    $pdo=null;
    $query=null;
  }
  return $valid;
}

function is_admin() {
  $ok = 0;
  if (isset($_SESSION["UID"])) {
    $user_id = filter_var($_SESSION["UID"]);
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
    $query = $pdo->prepare("SELECT login FROM users WHERE id=?");
    $query->execute([$user_id]);
    if ($row = $query->fetch()) {
      (strcasecmp($row["login"],"admin")==0) ? $ok=1 : $ok=0;
    }
    $pdo=null;
    $query=null;
    
  }
  return $ok;
}

function logout() {
  redirect("logout.php");
}

function main_form() {
  redirect("main.php");
}

function show_message($msg) {
  $out = "<script>alert(\"".$msg."\");</script>";
  print $out;
}

function redirect($page) {
  header("Location: ".$page);
  die();
}
?>