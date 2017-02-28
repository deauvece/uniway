<!DOCTYPE html>
<html lang="es">
<head>
	<title>Uniway / Inicia sesión</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/home-form-Style.css">
	<link rel="icon" type="image/png" href="Imagenes/favicon.png" />

</head>

<body>
<section class="contenedorContact">

	<div class="container">
		<div class="login">
			<form  action="php/login.php" method="POST" >
				<a href="index.html">
					<img class="loginImg" src="Imagenes/logo.png" width="175" /><br><br>
				</a>
				<hr>
				<span class="title">Inicia sesión</span>
				<input type="email" name="correo" placeholder="Correo electrónico" required>
				<input type="password" name="contrasena" placeholder="Contraseña" required>
				<?php
				  //Error de contraseña o correo
					if (isset($_GET["errorusuario"])=="si")
					{
				?>
					<span class="error">El nombre de usuario y la contraseña que ingresaste no coinciden con nuestros registros. Por favor, revisa e inténtalo de nuevo.</span>
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
			<hr>
			<span class="title">¿Todavia no tienes una cuenta? Regístrate!</span>
			<a href="register_user.php">
				<input class="botonLogin" type="submit" name="submit" value="Registrarse">
			</a>
		</div>
	</div>

</section>
</body>
</html>
