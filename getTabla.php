<?php

/*$servername = "localhost";
$username = "octaviop_phpAndo";
$password = "5328bobi94";
$dbname = "octaviop_andon";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$qry = "DESCRIBE REGISTRO";
$result = mysqli_query($conn,$qry);
$rows = mysqli_num_rows($result);

$columnas = array();

for($i = 0;$i<$rows;$i++)
{
	$test = mysqli_fetch_row($result);
	$columnas[] = $test[0];
}

$qry = "SELECT * FROM REGISTRO";
$result = mysqli_query($conn,$qry);
$rows = mysqli_num_rows($result);

for($i = 0; $i<$rows; $i++)
{
	$test = mysqli_fetch_row($result);

	echo "{";

	for($j = 0;$j<sizeof($test);$j++)
	{
		echo "\"";
		echo $columnas[$j];
		echo "\"ndon:\"";
		if(!is_null($test[$j]))
		{
			echo $test[$j];
		}
		else
		{
			echo "null";
		}
		echo "\"";
		if($i<sizeof($test)-1)
		{
			echo ",";
		}
	}
	echo "}";
	echo "<br>";
}*/

getDataBaseInJSON("CAUSA");

function getDataBaseInJSON($DB)
{
	$servername = "localhost";
	$username = "android";
	$password = "53285328";
	$dbname = "andon";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	$qry = "DESCRIBE $DB";
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);

	$columnas = array();

	for($i = 0;$i<$rows;$i++)
	{
		$test = mysqli_fetch_row($result);
		$columnas[] = $test[0];
	}

	$qry = "SELECT * FROM $DB";
	$result = mysqli_query($conn,$qry);
	$rows = mysqli_num_rows($result);

	for($i = 0; $i<$rows; $i++)
	{
		$test = mysqli_fetch_row($result);

		echo "{";

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
		echo "<br>";
	}

}


?>

