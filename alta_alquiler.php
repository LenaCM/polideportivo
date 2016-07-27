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
					<li class="current-menu-item"><a href="alquileres.php"><span>ALQUILER</span></a></li>
					<li><a href="empleados.php"><span>EMPLEADOS</span></a></li>
					<li><a href="mantenimiento.php"><span>MANTENIMIENTO</span></a></li>
				</ul>
				<div id="combo-holder"></div>
			</nav>
			<!-- ends nav -->
		</header>

		<div class="toggle-container">
			<?php
				$tipo_alq = $_POST['tipo_alq'];
				$num_soc = $_POST['numero_soc'];
				$instalacion = $_POST['instalacion'];
				$fecha = $_POST['fecha'];
				$hora = $_POST['hora'];
				$costo = $_POST['costo'];
				$nombre = strtoupper($_POST['nombre']);
				$apellido = strtoupper($_POST['apellido']);
				$tipo_doc = $_POST['tipo_doc'];
				$dni = $_POST['num_doc'];
				$senia = $_POST['senia'];
				if(isset($tipo_alq)){
					if($tipo_alq==1){
						if(isset($num_soc) and isset($instalacion) and isset($fecha) and isset($hora) and isset($costo)){
							$consulta = "SELECT sp_alta_alquiler(1, null, $num_soc, '$instalacion', '$fecha', '$hora', $costo, false)";
							if (!$result = pg_query($connect,$consulta)) {
								echo '<p class="infobox-error">'.pg_last_error($connect).'</p><br>';
							} else {
								echo '<p class="infobox-success">Datos ingresados correctamente</p><br><br>';
							}
						}else{
							echo '<p class="infobox-warning">No se cuenta con todos los datos requeridos</p><br><br>';
						}
					}else{

					}
					if($tipo_alq==2){
						if( isset($instalacion) and isset($fecha) and isset($hora) and isset($costo) and isset($nombre) and isset($apellido) and isset($tipo_doc) and isset($dni) and isset($senia)){
							$consulta = "SELECT sp_alta_alquiler('$tipo_doc', $dni, '$nombre', '$apellido', '$instalacion', '$fecha', '$hora', $costo, $senia,false)";
							if (!$result = pg_query($connect,$consulta)) {
								echo '<p class="infobox-error">'.pg_last_error($connect).'</p><br>';
							} else {
								echo '<p class="infobox-success">Datos ingresados correctamente</p><br><br>';
							}
						}else{
							echo '<p class="infobox-warning">No se cuenta con todos los datos requeridos</p><br><br>';
						}
					}else{

					}
				}else{
					echo '<p class="infobox-warning">No se cuenta con todos los datos requeridos</p><br>';
				}
				
			?>
			<a href="alquileres.php" class="link-button">Volver</a>
			<br><br>

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