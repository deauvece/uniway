<?PHP
$id_musica1 = $_POST["id_musica"];
$id_Generos1 = $_POST["id_Generos"];

$conexion = pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uiswheels password=P?'oG0s+");

$sql3="insert into musica (id_musica, generos) values ('$id_musica1','$id_Generos1')";

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
					Id Musica:
				</td>
				<td>
					<?PHP echo "$id_musica1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Genero:
				</td>
				<td>
					<?PHP echo "$id_Generos1"; ?>
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
