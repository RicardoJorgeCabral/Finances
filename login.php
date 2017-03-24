<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '.dat/config.php';
require_once '.dat/funcs.php';

$user = filter_input(INPUT_POST,"txtLogin");
$passwd = filter_input(INPUT_POST,"txtPasswd");

$hash = md5($passwd);
$passwd = null;

$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER , DB_PASSWORD);
$query = $pdo->prepare("SELECT * FROM users WHERE login=? AND passwd=?");
$query->execute([$user,$hash]);
if ($row = $query->fetch()) {
    $loc = "Location: main.php";
    session_start();
    $_SESSION["UID"] = $row[0];
    $_SESSION["ULOGIN"] = $row['login'];
}
else {
    $loc = "Location: index.php?LoginError=1";
}
$pdo = null;
$query = null;
header($loc);
die();
?>
