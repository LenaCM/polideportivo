<?php 
	$host = "localhost";
	$port = "5432";
	$user = "Esteban";
	$password = "1234";
	$dbname = "PolideportivoNuevo";
	$connect = pg_connect("host=$host port=$port user=$user password=$password dbname=$dbname");
	if($connect){
		echo "Conectado!<br>";
	}

	
?>