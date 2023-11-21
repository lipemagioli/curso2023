<?php

/*
 *  @copyright  Copyright 2018 
 *  @author  Cesar Moreira Ribeiro
 *  @author  Moraes Caixeta
 *  @version 1
 *  @link https://github.com/cmr/controleestoque GitHub
 */

require_once "../dao/user_dao.php";
include('../controller/user_controller.php');

if (!isAdmin()) {
    $_SESSION['msg'] = "É necessário fazer login antes!";
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Página Inicial Administrador</title>
        <link rel="stylesheet" type="text/css" href="../util/css/style.css">
        <link rel="icon" type="image/png" href="../util/images/favicon.png">
        <link rel="stylesheet" href="../util/css/w3.css">
        <style>
            .header {
                background: #003366;
            }
            button[name=register_btn] {
                background: #003366;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h2>Página Inicial Administrador</h2>
        </div>
        <div class="content">
            <!-- Notificação -->
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="error success" >
                    <h3>
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>

            <!-- Info do usuário logado -->
            <div class="profile_info">
                <img src="../util/images/avatar1.png" alt="usuario" >

                <div>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <strong><?php echo $_SESSION['user']['username']; ?></strong>

                        <small>
                            <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
                        </small>
                        <div class="w3-center">
                            <div class="w3-bar">
                                <a href="home.php?logout='1'" style="color: red;"><button class="w3-button w3-red">sair</button></a>
                                <a href="register.php"><button class="w3-button w3-blue">+ adicionar usuário</button></a>
                                <a href="home_user.php"><button class="w3-button w3-teal">acessar sistema</button></a>
                            </div>
                        </div>

                    <?php endif ?>
                </div>
            </div>



        </div>

    </body>
</html>