<?php
$codUsu = $_SESSION['usuario']['codigo'];

try {
    if (!empty($_POST)) {
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
            ':NomTar'     => $_POST["nome"],
            ':DesTar'     => $_POST["descricao"],
            ':DatIniTar'  => $_POST["data"],
            ':TepTar'     => $_POST["duracao"],
            ':PonTar'     => $_POST["prioridade"]
        ];

        $stmt = $conn->prepare($query);
        $result = $stmt->execute($query_params);

        if ($result) {
            setSuccessMessage('Tarefa adicionada com sucesso!');
            redirect('/index.php');
        }
    }
} catch (PDOException $ex) {
    setErrorMessage($ex->getMessage());
}