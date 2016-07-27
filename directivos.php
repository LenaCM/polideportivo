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
					<li class="current-menu-item"><a href="directivos.php"><span>DIRECTIVOS</span></a></li>
					<li><a href="socios.php"><span>SOCIOS</span></a></li> 
					<li><a href="cuotas.php"><span>CUOTAS</span></a></li>
					<li><a href="alquileres.php"><span>ALQUILER</span></a></li>
					<li><a href="empleados.php"><span>EMPLEADOS</span></a></li>
					<li><a href="mantenimiento.php"><span>MANTENIMIENTO</span></a></li>
				</ul>
				<div id="combo-holder"></div>
			</nav>
			<!-- ends nav -->
			
		</header>
		
		<!-- MAIN -->
		<div role="main" id="main" class="cf">
			
			<!-- headline -->
			<div class="headline">Panel Administracion de Directivos</div>
			<!-- ENDS headline -->
			
			<!-- Toggle opciones -->
			<div class="page-content entry-content feature cf">
				
			<h2 class="heading" style="text-align:center;">Opciones</h2>

			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				Dar de alta un nuevo directivo
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>		
			<div class="toggle-container" >
				<!-- form -->
				<!-- Modificado 28/06/2016 -->
				<div id="por_apellido">
								<form id="contactForm" action="alta_directivos.php" method="post">
									<fieldset>
											<p>
												<input class="busqueda" name="apellido_n" id="apellido_n" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder="Comience a escribir el apellido..."/>
											</p>
									</fieldset>
									 <input type="hidden" id="num-alta-directivo" name="num_socio" value="">
									<select name="puesto-directivo">
										<option disabled selected>Seleccionar puesto</option>
										<option value="DIRECTOR">Director</option>
										<option value="SUBDIRECTOR">Subdirector</option>
										<option value="TESORERO">Tesorero</option>
										<option value="CONTADOR">Contador</option>
									</select>

									<input type="submit" name="Cargar">
								</form>
					</div>
					
				<!-- ENDS form -->
			</div>						
			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				Buscar y Dar de Baja a un directivo
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>				
			<div class="toggle-container">
			<div id="por_apellido">
								<form id="contactForm" action="baja_directivos.php" method="post">
									<fieldset>
											<p>
												<input class="busqueda" name="apellido_n" id="apellido_n_dis" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder="Comience a escribir el apellido..."/>
											</p>
									</fieldset>
									 <input type="hidden" id="num-baja-directivo" name="num_socio" value="">
									<input type="submit" value="Eliminar">
								</form>
					</div>
					
			</div>
			
			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				Directivos
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>		
			<div class="toggle-container" >
				<!-- form -->
				<!-- Modificado 28/06/2016 -->
				<table>
					<tr>
						<td>Número de socio</td>
						<td>Nombre</td>
						<td>Apellido</td>
						<td>Tipo Documento</td>
						<td>Número de documento</td>
						<td>Puesto</td>
					</tr>
					<?php 
						$consulta = "select * from mostrar_directivos()";
						$result = pg_query($connect, $consulta);

						while($row = pg_fetch_array($result)){
							echo "<tr>";
							echo "<td>".$row['numero_socio']."</td>";
							echo "<td>".$row['nombre']."</td>";
							echo "<td>".$row['apellido']."</td>";
							echo "<td>".$row['tipo_doc']."</td>";
							echo "<td>".$row['dni']."</td>";
							echo "<td>".$row['puesto']."</td>";
							echo "</tr>";
						}
					?>
				</table>
				<!-- ENDS form -->
			</div>
					<!-- ENDS Toggle opciones -->
		</div>
			
			<!-- ENDS featured -->
			
	

		<!-- ENDS MAIN -->
		

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
	<!-- ENDS WRAPPER -->
	
	<?php 
		include('html/scripts.html');
	?>

</body>
</html>
