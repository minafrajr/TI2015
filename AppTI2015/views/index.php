<?php
session_start();

header('Content-Type: text/html; charset=utf-8');

if(empty($_SESSION['user'])){

	header("Location: login.php"); 
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>AlertSistem - Bem vindo</title>
	<meta charset="UTF-8">
	<meta name="description" content="Cadastro de novas tarefas">
	<meta name="keywords" content="">
	<meta name="author" content="SAD Soluções Web">
	<link rel="stylesheet" type="text/css" href="..\style\estilos.css">

	<script>

	</script>
</head>

<body>
	<h1>Alert System </h1>

	<div>
		<a href="cadastra_tarefa.php">Cadastrar Tarefa</a>
	</div>
	<br />
	<div> <a href="cadastra_usuario.php">cadastra usuário</a></div>
	
</body>
</html>

