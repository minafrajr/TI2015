<?php

require_once ("..\data\conect.php");//conexão com o banco.

try
{
	if (!empty($_POST))
	{
		$query="INSERT INTO usuario (NomUsu,DatNasUsu,SenUsu,EmaUsu)
				VALUES(:NomUsu,:DatNasUsu,:SenUsu,:EmaUsu)";

		$query_params =array(':NomUsu'=> $_POST["nomeU"],'DatNasUsu'=>$_POST["dataN"],'SenUsu'=>$_POST["senha"],'EmaUsu'=>$_POST["email"]);

		$stmt = $conn -> prepare($query);
		$result = $stmt -> execute($query_params);
	}
}
catch (PDOException $ex)
{
	die("Failed: " . $ex->getMessage());
}


?>


