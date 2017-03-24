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
        <div class="master_container">
        <?php get_div_header(); ?>
        <?php
        // put your code here
        ?>
            <div align="center" style="padding: 100px 30px 100px 30px;">
        <form action="login.php" method="POST">
            <table border="0" style="font-size: 16pt">               
                <tbody>
                    <tr>
                        <td>Login:</td>
                        <td><input type="text" name="txtLogin" value="" size="20" /> </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="txtPasswd" value="" size="20" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Login" name="btLogin" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <div style="color: red; font-weight: bold;">
                            <?php
                            if (isset($_GET["LoginError"])) {
                                if ( filter_input(INPUT_GET,"LoginError") == 1) {
                                    print "Acesso negado!";
                                }
                                else {
                                    print "&nbsp;";
                                }
                            }
                            else {
                                print "&nbsp;";
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
            </div>
            <?php get_div_footer(); ?>
        </div>
    </body>
</html>
