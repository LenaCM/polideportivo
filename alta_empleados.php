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

	?>

</head>
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
					<li><a href="directivos.php"><span>DIRECTIVOS</span></a></li>
					<li><a href="socios.php"><span>SOCIOS</span></a></li> 
					<li><a href="cuotas.php"><span>CUOTAS</span></a></li>
					<li><a href="alquileres.php"><span>ALQUILER</span></a></li>
					<li class="current-menu-item"><a href="empleados.php"><span>EMPLEADOS</span></a></li>
					<li><a href="mantenimiento.php"><span>MANTENIMIENTO</span></a></li>
				</ul>
				<div id="combo-holder"></div>
			</nav>
			<!-- ends nav -->
		</header>
		<div role="main" id="main" class="cf">
		<div class="toggle-container">
			<table><tr>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Numero de Documento</th>
				<th>Tipo de Documento</th>
				<th>Salario</th>
				<th>Antiguedad</th>
				<th>Horario de Entrada</th>
				<th>Horario de Salida</th>
			</tr>
			<?php 

				$nom = $_POST['name'];
				$ape = $_POST['apellido'];
				$num_doc = $_POST['num_doc'];
				$tipo = $_POST['tipo_doc'];
				$sueldo = $_POST['sueldo'];
				$ant = $_POST['antiguedad'];
				$entrada = $_POST['ho_ent'];
				$salida = $_POST['ho_sal'];
				
				$consulta = "select sp_alta_empleado('".$nom."','".$ape."', ".$num_doc.",'".$tipo."',".$sueldo.",".$ant.",'".$entrada."','".$salida."')";

				$result = pg_query($connect,$consulta);
				echo $num_doc;
				if (!$result) {
					echo '<p class="infobox-error">'.pg_last_error($connect).'</p><br>';
				} else {
					echo "Datos ingresados correctamente<br>";
				}
			
				$consulta2 = "SELECT * FROM empleados INNER JOIN personas USING (id_persona) INNER JOIN tipos_doc USING (id_tipo_doc) WHERE dni = $num_doc AND tipo_doc='$tipo'";
				if($row = pg_query($connect, $consulta2) && $result){
					/*while ($reg = pg_fetch_assoc($row)){
						$salario = $reg['salario'];
						$antiguedad = $reg['antiguedad'];
						$ho_ent = $reg['hora_entrada'];
						$ho_sal = $reg['hora_salida'];
					}*/

					echo "<tr><td>$nom</td><td>$ape</td><td>$num_doc</td><td>$tipo</td><td>$sueldo</td><td>$ant</td><td>$entrada</td><td>$salida</td></tr>";
				} else {
					echo "<tr><td colspan=8>No se ha registrado el empleado</td></tr>";
				}
			?>
			</table>
		</div>
		</div>
		<footer>
			<!-- ribbon -->
			<div id="twitter-holder">
				<div class="ribbon-left"></div>
				<div class="ribbon"></div>
				<div class="ribbon-right"></div>

			</div>

		<!-- ENDS ribbon -->		
		</footer>

	</div>
</body>
</html>
