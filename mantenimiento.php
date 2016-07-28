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
					<li><a href="alquileres.php"><span>ALQUILER</span></a></li>
					<li><a href="empleados.php"><span>EMPLEADOS</span></a></li>
					<li class="current-menu-item"><a href="mantenimiento.php"><span>MANTENIMIENTO</span></a></li>
				</ul>
				<div id="combo-holder"></div>
			</nav>
			<!-- ends nav -->
			
		</header>
		
		<!-- MAIN -->
		<div role="main" id="main" class="cf">
			
			<!-- headline -->
			<div class="headline">Panel Administracion de Mantenimiento</div>
			<!-- ENDS headline -->
			
			<!-- Toggle opciones -->
			<div class="page-content entry-content feature cf">
				
			<h2 class="heading" style="text-align:center;">Proveedores</h2>

			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				Dar de alta un nuevo proveedor
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>		
			<div class="toggle-container">
							<form id="contactForm" action="alta_proveedores.php" method="post">
								<fieldset>				
									<p>
										<label for="name" >Nombre</label>
										<input name="name"  id="name" type="text" class="form-poshytip" title="Ingrese su nombre" placeholder="Por Ej: Norte Insumos" required/>
									</p>
									<p>
										<label for="apellido" >Dirección</label>
										<input name="direccion"  id="apellido" type="text" class="form-poshytip" title="Ingrese su Apellido" required/>
									</p>
									<p>
										<label for="apellido" >Telefono</label>
										<input name="telefono"  id="apellido" type="text" class="form-poshytip" title="Ingrese su Apellido"  required/>
									</p>
									<p><input class="link-button green" type="submit" value="Enviar" name="submit" id="submit" /></p>
								</fieldset>
								
							</form>
							
			</div>


			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				Buscar y Dar de Baja a un proveedor
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>				
			<div class="toggle-container">
			<div id="por_apellido">
								<form id="contactForm" action="baja_proveedores.php" method="post">
									<fieldset>
											<p>
												<input class="busqueda" name="buscar_prov" id="buscar_prov" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder=""/>
											</p>
									</fieldset>
									 <input type="hidden" id="num-baja-proveedor" name="nombre" value="">
									<input type="submit" value="Eliminar">
								</form>	
			</div>
			</div>

			

					<!-- ENDS Toggle opciones -->
		</div>
			
			<!-- ENDS featured -->
		
			
			
			<!-- Toggle opciones -->
			<div class="page-content entry-content feature cf">
				
			<h2 class="heading" style="text-align:center;">Insumos</h2>

			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				Dar de alta un nuevo insumo
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>		
			<div class="toggle-container">
							<form id="contactForm" action="alta_insumos.php" method="post">
								<fieldset>				
									<p>
										<label for="name" >Nombre</label>
										<input name="name"  id="name" type="text" class="form-poshytip" title="Ingrese su nombre" placeholder="Por Ej: Toallas" required/>
									</p>
									<p>
										<label for="" >Stock</label><br>
										<input name="stock"  id="apellido" type="number" min="1" max="100" class="form-poshytip" required/>
									</p>
									<p>
										<label for="" >Tipo insumo</label>
										<select name="tipo_insumo">
											<option value="1">Insumo Administrativo</option>
											<option value="2">Insumo No Administrativo</option>
										</select>
									</p>
									<p><input class="link-button green" type="submit" value="Enviar" name="submit" id="submit" /></p>
								</fieldset>
								
							</form>
							
			</div>


			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				Buscar y de Baja a un insumo
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>				
			<div class="toggle-container">
			<div id="por_apellido">
								<form id="contactForm" action="baja_insumos.php" method="post">
									<fieldset>
											<p>
												<input class="busqueda" name="buscar_insumo" id="buscar-insumo" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder=""/>
											</p>
									</fieldset>
									 <input type="hidden" id="baja-insumo" name="nombre" value="">
									<input type="submit" value="Eliminar">
								</form>	
			</div>
			</div>
						
			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				Proveedores de insumos administrativos
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>
			<div class="toggle-container" id="relacionar">
				<form id="contactForm" action="alta_proveedores_insumos.php" method="post">
								<fieldset>				
									<p>
										<label for="buscar_provs" >Nombre proveedor</label>
										<input class="busqueda" name="buscar_provs" id="buscar_provs" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder="" required="">
									</p>
									<p>
										<label for="buscar_provs" >Nombre insumo</label>
										<input class="busqueda" name="buscar_insumos" id="buscar-insumos" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder="" required>
											</p>
									<p><input class="link-button green" type="submit" value="Cargar"  id="submit" /></p>
								</fieldset>
								
								<input type="hidden" id="proveedor" name="proveedor">
								<input type="hidden" name="insumo" id="insumo">
							</form>
			</div>

			<!-- SGSDG-->
			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				Insumos que usan las instalaciones
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>
			<div class="toggle-container" id="relacionar">
				<form id="contactForm" action="alta_instalaciones_insumos.php" method="post">
								<fieldset>				
									<p>
										<label for="buscar_provs" >Instalaciones</label>
										<select name="instalaciones" id="inst" required>
											<option>Seleccionar</option>
											<?php
												$consulta = "select * from instalaciones";
												$result = pg_query($connect,$consulta);
												while($row=pg_fetch_array($result)){
													$i = $row['nombre_instalacion'];
													echo "<option>".$row['nombre_instalacion']."</option>";
												}
											  ?>
										</select>

									</p>
									<p>
										<label for="buscar_provs" >Nombre insumo</label>
										<input class="busqueda" id="buscar_insumos" type="text" class="form-poshytip" title="Enter your document number" data-busqueda="1" placeholder="" required>
											</p>
									<p><input class="link-button green" type="submit" value="Cargar"  id="submit" /></p>
								</fieldset>
								
								<input type="hidden" name="insumo" id="insumos">
								<input type="hidden" name="instalaciones" id="instalaciones">
							</form>
			</div>

			<div class="toggle-trigger">
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
				Lista de insumos 
				<img class="mas" src="img/bullets/plus.png">
				<img class="menos" src="img/bullets/minus.png">
			</div>
			<div class="toggle-container" id="relacionar">
				<table>
					<tr>
						<th>Nombre</th>
						<th>Stock</th>
					</tr>
					<?php 
						$consulta = "select * from buscar_insumos('')";
					    $result = pg_query($connect,$consulta);
						while($row=pg_fetch_array($result)){
							echo '<tr>';
							echo '<td>'.$row['nombre'].'</td>';
							echo '<td>'.$row['stock'].'</td>';
							echo '</tr>';
						}

					 ?>
				</table>
			</div>
					
				

					<!-- ENDS Toggle opciones -->
				
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
