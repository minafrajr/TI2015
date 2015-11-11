<?php

namespace Controller;

use Data\Conexao;
use Data\Email;
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

    public function recuperarSenha()
    {
        $this->setTela('Recuperar senha');

        if ($this->isPost()) {
            try {
                //consulta
                $usuario = new Usuario();
                $usuario->setConexao(Conexao::getInstancia()->getConexao());
                $usuario->getPeloEmailEDataDeNascimento($this->getParametro('email'), $this->getParametro('dataNascimento'));

                $mensagem = "Olá {$usuario->getNomUsu()}, para recuperar sua senha, clique no link abaixo, ou copie e cole no navegador:<br><br>";
                $mensagem .= "<a href=\"http://ti2015.dev/usuario_nova_senha.php?h=" . md5($usuario->getEmaUsu()) . "\">" .
                    "http://ti2015.dev/usuario_nova_senha.php?h=" . md5($usuario->getEmaUsu()) .
                    "</a><br><br>";
                $mensagem .= "Att. Equipe AlertSistem";

                $email = new Email();
                $email->enviar($usuario->getEmaUsu(), $usuario->getNomUsu(), 'Recupere sua senha - AlertSistem', $mensagem);

                $this->setMensagemSucesso('Um e-mail foi enviado pra você!');
            } catch (\Exception $e) {
                $this->setMensagemErro('Não foi encontrado usuário com os dados fornecidos!');
            }
        }
    }

    public function novaSenha()
    {
        $this->setTela('Recuperar senha');

        $hash = $_GET['h'];
        $usuario = new Usuario();
        $usuario->setConexao(Conexao::getInstancia()->getConexao());

        try {
            $usuario->getPeloEmailHash($hash);
        } catch (\Exception $e) {
            $this->setMensagemErro($e->getMessage());
            $this->redirecionar('/login.php');
        }

        if ($this->isPost()) {
            $senha = $this->getParametro('senha');
            $confSenha = $this->getParametro('conf_senha');

            if ($senha !== $confSenha) {
                $this->setMensagemErro('As senhas devem ser idênticas!');
            } else {
                $usuario
                    ->setSenUsu(md5($senha))
                    ->salvar();

                $this->setMensagemSucesso('Senha alterada com sucesso!');
                $this->redirecionar('/login.php');
            }
        }
    }
}
