<?php

include('conexion.php');

if(isset($_GET['term'])){
	//CREATE OR REPLACE FUNCTION sp_busqueda_socio(tipo_busq integer, dato text)
	$valor = $_GET['term'];
}
$busqueda=$_GET['busqueda'];


if($busqueda==1){
	$query = "select * from sp_busqueda_socio(1, '$valor',null)";
			$consulta = pg_query($connect,$query);

			while($row = pg_fetch_array($consulta)){
				//$array['id'] = 456;
				$array['value'] = $row['apellido']." ".$row['nombre']." ".$row['tipo_doc']." ".$row['dni'];
				$array['numero_socio'] = $row['numero_socio'];
				$array['apellido'] = $row['apellido'];
				$array['nombre'] = $row['nombre'];
				$array['dni'] = $row['dni'];
				$array['tipo_doc'] = $row['tipo_doc'];
				$array['fechaingreso'] = $row['fechaingreso'];
				$array['estadocuenta'] = $row['estadocuenta'];
				$arreglo_completo[] = $array;
			}

			echo json_encode($arreglo_completo);
}
if($busqueda==2){
	$query = "SELECT * FROM sp_busqueda_empleado(1,'$valor')";
			$consulta = pg_query($connect,$query);

			while($row = pg_fetch_array($consulta)){
				//$array['id'] = 456;
				$array['value'] = $row['apellido']." ".$row['nombre']." ".$row['tipo_doc']." ".$row['dni'];
				$array['tipo_doc'] = $row['tipo_doc'];
				$array['apellido'] = $row['apellido'];
				$array['nombre'] = $row['nombre'];
				$array['dni'] = $row['dni'];
				$array['salario']=$row['salario'];
				$array['antiguedad']=$row['antiguedad'];
				$array['hora_entrada']=$row['hora_entrada'];
				$array['hora_salida']=$row['hora_salida'];
				$arreglo_completo[] = $array;
			}

			echo json_encode($arreglo_completo);
}

?>