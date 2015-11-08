<?php

namespace Data;

class Connect
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
     * @var \PDO connection
     */
    private $connection;

    /**
     * @var Connect instance
     */
    private static $instance;

    private function __construct()
    {
        //cria a conexão com o banco
        $this->connection = new \PDO(
            "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
            $this->username,
            $this->password
        );

        //codifica para o utf8
        $this->connection->exec("set names utf8");

        //configura o PDO para lançar a exception
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        //configura o PDO para retornar do banco um array com índices de string.
        //Assim a string representa o nome da coluna
        $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    /**
     * @return Connect
     */
    public static function getinstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
