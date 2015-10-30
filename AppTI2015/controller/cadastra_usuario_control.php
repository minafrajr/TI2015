<?php

try {
	if (!empty($_POST)) {
        $nome = getParam('nome');
        $dataNascimento = getParam('dataNascimento');
        $senha = getParam('senha');
        $email = getParam('email');

        if (Usuario::checkIfEmailExists($email)) {
            throw new Exception("Usuário com e-mail {$email} já existe!");
        }

        $usuario = new Usuario();

        $usuario
            ->setNomUsu($nome)
            ->setDatNasUsu($dataNascimento)
            ->setSenUsu(md5($senha))
            ->setEmaUsu($email)
            ->save();

        setSuccessMessage('Usuário salvo com sucesso!');

        redirect('/');
	}
} catch (PDOException $ex) {
	setErrorMessage("Erro ao inserir no banco: " . $ex->getMessage());
} catch (Exception $ex) {
    setErrorMessage("Erro ao salvar o usuário: " . $ex->getMessage());
}