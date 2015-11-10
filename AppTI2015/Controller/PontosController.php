<?php
/**
 * Class PontosController
 * @package Controller
 */


namespace Controller;


use Data\Conexao;
use Model\Usuario;

class PontosController extends Controller
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
        $this->setTela('Minha Pontuação');
        $codUsu = $this->getUsuario()->getCodUsu();

        $sql = "SELECT
                    SUM(Totpts) AS pontos
                FROM pontuacao_usuario p
                INNER JOIN tarefa t on t.CodTar = p.CodTarPon
                WHERE
                    t.ConTar = 'S'
                    AND t.CodUsu_Tar = :CodUsu;";
        $result = Conexao::getInstancia()->getConexao()->recuperarTudo($sql, [':CodUsu' => $codUsu]);
        $pontos = empty($result) ? 0 : (int)$result[0]['pontos'];

        return [
            'pontos' => $pontos
        ];
    }
}