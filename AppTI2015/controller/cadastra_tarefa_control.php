<?php
$codUsu = $_SESSION['usuario']['codigo'];

try {
    if (!empty($_POST)) {
        $query = "INSERT INTO tarefa (CodUsu_Tar, NomTar, DesTar, DatIniTar, TepTar)
                  VALUES (:CodigoUsu, :NomeTar, :descricaoTar, :dataIniTarefa, :tepTarefa)";

        $query_params = [
            ':CodigoUsu'     => $codUsu,
            ':NomeTar'       => $_POST["nome"],
            ':descricaoTar'  => $_POST["descricao"],
            ':dataIniTarefa' => $_POST["data"],
            ':tepTarefa'     => $_POST["hora"]
        ];

        $stmt = $conn->prepare($query);
        $result = $stmt->execute($query_params);

        if ($result) {
            header("Location: /index.php");
        }
    }
} catch (PDOException $ex) {
    die("Failed: " . $ex->getMessage());
}