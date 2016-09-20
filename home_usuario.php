<?php
	//para que no entre a la pagina sin haber iniciado sesion
	include("conec.php");
	$conn=conectarse();
	session_start();
	if (!$_SESSION) {
		header("location:home.html");
	}
 ?>













<!DOCTYPE html>
<html lang="es">
<head>
	<title>Uniway-usuario</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="CSS/home-form-Style.css">
	<script src="html5logo.js"></script>
     <script src="mathlib-min.js"></script>
     <script src="k3d-min.js"></script>
</head>

<body>
<a name="inicio"></a>
<!--BOTON IR ARRIBA-->
<span class="ir-arriba">
	<a href="#inicio">
		<img src="up.png">
	</a>
</span>
<!--BARRA DE NAVEGACION-->
<nav>
	<ul>
		<li>
			<input type="checkbox" name="name" id="btn">
			<div class="label">
				<label for="btn"> <img src="menu1.png" alt="menu-ham" height="50" width="50" /> </label>
			</div>
			<ul class="sinmenu" >
				<li>
	                                <a href="home_usuario.php">Inicio </a>
				</li>
				<li>
					<a href="contacto.html">Contacto</a>
				</li>
				<li>
					<a href="home_usuario.php#misionyvision">Quienes somos</a>
				</li>
				<li>
					<a href="perfil.php"> <?php echo $_SESSION['id_nombre_usuario']; ?> </a>
				</li>
				<li>
					<a href="logout.php">Cerrar Sesion</a>
				</li>
			</ul>
		</li>
	</ul>
</nav>
<!--LOGOOO-->
<div id="logo">
	<a href="home_usuario.php">
	<img src="logo-only.png" height="50" />
	<img src="logo-name.png" height="40" id="nombre" />
	</a>
</div>

<!--HEADER-->
<header>
	<h2>Hola <?php echo $_SESSION['id_nombre_usuario']; ?> ,gracias por usar nuestra plataforma.</h2>
	<p>
		Busca una ruta que te sirva para llegar a tu universidad!
	</p>
</header>
<!--MISIONYVISION-->
<a name="misionyvision"></a>
<section class="contenedorM">

	<h2>Nuestra misión y visión.</h2>
	<p>Conoce sobre nuestras motivaciones y objetivos.</p>
	<div class="columnas">
		<div class="col">
			<div class="imagen">
				<img src="mission.png" height="120">
			</div>
			<h5>Misión</h5>
			<p>
				Incentivar y promover el uso compartido del carro particular entre la comunidad universitaria generando disminución de la congestión vehicular de la ciudad, creación y fortalecimiento de los vinculos sociales y reducción de la contaminación al medio ambiente.
			</p>
		</div>
		<div class="col">
			<div class="imagen">
				<img src="vision.png" height="120">
			</div>
			<h5>Visión</h5>
			<p>
				Dentro de unos años esperamos ser la mejor opción de todas las universidades del pais para movilizarse dentro de sus respectivas ciudades.<br><br><br><br>
			</p>
		</div>
	</div>
</section>
<!--canvaaaaaaaaaaaas-->
<section class="canvas">
	<a href="tools.html" target="_blank" onClick="window.open(this.href, this.target, 'width=500,height=600'); return false;">
		<canvas id="canvas" style="background-color:#ddd"></canvas>
	</a>
</section>

<!--FEEDBACK-->
<footer>
	<div class="contenido">
		<h3 > Contáctanos:</h3>
		<p >
			¿Tienes alguna pregunta? sientete libre de escribirnos cualquier cosa, recomendaciones, preguntas, criticas, donaciones
			, regaños, estaremos respondiendo lo más pronto posible!
		</p>
		<a href="contacto.html">Escribenos</a>
	</div>
	<div class="social">
		<h3>Encuentranos tambien aquí</h3>
			<a href="#" onclick="javascript:if(confirm('Este link te dirige a nuestra pagina de Facebook')) {parent.location='http://google.com'}else{''};"><img src="fb.png" alt="facebook"/></a>
			<a href="#" onclick="javascript:if(confirm('Este link te dirige a nuestra pagina de Twitter')) {parent.location='http://google.com'}else{''};"><img src="tw.png" alt="twitter"/></a>
			<a href="#" onclick="javascript:if(confirm('Este link te dirige a nuestra pagina de Instagram')) {parent.location='http://google.com'}else{''};" ><img src="insta.png" alt="instagram"/></a>
		<p>
			info@uniway.com.co <br>
		</p>
	</div>
</footer>
<!--COPYRIGHT-->
<section class="copyright">
	<p>Uniway &copy;2016. All Rights Reserved.<p>
</section>
</body>
</html>
