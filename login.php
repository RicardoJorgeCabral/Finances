<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '.dat/config.php';
require '.dat/funcs.php';

$user = filter_input(INPUT_POST,"txtLogin");
$passwd = filter_input(INPUT_POST,"txtPasswd");

$hash = md5($passwd);
$passwd = null;

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$query = $pdo->prepare("SELECT * FROM users WHERE login=? AND passwd=?");
$query->execute([$user,$hash]);
if ($row = $query->fetch()) {
    $loc = "Location: main.php";
    session_start();
    $_SESSION["UID"] = $row[0];
}
else {
    $loc = "Location: index.php?LoginError=1";
}
$pdo = null;
$query = null;
header($loc);
die();
?>
