<?php

	require('conexion.php');

	$nombre = $_GET['nombre'];

	$consulta = "SELECT * FROM proveedores WHERE nombre = '$nombre'";
	$result = pg_query($connect,$consulta);

	while ($row=pg_fetch_assoc($result)) {
		$dir = $row['direccion'];
		$tel = $row['telefono'];
	}

	if (isset ($_POST['Modificar'])) {
		if (isset($_POST['name']) && !empty($_POST['name']) &&
			isset($_POST['dir']) && !empty($_POST['dir']) &&
			isset($_POST['tel']) && !empty($_POST['tel'])) {
			$nombre2 = $_POST['name'];
			$dir2 = $_POST['dir'];
			$tel2 = $_POST['tel'];
			if (pg_query($connect, "SELECT sp_modificacion_proveedor('$nombre','$nombre2','$tel2','$dir2')")) {
				header('refresh:1;url=proveedores.php');
				echo "<p style='color:green';>MODIFICACION REALIZADA CON EXITO</p>";
			} else {
				echo "No se pudo modificar el Proveedor";
			}
		} else {
			echo "Error";
		}
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
					<li><a href="socios.php"><span>SOCIOS</span></a></li> 
					<li><a href="empleados.php"><span>EMPLEADOS</span></a></li>
					<li class="current-menu-item"><a href="proveedores.php"><span>PROVEEDORES</span></a></li>
					<li><a href="insumos.php"><span>INSUMOS</span></a></li>
					<li><a href="flia_emp.php"><span>FLIA EMPLEADOS</span></a></li>
					<li><a href="flia_soc.php"><span>FLIA SOCIOS</span></a></li>
				</ul>
				<div id="combo-holder"></div>
			</nav>
			<!-- ends nav -->
		</header>

		<div class="toggle-container">
			<form id="contactForm" method = "POST" action="">
				<p>
					<label for="name">Nombre</label>
					<input name="name"  id="name" type="text" value="<?php echo $nombre;?>" class="form-poshytip" title="Enter your name" />
				</p>
				
				<p>
					<label for="dir">Direccion</label>
					<input name="dir"  id="dir" type="text" value="<?php echo $dir;?>" class="form-poshytip" title="Enter your sub name" />
				</p>
				
				<p>
					<label for="tel">Telefono</label>
					<input name="tel" id="tel" type="text" value="<?php echo $tel;?>" class="form-poshytip" title="Enter your document number" />
				</p>

				<input type="submit" value="Modificar" name="Modificar"/>
			</form>
		</div>
	</div>
</body>
</html>