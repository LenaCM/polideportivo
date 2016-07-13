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
					<li><a href="socios.php"><span>SOCIOS</span></a></li> 
					<li class="current-menu-item"><a href="empleados.php"><span>EMPLEADOS</span></a></li>
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
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Numero de Documento</th>
				<th>Tipo de Documento</th>
				<th>Salario</th>
				<th>Antiguedad</th>
				<th>Hora de Entrada</th>
				<th>Hora de Salida</th>
				<th>MODIFICAR</th>
				<th>ELIMINAR</th>
			</tr>

			<?php
				if (isset($_POST['num_doc']) && !empty($_POST['num_doc']) &&
					isset($_POST['tipo_doc']) && !empty($_POST['tipo_doc'])) {
					$num_doc = $_POST['num_doc'];
					$tipo_doc = $_POST['tipo_doc'];
					$consulta = "SELECT * FROM empleados INNER JOIN personas USING (id_persona) INNER JOIN tipos_doc USING (id_tipo_doc) WHERE dni = $num_doc AND tipo_doc = '$tipo_doc'";
					$row = pg_query($connect, $consulta);
					if ($reg = pg_fetch_assoc($row)) {
						$name = $reg['nombre'];
						$ape = $reg['apellido'];
						$salario = $reg['salario'];
						$antiguedad = $reg['antiguedad'];
						$ho_ent = $reg['hora_entrada'];
						$ho_sal = $reg['hora_salida'];
						echo "<tr><td>".$name."</td><td>".$ape."</td><td>".$num_doc."</td><td>".$tipo_doc."</td><td>".$salario."</td><td>".$antiguedad."</td><td>".$ho_ent."</td><td>".$ho_sal."</td><td><a href=modificar_empleado.php?ID=".$num_doc."&tipo_doc=".$tipo_doc.">MODIFICAR</a></td><td><a href=borrar_empleado_resul.php?ID=".$num_doc."&tipo_doc=".$tipo_doc.">ELIMINAR</a></td></tr>";
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