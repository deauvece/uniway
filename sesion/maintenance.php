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
		<link rel="stylesheet" type="text/css" href="../css/sesionOpen.css">
		<link rel="icon" type="image/png" href="../Imagenes/favicon.png" />
	</head>
	<body>

    <section class="maintenance">
      <img src="../Imagenes/logo.png" alt="" />
      <p class="title">
        Sitio en construccion
      </p>
      <p class="content">
        Lo sentimos <?php echo $name; ?> la plataforma está en desarrollo, ten paciencia muy pronto estará lista!
      </p>
      <a href="../php/logout.php">Cerrar sesión</a>
    </section>

		<script type="text/javascript" src="../js/main.js"  ></script>
	</body>
</html>
