<?php

$servername = "localhost";
	$username = "android";
	$password = "53285328";
	$dbname = "andon";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if(isset($_REQUEST["new_val"])&&isset($_REQUEST["field"])&&isset($_REQUEST["ID_REGISTRO"]))
{
	updateSomeData($_REQUEST['field'],$_REQUEST['new_val'],$_REQUEST['ID_REGISTRO'],$conn);
}

function updateSomeData($field, $new_val,$ID_REGISTRO_F,$conn_F)
{
	$qry = "UPDATE REGISTRO SET $field = $new_val WHERE ID_REGISTRO = $ID_REGISTRO_F";
	mysqli_query($conn_F,$qry);
}


mysqli_close($conn);

?>
