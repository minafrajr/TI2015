<?php

//$username = "root"; //usuário do banco
//$password = "1234"; //senha do banco
//$host = "localhost"; //endereço do banco
//$dbname = "tp_tarefas"; //nome do database

$username = "root"; //usuário do banco
$password = "maxmilhas"; //senha do banco
$host = "10.10.10.101"; //endereço do banco
$dbname = "tp_tarefas"; //nome do database

try {
    //cria a conexão com o banco
    $conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);

    //codifica para o utf8
    $conn->exec("set names utf8");
} catch (PDOException $ex) {
    //se a conexão falhar
    die("Falha ao conectar com o banco!<br/>Erro: " . $ex->getMessage());
}

//configura o PDO para lançar a exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//configura o PDO para retornar do banco um array com índices de string.
//Assim a string representa o nome da coluna
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);