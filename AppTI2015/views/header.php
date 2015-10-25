<?php require_once '../data/start.php'; ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>AlertSistem - <?= $tela ?: 'Bem vindo' ?></title>
        <meta charset="UTF-8">
        <meta name="description" content="Tela de login">
        <meta name="keywords" content="">
        <meta name="author" content="SAD Soluções Web">
        <link rel="stylesheet" type="text/css" href="/style/estilos.css">
    </head>

    <body>
        <h1><?= $tela ?: 'AlertSistem' ?></h1>
        <?php require_once 'messages.php' ?>
