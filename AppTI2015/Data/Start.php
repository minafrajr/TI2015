<?php

namespace Data;

use Controller\Controller;

class Start
{
    /**
     * @var Controller controller
     */
    private $controller;

    public function init()
    {
        // Pega o nome puro da View
        $fileName = str_replace('.php', '', str_replace('/', '', $_SERVER['SCRIPT_NAME']));
        // Parte o nome em duas partes
        $fileNameExplode = explode('_', $fileName, 2);
        // Coloca as partes em controllerName e actionName
        $controllerName = $fileNameExplode[0];
        $actionName = isset($fileNameExplode[1]) ? $fileNameExplode[1] : '';
        // Controller sempre tem a palavra Controller no fim do arquivo.
        $controllerName = "\\Controller\\" . ucfirst($controllerName) . 'Controller';
        // Converte o nome da ação de nome_da_ação para nomeDaAção
        $actionName = Util::convertToCamelCase($actionName, true);

        // Se o arquivo do Controller não existe, dá erro e sai
        if (!class_exists($controllerName)) {
            die("Controller $controllerName não encontrado!");
        }

        // Instancia o objeto do Controller
        /** @var Controller $controller */
        $controller = new $controllerName();

        $this->controller = $controller;

        // Se não tem nome de action. define como index
        if (empty($actionName)) {
            $actionName = 'index';
        }

        // Chama a ação, e se não existir da erro e sai
        return $controller->{$actionName}();
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
     * @return Start
     */
    public function setController(Controller $controller)
    {
        $this->controller = $controller;

        return $this;
    }
}
