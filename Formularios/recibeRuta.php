<?PHP
$id_ruta1 = $_POST["id_ruta"];
$time1 = $_POST["hora"];
$idaOsalida1 = $_POST["idaOsalida"];
$cupos1 = $_POST["cupos"];
$picoYplaca1 = $_POST["picoYplaca"];

$conexion = pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uiswheels password=P?'oG0s+");

$sql3="insert into ruta (id_ruta, hora, cupos, id_dia, ida_salida) values ('$id_ruta1','$time1','$cupos1', '$picoYplaca1' , '$idaOsalida1')";

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
					Id Ruta:
				</td>
				<td>
					<?PHP echo "$id_ruta1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Hora:
				</td>
				<td>
					<?PHP echo "$time1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Ida o salida:
				</td>
				<td>
					<?PHP echo "$idaOsalida1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Cupos:
				</td>
				<td>
					<?PHP echo "$cupos1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Pico y placa:
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
