<?php

namespace Controller;

use Data\Connect;

class IndexController extends Controller
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
        $codUsuario = $_SESSION['usuario']['codigo'];

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
