<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        /* teste */
        require_once '.dat/config.php';
require_once '.dat/funcs.php';

$input_array = filter_input_array(INPUT_POST);

$passwd = filter_input(INPUT_POST,"txtPasswd");
$user = filter_input(INPUT_POST,"txtLogin");

$hash = md5($passwd);

print "Login: $user <br />";
print "Password: $hash <br />";


$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$query = $pdo->prepare("SELECT * FROM users WHERE login=? AND passwd=?");
$query->execute([$user,$hash]);
if ($row = $query->fetch()) { 
    print "Login ok! <br />";
}
else {
    print "Login falhou! <br />";
} 
        ?>
    </body>
</html>
