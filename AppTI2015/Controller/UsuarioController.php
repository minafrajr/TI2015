<?php

namespace Controller;

use Data\Connect;
use Model\Usuario;

class UsuarioController extends Controller
{
    public function cadastrar()
    {
        $this->setTela('Novo Usuario');

        try {
            if ($this->isPost()) {
                $nome = $this->getParam('nome');
                $dataNascimento = $this->getParam('dataNascimento');
                $senha = $this->getParam('senha');
                $email = $this->getParam('email');

                $usuario = new Usuario();
                $usuario->setConnection(Connect::getinstance()->getConnection());

                if ($usuario->checkIfEmailExists($email)) {
                    throw new \Exception("Usuário com e-mail {$email} já existe!");
                }

                $usuario
                    ->setNomUsu($nome)
                    ->setDatNasUsu($dataNascimento)
                    ->setSenUsu(md5($senha))
                    ->setEmaUsu($email)
                    ->save();

                $this->setSuccessMessage('Usuário salvo com sucesso!');

                $this->redirect('/');
            }
        } catch (\PDOException $ex) {
            $this->setErrorMessage("Erro ao inserir no banco: " . $ex->getMessage());
        } catch (\Exception $ex) {
            $this->setErrorMessage("Erro ao salvar o usuário: " . $ex->getMessage());
        }
    }
}
