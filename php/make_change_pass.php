<?PHP
// llamar la funciones
include("functions.php");
include("hash_pass.php");
$conn=conectarse();
$new_pass=$_GET['nwps'];
$id_user=$_GET['idusr'];
$conf_code=$_GET['cnfcd'];

if ($new_pass & $id_user & $conf_code ) {
//verifica el codigo de confirmacion
	$sql="SELECT pass_conf_code FROM users WHERE id_user='$id_user'";
	$result = pg_query($conn, $sql);
	$vector=pg_fetch_array($result);
	$conf_code_BD=$vector['pass_conf_code'];
	if ($conf_code_BD==$conf_code) {
//se encripta y se actualiza la contraseña
		$encrpt_pswd= password_hash($new_pass,PASSWORD_DEFAULT);
		$sql2="UPDATE users SET password='$encrpt_pswd' WHERE id_user='$id_user'  ";
		$result2 = pg_query($conn, $sql2);
	}else {
		$error="Error, codigo de confirmacion no valido";
	}

}else{
	$error="Error, no existen variables de confirmacion para el cambio de contraseña";
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Uniway | Cambio de contraseña</title>
		<!--Meta-->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<!--Style-->
		<link rel="stylesheet" href="../css/home-form-Style.css">
		<link rel="icon" type="image/png" href="../Imagenes/favicon.png" />
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
		<!--JS-->
		<script src="../js/jquery-3.1.1.min.js"></script>
		<script src="../js/jquery-ui/jquery-ui.js"></script>
		<script src="../js/main.js"></script>
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.structure.css">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.theme.css">
	</head>
	<body>
		<section class="reset_container">
			<a href="../index.html"><img src="../Imagenes/logo.png" alt="" /></a>
			<div class="reset_box">
				<span>Nueva contraseña</span>
				<div class="input_reset_box">
					<?php
					if ($error) {
						echo "<p>Hubo un error en la confirmación del cambio de contraseña.</p>";
					}else {
						echo "<p>Los cambios se han efectuado satisfactoriamente, pero te recomendamos actualizar de nuevo tu contraseña</p>";
					}
					 ?>
				</div>
				<a href="../login-user.php"><button type="button" name="button">Iniciar sesión</button></a>
			</div>
		</section>
	</body>
</html>
