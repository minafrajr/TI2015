<?php
/**
 * Class PontosController
 * @package Controller
 */


namespace Controller;


use Data\Connect;

class PontosController extends Controller
{
    public function init()
    {
        // Se o usuário não está logado, redireciona para a tela de login
        if (empty($_SESSION['usuario'])) {
            $this->redirect('/login.php');
        }
    }

    public function index()
    {
        $this->setTela('Minha Pontuação');
        $codUsu = $_SESSION['usuario']['codigo'];

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