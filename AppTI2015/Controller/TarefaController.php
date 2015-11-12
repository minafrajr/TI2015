<?php

namespace Controller;

use Data\Conexao;
use Model\Tarefa;
use Model\Usuario;

class TarefaController extends Controller
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

    public function cadastrar()
    {
        $this->setTela('Nova Tarefa');
        $codUsu = $this->getUsuario()->getCodUsu();

        try {
            if ($this->isPost()) {
                $query =
                    "INSERT
                    INTO tarefa (CodUsu_Tar, NomTar, DesTar, DatIniTar, DatTerTar, TepTar, PonTar)
                    VALUES (
                        :CodUsu_Tar,
                        :NomTar,
                        :DesTar,
                        STR_TO_DATE(:DatIniTar, '%Y-%m-%dT%H:%i'),
                        DATE_ADD(STR_TO_DATE(:DatIniTar, '%Y-%m-%dT%H:%i'), INTERVAL :TepTar HOUR_MINUTE),
                        :TepTar,
                        :PonTar
                    )";

                $query_params = [
                    ':CodUsu_Tar' => $codUsu,
                    ':NomTar'     => $this->getParametro('nome'),
                    ':DesTar'     => $this->getParametro("descricao"),
                    ':DatIniTar'  => $this->getParametro("data"),
                    ':TepTar'     => $this->getParametro("duracao"),
                    ':PonTar'     => $this->getParametro("prioridade")
                ];

                $conn = Conexao::getInstancia()->getConexao();
                $result = $conn->salvar($query, $query_params);

                if ($result) {
                    $this->setMensagemSucesso('Tarefa adicionada com sucesso!');
                    $this->redirecionar('/index.php');
                }
            }
        } catch (\PDOException $ex) {
            $this->setMensagemErro($ex->getMessage());
        }
    }

    public function concluidas()
    {
        $this->setTela('Tarefas concluídas');
        $codUsuario = $_SESSION['usuario']['codigo'];

        $duracao = (int)$this->getParametro('duracao', 0);
        $data = $this->getParametro('data');
        $ordenar = $this->getParametro('ordenar', 'PonTar');

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
                    DATE_FORMAT(DatIniTar, '%d/%m/%Y %H:%i') as DatIniTar,
                    DatTerTar,
                    TepTar,
                    PonTar
                FROM tarefa
                WHERE CodUsu_Tar = :CodUsu_Tar
                AND ConTar = 'S'
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

    public function concluir()
    {
        if ($this->isPost()) {
            try {
                // Recupera a tarefa
                $tarefa = new Tarefa();
                $tarefa->setConexao(Conexao::getInstancia()->getConexao());
                $tarefa->getTarefa($this->getParametro('CodTar'));

                switch ($this->getParametro('acao')) {
                    case 'salvar':
                    case 'finalizar':
                        $this->salvar($tarefa);
                        break;

                    case 'excluir':
                        $this->excluir($tarefa);
                        break;
                }
            } catch (\Exception $e) {
                $this->setMensagemErro('Erro ao alterar a tarefa: ' . $e->getMessage());
            }
        }

        $this->redirecionar('/');
    }

    private function salvar(Tarefa $tarefa)
    {
        $finalizar = $this->getParametro('acao') === 'finalizar';

        // Cria um objeto de DateTime com a data do form
        $dataInicio = \DateTime::createFromFormat('Y-m-d\TH:i', $this->getParametro('data'));
        // Clona a data inicial para calcular a data final
        $dataFim = clone $dataInicio;
        // Pega a duração
        $duracao = $this->getParametro('duracao');
        // Quebra pelo ':' e coloca os valores em $hora e $min
        list($hora, $min) = explode(':', $this->getParametro('duracao'));
        // Converte os valores em int
        $hora = (int)$hora;
        $min = (int)$min;

        // Cria um objeto de DateInterval para calcular a nova data de término
        $intervalo = new \DateInterval("PT{$hora}H{$min}M");
        // Adiciona o intervalo á data de término
        $dataFim->add($intervalo);

        // Define os campos da tarefa de acordo com o form
        $tarefa
            ->setDatIniTar($dataInicio->format('Y-m-d H:i:s'))
            ->setDatTerTar($dataFim->format('Y-m-d H:i:s'))
            ->setTepTar($duracao)
            ->setDesTar($this->getParametro('descricao'));

        // Se a ação é de finalizar a tarefa, marca ela como finalizada
        if ($finalizar) {
            $tarefa->setConTar(Tarefa::FINALIZADA);
        }

        // Salva a tarefa
        $tarefa->salvar();

        $this->setMensagemSucesso('Tarefa ' . ($finalizar ? 'finalizada' : 'salva') . ' com sucesso!');
    }

    private function excluir(Tarefa $tarefa)
    {
        $tarefa->excluir();

        $this->setMensagemSucesso('Tarefa excluída com sucesso!');
    }
}
