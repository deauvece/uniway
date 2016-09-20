<?PHP
$id_comentario_pasajero1 = $_POST["id_comentario_pasajero"];
$id_ruta1 = $_POST["id_ruta"];
$id_pasajero1 = $_POST["id_pasajero"];
$hora1 = $_POST["hora"];
$fecha_comentario1 = $_POST["fecha_comentario"];
$contenido1 = $_POST["contenido"];

$conexion = pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uiswheels password=P?'oG0s+");

$sql3="insert into comentario_pasajero (id_comentario_pasajero, id_pasajero,id_ruta,hora,fecha,contenido) values ('$id_comentario_pasajero1','$id_pasajero1','$id_ruta1','$hora1','$fecha_comentario1','$contenido1')";

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
					Id Color:
				</td>
				<td>
					<?PHP echo "$id_comentario_pasajero1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Ruta:
				</td>
				<td>
					<?PHP echo "$id_ruta1"; ?>
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
					Hora:
				</td>
				<td>
					<?PHP echo "$hora1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Fecha:
				</td>
				<td>
					<?PHP echo "$fecha_comentario1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Comentario:
				</td>
				<td>
					<?PHP echo "$contenido1"; ?>
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
