<?php

$servername = "localhost";
	$username = "android";
	$password = "53285328";
	$dbname = "andon";

$pToken;
$pMacAddress;
$htid;


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_REQUEST["MAC_ADDRESS"]))
{
	$pMacAddress = $_REQUEST['MAC_ADDRESS'];

	if(isset($_REQUEST["TOKEN"]))
	{
		$pToken = $_REQUEST['TOKEN'];

		if(isItNew($pMacAddress,$conn))
		{
			$qry = "INSERT INTO TEAM_LEADERS (MAC_ADDRESS,TOKEN) VALUES ($pMacAddress,$pToken)";
			mysqli_query($conn,$qry);
		}
		else
		{
			$qry = "UPDATE TEAM_LEADERS SET TOKEN = $pToken WHERE MAC_ADDRESS=$pMacAddress";
			mysqli_query($conn,$qry);
		}	
	}

	if(isset($_REQUEST["LINEA"]))
	{
		$pLinea = $_REQUEST['LINEA'];
		if(isItNew($pMacAddress,$conn))
		{
			$qry = "INSERT INTO TEAM_LEADERS (MAC_ADDRESS,LINEA) VALUES ($pMacAddress,$pLinea)";
			mysqli_query($conn,$qry);
		}
		else
		{
			$qry = "UPDATE TEAM_LEADERS SET LINEA = $pLinea WHERE MAC_ADDRESS=$pMacAddress";
			mysqli_query($conn,$qry);
		}	
	}

	if(isset($_REQUEST["LOGED"]))
	{
		$pLoged = $_REQUEST['LOGED'];
		$qry = "UPDATE TEAM_LEADERS SET LOGED = $pLoged WHERE MAC_ADDRESS=$pMacAddress";
		mysqli_query($conn,$qry);
	}

	if(isset($_REQUEST["NOMBRE"]))
	{
		$pName = $_REQUEST['NOMBRE'];
		$qry = "UPDATE TEAM_LEADERS SET NOMBRE = $pName WHERE MAC_ADDRESS=$pMacAddress";
		mysqli_query($conn,$qry);
	}

	if(isset($_REQUEST["IN_APP"]))
	{
		$pInApp = $_REQUEST['IN_APP'];
		$qry = "UPDATE TEAM_LEADERS SET IN_APP = $pInApp WHERE MAC_ADDRESS=$pMacAddress";
		mysqli_query($conn,$qry);	
	}


	
}


function isItNew($MA,$conn_f)
{
	$query = "SELECT * FROM TEAM_LEADERS WHERE MAC_ADDRESS = $MA";
	$res = mysqli_query($conn_f,$query);
	$rows = mysqli_num_rows($res);

	return $rows == 0;
}

?>
