<?php 

	require('conexion.php');

	$nom = $_POST['name'];
	$ape = $_POST['Apellido'];
	$num_doc = $_POST['num_doc'];
	$tipo = $_POST['Tipo_doc'];

	$consulta = "SELECT sp_alta_socio('$nom','$ape', $num_doc,'$tipo')";

	/*echo $consulta;*/

	if (!$result = pg_query($connect,$consulta)) {
		echo "Error al dar el Alta";
	} else {
		echo "Datos ingresados correctamente<br>";
	}

	/*$id_pers = pg_query($connect, "SELECT id_persona FROM socios INNER JOIN personas USING (id_persona) INNER JOIN tipos_doc USING (id_tipo_doc) WHERE dni = $num_doc AND tipo_doc = '$tipo'");
	while ($row= pg_fetch_assoc($id_pers)) {
		$id_p = $id_pers['id_persona'];
	}
	echo $id_p;*/

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
</head>
<body>
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

		<div class="toggle-container">
			<table><tr>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Numero de Documento</th>
				<th>Tipo de Documento</th>
				<th>Numero de Socio</th>
				<th>Fecha de Ingreso</th>
				<th>Estado de Cuenta</th>
			</tr>
			<?php
			$consulta2 = "SELECT * FROM socios INNER JOIN personas USING (id_persona) INNER JOIN tipos_doc USING (id_tipo_doc) WHERE dni = $num_doc AND tipo_doc='$tipo'";
				$row = pg_query($connect, $consulta2);
				while ($reg = pg_fetch_assoc($row)){
					$id_soc = $reg['numero_socio'];
					$fecha_alta = $reg['fechaingreso'];
					$estado = $reg['estadocuenta'];
				}
				echo "<tr><td>$nom</td><td>$ape</td><td>$num_doc</td><td>$tipo</td><td>$id_soc</td><td>$fecha_alta</td><td>$estado</td></tr>";
			?>

			</table>
		</div>
	</div>
</body>
</html>