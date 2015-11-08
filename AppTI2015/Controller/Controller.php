<?php

namespace Controller;

/**
 * Class Controller
 */
abstract class Controller
{
    /**
     * @var string tela
     */
    private $tela;

    public function __construct()
    {
        $this->init();
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

    public function init()
    {
        // Não faz nada, tem que sobrescrever
    }

    public function index()
    {
        // Não faz nada, tem que sobrescrever
    }

    public function getRequest()
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

    public function getParam($name, $default = null)
    {
        $request = $this->getRequest();
        return isset($request[$name]) ? $request[$name] : $default;
    }

    public function redirect($url)
    {
        header("Location: {$url}", true, 302);
        exit;
    }

    public function getErrorMessage()
    {
        $errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : null;
        unset($_SESSION['errorMessage']);
        return $errorMessage;
    }

    public function setErrorMessage($errorMessage)
    {
        $_SESSION['errorMessage'] = $errorMessage;
    }

    public function getSuccessMessage()
    {
        $successMessage = isset($_SESSION['successMessage']) ? $_SESSION['successMessage'] : null;
        unset($_SESSION['successMessage']);
        return $successMessage;
    }

    public function setSuccessMessage($successMessage)
    {
        $_SESSION['successMessage'] = $successMessage;
    }
}
