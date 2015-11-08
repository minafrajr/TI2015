<?php

namespace Model;

abstract class Entity
{
    /**
     * @var \PDO connection
     */
    protected $connection;

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param \PDO $connection
     *
     * @return Entity
     */
    public function setConnection(\PDO $connection)
    {
        $this->connection = $connection;

        return $this;
    }
}