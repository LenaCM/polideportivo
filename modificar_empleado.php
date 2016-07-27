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
		<div role="main" id="main" class="cf">
			
			<div class="toggle-container">
				<?php
				    $css = 'block';
					$ID = $_GET['ID'];

					$consulta = "SELECT * FROM sp_busqueda_empleado(4,'$ID')";
					$result = pg_query($connect,$consulta);

					while ($row=pg_fetch_assoc($result)){
						$name = $row['nombre'];
						$apellido = $row['apellido'];
						$doc = $row['dni'];
						$tipo = $row ['tipo_doc'];
						$salario = $row['salario'];
						$antiguedad = $row['antiguedad'];
						$ho_ent = $row['hora_entrada'];
						$ho_sal = $row['hora_salida'];
					}

					if (isset ($_POST['Modificar'])) {
						if (isset($_POST['name']) && !empty($_POST['name']) && 
							isset($_POST['apellido']) && !empty($_POST['apellido']) &&
							isset($_POST['num_doc']) && !empty($_POST['num_doc']) &&
							isset($_POST['tipo_doc']) && !empty($_POST['tipo_doc']) &&
							isset($ID) && !empty($ID))
						{
							$name2 = strtoupper($_POST['name']);
							$ape2 = strtoupper($_POST['apellido']);
							$doc2 = $_POST['num_doc'];
							$tipo2 = $_POST['tipo_doc'];
							$salario2 = $_POST['sueldo'];
							$antiguedad2 = $_POST['antiguedad'];
							$ho_ent2 = $_POST['ho_ent'];
							$ho_sal2 = $_POST['ho_sal'];

							if($name!=$name2 || $apellido!=$ape2 || $doc!=$doc2 || $tipo!=$tipo2 || $salario!=$salario2 || $antiguedad!= $antiguedad2 || $ho_ent!= $ho_ent2 || $ho_sal!=$ho_sal2){
								$query = "SELECT sp_modificar_empleado($doc,'$tipo',$doc2,'$tipo2','$name2','$ape2',$salario2,$antiguedad2,'$ho_ent2','$ho_sal2')";

								if (pg_query($connect, $query)) {
									echo '<p class="infobox-success">Modificado con éxito</p><br>';
									echo '<p class="infobox-warning">'.pg_last_notice($connect).'</p><br>';
									
								} else {
									echo '<p class="infobox-error">'.pg_last_error($connect).'</p><br>';
								}
							}else{
								echo '<p class="infobox-warning">Los arreglos son iguales</p><br>';
							}
							
						} else {
							echo '<p class="infobox-error">No se cuenta con todos los datos necesarios</p><br>';
						}
						$css = 'none';

					}
				?>
				<div id="modificar"  style="display:<?php echo $css; ?>">
					<form id="contactForm" method = "POST" action="">
						<p>
							<label for="name" >Nombre</label>
							<input name="name"  id="name" type="text" class="form-poshytip" value="<?php echo $name;?>" title="Enter your name" />
						</p>
						
						<p>
							<label for="apellido" >Apellido</label>
							<input name="apellido"  id="apellido" type="text" class="form-poshytip" value="<?php echo $apellido;?>" title="Enter your sub name" value="AMAYA" />
						</p>
						
						<p>
							<label for="tipo_doc">Tipo de Documento</label>
							<select name="tipo_doc" id="tipo_doc" class="form-poshytip" value="<?php echo $tipo;?>" title="Enter your type of document">
								<option value="DNI" selected>DNI</option>
								<option value="PAS">PASAPORTE</option>
								<option value="LE">LIBRETA DE ENROLAMIENTO</option>
								<option value="LC">LIBRETA CIVICA</option>
							</select>
						</p><br>
						<p>
							<label for="num_doc">Numero de Documento</label>
							<input name="num_doc" id="num_doc" type="text" class="form-poshytip" value="<?php echo $doc;?>" title="Enter your document number" />
						</p>
						<p>
							<label for="sueldo">Sueldo</label><br>
							<input name="sueldo" id="sueldo" type="text" class="form-poshytip" value="<?php echo $salario;?>" title="Enter your document number" />
						</p>
						<p>
							<label for="antiguedad">Antiguedad</label>
							<input name="antiguedad" id="antiguedad" type="text" class="form-poshytip" value="<?php echo $antiguedad;?>" title="Enter your document number" />
						</p>
							<label for="ho_ent">Hora de entrada</label>
							<input name="ho_ent" id="ho_ent" type="time" class="form-poshytip" value="<?php echo $ho_ent;?>" title="Enter your document number" />
						</P><br>
						<p>
							<label for="ho_sal">Hora de salida</label>
							<input name="ho_sal" id="ho_sal" type="time" class="form-poshytip" value="<?php echo $ho_sal;?>" title="Enter your document number" />
						</p>
						<br>
						<input type="submit" value="Modificar" name="Modificar" class="busqueda" data-busqueda="2" />
						
					</form>
					

				</div>
				<a href="empleados.php" class="link-button">Volver</a>
				<br><br><br>
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