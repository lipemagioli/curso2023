<?php
require_once "dao/user_dao.php";
include('controller/user_controller.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "É necessário logar primeiro!";
    header('location: view/login.php');
}

if (isAdmin()) {
    header('location: view/home.php');
} else {
    header('location: view/home_user.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inicial</title>
    </head>
    <body>
        <div class="header">
            <h2>Página Inicial</h2>
        </div>
        <div class="content">
        </div>
    </body>
</html>