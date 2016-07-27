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
				
					<h2 class="heading" style="text-align:center;">Alta - Baja - Modificacion</h2>

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
						
						<div id="por_apellido" >
							<form id="contactForm" >
								<fieldset>
										<p>
									
											<input name="apellido_n" id="apellido_n" type="text" class="form-poshytip busqueda" title="Enter your document number" data-busqueda="2" placeholder="Comience a escribir el apellido..."/>
										</p>
								</fieldset>
							</form>
						</div>
						
						<?php

							$consulta = "SELECT * FROM sp_busqueda_empleado(1,'')";
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
							$consulta2 = "SELECT * FROM sp_busqueda_empleado(1,'')limit ".$tamano_pagina." offset ".$inicio;
							$result2 = pg_query($connect, $consulta2);

							echo '<table id="lista_empl"><tr class="nombre_columna"><td>Apellidos</td><td>Nombres</td><td>Numero de documento</td><td>Tipo Documento</td><td>Sueldo</td><td>Antiguedad en Años</td><td>Horario Entrada</td><td>Horario Salida</td><td>Modificar</td><td>Eliminar</td></tr>';
							while($row = pg_fetch_assoc($result2)){
								echo '<tr class="fila_resultado"><td>'.$row['apellido'].'</td><td>'.$row['nombre'].'</td><td>'.$row['dni'].'</td><td>'.$row['tipo_doc'].'</td><td>'.$row['salario'].'</td><td>'.$row['antiguedad']."</td><td>".$row['hora_entrada'].'</td><td>'.$row['hora_salida'].'</td><td><a class="link-button blue" href=modificar_empleado.php?ID='.$row['id_persona'].'>Modificar</a></td><td><a  class="link-button red" href=borrar_empleado.php?ID='.$row['dni'].'&tipo='.$row['tipo_doc'].'>Eliminar</a></td></tr>';
							}
							echo '</table><br><div class="paginador" >';
							if($total_paginas > 1){
									if($pagina != 1){
											echo '<a class="link-button" href="empleados.php?pagina='.($pagina-1).'"> <<< </a> ';
										}
									for($i=1; $i<=$total_paginas;$i++){

										if($pagina == $i){
											echo '<a class="link-button red">'.$pagina . '</a> ';
										}else{
											echo '<a class="link-button" href="empleados.php?pagina=' . $i . '">' . $i . '</a> '; 
										}
									}
									if($pagina != $total_paginas){
										echo ' <a class="link-button" href="empleados.php?pagina='.($pagina+1).'"> >>> </a> ';
									}
								}
							echo "</div><br><br>";

						?>
						
					</div>
					<!-- ENDS Toggle opciones -->
				</div>
			
			<!-- ENDS featured -->
			<!--familiares de empleados -->
				<div class="page-content entry-content feature cf">
					<h2 class="heading" style="text-align:center;">Familiares</h2>
					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						Alta Familiar de Empleado
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>
					<div class="toggle-container">
						<div id="por_apellido" >
							<form id="contactForm" >
								<fieldset>
										<p>
											Empleado
											<input name="apellido_empleado" id="apellido_empleado" type="text" class="form-poshytip busqueda" title="Enter your document number" data-busqueda="2" placeholder="Comience a escribir el apellido..."/>
										</p>
								</fieldset>
							</form>
						</div>
						<form id="contactForm" action="alta_familiar.php" method="post">
								<fieldset>	
									<p style="display:none">
										<label for="dni_empl" >dni empl</label>
										<input name="dni_empl"  id="dni_empl" type="text" class="form-poshytip" title="Ingrese su nombre"/>
									</p>
									<p style="display:none">
										<label for="tipo_dni_empl" >tipo dni empl</label>
										<input name="tipo_dni_empl"  id="tipo_dni_empl" type="text" class="form-poshytip" title="Ingrese su nombre"/>
									</p>			
									<p>
										<label for="name" >Nombre</label>
										<input name="name"  id="name" type="text" class="form-poshytip" title="Ingrese su nombre" placeholder="Escriba nombre..." required/>
									</p>
									<p>
										<label for="apellido" >Apellido</label>
										<input name="apellido"  id="apellido" type="text" class="form-poshytip" title="Ingrese su Apellido" placeholder="Escriba apellido" required/>
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
										<label for="rel_parentezco">Parentezco</label>
										<select name="rel_parentezco" id="rel_parentezco" class="form-poshytip" title="Elija una opción">
											<option value="CONYUGUE">CONYUGUE</option>
											<option value="HIJO">HIJO</option>
											<option value="HIJA">HIJA</option>
										</select>
									</p>
									<p><input class="link-button green" type="submit" value="Enviar" name="submit" id="submit" /></p>
								</fieldset>
								
							</form>
					</div>
					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						Modificar o Eliminar Familiar de Empleado
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>
					<div class="toggle-container">
					<?php
						$consulta = "SELECT * FROM sp_mostrar_familiares_empleados()";
							$result = pg_query($connect, $consulta);

							//pag
							if(pg_num_rows($result)>0){
								$tamano_pagina = 10;
								$pagina = $_GET["pagina_f"];
								if(!$pagina){
									$inicio = 0;
									$pagina = 1;
								}else{
									$inicio = ($pagina - 1) * $tamano_pagina ;
								}

								$numero_total_registros = pg_num_rows($result);
								$total_paginas = ceil($numero_total_registros / $tamano_pagina);
								$consulta2 = "SELECT * FROM sp_mostrar_familiares_empleados() limit ".$tamano_pagina." offset ".$inicio;
								$result2 = pg_query($connect, $consulta2);

								echo '<table id="lista_fam"><tr class="nombre_columna">
									<th>Apellido Empleado</th>
									<th>Nombre Empleado</th>
									<th>Numero de Documento</th>
									<th>Tipo</th>
									<th>Nombre Familiar</th>
									<th>Apellido Familiar</th>
									<th>Numero de Documento</th>
									<th>Tipo</th>
									<th>Parentezco</th>
									<th>MODIFICAR</th>
									<th>ELIMINAR</th></tr>';
								while($row = pg_fetch_assoc($result2)){
									echo '<tr class="fila_resultado">
											<td>'.$row['apellido_empleado'].'</td>
											<td>'.$row['nombre_empleado'].'</td>
											<td>'.$row['dni_empleado'].'</td>
											<td>'.$row['tipo_doc_empleado'].'</td>
											<td>'.$row['apellido_familiar'].'</td>
											<td>'.$row['nombre_familiar'].'</td>
											<td>'.$row['dni_familiar' ].'</td>
											<td>'.$row['tipo_doc_familiar' ].'</td>
											<td>'.$row['parentezco' ].'</td>
											<td><a class="link-button blue" href=modificar.php?ID='.$row['numero_socio'].'&tipo_busq=1>Modificar</a></td>
											<td><a class="link-button red" href=eliminar_familiar.php?dni='.$row['dni_familiar'].'&tipo='.$row['tipo_doc_familiar'].'>Eliminar</a></td></tr>';

								}
								echo '</table><br><div class="paginador" >';
								
								if($total_paginas > 1){
										if($pagina != 1){
												echo '<a class="link-button" href="empleados.php?paginaf='.($pagina-1).'"> <<< </a> ';
											}
										for($i=1; $i<=$total_paginas;$i++){

											if($pagina == $i){
												echo '<a class="link-button red">'.$pagina . '</a> ';
											}else{
												echo '<a class="link-button" href="empleados.php?paginaf=' . $i . '">' . $i . '</a> '; 
											}
										}
										if($pagina != $total_paginas){
											echo ' <a class="link-button" href="empleados.php?paginaf='.($pagina+1).'"> >>> </a> ';
										}
									}
								echo "</div><br><br>";
							}else{
								echo "No hay registros";
							}
							
					?>
					</div>	
				</div>
			<!--end familiares de empleados -->
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