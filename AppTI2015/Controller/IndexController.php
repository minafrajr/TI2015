<?php

namespace Controller;

use Data\Connect;
use Model\Usuario;

class IndexController extends Controller
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
        $codUsuario = $this->getUsuario()->getCodUsu();

        $duracao = (int)$this->getParam('duracao', 0);
        $data = $this->getParam('data');
        $ordenar = $this->getParam('ordenar', 'PonTar');

        $ordenacorsPossiveis = ['DatIniTar', 'TepTar', 'PonTar', 'NomTar'];

        if (!in_array($ordenar, $ordenacorsPossiveis)) {
            die('Falha de segurança! SQL Injection!');
        }

        $params = [':CodUsu_Tar' => $codUsuario];
        $where = '';

        if (!empty($duracao)) {
            $where .= "AND HOUR(TepTar) + 1 >= :Duracao ";
            $params[':Duracao'] = $duracao;
        }

        if (!empty($data)) {
            $where .= "AND DATE(DatIniTar) = :Data ";
            $params[':Data'] = $data;
        }

        $sql = "SELECT
                    CodTar,
                    NomTar,
                    DesTar,
                    DATE_FORMAT(DatIniTar, '%Y-%m-%dT%H:%i') as DatIniTar,
                    DatTerTar,
                    TepTar,
                    PonTar
                FROM tarefa
                WHERE CodUsu_Tar = :CodUsu_Tar
                AND ConTar = 'N'
                $where
                ORDER BY $ordenar ASC";

        $conn = Connect::getinstance()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return [
            'duracao' => $duracao,
            'data'    => $data,
            'ordenar' => $ordenar,
            'result'  => $result
        ];
    }
}
