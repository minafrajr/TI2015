<?php
//session_start();

require_once ("..\data\conect.php");//conexão com o banco.

$codUsu = $_SESSION['CodigoUsuario'];

try{
	if (!empty($_POST))
	{
		
		$query = "INSERT INTO tarefa (CodUsu_Tar,NomTar,DesTar,DatIniTar, TepTar) VALUES (:CodigoUsu,:NomeTar,:descricaoTar,:dataIniTarefa,:tepTarefa)";

		$query_params =array(':CodigoUsu'=> $codUsu,':NomeTar'=> $_POST["nometarefa"],':descricaoTar'=> $_POST["descri"],':dataIniTarefa'=> $_POST["data"],':tepTarefa'=> $_POST["hora"]);
		
		$stmt = $conn -> prepare($query);
		$result = $stmt -> execute($query_params);

		if($result){
			header("Location: ../views/index.php"); 
		}
	}
}
catch (PDOException $ex)
{
	die("Failed: " . $ex->getMessage());
}

?>