<?php

$servername = "127.0.0.1";
	$username = "android";
	$password = "53285328";
	$dbname = "andon";

$pLinea;
$pEstacion;
$htid;


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$qry = "SELECT * FROM REGISTRO";
$result = mysqli_query($conn,$qry);
$rows = mysqli_num_rows($result);		

if(isset($_REQUEST["linea"]))
{
	$pLinea = $_REQUEST['linea'];
}


if(isset($_REQUEST["estacion"]))
{
	$pEstacion = $_REQUEST['estacion'];
}

if(isset($_REQUEST["htid"]))
{
	$htid = $_REQUEST['htid'];
}


$qry = "INSERT INTO REGISTRO (ESTACION,LINEA,ENTERADO,RESUELTO,HORA_INICIO,CATEGORIA,CAUSA) VALUES ($pEstacion,$pLinea,0,0,NOW(),4,0)";
mysqli_query($conn,$qry);
$id_insert = mysqli_insert_id($conn);


echo "{\"htid\":\"$htid\",\"ID_REGISTRO\":\"$id_insert\",\"LINEA\":\"$pLinea\",\"ESTACION\":\"$pEstacion\"}"



?>

