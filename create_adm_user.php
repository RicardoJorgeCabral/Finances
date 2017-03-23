<html>
    <head>
        <title>Init app...</title>
    </head>
    <body>
        <div><b>App Init..</b></div>
        <div>
<?php

require_once '.dat/config.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $count = $pdo->query("SELECT COUNT(*) FROM users WHERE login='admin'")->fetchColumn();
    if ($count>0) {
        /*
         * User exists... Do nothing.
         */
        echo "Ok ... <br />";
    }
    else {
        /*
         * admin does not exists.. create it!!
         */       
        $sql = "INSERT INTO users (login,passwd,name,notes) "
             . "VALUES ('admin','".md5('admin')."','Administrator','App Administrator.')";
        $pdo->prepare($sql)->execute();
        echo "Admin setted up!! <br />";
    }
    $pdo = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
        </div>
    </body>
</html>