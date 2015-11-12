<?php

namespace Controller;

use Data\Conexao;
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
                $usuario->setConexao(Conexao::getInstancia()->getConexao());
                $usuario->getPeloEmailESenha($this->getParametro('email'), $this->getParametro('senha'));

                // Define o usuário da sessão
                $_SESSION['usuario'] = [
                    'codigo' => $usuario->getCodUsu(),
                    'nome'   => $usuario->getNomUsu(),
                    'email'  => $usuario->getEmaUsu()
                ];

                //encaminha para a página inicial.
                $this->setMensagemSucesso('Bem vindo ao sistema, ' . $usuario->getNomUsu());
                $this->redirecionar('/');
            }
        } catch (\PDOException $ex) {
            $this->setMensagemErro("Erro ao logar: " . $ex->getMessage());
        } catch (\Exception $ex) {
            $this->setMensagemErro($ex->getMessage());
        }
    }

    public function logoff()
    {
        $_SESSION = [];
        session_destroy();
        $this->redirecionar('/login.php');
    }
}
