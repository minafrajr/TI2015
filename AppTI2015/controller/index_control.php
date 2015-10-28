<?php

$codUsuario = $_SESSION['usuario']['codigo'];
$sql = "SELECT
    CodTar,
    NomTar,
    DesTar,
    DATE_FORMAT(DatIniTar, '%Y-%m-%dT%H:%i') as DatIniTar,
    DatTerTar,
    TepTar,
    PonTar
FROM tarefa
WHERE CodUsu_Tar = :CodUsu_Tar
ORDER BY DatIniTar ASC";

$stmt = $conn->prepare($sql);
$stmt->execute([':CodUsu_Tar' => $codUsuario]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);