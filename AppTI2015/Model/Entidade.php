<?php

namespace Model;

use Data\Database;

abstract class Entidade
{
    /**
     * @var Database conexao
     */
    protected $conexao;

    /**
     * @return Database
     */
    public function getConexao()
    {
        return $this->conexao;
    }

    /**
     * @param Database $conexao
     *
     * @return Entidade
     */
    public function setConexao(Database $conexao)
    {
        $this->conexao = $conexao;

        return $this;
    }
}