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
	<script type="text/javascript">
		function mostrar(id){
			$("id").show();
			if (id == "num_dni") {
				$("#tipo_y_dni").show();
				$("#por_apellido").hide();
			};
			if (id == "apellido_n") {
				$("#tipo_y_dni").hide();
				$("#por_apellido").show();
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
					<li><a href="alquileres.php"><span>ALQUILER</span></a></li>
					<li class="current-menu-item"><a href="empleados.php"><span>EMPLEADOS</span></a></li>
					<li><a href="mantenimiento.php"><span>MANTENIMIENTO</span></a></li>
				</ul>
				<div id="combo-holder"></div>
			</nav>
			<!-- ends nav -->
			
		</header>
		
		<!-- MAIN -->
		<div role="main" id="main" class="cf">
			
			<!-- headline -->
			<div class="headline">Panel Administracion de Empleados</div>
			<!-- ENDS headline -->
			
			<!-- Toggle opciones -->
				<div class="page-content entry-content feature cf">
				
					<h2 class="heading" style="text-align:center;">Opciones</h2>

					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						Dar de alta un Nuevo Empleado
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>		
					<div class="toggle-container">
						<!-- form -->
				<!-- Modificado 28/06/2016 -->
				<form id="contactForm" action="alta_empleados.php" method="post">
					<fieldset>				
						<p>
							<label for="name" >Nombre</label>
							<input name="name"  id="name" type="text" class="form-poshytip" title="Enter your name" />
						</p>
						
						<p>
							<label for="apellido" >Apellido</label>
							<input name="apellido"  id="apellido" type="text" class="form-poshytip" title="Enter your sub name" />
						</p>
						
						<p>
							<label for="tipo_doc">Tipo de Documento</label>
							<select name="tipo_doc" id="tipo_doc" class="form-poshytip" title="Enter your type of document">
								<option value="DNI" selected>DNI</option>
								<option value="PAS">PASAPORTE</option>
								<option value="LE">LIBRETA DE ENROLAMIENTO</option>
								<option value="LC">LIBRETA CIVICA</option>
							</select>
						</p><br>
						
						<p>
							<label for="num_doc">Numero de Documento</label>
							<input name="num_doc"  maxlength="8" id="num_doc" type="text" class="form-poshytip" title="Enter your document number" />
						</p>

						<p>
							<label for="sueldo">Sueldo</label><br>
							<input name="sueldo"   id="sueldo" type="number" min="0" max="100000" class="form-poshytip" title="Enter your document number" />
						</p>
						<p>
							<label for="antiguedad">Antiguedad</label>
							<input name="antiguedad" id="antiguedad" type="text" class="form-poshytip" title="Enter your document number" />
						</p>
							<label for="ho_ent">Hora de entrada</label>
							<input name="ho_ent" id="ho_ent" type="time" class="form-poshytip" title="Enter your document number" />
						</P><br>
						<p>
							<label for="ho_sal">Hora de salida</label>
							<input name="ho_sal" id="ho_sal" type="time" class="form-poshytip" title="Enter your document number" />
						</p>
						
						
						<p><input type="submit" value="ENVIAR" name="submit" id="submit" /></p>
					</fieldset>
					
				</form>
				<!-- ENDS form -->
					</div>
										
					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						Buscar y Modificar o Borrar un Empleado
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>				
					<div class="toggle-container">
						<form id="contactForm" action="empleados.php" method="post">
							<fieldset>
								<p>
									Elija el tipo de Busqueda
									<select name="status" id="status" class="form-poshytip" onChange="mostrar(this.value);">
										<option disabled="disabled" selected>Elija una Opcion Aca</option>
										<option value="apellido_n">Por Apellido</option>
										<option value="num_dni">Por Numero y Tipo de DNI</option>
										
									</select>
								</p>
							</fieldset>
						</form>
						<div id="por_apellido" style="display:none;">
							<form id="contactForm" >
								<fieldset>
										<p>
											<label for="apellido_n">Apellido</label>
											<input name="apellido_n" id="apellido_n" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="2" />
										</p>
								</fieldset>
							</form>
						</div>
						<div id="tipo_y_dni" style="display:none;">
							<form id="contactForm" action="buscar_empleado_modificar.php" method="post">
								<fieldset>
									<p>
										<label for="num_doc">Numero de Documento</label>
										<input name="num_doc" id="num_doc" type="text" class="form-poshytip" title="Enter your document number" />
									</p>
									<p>
										<label for="tipo_doc">Tipo de Documento</label>
										<select name="tipo_doc" id="tipo_doc" class="form-poshytip" title="Enter your type of document">
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
						<?php

							$consulta = "SELECT * FROM sp_busqueda_empleado(1,'')";
							$result = pg_query($connect, $consulta);

							echo '<table id="lista_empl"><tr class="nombre_columna"><td>Nombres</td><td>Apellidos</td><td>Numero de documento</td><td>Tipo Documento</td><td>Sueldo</td><td>Antiguedad</td><td>Horario Entrada</td><td>Horario Salida</td><td>Modificar</td><td>Eliminar</td></tr>';
							while($row = pg_fetch_assoc($result)){
								echo '<tr class="fila_resultado"><td>'.$row['nombre'].'</td><td>'.$row['apellido'].'</td><td>'.$row['dni'].'</td><td>'.$row['tipo_doc'].'</td><td>'.$row['salario'].'</td><td>'.$row['antiguedad']."</td><td>".$row['hora_entrada'].'</td><td>'.$row['hora_salida'].'</td><td><a class="link-button blue" href=modificar_empleado.php?ID='.$row['dni']."&tipo_doc=".$row['tipo_doc'].'>Modificar</a></td><td><a  class="link-button red" href=borrar_empleado_result.php?ID='.$row['dni'].'&tipo='.$row['tipo_doc'].'>Eliminar</a></td></tr>';
							}
							echo "</table>";

						?>
						
					</div>
					<!-- ENDS Toggle opciones -->
				</div>
			
			<!-- ENDS featured -->
			
		</div>

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