<?php

	require('conexion.php');

	$nombre = $_GET['nombre'];
	if ($nombre) {
		if (pg_query($connect,"SELECT sp_baja_proveedor()")) {
			# code...
		}
	}
?>