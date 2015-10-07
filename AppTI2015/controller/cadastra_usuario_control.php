<?php
try
{

	require_once ("..\data\conect.php");

}
catch (PDOException $ex)
{
	die("Failed: " . $ex->getMessage());
}


?>


