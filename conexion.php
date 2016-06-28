<?php 
	$host = "localhost";
	$port = "5432";
	$user = "postgres";
	$password = "1234";
	$dbname = "polideportivo";
	$connect = pg_connect("host=$host port=$port user=$user password=$password dbname=$dbname");
	if($connect){
		echo "Conectado!<br>";
	}

	$consulta = "SELECT * from socios s inner join personas p using(id_persona)";
	$result = pg_query($connect, $consulta);

	echo "<pre>Número Socio		Nombres		Apellidos</pre><br>";
	while($row = pg_fetch_assoc($result)){
		echo "<pre>".$row['numero_socio']."		".$row['nombre']."		".$row['apellido']."</pre><br>";
	}

?>