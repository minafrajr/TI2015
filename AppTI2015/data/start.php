<?php
// Inicia a sessão. Deve ser a primeira coisa a ser chamada
session_start();

// Define o tipo de resposta da requisição e o charset
header('Content-Type: text/html; charset=utf-8');

// Define as URLs que não devem validar se o usuário está logado
$ignorarSessao = [
    '/login.php',
    '/cadastra_usuario.php'
];

// Se o usuário não está logado e a tela atual não é uma das ignoradas,
// redireciona para a tela de login
if (empty($_SESSION['usuario']) && !in_array($_SERVER['PHP_SELF'], $ignorarSessao)) {
    header('Location: login.php');
}

// Conecta ao banco
require_once('connect.php');
require_once('functions.php');