<?PHP
$id_conductor1 = $_POST["id_conductor"];
$id_ruta1 = $_POST["id_ruta"];


$conexion = pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uiswheels password=P?'oG0s+");

$sql3="insert into ruta_conductor (id_conductor, id_ruta) values ('$id_conductor1','$id_ruta1')";

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

		<table id="consulta" >
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
					Id Conductor:
				</td>
				<td>
					<?PHP echo "$id_conductor1"; ?>
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
