<?php

namespace Controller;

use Data\Conexao;
use Model\Usuario;

class UsuarioController extends Controller
{
    public function cadastrar()
    {
        $this->setTela('Novo Usuario');

        try {
            if ($this->isPost()) {
                $nome = $this->getParametro('nome');
                $dataNascimento = $this->getParametro('dataNascimento');
                $senha = $this->getParametro('senha');
                $email = $this->getParametro('email');

                $usuario = new Usuario();
                $usuario->setConexao(Conexao::getInstancia()->getConexao());

                if ($usuario->verificaSeEmailExiste($email)) {
                    throw new \Exception("Usuário com e-mail {$email} já existe!");
                }

                $usuario
                    ->setNomUsu($nome)
                    ->setDatNasUsu($dataNascimento)
                    ->setSenUsu(md5($senha))
                    ->setEmaUsu($email)
                    ->salvar();

                $this->setMensagemSucesso('Usuário salvo com sucesso!');

                $this->redirecionar('/');
            }
        } catch (\PDOException $ex) {
            $this->setMensagemErro("Erro ao inserir no banco: " . $ex->getMessage());
        } catch (\Exception $ex) {
            $this->setMensagemErro("Erro ao salvar o usuário: " . $ex->getMessage());
        }
    }
}
