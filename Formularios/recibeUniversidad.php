<?PHP
$id_universidad1 = $_POST["id_universidad"];
$nombre1= $_POST["nombre"];
$sede1= $_POST["sede"];


$conexion = pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uiswheels password=P?'oG0s+");

$sql3="insert into universidad (id_universidad, nombre,sede) values ('$id_universidad1','$nombre1','$sede1')";

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
					Id Universidad:
				</td>
				<td>
					<?PHP echo "$id_universidad1"; ?>
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
					Sede:
				</td>
				<td>
					<?PHP echo "$sede1"; ?>
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
