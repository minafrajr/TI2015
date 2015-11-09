<?php

namespace Data;

use Controller\Controller;

class Aplicacao
{
    /**
     * @var Controller controller
     */
    private $controller;

    public function iniciar()
    {
        // Pega o nome puro da View
        $nomeArquivo = str_replace('.php', '', str_replace('/', '', $_SERVER['SCRIPT_NAME']));
        // Parte o nome em duas partes
        $nomeArquivoExplode = explode('_', $nomeArquivo, 2);
        // Coloca as partes em controllerName e actionName
        $nomeController = $nomeArquivoExplode[0];
        $nomeAcao = isset($nomeArquivoExplode[1]) ? $nomeArquivoExplode[1] : '';
        // Controller sempre tem a palavra Controller no fim do arquivo.
        $nomeController = "\\Controller\\" . ucfirst($nomeController) . 'Controller';
        // Converte o nome da ação de nome_da_ação para nomeDaAção
        $nomeAcao = Util::converterParaCamelCase($nomeAcao, true);

        // Se o arquivo do Controller não existe, dá erro e sai
        if (!class_exists($nomeController)) {
            die("Controller $nomeController não encontrado!");
        }

        // Instancia o objeto do Controller
        /** @var Controller $controller */
        $controller = new $nomeController();

        $this->controller = $controller;

        // Se não tem nome de action. define como index
        if (empty($nomeAcao)) {
            $nomeAcao = 'index';
        }

        // Chama a ação, e se não existir da erro e sai
        return $controller->{$nomeAcao}();
    }

    /**
     * @return Controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     *
     * @return Aplicacao
     */
    public function setController(Controller $controller)
    {
        $this->controller = $controller;

        return $this;
    }
}
