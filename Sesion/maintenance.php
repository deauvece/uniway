<?php
		//se comprueba si ha iniciado sesion
		session_start();
		if ($_SESSION['activo'] == false) {
			header("location:../login-user.php?errorSesion=si");
		}else {
			$name = $_SESSION['id_nombre_usuario'] ;
			$last_name = $_SESSION['id_apellido_usuario'] ;
			$full_name= $name ." ". $last_name;
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Uniway</title>
    		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="../CSS/sesionOpen.css">
		<link rel="icon" type="image/png" href="../Imagenes/favicon.png" />
	</head>
	<body>
		<a name="inicio"></a>
		<!--Nav bar-->
		<nav class="navFeed" >
			<div class="left">
				<img src="logo-name.png" alt="logo"/>
			</div>
			<div class="center">
				<a href="#inicio">
					<img src="logo-only.png" alt="logo"/>
				</a>
			</div>
			<!--Menu responsive-->
			<ul>
				<li>
					<input type="checkbox" name="name" id="btn" onclick='menuDesplegable()' >
					<div class="label">
						<label for="btn"> <img src="menu1.png" alt="menu-ham" height="50" width="50" /> </label>
					</div>
					<ul class="sinmenu" >
						<li>
							<a href="../Php/logout.php">Cerrar sesión</a>
						</li>
					</ul>
				</li>
			</ul>
			<!--fin menu responsive-->
			<div class="right">
				<img src="config.png" alt="settings" />
			</div>
		</nav>
    <section class="maintenance">
      <img src="../Imagenes/logo.png" alt="" />
      <p class="title">
        Sitio en construccion
      </p>
      <p class="content">
        Lo sentimos <?php echo $nombre; ?> la plataforma está en desarrollo, ten paciencia muy pronto estará lista!
      </p>
      <a href="../Php/logout.php">Cerrar sesión</a>
    </section>

		<script type="text/javascript" src="../JS/main.js"  ></script>
	</body>
</html>
