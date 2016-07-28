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
					<li  class="current-menu-item"><a href="cuotas.php"><span>CUOTAS</span></a></li>
					<li><a href="alquileres.php"><span>ALQUILER</span></a></li>
					<li><a href="empleados.php"><span>EMPLEADOS</span></a></li>
					<li><a href="mantenimiento.php"><span>MANTENIMIENTO</span></a></li>
				</ul>
				<div id="combo-holder"></div>
			</nav>
			<!-- ends nav -->
		</header>

		<div class="toggle-container">
			<?php
				$monto = $_POST['monto'];
				$desc = $_POST['desc'];
				if(isset($monto) and isset($desc)){
					
					$consulta = "SELECT sp_alta_cuotas( $monto, $desc)";
					if (!$result = pg_query($connect,$consulta)) {
						echo '<p class="infobox-error">'.pg_last_error($connect).'</p><br>';
						echo '<p class="infobox-warning">'.pg_last_notice($connect).'</p><br>';
					} else {
						echo '<p class="infobox-success">Datos ingresados correctamente</p><br>';
					}
					
				}else{
					echo '<p class="infobox-warning">No se cuenta con todos los datos requeridos</p><br>';
				}
			?>
			<a href="cuotas.php" class="link-button">Volver</a>
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