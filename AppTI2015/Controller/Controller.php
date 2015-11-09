<?php

namespace Controller;

use Model\Usuario;

/**
 * Class Controller
 */
abstract class Controller
{
    /**
     * @var string tela
     */
    private $tela;

    /**
     * @var Usuario usuario
     */
    private $usuario;

    public function __construct()
    {
        $this->iniciar();
    }

    /**
     * @return string
     */
    public function getTela()
    {
        return $this->tela;
    }

    /**
     * @param string $tela
     *
     * @return Controller
     */
    public function setTela($tela)
    {
        $this->tela = $tela;

        return $this;
    }

    public function iniciar()
    {
        // Não faz nada, tem que sobrescrever
    }

    public function index()
    {
        // Não faz nada, tem que sobrescrever
    }

    public function getRequisicao()
    {
        if ($this->isPost()) {
            return $_POST;
        }

        return $_REQUEST;
    }

    public function isPost()
    {
        return !empty($_POST);
    }

    public function getParametro($name, $default = null)
    {
        $request = $this->getRequisicao();
        return isset($request[$name]) ? $request[$name] : $default;
    }

    public function redirecionar($url)
    {
        header("Location: {$url}", true, 302);
        exit;
    }

    public function getMensagemErro()
    {
        $mensagem = isset($_SESSION['mensagemErro']) ? $_SESSION['mensagemErro'] : null;
        unset($_SESSION['mensagemErro']);
        return $mensagem;
    }

    public function setMensagemErro($mensagem)
    {
        $_SESSION['mensagemErro'] = $mensagem;
    }

    public function getMensagemSucesso()
    {
        $mensagem = isset($_SESSION['mensagemSucesso']) ? $_SESSION['mensagemSucesso'] : null;
        unset($_SESSION['mensagemSucesso']);
        return $mensagem;
    }

    public function setMensagemSucesso($mensagem)
    {
        $_SESSION['mensagemSucesso'] = $mensagem;
    }

    /**
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     *
     * @return Controller
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
}
