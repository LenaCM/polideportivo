

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
		function remover(){
			elemento=document.getElementById("contactForm");
			elemento.parentNode.removeChild(elemento);
		}
	</script>
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

		<div class="toggle-container">
		<?php
			$ID = $_GET['ID'];
					$tipo_busq = $_GET['tipo_busq'];

					$consulta = "select * from sp_busqueda_socio(5,'$ID',null)";
					$result = pg_query($connect,$consulta);

					while ($row=pg_fetch_assoc($result)){
						$name = strtoupper($row['nombre']);
						$apellido = strtoupper($row['apellido']);
						$doc = $row['dni'];
						$tipo = $row ['tipo_doc'];
					}
		?>
			<form id="contactForm" method = "POST" action="">
				<p>
					<label for="name" >Nombre</label>
					<input name="name"  id="name" type="text" class="form-poshytip" value="<?php echo $name;?>" title="Enter your name" />
				</p>
				
				<p>
					<label for="apellido" >Apellido</label>
					<input name="apellido"  id="apellido" type="text" class="form-poshytip" value="<?php echo $apellido;?>" title="Enter your sub name" />
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
					<input name="num_doc" maxlength="8" id="num_doc" type="text" class="form-poshytip" value="<?php echo $doc;?>" title="Enter your document number" />
				</p>
				<input type="submit" value="Modificar" name="Modificar"/>
				<a class="link-button" href="socios.php"> Volver </a>
			</form>
			<?php 
				if (isset ($_POST['Modificar'])) {
					if (isset($_POST['name']) && !empty($_POST['name']) && 
						isset($_POST['apellido']) && !empty($_POST['apellido']) &&
						isset($_POST['num_doc']) && !empty($_POST['num_doc']) &&
						isset($_POST['tipo_doc']) && !empty($_POST['tipo_doc']) &&
						isset($ID) && !empty($ID) && isset($tipo_busq) && !empty($tipo_busq))
					{
						$name2 = strtoupper($_POST['name']);
						$ape2 = strtoupper($_POST['apellido']);
						$doc2 = $_POST['num_doc'];
						$tipo2 = $_POST['tipo_doc'];

						if ($tipo_busq == 1) {
							if(pg_query($connect, "SELECT sp_modificacion_socio($tipo_busq,NULL,$ID,$doc2,'$tipo2','$name2','$ape2')")){
								
								echo '<p class="infobox-success">Modificado con éxito</p>';
								
							} else {
								echo '<p class="infobox-error">'.pg_last_error($connect).'</p>';
							} 
							echo '<script type="text/javascript">remover();</script>';
						} else {
							if(pg_query($connect, "SELECT sp_modificacion_socio($tipo_busq,'$tipo',$doc2,$doc2,'$tipo2','$name2','$ape2')")){
								echo '<p class="infobox-success">Modificado con éxito</p>';
							} else {
								echo '<p class="infobox-error">'.pg_last_error($connect).'</p>';
							}
							echo '<script type="text/javascript">remover();</script>';
						}
						$consulta2 = "select * from sp_busqueda_socio(4, '$doc2', '$tipo2')";
						$result = pg_query($connect, $consulta2);
						echo '<table id="lista_soc"><tr class="nombre_columna"><th>Numero de Socio</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Numero de Documento</th>
							<th>Tipo de Documento</th>
							<th>Fecha de Ingreso</th>
							<th>Estado de Cuenta</th>
							<th>MODIFICAR</th>
							<th>ELIMINAR</th></tr>';
						while($row = pg_fetch_assoc($result)){
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
						echo '</table><br><a class="link-button" href="socios.php"> Volver </a>';
					} else {
						echo '<p class="infobox-error">Error no se cargaron datos</p>
							  <script type="text/javascript">remover();</script>
							  <a class="link-button" href="socios.php"> Volver </a>';

					}
				}
			?>
			

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