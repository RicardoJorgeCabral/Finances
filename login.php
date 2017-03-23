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

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$query = $pdo->prepare("SELECT * FROM users WHERE login=? AND passwd=?");
$query->execute([$user,$hash]);
if ($row = $query->fetch()) {
    header("Location : app.php");
    die();
}
else {
    header("Location: index.php?LoginError=1");
    die();
}
$pdo = null;
$query = null;
?>
