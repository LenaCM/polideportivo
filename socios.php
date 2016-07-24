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
	<!-- script seleccionar tipo de busqueda en modificacion o eliminacion de socios-->
	<script type="text/javascript">
		function mostrar(id){
			$("id").show();
			if (id == "num_dni") {
				$("#tipo_y_dni").show();
				$("#num_soc").hide();
				$("#por_apellido").hide();
			};
			if (id == "num_soc") {
				$("#tipo_y_dni").hide();
				$("#num_soc").show();
				$("#por_apellido").hide();

			};
			if (id == "apellido_n") {
				$("#por_apellido").show();
				$("#tipo_y_dni").hide();
				$("#num_soc").hide();
			};
		}
	</script>
	<!-- FIN script seleccionar tipo de busqueda -->

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
		
		<!-- MAIN -->
		<div role="main" id="main" class="cf">
			
			<!-- headline -->
			<div class="headline">Panel Administracion de Socios</div>
			<!-- ENDS headline -->
			
			<!-- Toggle opciones -->
			<div class="page-content entry-content feature cf">
				
			<h2 class="heading" style="text-align:center;">Alta - Baja - Modificacion</h2>

			<!-- Alta nuevo socio -->
			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				Dar de alta un nuevo socio
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>		
			<div class="toggle-container">
				<form id="contactForm" action="alta.php" method="post">
					<fieldset>				
						<p>
							<label for="name" >Nombre</label>
							<input name="name"  id="name" type="text" class="form-poshytip" title="Ingrese su nombre" placeholder="Por Ej: Mariel" required/>
						</p>
						<p>
							<label for="apellido" >Apellido</label>
							<input name="Apellido"  id="apellido" type="text" class="form-poshytip" title="Ingrese su Apellido" placeholder="Por Ej: Fernandez" required/>
						</p>
						<p>
							<label for="tipo_doc">Tipo de Documento</label>
							<select name="Tipo_doc" id="tipo_doc" class="form-poshytip" title="Elija una opción">
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
						<p><input class="link-button green" type="submit" value="Enviar" name="submit" id="submit" /></p>
					</fieldset>
					
				</form>
				
			</div>	
			<!-- Fin Alta nuevo socio -->

			<!-- Modificacion o eliminacion de socios -->					
			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				 Modificar o Dar de Baja a un Socio
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>				
			<div class="toggle-container" >
				<form id="contactForm" action="socios.php" method="post">
					<fieldset>
						<p>
							Tipo de Búsqueda
							<select name="status" id="status" class="form-poshytip" onChange="mostrar(this.value);">
								<option disabled="disabled" selected>Elija una Opción</option>
								<option value="apellido_n">Por Apellido</option>
								<option value="num_dni">Por Número y Tipo de Documento</option>
								<option value="num_soc">Por Número de Socio</option>
							</select>
						</p>
					</fieldset>
				</form>
				<div id="por_apellido" style="display:none;">
					<form id="contactForm" >
						<fieldset>
								<p>
									<input name="apellido_n" id="apellido_n" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder="Comience a escribir el apellido..."/>
								</p>
						</fieldset>
					</form>
				</div>
				<div id="tipo_y_dni" style="display:none;">
					<form id="contactForm" action="buscar_socio_modificar.php" method="post">
						<fieldset>
								<p>
									<label for="num_doc">Número de Documento</label>
									<input name="num_doc" id="num_doc" type="text" class="form-poshytip" title="Enter your document number" maxlength="8" />
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
								<label for="num_soc">Número de Socio</label>
								<input name="num_soc" id="num_soc" type="text" class="form-poshytip" title="Enter your document number" />
							</p>
							<p>
								<input type="submit" value="Buscar" name="buscar" id="buscar">
							</p>
						</fieldset>
					</form>
				</div>
			<!-- tabla con resultados de socios activos -->
				<?php

					$consulta = "select * from sp_busqueda_socio(1,'',null) order by numero_socio desc";
					$result = pg_query($connect, $consulta);

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
						$consulta2 = "select * from sp_busqueda_socio(1,'',null) order by numero_socio desc limit ".$tamano_pagina." offset ".$inicio;
						$result2 = pg_query($connect, $consulta2);
					
					echo '<table id="lista_soc"><tr class="nombre_columna"><th>Numero de Socio</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Numero de Documento</th>
							<th>Tipo de Documento</th>
							<th>Fecha de Ingreso</th>
							<th>Estado de Cuenta</th>
							<th>MODIFICAR</th>
							<th>ELIMINAR</th></tr>';
						while($row = pg_fetch_assoc($result2)){
							echo '<tr class="fila_resultado">
									<td>'.$row['numero_socio'].'</td>
									<td>'.$row['nombre'].'</td>
									<td>'.$row['apellido'].'</td>
									<td>'.$row['dni'].'</td>
									<td>'.$row['tipo_doc'].'</td>
									<td>'.$row['fechaingreso'].'</td>
									<td>'.$row['estadocuenta' ].'</td>
									<td><a class="link-button blue" href=modificar.php?ID='.$row['numero_socio'].'&tipo_busq=1>Modificar</a></td>
									<td><a class="link-button red" href=borrar_socio_resul.php?ID='.$row['numero_socio'].'&tipo_busq=1>Eliminar</a></td></tr>';

						}
					echo '</table><br><div class="paginador" >';
					if($total_paginas > 1){
						if($pagina != 1){
								echo '<a class="link-button" href="socios.php?pagina='.($pagina-1).'"> <<< </a> ';
							}
						for($i=1; $i<=$total_paginas;$i++){

							if($pagina == $i){
								echo '<a class="link-button red">'.$pagina . '</a> ';
							}else{
								echo '<a class="link-button" href="socios.php?pagina=' . $i . '">' . $i . '</a> '; 
							}
						}
						if($pagina != $total_paginas){
							echo ' <a class="link-button" href="socios.php?pagina='.($pagina+1).'"> >>> </a> ';
						}
					}
					echo "</div><br><br>";
				?>
				<!-- FIN tabla con resultados de socios activos -->		
			</div>
			<!-- FIN modificacion o eliminacion de socios -->
		</div>
		<!-- FIN seccion 
		<div role="main" id="main" class="cf">
		<!-- Disciplinas que practican los socios -->	
			
			<div class="page-content entry-content feature cf">	
			<h2 class="heading" style="text-align:center;">Practica de Disciplinas</h2>
				<!--cargar una nueva disclina para un socio -->
				<div class="toggle-trigger">
					<img class="mas" src="img/bullets/plus.png">
					<img class="menos" src="img/bullets/minus.png">
						Registrar práctica de disciplina de un socio
					<img class="mas" src="img/bullets/plus.png">
					<img class="menos" src="img/bullets/minus.png">
				</div>
				<div class="toggle-container">
					<div id="por_apellido_dis">
						<form id="contactForm" >
							<fieldset>
									<p>Buscar socio
										<input name="apellido_n_dis" id="apellido_n_dis" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder="Comience a escribir el apellido..."/>
									</p>
							</fieldset>
						</form>
					</div>
					<?php

						$consulta = "select * from sp_busqueda_socio(1,'',null) order by numero_socio desc";
						$result = pg_query($connect, $consulta);

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
							$consulta2 = "select * from sp_busqueda_socio(1,'',null) order by numero_socio desc limit ".$tamano_pagina." offset ".$inicio;
							$result2 = pg_query($connect, $consulta2);
						echo '<table id="alta_disciplina" style="display:none"><tr class="nombre_columna">
								<th>Numero de Socio</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Elija disclipina</th>
								<th>Agregar</th></tr>';

						echo '</table><br>';
					?>
				</div>
				
				
				<!--FIN de cargar una nueva disclina para un socio -->
				<div class="toggle-trigger">
					<img class="mas" src="img/bullets/plus.png">
					<img class="menos" src="img/bullets/minus.png">
						Modificar o eliminar práctica de disciplina de un socio
					<img class="mas" src="img/bullets/plus.png">
					<img class="menos" src="img/bullets/minus.png">
				</div>
				<div class="toggle-container">

				</div>
			<!-- FIN Disciplinas que practican los socios -->
		</div>
		<!-- footer -->
		<footer>
			<!-- ribbon -->
			<div id="twitter-holder">
				<div class="ribbon-left"></div>
				<div class="ribbon"></div>
				<div class="ribbon-right"></div>
			</div>
		<!-- ENDS ribbon -->		
		</footer>
		<!-- END footer -->
	</div>
	<!-- ENDS WRAPPER -->
	
	<?php 
		include('html/scripts.html');
	?>

</body>
</html>
