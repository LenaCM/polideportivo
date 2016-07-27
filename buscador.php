<?php

include('conexion.php');

if(isset($_GET['term'])){
	//CREATE OR REPLACE FUNCTION sp_busqueda_socio(tipo_busq integer, dato text)
	$valor = strtoupper($_GET['term']);
}
$busqueda=$_GET['busqueda'];


if($busqueda==1){
	$query = "select * from sp_busqueda_socio(1, '$valor',null)";
			$consulta = pg_query($connect,$query);

			while($row = pg_fetch_array($consulta)){
				
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
	$query = "select * from sp_busqueda_empleado(1,'$valor')";
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
if($busqueda==3){
	$query = "select * from sp_busqueda_socio(6, '$valor',null)";
			$consulta = pg_query($connect,$query);

			while($row = pg_fetch_array($consulta)){
				//$array['id'] = 456;
				$array['value'] = $row['apellido']." ".$row['nombre']." ".$row['tipo_doc']." ".$row['dni']." ".$row['disciplina'];
				$array['numero_socio'] = $row['numero_socio'];
				$array['apellido'] = $row['apellido'];
				$array['nombre'] = $row['nombre'];
				$array['dni'] = $row['dni'];
				$array['tipo_doc'] = $row['tipo_doc'];
				$array['fechaingreso'] = $row['fechaingreso'];
				$array['estadocuenta'] = $row['estadocuenta'];
				$array['disciplina']=$row['disciplina'];
				$array['id_disciplina']=$row['id_disciplina'];
				$arreglo_completo[] = $array;
			}

			echo json_encode($arreglo_completo);
}
if($busqueda==4){
	$query = "select * from sp_mostrar_familiares(2,'$valor')";
	$consulta = pg_query($connect,$query);
	while($row = pg_fetch_array($consulta)){
				
				$array['value'] = $row['apellido_socio'].", ".$row['nombre_socio']." es familiar de ".$row['apellido_socio_familiar'].", ".$row['nombre_socio_familiar'];
				$array['apellido_socio'] = $row['apellido_socio'];
				$array['nombre_socio'] = $row['nombre_socio'];
				$array['apellido_socio_familiar'] = $row['apellido_socio_familiar'];
				$array['nombre_socio_familiar'] = $row['nombre_socio_familiar'];
				$array['numero_socio'] = $row['numero_socio'];
				$array['numero_socio_familiar'] = $row['numero_socio_familiar'];
			
				$arreglo_completo[] = $array;
			}

			echo json_encode($arreglo_completo);
}
if($busqueda==5){
	$query = "select * from sp_mostrar_familiares(1,'$valor')";
	$consulta = pg_query($connect,$query);
	while($row = pg_fetch_array($consulta)){
				
				$array['value'] = $row['apellido_socio'].", ".$row['nombre_socio']." es familiar de ".$row['apellido_socio_familiar'].", ".$row['nombre_socio_familiar'];
				$array['apellido_socio'] = $row['apellido_socio'];
				$array['nombre_socio'] = $row['nombre_socio'];
				$array['apellido_socio_familiar'] = $row['apellido_socio_familiar'];
				$array['nombre_socio_familiar'] = $row['nombre_socio_familiar'];
				$array['numero_socio'] = $row['numero_socio'];
				$array['numero_socio_familiar'] = $row['numero_socio_familiar'];
			
				$arreglo_completo[] = $array;
			}

			echo json_encode($arreglo_completo);
}
if($busqueda==6){
	$query = "select * from sp_busqueda_socio(2, '$valor',null)limit 1";
			$consulta = pg_query($connect,$query);

			while($row = pg_fetch_array($consulta)){
				
				$array['value'] = $row['nombre'];
				$array['nombre'] = $row['nombre'];
				$arreglo_completo[] = $array;
			}

			echo json_encode($arreglo_completo);
}
if($busqueda==7){
	$query = "select * from sp_busqueda_socio(1, '$valor',null) limit 1";
			$consulta = pg_query($connect,$query);

			while($row = pg_fetch_array($consulta)){
				
				$array['value'] = $row['apellido'];
				$array['apellido'] = $row['apellido'];
				$arreglo_completo[] = $array;
			}

			echo json_encode($arreglo_completo);
}
if($busqueda==8){
	$query = "select * from sp_busqueda_socio(4, '$valor','') limit 1";
			$consulta = pg_query($connect,$query);

			while($row = pg_fetch_array($consulta)){
				
				$array['value'] = $row['dni'];
				$array['dni'] = $row['dni'];

				$arreglo_completo[] = $array;
			}

			echo json_encode($arreglo_completo);
}
if($busqueda==9){
	$query = "select * from sp_busqueda_socio(3, '$valor','') limit 1";
			$consulta = pg_query($connect,$query);

			while($row = pg_fetch_array($consulta)){
				
				$array['value'] = $row['disciplina'];
				$array['disciplina'] = $row['disciplina']; 
				$arreglo_completo[] = $array;
			}

			echo json_encode($arreglo_completo);
}
if($busqueda==10){
	$tipo = $_GET['tipo'];
	$query = "select * from sp_busqueda_socio($tipo, '$valor','')";
			$consulta = pg_query($connect,$query);

			while($row = pg_fetch_array($consulta)){
				//$array['id'] = 456;
				$array['value'] = $row['apellido']." ".$row['nombre']." ".$row['tipo_doc']." ".$row['dni']." ".$row['disciplina'];
				$array['numero_socio'] = $row['numero_socio'];
				$array['apellido'] = $row['apellido'];
				$array['nombre'] = $row['nombre'];
				$array['dni'] = $row['dni'];
				$array['tipo_doc'] = $row['tipo_doc'];
				$array['fechaingreso'] = $row['fechaingreso'];
				$array['estadocuenta'] = $row['estadocuenta'];
				$array['disciplina']=$row['disciplina'];
				$array['id_disciplina']=$row['id_disciplina'];
				$arreglo_completo[] = $array;
			}

			echo json_encode($arreglo_completo);
}
?>