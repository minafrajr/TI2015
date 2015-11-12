<?php

namespace Data;

class Conexao
{
    //private $username = "root"; //usuário do banco
    //private $password = "1234"; //senha do banco
    //private $host = "localhost"; //endereço do banco
    //private $dbname = "tp_tarefas"; //nome do database

    private $username = "root"; //usuário do banco
    private $password = "maxmilhas"; //senha do banco
    private $host = "10.10.10.101"; //endereço do banco
    private $dbname = "tp_tarefas"; //nome do database

    /**
     * @var Database conexao
     */
    private $conexao;

    /**
     * @var Conexao instancia
     */
    private static $instancia;

    private function __construct()
    {
        //cria a conexão com o banco
        $pdo = new \PDO(
            "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
            $this->username,
            $this->password
        );

        //codifica para o utf8
        $pdo->exec("set names utf8");

        //configura o PDO para lançar a exception
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        //configura o PDO para retornar do banco um array com índices de string.
        //Assim a string representa o nome da coluna
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

        $this->conexao = new Database($pdo);
    }

    /**
     * @return Conexao
     */
    public static function getInstancia()
    {
        if (empty(self::$instancia)) {
            self::$instancia = new static();
        }

        return self::$instancia;
    }

    /**
     * @return Database
     */
    public function getConexao()
    {
        return $this->conexao;
    }
}
