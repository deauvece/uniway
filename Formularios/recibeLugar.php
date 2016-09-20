<?PHP
$id_lugar1 = $_POST["id_lugar"];
$direccion1 = $_POST["direccion"];
$especifiacion1 = $_POST["especifiacion"];
//para subir la imagennnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn
	if($_POST){
	// Creamos la cadena aletoria, para que no se repita el nombre de la imagen en la carpeta
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	$cad = "";
	for($i=0;$i<12;$i++) {
	$cad .= substr($str,rand(0,62),1);
	}
	// Fin de la creacion de la cadena aletoria
	$tamano = $_FILES [ 'file' ][ 'size' ]; // Leemos el tamaño del fichero
	$tamaño_max="50000000000"; // Tamaño maximo permitido
	if( $tamano < $tamaño_max){ // Comprovamos el tamaño
	$destino = 'uploaded' ; // Carpeta donde se guardata
	$sep=explode('image/',$_FILES["file"]["type"]); // Separamos image/
	$tipo=$sep[1]; // Optenemos el tipo de imagen que es
	if($tipo == "png" || $tipo == "pjpeg" || $tipo == "bmp"){ // Si el tipo de imagen a subir es el mismo de los permitidos, segimos. Puedes agregar mas tipos de imagen
	move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo);  // Subimos el archivo

	}
	else echo "el tipo de archivo no es de los permitidos";// Si no es el tipo permitido lo desimos
	}
	else echo "El archivo supera el peso permitido.";// Si supera el tamaño de permitido lo desimos
	}
//para subir la imagennnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn

$conexion = pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uiswheels password=P?'oG0s+");

$sql3="insert into lugar (id_lugar, direccion, especificacion) values ('$id_lugar1','$direccion1', '$especifiacion1')";

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
					Id Lugar:
				</td>
				<td>
					<?PHP echo "$id_lugar1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Direccion:
				</td>
				<td>
					<?PHP echo "$direccion1"; ?>
				</td>
			</tr>
			<tr>
				<td>
					Especificacion:
				</td>
				<td>
					<?PHP echo "$especifiacion1"; ?>
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
