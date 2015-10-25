<?php
session_start(); // Deve ser a primeira coisa a ser chamada

header('Content-Type: text/html; charset=utf-8');

if (empty($_SESSION['user']) && $_SERVER['PHP_SELF'] !== '/login.php') {
    header('Location: login.php');
}

require_once('connect.php');