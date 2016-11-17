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

	<div class="container">
		<div class="register">
			<form  action="Php/register.php" method="POST" >
					<p>
						Registrate y has parte de esta gran comunidad!
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
						include("Php/conec.php");
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
					<input type="email" name="email" placeholder="Correo electrónico" required>
					<?php
						//El correo ya existe
						if (isset($_GET["emailerror"])=="true")
						{
					?>
						<span class="error">El correo que ingresaste ya existe</span>
					<?php
						}
					?>
					<input type="password" id="pass1" name="password" placeholder="Contraseña"  required>
					<!-- <input type="text" id="pass2" name="confirmPassword" placeholder="Confirma tu contraseña" required > -->
					<input type="submit" value="Registrar">
			</form>
		</div>
	</div>

</section>

<!--COPYRIGHT-->
<section class="copyright">
	<p>Uniway &copy;2016. All Rights Reserved.<p>
</section>
</body>
</html>
