<?php

	require('conexion.php');

	$ID = $_GET['ID'];
	$tipo_busq = $_GET['tipo_busq'];
	/*if (isset($_POST['num_doc']) && !empty($_POST['num_doc']) &&
		isset($_POST['Tipo_doc']) && !empty($_POST['Tipo_doc'])) {
		echo "entro por dni";
		$tipo_busq = 2;
	} elseif (isset($_POST['num_soc']) && !empty($_POST['num_soc'])) {
		$tipo_busq = 1;
	} else {
		echo "No elijio ninguna busqueda";
	}*/


	if ($ID AND $tipo_busq) {

		if ($tipo_busq == 1) {

			if(pg_query($connect, "SELECT sp_baja_socio($tipo_busq,NULL,$ID)")){
				header('refresh:1;url:socios.php');
				echo "<p style='color:green';>BAJA REALIZADA CON EXITO</p>";
			} else {
				echo "<br>El Socio No Esta Activo";
			}
		} else {
			$tipo_doc = $_GET['tipo_doc'];
			if(pg_query($connect, "SELECT sp_baja_socio($tipo_busq,'$tipo_doc',$ID)")){
				header('refresh:1;url:socios.php');
				echo "<p style='color:green';>BAJA REALIZADA CON EXITO</p>";
			} else {
				echo "<br>El Socio No Esta Activo";
			}
		}
	} else {
		echo "Error";
	}

?>

<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Polideportivo</title>
	<meta name="description" content="">
	<!-- Mobile viewport optimized: h5bp.com/viewport -->
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" media="screen" href="css/superfish.css" /> 
	<link rel="stylesheet" href="css/nivo-slider.css" media="all"  /> 
	<link rel="stylesheet" href="css/tweet.css" media="all"  />
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" media="all" href="css/lessframework.css"/>
	
	
	<!-- All JavaScript at the bottom, except this Modernizr build.
	   Modernizr enables HTML5 elements & feature detects for optimal performance.
	   Create your own custom Modernizr build: www.modernizr.com/download/ -->
	<script src="js/modernizr-2.5.3.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		function mostrar(id){
			$("id").show();
			if (id == "num_dni") {
				$("#tipo_y_dni").show();
				$("#num_soc").hide();
			};
			if (id == "num_soc") {
				$("#tipo_y_dni").hide();
				$("#num_soc").show();
			};
		}
	</script>
</head>
<body>
	
	<!-- WRAPPER -->
	<div class="wrapper cf">
	
		<header class="cf">
						
			<div id="logo" class="cf">
				<a href="index.html" ><img src="img/logo.png" alt="" /></a>
			</div>
			
			<!-- nav -->
			<nav class="cf">
				<ul id="nav" class="sf-menu">
					<!-- Nuevo menu para socios? -->
					<li><a href="index.html"><span>INICIO</span></a></li>
					<li class="current-menu-item"><a href="socios.php"><span>SOCIOS</span></a></li> 
					<li><a href="empleados.php"><span>EMPLEADOS</span></a></li>
					<li><a href="proveedores.php"><span>PROVEEDORES</span></a></li>
					<li><a href="insumos.php"><span>INSUMOS</span></a></li>
					<li><a href="flia_emp.php"><span>FLIA EMPLEADOS</span></a></li>
					<li><a href="flia_soc.php"><span>FLIA SOCIOS</span></a></li>
				</ul>
				<div id="combo-holder"></div>
			</nav>
			<!-- ends nav -->
			
		</header>
		<table><tr>
				<td>Nombre</td>
				<td>Apellido</td>
				<td>Numero de Documento</td>
				<td>Tipo de Documento</td>
				<td>Numero de Socio</td>
				<td>Fecha de Ingreso</td>
				<td>Estado de Cuenta</td>
			</tr>
			<?php
				$porsoc = "SELECT * FROM socios INNER JOIN personas USING (id_persona) INNER JOIN tipos_doc USING (id_tipo_doc) WHERE numero_socio = $ID";
				$row = pg_query($connect, $porsoc);
				if ($reg = pg_fetch_array($row)) {
					$fecha_alta = $reg['fechaingreso'];
					$estado = $reg['estadocuenta'];
					$name = $reg['nombre'];
					$ape = $reg['apellido'];
					$num_doc = $reg['dni'];
					$tipo_doc = $reg['tipo_doc'];
					echo "<tr><td>".$name."</td><td>".$ape."</td><td>".$num_doc."</td><td>".$tipo_doc."</td><td>".$ID."</td><td>".$fecha_alta."</td><td>".$estado."</td></tr>";
				} else {
					echo "No es Socio";
				}
			?>
		</table>
	</div>
</body>
</html>
