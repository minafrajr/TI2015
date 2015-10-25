<?php

try {
	if (!empty($_POST)) {
        $nome = $_POST['nome'];
        $dataNascimento = $_POST['dataNascimento'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];

        $query = "SELECT CodUsu FROM usuario WHERE EmaUsu = :EmaUsu;";

        /** @var $stmt PDOStatement */
        $stmt = $conn->prepare($query);
        $result = $stmt->execute([':EmaUsu' => $email]);
        $all = $stmt->fetchAll();

        if (!empty($all)) {
            throw new Exception("Usuário com e-mail {$email} já existe!");
        }

		$query = "INSERT INTO usuario (NomUsu, DatNasUsu, SenUsu, EmaUsu)
				  VALUES(:NomUsu, :DatNasUsu, MD5(:SenUsu), :EmaUsu);";

		$query_params = [
            ':NomUsu'    => $nome,
            ':DatNasUsu' => $dataNascimento,
            ':SenUsu'    => $senha,
            ':EmaUsu'    => $email
		];

		$stmt = $conn->prepare($query);
		$result = $stmt->execute($query_params);

        setSuccessMessage('Usuário salvo com sucesso!');

        // Redireciona para a própria tela, para evitar submeter novamente o formulário com F5
        header("Location: {$_SERVER['PHP_SELF']}");
	}
} catch (PDOException $ex) {
	setErrorMessage("Erro ao inserir no banco: " . $ex->getMessage());
} catch (Exception $ex) {
    setErrorMessage("Erro ao salvar o usuário: " . $ex->getMessage());
}