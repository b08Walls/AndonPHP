<?php

	$servername = "localhost";
	$username = "android";
	$password = "53285328";
	$dbname = "andon";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	$ID_PERSONA;
	$ID_REGISTRO;

	if(isset($_REQUEST["ID_PERSONA"])&&isset($_REQUEST["ID_REGISTRO"]))
	{
		$ID_REGISTRO = $_REQUEST['ID_REGISTRO'];
		$ID_PERSONA = $_REQUEST['ID_PERSONA'];
		$qry = "SELECT * FROM NOTIFICACIONES WHERE ID_PERSONA = $ID_PERSONA AND ID_REGISTRO = $ID_REGISTRO";
		$result = mysqli_query($conn,$qry);
		$rows = mysqli_num_rows($result);

		if($rows==0)
		{
			$qry = "INSERT INTO NOTIFICACIONES (ID_REGISTRO,ID_PERSONA) VALUES ($ID_REGISTRO,$ID_PERSONA)";
			mysqli_query($conn,$qry);
			echo "{\"RESULTADO\":\"OK\"}";
		}
		else
		{
			echo "{\"RESULTADO\":\"NOK\"}";
		}
	}
	else if(isset($_REQUEST["ID_REGISTRO"])&&isset($_REQUEST["STATUS"]))
	{
		$new = $_REQUEST["STATUS"];
		$ID_REGISTRO = $_REQUEST["ID_REGISTRO"];
		$qry = "UPDATE NOTIFICACIONES SET STATUS = $new WHERE ID_REGISTRO = $ID_REGISTRO";
		mysqli_query($conn,$qry);
	}
	else
	{
		echo "EN EL GET DEBERAS ENVIAR, ID_PERSONA y ID_REGISTRO";
	}



?>