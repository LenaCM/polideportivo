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
				
					<h2 class="heading" style="text-align:center;">Opciones para Socios</h2>

					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						 Nuevo Alquiler de Socio
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>		
					
						<!-- form -->
					<!-- Modificado 28/06/2016 -->
					<div class="toggle-container">
						<div id="por_apellido">
								<form id="contactForm" >
									<fieldset>
											<p> Socio
												<input class="busqueda" name="apellido_n" id="apellido_n" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder="Comience a escribir el apellido..."/>
											</p>

									</fieldset>

								</form>
						</div>
						<form id="contactForm" action="alta_alquiler.php" method="post">
							<fieldset>
								<p>
									<input type="text" style="display:none" name="numero_soc" id="numero_soc" class="form-poshytip">
								</p>
								<p>
									<input type="text" style="display:none" name="tipo_alq" id="tipo_alq" class="form-poshytip">
								</p>
								<p>
										<label for="instalacion">Seleccione instalación</label>
										<select name="instalacion" id="instalacion" class="form-poshytip" title="Elija una opción" required >
											<option value="" selected disabled>Elija una opción</option>
											<option value="CANCHA DE FUTBOL 11">CANCHA DE FUTBOL 11</option>
											<option value="CANCHA DE TENIS">CANCHA DE TENIS</option>
											<option value="CANCHA DE BASKET">CANCHA DE BASKET</option>
											<option value="CANCHA DE FUTBOL 5 1">CANCHA DE FUTBOL 5 1</option>
											<option value="CANCHA DE FUTBOL 5 2">CANCHA DE FUTBOL 5 2</option>
											<option value="PISCINA 1">PISCINA 1</option>
											<option value="PISCINA 2">PISCINA 2</option>
											<option value="SALÓN 1">SALÓN 1</option>
											<option value="SALÓN 2">SALÓN 2</option>
										</select>
									</p>
									<p>
										<label for="fecha">Fecha Alquiler</label>
										<input name="fecha" id="fecha" type="date" class="form-poshytip"   title="Enter your document number" required/>
									</p>
									<br>
									<p>
										<label for="hora">Hora Alquiler</label>
										<input name="hora" id="hora" type="time" class="form-poshytip"   title="Enter your document number" required/>
									</p>
									<br>
									<p>
										<label for="costo">Costo</label>
										<input name="costo" id="costo" type="text" class="form-poshytip"   maxlength="8" title="Enter your document number" required/>
									</p>
									
									<p><input class="link-button green" type="submit" value="Enviar" name="submit" id="submit" /></p>
							</fieldset>
						</form>
					</div>
					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						 Eliminar Alquiler de Socio
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>	
					<div class="toggle-container">
						<div id="">
								<form id="contactForm" >
									<fieldset>
											<p> Socio
												<input class="busqueda" name="eliminar_alquiler" id="eliminar_alquiler" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder="Comience a escribir el apellido..."/>
											</p>

									</fieldset>

								</form>
								<table id="listado_al_socio" style="display:none"><tr class="nombre_columna"><th>Fecha</th><th>Hora</th><th>Apellidos</th><th>Nombres</th><th>Número de Socio</th><th>Instalación</th><th>Costo</th><th>Pagado</th></tr></table>
						</div>
					</div>
				</div>
				<!--opciones para no socios -->
					<div class="page-content entry-content feature cf">
						<h2 class="heading" style="text-align:center;">Opciones para No Socios</h2>
						<div class="toggle-trigger">
							<img class="mas" src="img/bullets/plus.png">
							<img class="menos" src="img/bullets/minus.png">
							 Nuevo Alquiler de No Socio
							<img class="mas" src="img/bullets/plus.png">
							<img class="menos" src="img/bullets/minus.png">
						</div>	
						<div class="toggle-container">
							<form id="contactForm" action="alta_alquiler.php" method="post">
								<fieldset>
									<p>
										<label for="nombre">Nombre</label>
										<input name="nombre" id="nombre" type="text" class="form-poshytip"   title="Enter your document number" required/>
									</p>
									<p>
										<label for="apellido">Apellido</label>
										<input name="apellido" id="apellido" type="text" class="form-poshytip"   title="Enter your document number" required/>
									</p>
									<p>
										<label for="tipo_doc">Tipo de Documento</label>
										<select name="tipo_doc" id="tipo_doc" class="form-poshytip" title="Elija una opción">
											<option value="DNI">DNI</option>
											<option value="PAS">PASAPORTE</option>
											<option value="LE">LIBRETA DE ENROLAMIENTO</option>
											<option value="LC">LIBRETA CIVICA</option>
										</select>
									</p>
									<p>
										<label for="num_doc">Número de Documento</label>
										<input name="num_doc" id="num_doc" type="text" class="form-poshytip"  maxlength="8" title="Enter your document number" required/>
									</p>
									<p>
										<label for="instalacion">Seleccione instalación</label>
										<select name="instalacion" id="instalacion" class="form-poshytip" title="Elija una opción" required >
											<option value="" selected disabled>Elija una opción</option>
											<option value="CANCHA DE FUTBOL 11">CANCHA DE FUTBOL 11</option>
											<option value="CANCHA DE TENIS">CANCHA DE TENIS</option>
											<option value="CANCHA DE BASKET">CANCHA DE BASKET</option>
											<option value="CANCHA DE FUTBOL 5 1">CANCHA DE FUTBOL 5 1</option>
											<option value="CANCHA DE FUTBOL 5 2">CANCHA DE FUTBOL 5 2</option>
											<option value="PISCINA 1">PISCINA 1</option>
											<option value="PISCINA 2">PISCINA 2</option>
											<option value="SALÓN 1">SALÓN 1</option>
											<option value="SALÓN 2">SALÓN 2</option>
										</select>
									</p>
									<p>
										<label for="fecha">Fecha Alquiler</label>
										<input name="fecha" id="fecha" type="date" class="form-poshytip"   title="Enter your document number" required/>
									</p>
									<br>
									<p>
										<label for="hora">Hora Alquiler</label>
										<input name="hora" id="hora" type="time" class="form-poshytip"   title="Enter your document number" required/>
									</p>
									<br>
									<p>
										<label for="costo">Costo</label>
										<input name="costo" id="costo" type="text" class="form-poshytip"   maxlength="8" title="Enter your document number" required/>
									</p>
									<p>
										<label for="senia">Seña</label>
										<input name="senia" id="senia" type="text" class="form-poshytip"   maxlength="8" title="Enter your document number" required/>
									</p>
									<p>
										<input type="text" style="display:none" name="tipo_alq" id="tipo_alq" class="form-poshytip" value="2">
									</p>
									<p><input class="link-button green" type="submit" value="Enviar" name="submit" id="submit" /></p>
							</fieldset>
							</form>
					</div>
				</div>
				<!--fin opciones para no socios-->
				<!-- listado de alquileres-->
				<div class="page-content entry-content feature cf">
					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						 Listado de alquileres
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>	
					<div class="toggle-container">
						<?php
							$consulta = "SELECT * FROM sp_listado_alquiler()";
							$result = pg_query($connect, $consulta);
							//pag
							$tamano_pagina = 10;
							$pagina = $_GET["pagina"];
							if(!$pagina){
								$inicio = 0;
								$pagina = 1;
							}else{
								$inicio = ($pagina - 1) * $tamano_pagina ;
							}

							$numero_total_registros = pg_num_rows($result);
							$total_paginas = ceil($numero_total_registros / $tamano_pagina);
							$consulta2 = "SELECT * FROM sp_listado_alquiler()limit ".$tamano_pagina." offset ".$inicio;
							$result2 = pg_query($connect, $consulta2);
							$result2 = pg_query($connect, $consulta2);

							echo '<table id="listado_empl"><tr class="nombre_columna"><th>Fecha</th><th>Hora</th><th>Apellidos</th><th>Nombres</th><th>Número de Socio</th><th>Instalación</th><th>Costo</th><th>Pagado</th></tr>';
							while($row = pg_fetch_assoc($result2)){
								if($row['numero_socio']==0){
									$row['numero_socio']='';
								}
								if($row['pagado']=='f'){
									$row['pagado']='No';
								}
								if($row['pagado']=='t'){
									$row['pagado']='Si';
								}
								echo '<tr class="fila_resultado"><td>'.$row['fecha'].'</td><td>'.$row['hora'].'</td><td>'.$row['apellido'].'</td><td>'.$row['nombre'].'</td><td>'.$row['numero_socio'].'</td><td>'.$row['nombre_instalacion'].'</td><td>'.$row['costo'].'</td><td>'.$row['pagado'].'</td></tr>';
							}
							echo '</table><br><div class="paginador" >';
							if($total_paginas > 1){
									if($pagina != 1){
											echo '<a class="link-button" href="alquileres.php?pagina='.($pagina-1).'"> <<< </a> ';
										}
									for($i=1; $i<=$total_paginas;$i++){

										if($pagina == $i){
											echo '<a class="link-button red">'.$pagina . '</a> ';
										}else{
											echo '<a class="link-button" href="alquileres.php?pagina=' . $i . '">' . $i . '</a> '; 
										}
									}
									if($pagina != $total_paginas){
										echo ' <a class="link-button" href="alquileres.php?pagina='.($pagina+1).'"> >>> </a> ';
									}
								}
							echo "</div><br><br>";

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
	<?php 
		include('html/scripts.html');
	?>
</body>
</html>