<?php

$servername = "localhost";
	$username = "android";
	$password = "53285328";
	$dbname = "andon";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$ID_TELEGRAM;
$AREA;
$TIEMPO;

if(isset($_REQUEST["ID_TELEGRAM"])&&isset($_REQUEST["AREA"])&&isset($_REQUEST["TIEMPO"]))
{
	$ID_TELEGRAM = $_REQUEST['ID_TELEGRAM'];
	$AREA = $_REQUEST['AREA'];
	$TIEMPO = $_REQUEST['TIEMPO'];

	$qry = "SELECT * FROM PERSONAS_NOTIF WHERE ID_TELEGRAM = " . $_REQUEST['ID_TELEGRAM'] ;
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);

	if($rows <= 0 && $AREA != "BAJA")
	{
		$qry = "INSERT INTO PERSONAS_NOTIF (ID_TELEGRAM,AREA,MINUTOS) VALUES ($ID_TELEGRAM,$AREA,$TIEMPO)";
		mysqli_query($conn,$qry);
		echo "{\"RESULTADO\":\"1\",\"MENSAJE\":\"Se ha registrado correctamente en el área: subsarea para ser notificado a los substiempo minuto(s). Buen día.\"}";
	}
	else if (strtolower($AREA) == "baja")
	{
		$sql = "DELETE FROM PERSONAS_NOTIF WHERE ID_TELEGRAM = ".$ID_TELEGRAM;
		mysqli_query($conn,$sql);
		echo "{\"RESULTADO\":\"2\",\"MENSAJE\":\"Se ha dado de baja del sistema, ya no recibira más notificaciones.\"}";
	}
	else
	{
		$sql = "SELECT AREA FROM PERSONAS_NOTIF WHERE ID_TELEGRAM = ".$ID_TELEGRAM;
		$result = mysqli_query($conn,$sql);
		$test = mysqli_fetch_row($result);
		$area_past = $test[0];
		$sql = "SELECT MINUTOS FROM PERSONAS_NOTIF WHERE ID_TELEGRAM = ".$ID_TELEGRAM;
		$result = mysqli_query($conn,$sql);
		$test = mysqli_fetch_row($result);
		$tiempo_past = $test[0];
		if($area_past != $AREA || $tiempo_past != $TIEMPO)
		{

			$sql = "UPDATE PERSONAS_NOTIF SET AREA = ".$AREA." WHERE ID_TELEGRAM = " . $ID_TELEGRAM;
			//echo $sql . "<br>";
			mysqli_query($conn,$sql);
			$sql = "UPDATE PERSONAS_NOTIF SET MINUTOS = ".$TIEMPO." WHERE ID_TELEGRAM = " . $ID_TELEGRAM;
			//echo $sql . "<br>";
			mysqli_query($conn,$sql);
			echo "{\"RESULTADO\":\"3\",\"MENSAJE\":\"Se ha actualizado su registro correctamente, usted esta registrado en el área: subsarea para ser notificado a los substiempo minuto(s). buen día\"}";
		}
		else
		{
			echo "{\"RESULTADO\":\"4\",\"MENSAJE\":\"Usted ya esta registrado con esos datos, buen día.\"}";
		}
	}
}
else
{
	echo "PARA PRUEBAS EN EXPLORADOR ESTOS SON LOS DATOS EN EL GET:";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "ID_TELEGRAM";
	echo "<br>";
	echo "AREA";
	echo "<br>";
	echo "TIEMPO";
}






?>