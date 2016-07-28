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
					<li  class="current-menu-item"><a href="cuotas.php"><span>CUOTAS</span></a></li>
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
			<div class="headline">Panel Administracion de CUOTAS</div>
			<!-- ENDS headline -->
			
			<!-- Toggle opciones -->
				<div class="page-content entry-content feature cf">
				
					<h2 class="heading" style="text-align:center;">Opciones</h2>

					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						Agregar Cuota a Socio
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>
						
					<div class="toggle-container">
						<div id="por_apellido">
								<form id="contactForm" action="agregar_cuota.php" method="post">
									<fieldset>
											<p> Socio
												<input class="busqueda" name="apellido_n" id="apellido_n" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder="Comience a escribir el apellido..."/>
											</p>
											<p>
												<input type="text" style="display:none" name="numero_soc" id="numero_soc" class="form-poshytip">
											</p>
											<p>
												<label for="fecha">Fecha Cuota</label>
												<input name="fecha" id="fecha" type="date" class="form-poshytip"   title="Enter your document number" required/>
											</p>
											<p>
												<label for="monto">Monto</label>
												<input name="monto" id="monto" type="text" class="form-poshytip"   maxlength="8" title="Enter your document number" required/>
											</p>
											<p>
												<label for="desc">Descuento</label>
												<input name="desc" id="desc" type="text" class="form-poshytip"   maxlength="8" title="Enter your document number" required/>
											</p>

											<p><input class="link-button green" type="submit" value="Agregar Cuota" name="submit" id="submit" /></p>
									</fieldset>

								</form>
						</div>
					</div>
					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
							Modificar Cuotas
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>
					<div class="toggle-container">
						<div id="por_apellido">
								<form id="contactForm" action="modificar_cuota.php" method="post">
									<fieldset>
											<p> Cuota de Socio
												<input class="busqueda" name="apellido_cuotas" id="apellido_cuotas" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder="Comience a escribir el apellido..."/>
											</p>
											<p>
												<input type="text" style="display:none" name="numero_soc_mod" id="numero_soc_mod" class="form-poshytip">
											</p>
											<p>
												<input style="display:none" name="fecha_mod" id="fecha_mod" type="date" class="form-poshytip"   title="Enter your document number" required/>
											</p>
											<p>
												<input style="display:none" name="pasa" id="pasa" type="number" class="form-poshytip"   title="Enter your document number" required/>
											</p>
											<p>
												<label for="monto_mod">Monto</label>
												<input name="monto_mod" id="monto_mod" type="text" class="form-poshytip"   maxlength="8" title="Enter your document number" required/>
											</p>
											<p>
												<label for="desc_mod">Descuento</label>
												<input name="desc_mod" id="desc_mod" type="text" class="form-poshytip"   maxlength="8" title="Enter your document number" required/>
											</p>
											<p>
												<label for="pagado">Pagado</label><br>
												<select name="pagado" id="pagado">
													
													<option value="true">Si</option>
													<option value="false" selected>No</option>
												</select>
											</p>
											<p><input class="link-button green" type="submit" value="Modificar Cuota" name="submit" id="submit" /></p>
									</fieldset>

								</form>
						</div>
						
					</div>
					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						Actualizar Cuotas a todos los socios
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>
					<div class="toggle-container">
						<form id="contactForm" action="agregar_cuotas_general.php" method="post">
									<fieldset>
											<p>
												<label for="monto">Monto</label>
												<input name="monto" id="monto" type="text" class="form-poshytip"   maxlength="8" title="Enter your document number" required/>
											</p>
											<p>
												<label for="desc">Descuento</label>
												<input name="desc" id="desc" type="text" class="form-poshytip"   maxlength="8" title="Enter your document number" required/>
											</p>
											<p><input class="link-button green" type="submit" value="Agregar Cuotas" name="submit" id="submit" /></p>
									</fieldset>

								</form>
					</div>
					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
							Listado de Cuotas
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>
					<div class="toggle-container">
					
						<?php
							$consulta = "SELECT * FROM sp_buscar_cuotas('')";
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
							$consulta2 = "SELECT * FROM sp_buscar_cuotas('')limit ".$tamano_pagina." offset ".$inicio;
							$result2 = pg_query($connect, $consulta2);
							$result2 = pg_query($connect, $consulta2);

							echo '<table id="listado_cuotas"><tr class="nombre_columna"><th>Fecha</th><th>Número Socio</th><th>Apellido</th><th>Nombre</th><th>`Documento</th><th>Tipo</th><th>Precio</th><th>Descuento</th><th>Precio Final</th><th>Pagada</th></tr>';
							while($row = pg_fetch_assoc($result2)){
								if($row['pagada']=='f'){
									$row['pagada']='No';
								}
								if($row['pagada']=='t'){
									$row['pagada']='Si';
								}
								echo '<tr class="fila_resultado"><td>'.$row['fecha'].'</td><td>'.$row['numero_socio'].'</td><td>'.$row['apellido'].'</td><td>'.$row['nombre'].'</td><td>'.$row['dni'].'</td><td>'.$row['tipo_doc'].'</td><td>'.$row['precio'].'</td><td>'.$row['descuento'].'</td><td>'.$row['precio_final'].'</td><td>'.$row['pagada'].'</td></tr>';
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