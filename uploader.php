<?php

	if(isset($_POST['comentario']))
	{
	?>
		<!DOCTYPE html>
		<html lang="es">
		<head>
			<title>Uniway</title>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width,initial-scale=1.0">
			<link rel="stylesheet" type="text/css" href="css/home-form-Style.css">
		</head>
		
		<body>
		<a name="inicio"></a>
		<!--BARRA DE NAVEGACION-->
		<nav>
			<ul>
				<li>
					<input type="checkbox" name="name" id="btn">
					<div class="label">
						<label for="btn"> <img src="Imagenes/menu1.png" alt="menu-ham" height="50" width="50" /> </label>
					</div>
					<ul class="sinmenu" >
						<li>
							<a href="home.html">Inicio</a>
						</li>
						<li>
							<a href="dataBase.html">Data Base</a>
						</li>
						<li>
							<a href="contacto.html">Contacto</a>
						</li>
						<li>
							<a href="home.html#misionyvision">Quienes somos</a>
						</li>
						<li>
							<a href="fail.html">Cómo funciona</a>
						</li>
						<li>
							<a href="fail.html">Inicia Sesión</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
		<!--LOGOOO-->
		<div id="logo">
			<a href="home.html">
			<img src="Imagenes/logo-only.png" height="50" />
			<img src="Imagenes/logo-name.png" height="40" id="nombre" />
			</a>
		</div>
		
		
		<!--TEXTO-->
		<section class="contenedorContact">
		
			<h2>CONTACTANOS </h2>
			<div class="container">
				<h3>
					<?php $nombre=$_POST['nombre']; echo "$nombre", "!" ; ?>
					muchas gracias por compartir tu opinión con nosotros, trataremos de responderte lo más rápido posible.
				</h3>
				<br><br><br><br>
				<div id="btn-inicio">
					<a href="home.html">Inicio</a>
				</div>
			</div>
		
		</section>
		
		<!--COPYRIGHT-->
		<section class="copyright">
			<p>Uniway &copy;2016. All Rights Reserved.<p>
		</section>
		</body>
		</html>
		

	<?php
	} else {
		     $target_path = "Formularios/uploaded/";
		     $target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
		     if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		     {
		?>		

			<script type="text/javascript">
	                     javascript:history.back();
	                     alert("El archivo ha sido subido con exito!");
	               </script>

		<?php
		        
		     } else{
		?>
		               <script type="text/javascript">
		                     javascript:history.back();
		                     alert("ERROR SUBIENDO EL ARCHIVO, por favor intente de nuevo.");
		               </script>
		<?php
		          }
	}

     
?>
