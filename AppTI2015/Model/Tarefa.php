<?php

namespace Model;

use Data\Connect;

/**
 * Class Tarefa
 */
class Tarefa extends Entity
{
    const FINALIZADA = 'S';
    const ABERTA = 'N';

    private $CodTar;
    private $CodUsu_Tar;
    private $NomTar;
    private $DesTar;
    private $DatIniTar;
    private $DatTerTar;
    private $TepTar;
    private $PonTar;
    private $ConTar;

    /**
     * @return mixed
     */
    public function getCodTar()
    {
        return $this->CodTar;
    }

    /**
     * @param mixed $CodTar
     *
     * @return Tarefa
     */
    public function setCodTar($CodTar)
    {
        $this->CodTar = $CodTar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodUsuTar()
    {
        return $this->CodUsu_Tar;
    }

    /**
     * @param mixed $CodUsu_Tar
     *
     * @return Tarefa
     */
    public function setCodUsuTar($CodUsu_Tar)
    {
        $this->CodUsu_Tar = $CodUsu_Tar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomTar()
    {
        return $this->NomTar;
    }

    /**
     * @param mixed $NomTar
     *
     * @return Tarefa
     */
    public function setNomTar($NomTar)
    {
        $this->NomTar = $NomTar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDesTar()
    {
        return $this->DesTar;
    }

    /**
     * @param mixed $DesTar
     *
     * @return Tarefa
     */
    public function setDesTar($DesTar)
    {
        $this->DesTar = $DesTar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatIniTar()
    {
        return $this->DatIniTar;
    }

    /**
     * @param mixed $DatIniTar
     *
     * @return Tarefa
     */
    public function setDatIniTar($DatIniTar)
    {
        $this->DatIniTar = $DatIniTar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatTerTar()
    {
        return $this->DatTerTar;
    }

    /**
     * @param mixed $DatTerTar
     *
     * @return Tarefa
     */
    public function setDatTerTar($DatTerTar)
    {
        $this->DatTerTar = $DatTerTar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTepTar()
    {
        return $this->TepTar;
    }

    /**
     * @param mixed $TepTar
     *
     * @return Tarefa
     */
    public function setTepTar($TepTar)
    {
        $this->TepTar = $TepTar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPonTar()
    {
        return $this->PonTar;
    }

    /**
     * @param mixed $PonTar
     *
     * @return Tarefa
     */
    public function setPonTar($PonTar)
    {
        $this->PonTar = $PonTar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConTar()
    {
        return $this->ConTar;
    }

    /**
     * @param mixed $ConTar
     *
     * @return Tarefa
     */
    public function setConTar($ConTar)
    {
        $this->ConTar = $ConTar;

        return $this;
    }

    public function get($id)
    {
        $query = "SELECT
                    CodTar,
                    CodUsu_Tar,
                    NomTar,
                    DesTar,
                    DatIniTar,
                    DatTerTar,
                    TepTar,
                    PonTar,
                    ConTar
				  FROM tarefa
				  WHERE CodTar = :id";

        $conn = $this->getConnection();
        $stmt = $conn->prepare($query);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetchAll();

        if (empty($result)) {
            throw new \Exception("Tarefa com ID {$id} não foi encontrada");
        }

        $result = $result[0];

        return $this
            ->setCodTar($result['CodTar'])
            ->setCodUsuTar($result['CodUsu_Tar'])
            ->setNomTar($result['NomTar'])
            ->setDesTar($result['DesTar'])
            ->setDatIniTar($result['DatIniTar'])
            ->setDatTerTar($result['DatTerTar'])
            ->setTepTar($result['TepTar'])
            ->setPonTar($result['PonTar'])
            ->setConTar($result['ConTar']);
    }

    public function save()
    {
        $params = [
            ':CodUsu_Tar' => $this->CodUsu_Tar,
            ':NomTar'     => $this->NomTar,
            ':DesTar'     => $this->DesTar,
            ':DatIniTar'  => $this->DatIniTar,
            ':DatTerTar'  => $this->DatTerTar,
            ':TepTar'     => $this->TepTar,
            ':PonTar'     => $this->PonTar,
            ':ConTar'     => $this->ConTar,
        ];

        if (empty($this->CodTar)) {
            $query = "INSERT INTO tarefa (CodUsu_Tar, NomTar, DesTar, DatIniTar, DatTerTar, TepTar, PonTar, ConTar)
				  VALUES(:CodUsu_Tar, :NomTar, :DesTar, :DatIniTar, :DatTerTar, :TepTar, :PonTar, :ConTar);";
        } else {
            $query = "UPDATE tarefa SET
                    CodUsu_Tar = :CodUsu_Tar,
                    NomTar = :NomTar,
                    DesTar = :DesTar,
                    DatIniTar = :DatIniTar,
                    DatTerTar = :DatTerTar,
                    TepTar = :TepTar,
                    PonTar = :PonTar,
                    ConTar = :ConTar
                    WHERE CodTar = :CodTar;";

            $params[':CodTar'] = $this->CodTar;
        }

        $stmt = $this->getConnection()->prepare($query);
        $result = $stmt->execute($params);

        if (!$result) {
            throw new \Exception('Erro ao salvar o usuário');
        }

        return $this;
    }
}