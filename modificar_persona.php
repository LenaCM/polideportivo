<?php 

	require('conexion.php');

	if ($_POST['num_doc'] == NULL){
		$doc = NULL;
	} else {
		$doc = $_POST['num_doc'];
	}
	if ($_POST['name'] == NULL){
		$name = NULL;
	} else {
		$name = $_POST['name'];
	}
	if ($_POST['apellido'] == NULL){
		$ape = NULL;
	} else {
		$ape = $_POST['apellido'];
	}
	$tipo_doc = $_POST['tipo_doc'];
	$doc_busq = $_POST['num_doc_busq'];
	$tipo_doc_busq = $_POST['tipo_doc_busq'];

	$consulta = "SELECT sp_modificacion_persona ($doc_busq,'$tipo_doc_busq',$doc,'$tipo_doc','$name','$ape')";

	echo $consulta;

	if (!$result = pg_query($connect,$consulta)) {
		echo "Error al modificar datos";
	} else {
		echo "Cambios realizados con exito";
	}
?>