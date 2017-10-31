<?php

	echo "hello world";
	echo "<br>";
	saludo("pedro");
	saludo("miguel");
	saludo("juan");
	saludo("kikes");

	function saludo($nombre)
	{
		static $cont = 0;
		echo "hola $nombre";
		echo " $cont";
		++$cont;
		echo "<br>";
	}
?>