<!DOCTYPE html>
<html lang="es">
<head>
	<title>Uniway</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="CSS/home-form-Style.css">
	<link rel="icon" type="image/png" href="Imagenes/favicon.png" />
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
					<a href="contacto.html">Contacto</a>
				</li>
				<li>
					<a href="home.html#misionyvision">Quienes somos</a>
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


<!--MISIONYVISION-->
<section class="contenedorContact">

	<h2>INICIA SESIÓN </h2>
	<div class="container">
		<div class="login">

			<form  action="Php/login.php" method="POST" >
        <img class="loginImg" src="Imagenes/loginImage.jpg" alt="usuario" width="354" /><br><br>
				<input type="email" name="correo" placeholder="Correo electrónico" required>
				<input type="password" name="contrasena" placeholder="Contraseña" required>
				<?php
				  //Error de contraseña o correo
					if (isset($_GET["errorusuario"])=="si")
					{
				?>
					<span class="error">La cuenta o la contraseña es incorrecta.</span>
				<?php
					}
				?>
				<?php
					//Error de inicio se sesion
					if (isset($_GET["errorSesion"])=="si")
					{
				?>
					 <span class="error">No has iniciado sesión!</span>
				<?php
					}
				?>
				<input class="botonLogin" type="submit" name="submit" value="Entrar">
			</form>
			<a href="register_user.php">
				<input class="botonLogin" type="submit" name="submit" value="Registrarse">
			</a>
		</div>
	</div>

</section>

<!--COPYRIGHT-->
<section class="copyright">
	<p>Uniway &copy;2016. All Rights Reserved.<p>
</section>
</body>
</html>
