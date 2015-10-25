<?php

try {
	if (!empty($_POST)) {
		//consulta
		$query = "SELECT CodUsu, NomUsu, EmaUsu
				  FROM usuario 
				  WHERE SenUsu= :senhaUsu AND EmaUsu = :emailUsu";

		//repassa os parãmetros
		$query_params = [':senhaUsu' => $_POST["senha"], ':emailUsu' => $_POST["email"]];

		//executa a consulta no banco
		$stmt = $conn->prepare($query);
		$stmt->execute($query_params);
		$result = $stmt->fetchAll();

		if (!empty($result)) {
			//
			$_SESSION['CodigoUsuario'] = $result[0]['CodUsu'];
			$_SESSION['user'] = $result[0]['NomUsu'];
			$_SESSION['email'] = $result[0]['EmaUsu'];

			//encaminha para a página inicial.
			header("Location: ../views/index.php");
		} else {
			header("Location: ../views/login.php");
		}
	}
} catch (PDOException $ex) {
	die("Failed: " . $ex->getMessage());
}
