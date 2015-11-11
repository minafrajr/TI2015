<?php

namespace Model;

/**
 * Class Usuario
 */
class Usuario extends Entidade
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

    public function getUsuario($id)
    {
        $query = "SELECT CodUsu, NomUsu, DatNasUsu, SenUsu, EmaUsu, AvaUsu
				  FROM usuario
				  WHERE CodUsu = :id";

        $conn = $this->getConexao();
        $result = $conn->recuperarTudo($query, [':id' => $id]);

        if (empty($result)) {
            throw new \Exception("Usuário com ID {$id} não foi encontrado");
        }

        $result = $result[0];

        return $this
            ->setCodUsu($result['CodUsu'])
            ->setNomUsu($result['NomUsu'])
            ->setDatNasUsu($result['DatNasUsu'])
            ->setSenUsu($result['SenUsu'])
            ->setEmaUsu($result['EmaUsu'])
            ->setAvaUsu($result['AvaUsu']);
    }

    public function salvar()
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

        $result = $this->getConexao()->salvar($query, $params);

        if (!$result) {
            throw new \Exception('Erro ao salvar o usuário');
        }

        return $this;
    }

    public function getPeloEmailESenha($email, $password)
    {
        $query = "SELECT CodUsu
				  FROM usuario
				  WHERE SenUsu= MD5(:senhaUsu) AND EmaUsu = :emailUsu";

        //repassa os parãmetros
        $query_params = [':senhaUsu' => $password, ':emailUsu' => $email];

        //executa a consulta no banco
        $conn = $this->getConexao();
        $result = $conn->recuperarTudo($query, $query_params);

        if (empty($result)) {
            throw new \Exception("Usuário e senha inválidos");
        }

        return $this->getUsuario($result[0]['CodUsu']);
    }

    public function getPeloEmailEDataDeNascimento($email, $dataNascimento)
    {
        $query = "SELECT CodUsu
				  FROM usuario
				  WHERE DatNasUsu = :DatNasUsu AND EmaUsu = :EmaUsu";

        //repassa os parãmetros
        $query_params = [':DatNasUsu' => $dataNascimento, ':EmaUsu' => $email];

        //executa a consulta no banco
        $conn = $this->getConexao();
        $result = $conn->recuperarTudo($query, $query_params);

        if (empty($result)) {
            throw new \Exception("Usuário e data de nascimento inválidos");
        }

        return $this->getUsuario($result[0]['CodUsu']);
    }

    public function getPeloEmailHash($hash)
    {
        $query = "SELECT CodUsu
				  FROM usuario
				  WHERE MD5(EmaUsu) = :EmaUsu";

        //repassa os parãmetros
        $query_params = [':EmaUsu' => $hash];

        //executa a consulta no banco
        $conn = $this->getConexao();
        $result = $conn->recuperarTudo($query, $query_params);

        if (empty($result)) {
            throw new \Exception("O hash informado é inválido");
        }

        return $this->getUsuario($result[0]['CodUsu']);
    }

    public function verificaSeEmailExiste($email)
    {
        $query = "SELECT CodUsu
				  FROM usuario
				  WHERE EmaUsu = :emailUsu";

        //repassa os parãmetros
        $query_params = [':emailUsu' => $email];

        //executa a consulta no banco
        $result = $this->getConexao()->recuperarTudo($query, $query_params);

        return !empty($result);
    }
}