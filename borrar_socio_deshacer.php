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
	
	<!-- WRAPPER -->
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
					<li class="current-menu-item"><a href="socios.php"><span>SOCIOS</span></a></li> 
					<li><a href="cuotas.php"><span>CUOTAS</span></a></li>
					<li><a href="alquileres.php"><span>ALQUILER</span></a></li>
					<li><a href="empleados.php"><span>EMPLEADOS</span></a></li>
					<li><a href="mantenimiento.php"><span>MANTENIMIENTO</span></a></li>
				</ul>
				<div id="combo-holder"></div>
			</nav>
			<!-- ends nav -->
			
		</header>
		<div role="main" id="main" class="cf">
			<div class="toggle-container">
				<?php
					$ID = $_GET['ID'];
					$tipo_busq = $_GET['tipo_busq'];

					if ($ID AND $tipo_busq) {

						if ($tipo_busq == 1) {

							if(pg_query($connect, "select sp_deshacer_eliminacion_socio($tipo_busq, null, $ID)")){
								echo '<p class="infobox-success">Se deshicieron los cambios</p>';
							}else {
								echo '<p class="infobox-error">'.pg_last_error($connect).'</p>';
							}
						}else {
							$tipo_doc = $_GET['tipo_doc'];
							if(pg_query($connect, "select sp_deshacer_eliminacion_socio($tipo_busq, '$tipo_doc', '$ID')")){
								echo '<p class="infobox-success">Se deshicieron los cambios</p>';
							} else {
								echo '<p class="infobox-error">'.pg_last_error($connect).'</p>';
							}
						}
					} else {
						echo '<p class="infobox-error">No se cargaron datos</p>';
					}
					echo '<a class="link-button" href="socios.php"> Volver </a>';
				?>
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
