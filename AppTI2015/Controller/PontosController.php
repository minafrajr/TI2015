<?php
/**
 * Class PontosController
 * @package Controller
 */


namespace Controller;


use Data\Connect;
use Model\Usuario;

class PontosController extends Controller
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
        $this->setTela('Minha Pontuação');
        $codUsu = $this->getUsuario()->getCodUsu();

        $sql = "SELECT SUM(PonTar * 10) AS pontos from tarefa WHERE ConTar = 'S' AND CodUsu_Tar = :CodUsu;";
        $stmt = Connect::getinstance()->getConnection()->prepare($sql);
        $stmt->execute([':CodUsu' => $codUsu]);
        $result = $stmt->fetchAll();
        $pontos = empty($result) ? 0 : (int)$result[0]['pontos'];

        return [
            'pontos' => $pontos
        ];
    }
}