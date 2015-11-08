<?php

namespace Model;

use Data\Connect;

/**
 * Class Usuario
 */
class Usuario extends Entity
{
    private $CodUsu;
    private $NomUsu;
    private $DatNasUsu;
    private $SenUsu;
    private $EmaUsu;
    private $AvaUsu;

    /**
     * @return mixed
     */
    public function getCodUsu()
    {
        return $this->CodUsu;
    }

    /**
     * @param mixed $CodUsu
     *
     * @return Usuario
     */
    public function setCodUsu($CodUsu)
    {
        $this->CodUsu = $CodUsu;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomUsu()
    {
        return $this->NomUsu;
    }

    /**
     * @param mixed $NomUsu
     *
     * @return Usuario
     */
    public function setNomUsu($NomUsu)
    {
        $this->NomUsu = $NomUsu;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatNasUsu()
    {
        return $this->DatNasUsu;
    }

    /**
     * @param mixed $DatNasUsu
     *
     * @return Usuario
     */
    public function setDatNasUsu($DatNasUsu)
    {
        $this->DatNasUsu = $DatNasUsu;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenUsu()
    {
        return $this->SenUsu;
    }

    /**
     * @param mixed $SenUsu
     *
     * @return Usuario
     */
    public function setSenUsu($SenUsu)
    {
        $this->SenUsu = $SenUsu;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmaUsu()
    {
        return $this->EmaUsu;
    }

    /**
     * @param mixed $EmaUsu
     *
     * @return Usuario
     */
    public function setEmaUsu($EmaUsu)
    {
        $this->EmaUsu = $EmaUsu;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvaUsu()
    {
        return $this->AvaUsu;
    }

    /**
     * @param mixed $AvaUsu
     *
     * @return Usuario
     */
    public function setAvaUsu($AvaUsu)
    {
        $this->AvaUsu = $AvaUsu;

        return $this;
    }

    public function get($id)
    {
        $query = "SELECT CodUsu, NomUsu, DatNasUsu, SenUsu, EmaUsu, AvaUsu
				  FROM usuario
				  WHERE CodUsu = :id";

        $conn = $this->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetchAll();

        if (empty($result)) {
            throw new \Exception("Usuário com ID {$id} não foi encontrado");
        }

        $result = $result[0];

        return $this
            ->setCodUsu($result['CodUsu'])
            ->setNomUsu($result['Nomusu'])
            ->setDatNasUsu($result['DatNasUsu'])
            ->setSenUsu($result['SenUsu'])
            ->setEmaUsu($result['EmaUsu'])
            ->setAvaUsu($result['AvaUsu']);
    }

    public function save()
    {
        $params = [
            ':NomUsu' => $this->NomUsu,
            ':DatNasUsu' => $this->DatNasUsu,
            ':SenUsu' => $this->SenUsu,
            ':EmaUsu' => $this->EmaUsu,
            ':AvaUsu' => $this->AvaUsu
        ];

        if (empty($this->CodUsu)) {
            $query = "INSERT INTO usuario (NomUsu, DatNasUsu, SenUsu, EmaUsu, AvaUsu)
				  VALUES(:NomUsu, :DatNasUsu, :SenUsu, :EmaUsu, :AvaUsu);";
        } else {
            $query = "UPDATE usuario SET
                    NomUsu = :NomUsu,
                    DatNasUsu = :DatNasUsu,
                    SenUsu = :SenUsu,
                    EmaUsu = :EmaUsu,
                    AvaUsu = :AvaUsu
                    WHERE CodUsu = :CodUsu;";

            $params[':CodUsu'] = $this->CodUsu;
        }

        $stmt = $this->getConnection()->prepare($query);
        $result = $stmt->execute($params);

        if (!$result) {
            throw new \Exception('Erro ao salvar o usuário');
        }

        return $this;
    }

    public function getByEmailAndPassword($email, $password)
    {
        $query = "SELECT CodUsu
				  FROM usuario
				  WHERE SenUsu= MD5(:senhaUsu) AND EmaUsu = :emailUsu";

        //repassa os parãmetros
        $query_params = [':senhaUsu' => $password, ':emailUsu' => $email];

        //executa a consulta no banco
        $conn = $this->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->execute($query_params);
        $result = $stmt->fetchAll();

        if (empty($result)) {
            throw new \Exception("Usuário e senha inválidos");
        }

        return $this->get($result[0]['CodUsu']);
    }

    public function checkIfEmailExists($email)
    {
        $query = "SELECT CodUsu
				  FROM usuario
				  WHERE EmaUsu = :emailUsu";

        //repassa os parãmetros
        $query_params = [':emailUsu' => $email];

        //executa a consulta no banco
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute($query_params);
        $result = $stmt->fetchAll();

        return !empty($result);
    }
}