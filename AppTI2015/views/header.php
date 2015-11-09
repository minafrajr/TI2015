<?php require_once '../Data/init.php'; ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>AlertSistem - <?= $controller->getTela() ?: 'Bem vindo' ?></title>
        <meta charset="UTF-8">
        <meta name="description" content="Tela de login">
        <meta name="keywords" content="">
        <meta name="author" content="SAD Soluções Web">
        <link rel="stylesheet" type="text/css" href="/style/estilos.css">
    </head>

    <body>
        <?php require_once 'menu.php' ?>
        <div class="container">
            <div class="titulo">
                <?php if ($controller->getUsuario() !== null): ?>
                    <span class="icone-menu">...</span>
                <?php endif ?>
                <h1>
                    <?= $controller->getTela() ?: 'AlertSistem' ?>
                </h1>
            </div>
            <?php require_once 'messages.php' ?>
