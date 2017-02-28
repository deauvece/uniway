<?php


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Uniway</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="CSS/home-form-Style.css">
	<link rel="icon" type="image/png" href="Imagenes/favicon.png" />
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<!--captcha google-->
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
<a name="inicio"></a>
<!--BARRA DE NAVEGACION-->
<nav class="simple-nav">
	<ul >
		<li>
			<a href="home.html">
				<img src="Imagenes/logo-name-white.png" width="150" id="nombre" />
			</a>
		</li>
	</ul>
</nav>
<section class="account-login">
<ul>
	<li>
		¿Ya tienes una cuenta?
	</li>
	<li id="login">
		<a href="login-user.php">Iniciar Sesión</a>
	</li>
</ul>
</section>


<!--MISIONYVISION-->
<section class="contenedorContact">
		<div class="register">
			<form autocomplete="off" action="register-test.php" method="POST" >
					<p>
						Ingresa tus datos y has parte de esta gran comunidad!
					</p>
					<input type="text" name="names" placeholder="Nombres" required/>
					<input type="text" name="last_names" placeholder="Apellidos" required>
					<input type="tel" name="phone" placeholder="Numero celular" required>
					<div class="sex">
						<!--M(masculino) F(femenino)-->
							<input type="radio" id="radio_h" name="sex" value="M" required>
							<label for="radio_h">Hombre</label>
							<input type="radio" id="radio_m" name="sex" value="F">
							<label for="radio_m">Mujer</label>
					</div>
					<select name="id_u"  required>
					<option value="">Elige tu universidad</option>
						<?PHP
						include("Php/functions.php");
						$conn=conectarse();
						$sql1="SELECT * FROM universities";
						$result = pg_query($conn,$sql1);
						while ($vector=pg_fetch_array($result))
						{
						?>

						<option value="<?PHP echo $vector['id_u']?>" >
						<?PHP echo $vector['name']; ?>
						</option>

						<?PHP
						}
						?>

					</select>
					<input autocomplete="off" type="email" name="email" placeholder="Correo electrónico" required  >
					<?php
						//El correo ya existe
						if (isset($_GET["emailerror"])=="true")
						{
					?>
						<span class="error">El correo que ingresaste ya existe</span>
					<?php
						}
					?>

					<input autocomplete="off" type="password" id="pass1" name="password" placeholder="Contraseña"  required>
					<!-- <input type="text" id="pass2" name="confirmPassword" placeholder="Confirma tu contraseña" required > -->
					<div class="g-recaptcha" data-sitekey="6LdlABcUAAAAAONiTJxjYQNxI9o5k6OHxuBBjftB"></div>
					<input type="submit" value="Crear cuenta">
			</form>

		</div>
</section>
<span class="termycon">
	Al hacer click en "Crear cuenta", aceptas los Términos y las condiciones
	de Uniway y la politica de privacidad.
</span>
<!--COPYRIGHT-->
<section class="copyright">
	<p>Uniway &copy;2017. All Rights Reserved.<p>
</section>
</body>
</html>
