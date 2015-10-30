<?php

$codUsuario = $_SESSION['usuario']['codigo'];

$duracao = (int) getParam('duracao', 0);
$data = getParam('data');
$ordenar = getParam('ordenar', 'DatIniTar');

if ($ordenar !== 'DatIniTar' && $ordenar !== 'TepTar') {
    die('Falha de segurança! SQL Injection!');
}

$params = [':CodUsu_Tar' => $codUsuario];
$where = '';

if (!empty($duracao)) {
    $where .= "AND HOUR(TepTar) + 1 >= :Duracao ";
    $params[':Duracao'] = $duracao;
}

if (!empty($data)) {
    $where .= "AND DATE(DatIniTar) = :Data ";
    $params[':Data'] = $data;
}

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
$where
ORDER BY $ordenar ASC";

$conn = Connect::getinstance()->getConnection();
$stmt = $conn->prepare($sql);
$stmt->execute($params);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);