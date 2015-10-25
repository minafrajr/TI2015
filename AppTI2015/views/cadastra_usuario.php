<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>

<head>
	<title>Nova Tarefa</title>
	<meta charset="UTF-8">
	<meta name="description" content="Cadastro de novas tarefas">
	<meta name="keywords" content="">
	<meta name="author" content="SAD Solu��es Web">
	<link rel="stylesheet" type="text/css" href="/style/estilos.css">

	<script>

	</script>
</head>

<body>
	<h1>Novo Usuario </h1>

	<form id="frm1" method="POST" action="..\controller\cadastra_usuario_control.php">
		<table id="usuario" cellspacing="10">
			<tr>
				<td>Nome:</td>
				<td>
					<input type="text" id="NomeUsuario" name="nomeU" Placeholder="Digite seu nome">
					<em>*</em>
				</td>
			</tr>
			<tr>
				<td>Email:</td>
				<td>
					<input type="email" name="email">
					<em>*</em>
			</tr>
			<tr>
				<td>Data de Nascimento:</td>
				<td>
					<input type="date" name="dataN">
					<em>*</em>
				</td>
			</tr>
			<tr></tr>
			<tr>
				<td>Senha:</td>
				<td>
					<input type="password" name="senha">
					<em>*</em>
				</td>
			</tr>
			<tr>
				<td>Confirmar Senha:</td>
				<td>
					<input type="password" name="conf_senha">
					<em>*</em>
				</td>
			</tr>
			<tr>
				<td>Escolher Avatar:</td>
				<td>
					<input type="file" name="avatarToUpload" id="avatarToUpload">
				</td>
			</tr>
			<tr>
				<td>* Campos Obrigatorios</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="Enviar" value="OK">
				</td>
				<td>
					<input type="reset" name="limpar" value="Cancelar">
				</td>
			</tr>
		</table>
		<br />
		
		
	</form>


</body>
</html>
