<?PHP
$id_tranporte1 = $_POST["id_tranporte"];
$placas1 = $_POST["placas"];
$cupos1 = $_POST["cupos"];
$tipoTransporte1 = $_POST["tipoTransporte"];
$aireAcondicionado1 = $_POST["aireAcondicionado"];
$wifi1 = $_POST["wifi"];
$precio1= $_POST["precio"];
$color1 = $_POST["color"];
$modelo_transporte1= $_POST["modelo_transporte"];

$conexion = pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uiswheels password=P?'oG0s+");

$sql3="insert into transporte (id_transporte, placas, cupos, tipo_transporte, aire_acondicionado, precio, modelo_transporte, wifi, id_color)
values ('$id_tranporte1','$placas1', '$cupos1', '$tipoTransporte1', '$aireAcondicionado1','$precio1','$modelo_transporte1', '$wifi1','$color1')";

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
					Id Transporte:
				</td>
				<td>
					<?PHP echo "$id_tranporte1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Placas:
				</td>
				<td>
					<?PHP echo "$placas1"; ?>
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
					Transporte:
				</td>
				<td>
					<?PHP echo "$tipoTransporte1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Aire acondicionado:
				</td>
				<td>
					<?PHP echo "$aireAcondicionado1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Wi-fi:
				</td>
				<td>
					<?PHP echo "$wifi1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Precio:
				</td>
				<td>
					<?PHP echo "$precio1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Color:
				</td>
				<td>
					<?PHP echo "$color1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Modelo:
				</td>
				<td>
					<?PHP echo "$modelo_transporte1"; ?>
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
