<?php
// Inicia a sessão. Deve ser a primeira coisa a ser chamada
session_start();

// Inicia o buffer da tela. Serve para fazer os redirecionamentos de tela
ob_start();

// Conecta ao banco
require_once('../../vendor/autoload.php');

// Define o tipo de resposta da requisição e o charset
header('Content-Type: text/html; charset=utf-8');

// Inicia a aplicação
$start = new Data\Aplicacao();
// Cria a variável com o parâmetros da View
$view = $start->iniciar();
// Cria a variável com o objeto do controller corrente
$controller = $start->getController();