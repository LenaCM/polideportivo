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

		<div class="toggle-container">
			<?php
				$nom = $_POST['name'];
				$ape = $_POST['Apellido'];
				$num_doc = $_POST['num_doc'];
				$tipo = $_POST['Tipo_doc'];
				echo $tipo;
				if(isset($nom) and isset($ape) and isset($num_doc) and isset($tipo)){
					
					$consulta = "SELECT sp_alta_socio('$nom','$ape', $num_doc,'$tipo')";
					if (!$result = pg_query($connect,$consulta)) {
						echo '<p class="infobox-error">'.pg_last_error($connect).'</p>';
					} else {
						echo '<p class="infobox-success">Datos ingresados correctamente</p>';
						$consulta2 = "select * from sp_busqueda_socio(4, '$num_doc', '$tipo')";
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
						echo "</table><br>";
					}
					
				}else{
					echo '<p class="infobox-warning">No se han ingresado todos los datos requeridos</p><br>';
				}
			?>
			<a href="socios.php" class="link-button">Volver</a>
			<br><br>

			</table>
		</div>
		<!-- ribbon -->
			<div id="twitter-holder">
				<div class="ribbon-left"></div>
				<div class="ribbon"></div>
				<div class="ribbon-right"></div>
			</div>
		<!-- ENDS ribbon -->
	</div>
</body>
</html>