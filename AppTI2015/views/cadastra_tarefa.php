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
	<h1>Nova Tarefa </h1>
	<form id="frm_new_tarefa" method="post" action="../controller/Cadastra_nova_tarefa_control.php">
		<table id="tarefas" cellspacing="10">
			<tr>
				<td>Nome:</td>
				<td>
					<input type="text" name="nometarefa" placeholder="Nome da Tarefa">
				</td>
			</tr>
			<tr>
				<td>Prioridade:</td>
				<td>
					<select name="prioridade">
						<option nome="pri">-</option>
						<option nome="pri">1</option>
						<option nome="pri">2</option>
						<option nome="pri">3</option>
						<option nome="pri">4</option>
						<option nome="pri">5</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Data</td>
				<td>
					<input type="date" name="data">
				</td>
			</tr>
			<tr>
				<td>Dura��o</td>
				<td>
					<input type="time" name="hora">
				</td>
			</tr>
			<tr>
				<td>Descri��o</td>
				<td>
					<input class="descricao" name="descri" type="text">
				</td>
			</tr>

			<tr>
				<td>
					<input type="submit" name="Enviar" value="OK">
				</td>
				<td>
					<input type="reset" name="limpar" value="Cancelar"></td>
			</tr>
		</table>
	</form>
</body>

</html>
