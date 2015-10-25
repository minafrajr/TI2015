<?php
header('Content-Type: text/html; charset=utf-8');

require_once("..\data\connect.php");//conex�o com o banco.

try
{
	if (!empty($_POST))
	{
		//consulta
		$query = "SELECT CodUsu, NomUsu, EmaUsu
				  FROM usuario 
				  WHERE SenUsu= :senhaUsu and EmaUsu = :emailUsu";

		//repassa os par�metros
		$query_params = array(':senhaUsu'=>$_POST["senha"], ':emailUsu'=> $_POST["email"]);
		
		//executa a consulta no banco
		$stmt = $conn->prepare($query); 
		$stmt->execute($query_params); 
		$result = $stmt->fetchAll(); 

		if(!empty($result)){

			
			//
			$_SESSION['CodigoUsuario'] = $result[0]['CodUsu'];
			$_SESSION['user'] = $result[0]['NomUsu'];
			$_SESSION['email'] = $result[0]['EmaUsu'];
			
			//encaminha para a p�gina inicial.
			header("Location: ../views/index.php"); 
		}
		else{
		 header("Location: ../views/login.php"); 
		}
	} 
}
catch (PDOException $ex)
{
	die("Failed: " . $ex->getMessage());
}
?>