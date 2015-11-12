<?php

namespace Data;

class Database
{
    /**
     * @var \PDO conexao
     */
    private $conexao;

    /**
     * Database constructor.
     *
     * @param \PDO $conexao
     */
    public function __construct(\PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    /**
     * @param string $sql
     * @param array $params
     *
     * @return array
     */
    public function recuperarTudo($sql, array $params = [])
    {
        return $this->executar($sql, $params, true);
    }

    /**
     * @param string $sql
     * @param array $params
     *
     * @return bool
     */
    public function salvar($sql, array $params = [])
    {
        return $this->executar($sql, $params, false);
    }

    /**
     * @param string $sql
     * @param array $params
     * @param bool $isSelect
     *
     * @return array|bool
     */
    protected function executar($sql, array $params, $isSelect = true)
    {
        $stmt = $this->conexao->prepare($sql);
        $result = $stmt->execute($params);

        if ($isSelect) {
            return $stmt->fetchAll();
        }

        return $result;
    }
}