<?php

try {
    if (!empty($_POST)) {
        //consulta
        $query = "SELECT CodUsu, NomUsu, EmaUsu
				  FROM usuario 
				  WHERE SenUsu= MD5(:senhaUsu) AND EmaUsu = :emailUsu";

        //repassa os parãmetros
        $query_params = [':senhaUsu' => $_POST["senha"], ':emailUsu' => $_POST["email"]];

        //executa a consulta no banco
        $stmt = $conn->prepare($query);
        $stmt->execute($query_params);
        $result = $stmt->fetchAll();

        if (!empty($result)) {
            // Define o usuário da sessão
            $_SESSION['usuario'] = [
                'codigo' => $result[0]['CodUsu'],
                'nome'   => $result[0]['NomUsu'],
                'email'  => $result[0]['EmaUsu']
            ];

            //encaminha para a página inicial.
            setSuccessMessage('Bem vindo ao sistema, ' . $_SESSION['usuario']['nome']);
            header("Location: /index.php");
        } else {
            throw new Exception('Usuário e senha inválidos');
        }
    }
} catch (PDOException $ex) {
    setErrorMessage("Erro ao logar: " . $ex->getMessage());
} catch (Exception $ex) {
    setErrorMessage($ex->getMessage());
}
