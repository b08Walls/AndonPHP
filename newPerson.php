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


if($_REQUEST["ID_TELEGRAM"])
{
	$ID_TELEGRAM = $_REQUEST['ID_TELEGRAM'];
}

if($_REQUEST["AREA"])
{
	$AREA = $_REQUEST['AREA'];
}

if($_REQUEST["TIEMPO"])
{
	$TIEMPO = $_REQUEST['TIEMPO'];
}

$qry = "SELECT * FROM PERSONAS_NOTIF WHERE ID_TELEGRAM = " . $_REQUEST['ID_TELEGRAM'] ;
$result = mysqli_query($conn,$qry);
$rows = mysqli_num_rows($result);

if($rows <= 0 && $AREA != "BAJA")
{
	$qry = "INSERT INTO PERSONAS_NOTIF (ID_TELEGRAM,AREA,MINUTOS) VALUES ($ID_TELEGRAM,$AREA,$TIEMPO");
	mysqli_query($conn,$qry);
	echo ":E:1:E:";
}
else if ($AREA == "BAJA")
{
	$sql = "DELETE FROM PERSONAS_NOTIF WHERE ID_TELEGRAM = ".$ID_TELEGRAM;
	mysqli_query($conn,$sql);
	echo ":E:3:E:";	
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
		echo $sql . "<br>";
		mysqli_query($conn,$sql);
		$sql = "UPDATE PERSONAS_NOTIF SET MINUTOS = ".$TIEMPO." WHERE ID_TELEGRAM = " . $ID_TELEGRAM;
		echo $sql . "<br>";
		mysqli_query($conn,$sql);
		echo ":E:2:E:";
	}
	else
	{
		echo ":E:0:E:";
	}
}


?>