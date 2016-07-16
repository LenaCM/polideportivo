|<?php 
	$host = "localhost";
	$port = "5432";
	$user = "postgres";
	$password = "1234";
	$dbname = "polideportivo";
	$connect = pg_connect("host=$host port=$port user=$user password=$password dbname=$dbname");
	if(!$connect){
		echo "No se pudo conectar <br>";
	}

	

?>