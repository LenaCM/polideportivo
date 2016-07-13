<?php

	require('conexion.php');

	$ID = $_GET['ID'];
	$tipo_doc = $_GET['tipo_doc'];

	$consulta = "SELECT * FROM empleados INNER JOIN personas USING (id_persona) INNER JOIN tipos_doc USING (id_tipo_doc) WHERE dni = $ID AND tipo_doc = '$tipo_doc'";
	$result = pg_query($connect,$consulta);

	while ($row=pg_fetch_assoc($result)){
		$name = $row['nombre'];
		$apellido = $row['apellido'];
		$doc = $row['dni'];
		$tipo = $row ['tipo_doc'];
		$salario = $row['salario'];
		$antiguedad = $row['antiguedad'];
		$ho_ent = $row['hora_entrada'];
		$ho_sal = $row['hora_salida'];
	}

	if (isset ($_POST['Modificar'])) {
		if (isset($_POST['name']) && !empty($_POST['name']) && 
			isset($_POST['apellido']) && !empty($_POST['apellido']) &&
			isset($_POST['num_doc']) && !empty($_POST['num_doc']) &&
			isset($_POST['tipo_doc']) && !empty($_POST['tipo_doc']) &&
			isset($ID) && !empty($ID) && isset($tipo_doc) && !empty($tipo_doc))
		{
			$name2 = $_POST['name'];
			$ape2 = $_POST['apellido'];
			$doc2 = $_POST['num_doc'];
			$tipo2 = $_POST['tipo_doc'];
			$salario2 = $_POST['sueldo'];
			$antiguedad2 = $_POST['antiguedad'];
			$ho_ent2 = $_POST['ho_ent'];
			$ho_sal2 = $_POST['ho_sal'];
			if (pg_query($connect, "SELECT sp_modificar_empleado($ID,'$tipo_doc',$doc2,'$tipo2','$name2','$ape2',$salario2,$antiguedad2,'$ho_ent2','$ho_sal2')")) {
				header('refresh:1;url=empleados.php');
				echo "<p style='color:green';>MODIFICACION REALIZADA CON EXITO</p>";
			} else {
				echo "No se pudo modificar el Empleado";
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

		<div class="toggle-container">
			<form id="contactForm" method = "POST" action="">
				<p>
					<label for="name" >Nombre</label>
					<input name="name"  id="name" type="text" class="form-poshytip" value="<?php echo $name;?>" title="Enter your name" />
				</p>
				
				<p>
					<label for="apellido" >Apellido</label>
					<input name="apellido"  id="apellido" type="text" class="form-poshytip" value="<?php echo $apellido;?>" title="Enter your sub name" value="AMAYA" />
				</p>
				
				<p>
					<label for="tipo_doc">Tipo de Documento</label>
					<select name="tipo_doc" id="tipo_doc" class="form-poshytip" value="<?php echo $tipo;?>" title="Enter your type of document">
						<option value="DNI" selected>DNI</option>
						<option value="PAS">PASAPORTE</option>
						<option value="LE">LIBRETA DE ENROLAMIENTO</option>
						<option value="LC">LIBRETA CIVICA</option>
					</select>
				</p><br>
				<p>
					<label for="num_doc">Numero de Documento</label>
					<input name="num_doc" id="num_doc" type="text" class="form-poshytip" value="<?php echo $doc;?>" title="Enter your document number" />
				</p>
				<p>
					<label for="sueldo">Sueldo</label><br>
					<input name="sueldo" id="sueldo" type="text" class="form-poshytip" value="<?php echo $salario;?>" title="Enter your document number" />
				</p>
				<p>
					<label for="antiguedad">Antiguedad</label>
					<input name="antiguedad" id="antiguedad" type="text" class="form-poshytip" value="<?php echo $antiguedad;?>" title="Enter your document number" />
				</p>
					<label for="ho_ent">Hora de entrada</label>
					<input name="ho_ent" id="ho_ent" type="time" class="form-poshytip" value="<?php echo $ho_ent;?>" title="Enter your document number" />
				</P><br>
				<p>
					<label for="ho_sal">Hora de salida</label>
					<input name="ho_sal" id="ho_sal" type="time" class="form-poshytip" value="<?php echo $ho_sal;?>" title="Enter your document number" />
				</p>

				<input type="submit" value="Modificar" name="Modificar"/>
			</form>
		</div>
	</div>
</body>
</html>