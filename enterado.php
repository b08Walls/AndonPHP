<?php

$servername = "localhost";
	$username = "android";
	$password = "53285328";
	$dbname = "andon";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if( $_REQUEST["enterado"])
{
	$new_status = 0;

	echo $_REQUEST['enterado'];
	if($_REQUEST['enterado']=="true")
	{
		$new_status = 1;
	}
	else if($_REQUEST['enterado']=="false")
	{
		$new_status = 0;
	}
	
	$qry = "SELECT * FROM REGISTRO";
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);

	$qry = "UPDATE REGISTRO SET ENTERADO = " . $new_status . " WHERE ID_REGISTRO = " . $rows;
	echo "<br>" . $qry;
	mysqli_query($conn,$qry);
}

if( $_REQUEST["resuelto"])
{
	$new_status = 0;

	$qry = "SELECT * FROM REGISTRO";
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);

	if($_REQUEST['resuelto']=="true")
	{
		$new_status = 1;
		$qry = "UPDATE REGISTRO SET HORA_FINAL = NOW() WHERE ID_REGISTRO = " . $rows;
		mysqli_query($conn,$qry);
	}
	else if($_REQUEST['enterado']=="false")
	{
		$new_status = 0;
	}

	$qry = "UPDATE REGISTRO SET resuelto = " . $new_status . " WHERE ID_REGISTRO = " . $rows;
	echo "<br>" . $qry;
	mysqli_query($conn,$qry);
}

if($_REQUEST["categoria"])
{
	$new_status = 0;
	$qry = "SELECT * FROM REGISTRO";
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);

	switch($_REQUEST['categoria'])
	{
		case "mantenimiento":
		$new_status = 0;
		echo $new_status . "<br>";
		break;

		case "logistica":
		$new_status = 1;
		break;

		case "calidad":
		$new_status = 2;
		break;

		case "produccion":
		$new_status = 3;
		break;
		default:
		$new_status = -1;
		break;
	}

	if($new_status>=0)
	{
		$qry = "UPDATE REGISTRO SET categoria = " . $new_status . " WHERE ID_REGISTRO = " . $rows;
		echo "<br>" . $qry;
		mysqli_query($conn,$qry);
	}
}

if($_REQUEST["estacion"])
{
	$qry = "SELECT * FROM REGISTRO";
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);

	$qry = "UPDATE REGISTRO SET ESTACION = " . $_REQUEST['estacion'] . " where ID_REGISTRO = " . $rows;
	mysqli_query($conn,$qry);
}


mysql_close($conn);

?>

