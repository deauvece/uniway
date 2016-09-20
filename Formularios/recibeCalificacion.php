<?PHP

$id_calificacion1 = $_POST["id_calificacion"];
$id_conductor1 = $_POST["id_Conductor"];
$id_pasajero1 = $_POST["id_Pasajero"];
$calificacion1 = $_POST["calificacion"];
$fecha_calificacion1 = $_POST["fecha_calificacion"];
$hora_calificacion1= $_POST["hora_calificacion"];
$comentario1 = $_POST["comentario"];

$conexion = pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uiswheels password=P?'oG0s+");

$sql3="insert into calificacion (id_calificacion, id_conductor, id_pasajero, calificacion, fecha_calificacion, hora_calificacion, comentario )
values ('$id_calificacion1','$id_conductor1', '$id_pasajero1', '$calificacion1', '$fecha_calificacion1','$hora_calificacion1', '$comentario1')";

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
					Id Calificacion:
				</td>
				<td>
					<?PHP echo "$id_calificacion1"; ?>
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
					Id Pasajero:
				</td>
				<td>
					<?PHP echo "$id_pasajero1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Calificacion:
				</td>
				<td>
					<?PHP echo "$calificacion1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Comentario:
				</td>
				<td>
					<?PHP echo "$comentario1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Fecha:
				</td>
				<td>
					<?PHP echo "$fecha_calificacion1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Hora:
				</td>
				<td>
					<?PHP echo "$hora_calificacion1"; ?>
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
