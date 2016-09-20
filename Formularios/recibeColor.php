<?PHP
$id_color1 = $_POST["id_color"];
$id_colores1 = $_POST["id_colores"];


$conexion = pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uiswheels password=P?'oG0s+");

$sql3="insert into color (id_color, colores) values ('$id_color1','$id_colores1')";

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
					<?PHP echo "$id_color1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Colores:
				</td>
				<td>
					<?PHP echo "$id_colores1"; ?>
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
