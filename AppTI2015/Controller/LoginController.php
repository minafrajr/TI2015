<?php

namespace Controller;

use Data\Connect;
use Model\Usuario;

class LoginController extends Controller
{
    public function index()
    {
        $this->setTela('Login');

        try {
            if ($this->isPost()) {
                //consulta
                $usuario = new Usuario();
                $usuario->setConnection(Connect::getinstance()->getConnection());
                $usuario->getByEmailAndPassword($this->getParam('email'), $this->getParam('senha'));

                // Define o usuário da sessão
                $_SESSION['usuario'] = [
                    'codigo' => $usuario->getCodUsu(),
                    'nome'   => $usuario->getNomUsu(),
                    'email'  => $usuario->getEmaUsu()
                ];

                //encaminha para a página inicial.
                $this->setSuccessMessage('Bem vindo ao sistema, ' . $usuario->getNomUsu());
                $this->redirect('/');
            }
        } catch (\PDOException $ex) {
            $this->setErrorMessage("Erro ao logar: " . $ex->getMessage());
        } catch (\Exception $ex) {
            $this->setErrorMessage($ex->getMessage());
        }
    }

    public function logoff()
    {
        $_SESSION = [];
        session_destroy();
        $this->redirect('/login.php');
    }
}
