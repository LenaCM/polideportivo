<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php 

	require('conexion.php');
	include('html/head.html');

	$nom = $_POST['name'];
	$ape = $_POST['Apellido'];
	$num_doc = $_POST['num_doc'];
	$tipo = $_POST['Tipo_doc'];

	$consulta = "SELECT sp_alta_socio('$nom','$ape', $num_doc,'$tipo')";


?>
<body>
	<div class="wrapper cf">
		<!-- ribbon -->
			<div id="twitter-holder">
				<div class="ribbon-left"></div>
				<div class="ribbon"></div>
				<div class="ribbon-right"></div>
			</div>
		<!-- ENDS ribbon -->
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

				if (!$result = pg_query($connect,$consulta)) {
					echo '<p class="infobox-error">'.pg_last_error($connect).'</p>';
				} else {
					echo '<p class="infobox-success">Datos ingresados correctamente</p>';
				}
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
		<!-- ribbon -->
			<div id="twitter-holder">
				<div class="ribbon-left"></div>
				<div class="ribbon"></div>
				<div class="ribbon-right"></div>
			</div>
		<!-- ENDS ribbon -->
	</div>
</body>
</html>