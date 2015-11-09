<?php

namespace Controller;

use Data\Conexao;
use Model\Usuario;

class IndexController extends Controller
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
        $codUsuario = $this->getUsuario()->getCodUsu();

        $duracao = (int)$this->getParametro('duracao', 0);
        $data = $this->getParametro('data');
        $ordenar = $this->getParametro('ordenar', 'PonTar');

        $ordenacoesPossiveis = ['DatIniTar', 'TepTar', 'PonTar', 'NomTar'];

        if (!in_array($ordenar, $ordenacoesPossiveis)) {
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

        $conn = Conexao::getInstancia()->getConexao();
        $result = $conn->recuperarTudo($sql, $params);

        return [
            'duracao' => $duracao,
            'data'    => $data,
            'ordenar' => $ordenar,
            'result'  => $result
        ];
    }
}
