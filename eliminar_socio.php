<?php
	require('conexion.php');

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
				<td>Modificar</td>
			</tr>
			<?php

				if (isset($_POST['num_doc']) && !empty($_POST['num_doc']) &&
					isset($_POST['Tipo_doc']) && !empty($_POST['Tipo_doc'])) {
					echo "entro por dni";
					$tipo_busq = 2;
					$num_doc = $_POST['num_doc'];
					$tipo_doc = $_POST['Tipo_doc'];
					$pordni = "SELECT * FROM socios INNER JOIN personas USING (id_persona) INNER JOIN tipos_doc USING (id_tipo_doc) WHERE dni = $num_doc AND tipo_doc = '$tipo_doc'";
					$row = pg_query($connect, $pordni);
					if ($reg = pg_fetch_assoc($row)) {
						$name = $reg['nombre'];
						$ape = $reg['apellido'];
						$num_soc = $reg['numero_socio'];
						$fecha_alta = $reg['fechaingreso'];
						$estado = $reg['estadocuenta'];
						echo "<tr><td>".$name."</td><td>".$ape."</td><td>".$num_doc."</td><td>".$tipo_doc."</td><td>".$num_soc."</td><td>".$fecha_alta."</td><td>".$estado."</td><td><a href=borrar_socio_resul.php?ID=".$num_soc."&tipo_busq=".$tipo_busq."$tipo_doc>ELIMINAR</a></td></tr>";
					} else {
						echo "<tr><td colspan=8>No es Socio</td></tr>";
					}
				} elseif (isset($_POST['num_soc']) && !empty($_POST['num_soc'])) {
					echo "Entro por socio";
					$tipo_busq = 1;
					$num_soc = $_POST['num_soc'];
					$porsoc = "SELECT * FROM socios INNER JOIN personas USING (id_persona) INNER JOIN tipos_doc USING (id_tipo_doc) WHERE numero_socio = $num_soc";
					$row = pg_query($connect, $porsoc);
					if ($reg = pg_fetch_array($row)) {
						$fecha_alta = $reg['fechaingreso'];
						$estado = $reg['estadocuenta'];
						$name = $reg['nombre'];
						$ape = $reg['apellido'];
						$num_doc = $reg['dni'];
						$tipo_doc = $reg['tipo_doc'];
						echo "<tr><td>".$name."</td><td>".$ape."</td><td>".$num_doc."</td><td>".$tipo_doc."</td><td>".$num_soc."</td><td>".$fecha_alta."</td><td>".$estado."</td><td><a href=borrar_socio_resul.php?ID=".$num_soc."&tipo_busq=".$tipo_busq.">ELIMINAR</a></td></tr>";
					} else {
						echo "<tr><td colspan=8>No es Socio</td></tr>";
					}
				} else {
					echo "Error, No ingreso ningun dato";
				}
			?>
		</table>

	</div>
</body>
</html>