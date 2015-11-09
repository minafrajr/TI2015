<?php
/**
 * Class RelatorioController
 * @package Controller
 */

namespace Controller;

use Data\Conexao;
use Model\Tarefa;
use Model\Usuario;

class RelatorioController extends Controller
{
    public function iniciar()
    {
        // Se o usuário não está logado, redireciona para a tela de login
        if (empty($_SESSION['usuario'])) {
            $this->redirecionar('/login.php');
        }

        $usuario = new Usuario();
        $usuario->setConexao(Conexao::getInstancia()->getConexao());
        $usuario->getUsuario($_SESSION['usuario']['codigo']);
        $this->setUsuario($usuario);
    }

    public function index()
    {
        $this->setTela('Relatório');
        $groupBy = $this->getParametro('group', 'ano');
        $codUsuario = $this->getUsuario()->getCodUsu();

        $tarefa = new Tarefa();
        $tarefa->setConexao(Conexao::getInstancia()->getConexao());
        $report = $tarefa->getRelatorioPeloUsuario($codUsuario, $groupBy);

        return [
            'group' => $groupBy,
            'relatorio' => $report
        ];
    }
}