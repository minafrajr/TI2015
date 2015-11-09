<?php
/**
 * Class RelatorioController
 * @package Controller
 */

namespace Controller;

use Data\Connect;
use Model\Tarefa;
use Model\Usuario;

class RelatorioController extends Controller
{
    public function init()
    {
        // Se o usuário não está logado, redireciona para a tela de login
        if (empty($_SESSION['usuario'])) {
            $this->redirect('/login.php');
        }

        $usuario = new Usuario();
        $usuario->setConnection(Connect::getinstance()->getConnection());
        $usuario->get($_SESSION['usuario']['codigo']);
        $this->setUsuario($usuario);
    }

    public function index()
    {
        $this->setTela('Relatório');
        $groupBy = $this->getParam('group', 'ano');
        $codUsuario = $this->getUsuario()->getCodUsu();

        $tarefa = new Tarefa();
        $tarefa->setConnection(Connect::getinstance()->getConnection());
        $report = $tarefa->getReportByUser($codUsuario, $groupBy);

        return [
            'group' => $groupBy,
            'relatorio' => $report
        ];
    }
}