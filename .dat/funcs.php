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

function valid_session() {
  $valid = "";
  if (isset($_SESSION["UID"])) {
    $user_id = filter_var($_SESSION["UID"]);
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $query = $pdo->prepare("SELECT name FROM users WHERE id=?");
    $query->execute([$user_id]);
    if ($row = $query->fetch()) {
      $valid=$row['name'];
    }
    $pdo=null;
    $query=null;
    return $valid;
  }
}

function logout() {
  header("Location: logout.php");
  die();
}
?>