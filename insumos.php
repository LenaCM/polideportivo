<?php
	require('conexion.php');

?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Polideportivo</title>
	<meta name="description" content="">
	<!-- Mobile viewport optimized: h5bp.com/viewport -->
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" media="screen" href="css/superfish.css" /> 
	<link rel="stylesheet" href="css/nivo-slider.css" media="all"  /> 
	<link rel="stylesheet" href="css/tweet.css" media="all"  />
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" media="all" href="css/lessframework.css"/>
	
	
	<!-- All JavaScript at the bottom, except this Modernizr build.
	   Modernizr enables HTML5 elements & feature detects for optimal performance.
	   Create your own custom Modernizr build: www.modernizr.com/download/ -->
	<script src="js/modernizr-2.5.3.min.js"></script>
</head>
<body>
	
	<!-- WRAPPER -->
	<div class="wrapper cf">
	
		<header class="cf">
						
			<div id="logo" class="cf">
				<a href="index.html" ><img src="img/logo.png" alt="" /></a>
			</div>
			
			<!-- nav -->
			<nav class="cf">
				<ul id="nav" class="sf-menu">
					<!-- Nuevo menu para socios? -->
					<li><a href="index.html"><span>INICIO</span></a></li>
					<li><a href="socios.php"><span>SOCIOS</span></a></li> 
					<li><a href="empleados.php"><span>EMPLEADOS</span></a></li>
					<li><a href="proveedores.php"><span>PROVEEDORES</span></a></li>
					<li class="current-menu-item"><a href="insumos.php"><span>INSUMOS</span></a></li>
					<li><a href="flia_emp.php"><span>FLIA EMPLEADOS</span></a></li>
					<li><a href="flia_soc.php"><span>FLIA SOCIOS</span></a></li>
				</ul>
				<div id="combo-holder"></div>
			</nav>
			<!-- ends nav -->
			
		</header>
		
		<!-- MAIN -->
		<div role="main" id="main" class="cf">
			
			<!-- headline -->
			<div class="headline">Panel Administracion de Insumos</div>
			<!-- ENDS headline -->
			
			<!-- Toggle opciones -->
				<div class="page-content entry-content feature cf">
				
					<h2 class="heading" style="text-align:center;">Opciones</h2>

					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						Dar de alta un Nuevo Insumo
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>		
					<div class="toggle-container">
						<!-- form -->
				<!-- Modificado 28/06/2016 -->
				<form id="contactForm" action="alta.php" method="post">
					<fieldset>				
						<p>
							<label for="name" >Nombre</label>
							<input name="name"  id="name" type="text" class="form-poshytip" title="Enter your name" />
						</p>
						
						<p>
							<label for="apellido" >Apellido</label>
							<input name="Apellido"  id="apellido" type="text" class="form-poshytip" title="Enter your sub name" />
						</p>
						
						<p>
							<label for="tipo_doc">Tipo de Documento</label>
							<select name="Tipo_doc" id="tipo_doc" class="form-poshytip" title="Enter your type of document">
								<option value="DNI" selected>DNI</option>
								<option value="PAS">PASAPORTE</option>
								<option value="LE">LIBRETA DE ENROLAMIENTO</option>
								<option value="LC">LIBRETA CIVICA</option>
							</select>
						</p><br>
						
						<p>
							<label for="num_doc">Numero de Documento</label>
							<input name="num_doc" id="num_doc" type="text" class="form-poshytip" title="Enter your document number" />
						</p>
						
						<!-- send mail configuration -->
						<input type="hidden" value="your@email.com" name="to" id="to" />
						<input type="hidden" value="ENter the subject here" name="subject" id="subject" />
						<input type="hidden" value="send-mail.php" name="sendMailUrl" id="sendMailUrl" />
						<!-- ENDS send mail configuration -->
						
						<p><input type="submit" value="Enviar" name="submit" id="submit" /></p>
					</fieldset>
					
				</form>
				<!-- ENDS form -->
					</div>
										
					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						Modificar datos de un Insumo
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>				
					<div class="toggle-container">

						<?php

							$consulta = "SELECT * from socios s inner join personas p using(id_persona)";
							$result = pg_query($connect, $consulta);

							echo "<table><tr><td>Número</td><td>Nombres</td><td>Apellidos</td><td>Modificar</td></tr>";
							while($row = pg_fetch_assoc($result)){
								echo "<tr><td>".$row['numero_socio']."</td><td>".$row['nombre']."</td><td>".$row['apellido']."</td><td><a href=modificar.php?ID=".$row['numero_socio'].">Modificar</a></tr>";
							}
							echo "</table>";

						?>
						
					</div>
					
					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						Dar de baja a un Insumo
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>				
					<div class="toggle-container">
						<form id="contactForm" action="modificar_persona.php" method="post">
							<fieldset>
							</fieldset>
						</form>
					</div>
					<div class="toggle-trigger">
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
						Buscar un Insumo
						<img class="mas" src="img/bullets/plus.png">
						<img class="menos" src="img/bullets/minus.png">
					</div>				
					<div class="toggle-container">
						<table class="hol">
								<tr>
									<th>Numero de Socio</th>
									<th>Nombres</th>
									<th>Apellidos</th>
								</tr>
								<tr>
									<td>1</td>
									<td>Malena</td>
									<td>Corrales Moyano</td>
								</tr>
							</table>
					</div>
					<!-- ENDS Toggle opciones -->
				</div>
			
			<!-- ENDS featured -->
			
		</div>

		<!-- ENDS MAIN -->
		

		<footer>
		
			<!-- text message -->
			<div id="twitter-holder">
				<div class="ribbon-left"></div>
				<div class="ribbon">
					<div id="tweets-bar" class="tweet">
					
					<ul class="tweet_list">
						<li>
						<div class="tweet_time">Today</div>
						Enter an small text notification visible on all pages. <a href="http://twitter.com/ansimuz" >@ansimuz</a> </li>
					</ul>
					
					</div>
				</div>
				<div class="ribbon-right"></div>
			</div>
			<!-- ENDS text message -->
			
			
			<!-- widgets -->
			<ul  class="widget-cols cf">
				<li class="first-col">
					
					<div class="widget-block">
						<h4>RECENT POSTS</h4>
						<div class="recent-post cf">
							<a href="#" class="thumb"><img src="img/dummies/54x54.gif" alt="Post" /></a>
							<div class="post-head">
								<a href="#">Pellentesque habitant morbi senectus </a><span> March 12, 2011</span>
							</div>
						</div>
						<div class="recent-post cf">
							<a href="#" class="thumb"><img src="img/dummies/54x54b.gif" alt="Post" /></a>
							<div class="post-head">
								<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
							</div>
						</div>
						<div class="recent-post cf">
							<a href="#" class="thumb"><img src="img/dummies/54x54c.gif" alt="Post" /></a>
							<div class="post-head">
								<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
							</div>
						</div>
					</div>
				</li>
				
				<li class="second-col">
					
					<div class="widget-block">
						<h4>ABOUT</h4>
						<p>Vintage Template it's completely free this means you don't have to pay anything <a href="http://luiszuno.com/blog/license" >read license</a>.</p> 
						
						<p>Placeholder images by <a href="http://twistedfork.me/" >Dan Matutina</a></p>
						<p>Visit <a href="http://templatecreme.com/" >Template Creme</a> and find the most beautiful free templates up to date.</p>
					</div>
					
				</li>
				
				<li class="third-col">
					
					<div class="widget-block">
						<h4>DUMMY TEXT</h4>
						<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. </p>
		     		</div>
		     		
				</li>
				
				<li class="fourth-col">
					
					<div class="widget-block">
						<h4>CATEGORIES</h4>
						<ul>
							<li class="cat-item"><a href="#" >Design</a></li>
							<li class="cat-item"><a href="#" >Photo</a></li>
							<li class="cat-item"><a href="#" >Art</a></li>
							<li class="cat-item"><a href="#" >Game</a></li>
							<li class="cat-item"><a href="#" >Film</a></li>
							<li class="cat-item"><a href="#" >TV</a></li>
						</ul>
					</div>
		     		
				</li>	
			</ul>
			<!-- ENDS widgets -->
			
			<!-- bottom -->
			<div id="bottom">
				<div id="widget-trigger-holder"><a id="widget-trigger" href="#" title="View More" class="poshytip"></a></div>
				<div id="content">HalfTone Theme by <a href="http://www.luiszuno.com" >luiszuno.com</a> </div>
			</div>
			<!-- ENDS bottom -->
			
		</footer>
		
		
	</div>
	<!-- ENDS WRAPPER -->
	
	<!-- JavaScript at the bottom for fast page loading -->
	
	
	<!-- scripts concatenated and minified via build script -->
	<script src="js/jquery-1.7.1.min.js"></script>
	<script src="js/custom.js"></script>
	
	<!-- superfish -->
	<script  src="js/superfish-1.4.8/js/hoverIntent.js"></script>
	<script  src="js/superfish-1.4.8/js/superfish.js"></script>
	<script  src="js/superfish-1.4.8/js/supersubs.js"></script>
	<!-- ENDS superfish -->
	
	<script src="js/jquery.nivo.slider.js" ></script>
	<script src="js/css3-mediaqueries.js"></script>
	<script src="js/tabs.js"></script>
	<script  src="js/poshytip-1.1/src/jquery.poshytip.min.js"></script>
	<!-- end scripts -->

</body>
</html>