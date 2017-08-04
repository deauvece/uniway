<!DOCTYPE html>
<html lang="es">
<head>
	<title>Uniway | Inicio de sesión</title>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/home-form-Style.css">
	<link rel="icon" type="image/png" href="Imagenes/favicon.png" />
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
</head>

<body>
<section class="contenedorContact">
	<a href="index.html">
		<img class="loginImg" src="Imagenes/logo.png"  /><br><br>
	</a>
		<div class="login">
			<span class="title">Inicia sesión</span>
			<form  action="php/login.php" method="POST" >
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
				<button class="botonLogin button_1" type="submit">Entrar</button>
				<span><a href="password_reset.php">¿Has olvidado tu contraseña?</a></span>
			</form>
			<hr>
			<p>¿Todavia no tienes una cuenta? Regístrate!</p>
			<a href="register_user.php">
				<button class="botonLogin button_1" type="button">Registrarse</button>
			</a>
		</div>
</section>
</body>
</html>
