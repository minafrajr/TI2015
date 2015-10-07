<?php

$username = "root"; //usuário do banco
$password = "1234"; //senha do banco
$host = "localhost"; //endereço do banco
//$dbname = "tp_tarefas"; //nome do database
$dbname = "siesc"; //nome do database


//inicializa o banco para utf8
//$options - array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAME utf8');


try{
    //cria a conexão com o banco
    //$conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    $conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
    
    //codifica para o utf8
    $conn ->exec("set names utf8");
}
catch(PDOException $ex){
    //se a conexão falhar
    die("Falha ao conectar com o banco!<br/>Erro: " . $ex->getMessage());
}

//configura o PDO para lançar a exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

//configura o PDO para retornar do banco um array com índices de string.
//Assim a string representa o nome da coluna
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 


header('Content-Type: text/html; charset=utf-8');

session_start(); 



//teste simples para conexão
try {
   
    $stmt = $conn->prepare("SELECT idAno, AnoEF FROM ano"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->fetchAll(); 
     
   foreach ($result as $linha)
    {
        echo $linha['idAno']."  ".$linha['AnoEF']."<br/>";
    }

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>