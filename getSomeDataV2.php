<?php

/*$servername = "localhost";
$username = "octaviop_phpAndo";
$password = "5328bobi94";
$dbname = "mydb";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);*/
$DB;
$htid;

if(isset($_REQUEST["DB"]))
{
	$DB = $_REQUEST['DB'];
}

if(isset($_REQUEST["htid"]))
{
	$htid = $_REQUEST['htid'];
}

if(isset($_REQUEST["condicion"])&&isset($_REQUEST["DB"])&&isset($_REQUEST["htid"]))
{
	getDataBaseInJSON($DB,$_REQUEST['condicion'],$_REQUEST['htid']);
}

$tipo_qry = "D";
if(isset($_REQUEST["tipo_qry"]))
{
	if($tipo_qry == "spe")
	{
		$marco = "D1";
	}
	else
	{
		$marco = "D";
	}
}

if(isset($_REQUEST["condicion_android"]))
{
	echo $_REQUEST['condicion_android'] . "<br>";
	echo $_REQUEST['DB'] . "<br>";
	$qry = "SELECT * FROM ".$DB." WHERE " . $_REQUEST['condicion_android'];
	echo $qry;
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);
	

	



	echo ":";
	echo $marco;
	echo ":";
	for($i = 0; $i<$rows; $i++)
	{
		$test = mysqli_fetch_row($result);

		foreach ($test as &$valor) {
			if(!is_null($valor))
			{
			    echo $valor . "::";
			}
			else
			{
				echo "null::";
			}
		}
		echo "<br>";
	}	
	echo ":";
	echo $marco;
	echo ":";
}


if(isset($_REQUEST["now"]))
{

	$servername = "localhost";
	$username = "android";
	$password = "53285328";
	$dbname = "andon";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	$qry = "SELECT NOW()";
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);

	for($i = 0; $i<$rows; $i++)
	{
		$test = mysqli_fetch_row($result);

		foreach ($test as &$valor) {
			if(!is_null($valor))
			{
			    echo $valor;
			}
			else
			{
				echo "null";
			}
		}
	}
}


function getDataBaseInJSON($DB_F,$CONDICION_F,$htid_F)
{
	$servername = "localhost";
	$username = "android";
	$password = "53285328";
	$dbname = "andon";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	$qry = "DESCRIBE $DB_F";
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);

	$columnas = array();

	for($i = 0;$i<$rows;$i++)
	{
		$test = mysqli_fetch_row($result);
		$columnas[] = $test[0];
	}

	if($CONDICION_F!="GENERAL")
	{
		$qry = "SELECT * FROM $DB_F WHERE $CONDICION_F";
	}
	else
	{
		$qry = "SELECT * FROM $DB_F";
	}
	$result = mysqli_query($conn,$qry);	
	$rows = mysqli_num_rows($result);


	if($rows>0)
	{
		for($i = 0; $i<$rows; $i++)
		{
			$test = mysqli_fetch_row($result);

			echo "{\"htid\":\"$htid_F\",";

			for($j = 0;$j<sizeof($test);$j++)
			{
				echo "\"";
				echo $columnas[$j];
				echo "\":\"";
				if(!is_null($test[$j]))
				{
					echo $test[$j];
				}
				else
				{
					echo "null";
				}
				echo "\"";
				if($j<sizeof($test)-1)
				{
					echo ",";
				}
			}
			echo "}";
			if($i<$rows-1)
			{
				echo "JS";
			}
		}	
	}
	else
	{
		echo "{\"htid\":\"$htid_F\"}";
	}
	
}

?>