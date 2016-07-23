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

		<!-- MAIN -->
		<div role="main" id="main" class="cf">
			
			<!-- headline -->
			<div class="headline">Panel Administracion de Alquileres</div>
			<!-- ENDS headline -->
			
			<!-- Toggle opciones -->
				<div class="page-content entry-content feature cf">
				
					<h2 class="heading" style="text-align:center;">Opciones</h2>

					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						Dar de alta un nuevo Alquiler de Socio
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>		
					<div class="toggle-container">
						<!-- form -->
				<!-- Modificado 28/06/2016 -->
				<div class="toggle-container">
						<form id="contactForm" action="socios.php" method="post">
							<fieldset>
								<p>
									Elija el tipo de Busqueda
									<select name="status" id="status" class="form-poshytip" onChange="mostrar(this.value);">
										<option disabled="disabled" selected>Elija una Opcion Aca</option>
										<option value="num_dni">Por Numero y Tipo de DNI</option>
										<option value="num_soc">Por Numero de Socio</option>
									</select>
								</p>
							</fieldset>
						</form>
						<div id="tipo_y_dni" style="display:none;">
							<form id="contactForm" action="buscar_socio_modificar.php" method="post">
								<fieldset>
									<p>
										<label for="num_doc">Numero de Documento</label>
										<input name="num_doc" id="num_doc" type="text" class="form-poshytip" title="Enter your document number" />
									</p>
									<p>
										<label for="tipo_doc">Tipo de Documento</label>
										<select name="Tipo_doc" id="tipo_doc" class="form-poshytip" title="Enter your type of document">
											<option value="DNI" selected>DNI</option>
											<option value="PAS">PASAPORTE</option>
											<option value="LE">LIBRETA DE ENROLAMIENTO</option>
											<option value="LC">LIBRETA CIVICA</option>
										</select>
									</p>
									<p>
										<input type="submit" value="Buscar" name="submit" id="submit">
									</p>
								</fieldset>
							</form>
						</div>
						<div id="num_soc" style="display:none;">
							<form id="contactForm" action="buscar_socio_modificar.php" method="post">
								<fieldset>
									<p>
										<label for="num_soc">Numero de Socio</label>
										<input name="num_soc" id="num_soc" type="text" class="form-poshytip" title="Enter your document number" />
									</p>
									<p>
										<input type="submit" value="Buscar" name="buscar" id="buscar">
									</p>
								</fieldset>
							</form>
						</div>
						<?php

							$consulta = "SELECT * from socios s inner join personas p using(id_persona)";
							$result = pg_query($connect, $consulta);

							echo "<table><tr><th>Número de Socio</th><th>Nombres</th><th>Apellidos</th><th>DNI</th><th>MODIFICAR</th><th>ELIMINAR</th></tr>";
							while($row = pg_fetch_assoc($result)){
								echo "<tr><td>".$row['numero_socio']."</td><td>".$row['nombre']."</td><td>".$row['apellido']."</td><td>".$row['dni']."</td><td><a href=alta_alquiler.php?ID=".$row['numero_socio']."&tipo_busq=1>Dar Alta Alquiler</a></td></tr>";
							}
							echo "</table>";
							echo $row['id_persona'];
						?>
				</div>
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