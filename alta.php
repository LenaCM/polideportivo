<?php 

	require('conexion.php');

	$nom = $_POST['name'];
	$ape = $_POST['Apellido'];
	$num_doc = $_POST['num_doc'];
	$tipo = $_POST['Tipo_doc'];

	$consulta = "SELECT sp_alta_persona('$nom','$ape', $num_doc,'$tipo')";

	echo $consulta;

	if (!$result = pg_query($connect,$consulta)) {
		echo "Error al dar el Alta";
	} else {
		echo "Datos ingresados correctamente";
	}

?>