<?php
include("../../Php/functions.php");
$conn=conectarse();
extract($_POST);
//ide del usuario para el nombre de la imagen a subir
session_start();
$idu=$_SESSION['id_usuario'];

//update the transport image
$file=$_FILES["file2"];
if (!$file) {
	echo "No hay archivo";
}else{
	$cad = "profile_".$idu;
	$tamano = $_FILES[ 'file2' ][ 'size' ]; // Leemos el tamaño del fichero en bytes
	$tamaño_max="2000000"; // Tamaño maximo permitido son 2 megabytes
	if ($tamano!=0) {
		if( $tamano < $tamaño_max){ // Comprovamos el tamaño
			$destino = 'upload' ; // Carpeta donde se guardara
			$sep=explode('image/',$_FILES['file2']['type']); // Separamos image/
			$tipo=$sep[1]; // Optenemos el tipo de imagen que es
			if(($_FILES['file2']['type'] == "image/jpeg") || ($_FILES['file2']['type'] == "image/png")|| ($_FILES['file2']['type'] == "image/jpg")){ // Si el tipo de imagen a subir es el mismo de los permitidos
				$ruta="../Imagenes/profileImages/upload/profile_".$idu.".".$tipo;
				$sql1_update= "UPDATE users SET profile_image='$ruta' WHERE id_user='".$idu."' ";
				$result_img = pg_query($conn,$sql1_update);
				move_uploaded_file ( $_FILES [ 'file2' ][ 'tmp_name' ], "$destino/$cad.$tipo");  // Subimos el archivo
				header("location:../../Sesion/userProfile.php?idu=myProfile");
			}else {
				echo "el tipo de archivo no es de los permitidos";/* Si no es el tipo permitido lo decimos*/
			}
		}else {
			echo "El archivo supera el peso permitido.";/* Si supera el tamaño de permitido lo decimos*/
		}
	}
	header("location:../../Sesion/userProfile.php?idu=myProfile");
}

?>
