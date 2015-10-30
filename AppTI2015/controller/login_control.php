<?php

try {
    if (!empty($_POST)) {
        //consulta
        $usuario = Usuario::getByEmailAndPassword(getParam('email'), getParam('senha'));

        // Define o usuário da sessão
        $_SESSION['usuario'] = [
            'codigo' => $usuario->getCodUsu(),
            'nome'   => $usuario->getNomUsu(),
            'email'  => $usuario->getEmaUsu()
        ];

        //encaminha para a página inicial.
        setSuccessMessage('Bem vindo ao sistema, ' . $usuario->getNomUsu());
        redirect('/');
    }
} catch (PDOException $ex) {
    setErrorMessage("Erro ao logar: " . $ex->getMessage());
} catch (Exception $ex) {
    setErrorMessage($ex->getMessage());
}
