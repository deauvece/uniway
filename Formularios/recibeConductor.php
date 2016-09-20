<?PHP
$id_conductor1 = $_POST["id_conductor"];
$nombre1 = $_POST["nombre"];
$apellido1 = $_POST["apellido"];
$genero1 = $_POST["genero"];
$fecha_nac1 = $_POST["fecha_nac"];
$profesion1 = $_POST["profesion"];
$Ciudad1 = $_POST["Ciudad"];
$telefono1= $_POST["telefono"];
$correo1 = $_POST["correo"];
$picoYplaca1= $_POST["picoYplaca"];
$contrasena1= $_POST["contrasena"];
$correoInstitucional1 = $_POST["correoInstitucional"];
$documento1 = $_POST["documento"];
$universidad1 = $_POST["id_universidad"];

$conexion = pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uiswheels password=P?'oG0s+");

$sql3="insert into conductor (id_conductor, nombres, apellidos, id_genero, fecha_nacimiento, profesion, ciudad, telefono, correo, id_dia, password, correo_inst, documento, id_universidad ) values ('$id_conductor1','$nombre1', '$apellido1', '$genero1', '$fecha_nac1', '$profesion1','$Ciudad1', '$telefono1', '$correo1', '$picoYplaca1', '$contrasena1', '$correoInstitucional1', '$documento1' , '$universidad1')";

	$result = pg_query($conexion, $sql3);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Confirmacion</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
	</head>
	<body >

		<table id="consulta">
			<tr>
				<td colspan="2" >
					<h2>
						Datos enviados:
					</h2>
				</td>
			</tr>
			<tr>
				<td>
					Id Conductor:
				</td>
				<td>
					<?PHP echo "$id_conductor1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Nombre:
				</td>
				<td>
					<?PHP echo "$nombre1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Apellido:
				</td>
				<td>
					<?PHP echo "$apellido1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Universidad:
				</td>
				<td>
					<?PHP echo "$universidad1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Genero:
				</td>
				<td>
					<?PHP echo "$genero1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Fecha de nacimiento:
				</td>
				<td>
					<?PHP echo "$fecha_nac1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Ciudad:
				</td>
				<td>
					<?PHP echo "$Ciudad1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Telefono:
				</td>
				<td>
					<?PHP echo "$telefono1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Documento:
				</td>
				<td>
					<?PHP echo "$documento1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Correo inst:
				</td>
				<td>
					<?PHP echo "$correoInstitucional1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Correo:
				</td>
				<td>
					<?PHP echo "$correo1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Contraseña:
				</td>
				<td>
					<?PHP echo "$contrasena1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Profesion:
				</td>
				<td>
					<?PHP echo "$profesion1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Dia de pico y placa:
				</td>
				<td>
					<?PHP echo "$picoYplaca1"; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<a href="../dataBase.html"> <button class="botonVolver" >Volver</button> </a>
				</td>
			</tr>
		</table>
	</body>
</html>
