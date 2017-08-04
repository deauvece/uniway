<?php
// Activar errores
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
include("../../php/functions.php");
$conn=conectarse();
extract($_POST);
//ide del usuario para el nombre de la imagen a subir
session_start();
$idu=$_SESSION['id_usuario'];

$size= $_FILES[ 'file2' ][ 'size' ];
if ( $size == 0) {
	echo "No hay archivo";
}else{
	$cad = "profile_".$idu;
	$tamano = $_FILES[ 'file2' ][ 'size' ]; // Leemos el tamaño del fichero en bytes
	$tamaño_max="2000000"; // Tamaño maximo permitido son 2 megabytes
	if( $tamano < $tamaño_max){ // Comprobamos el tamaño
		$destino = 'temp' ; // Carpeta donde se guardara
		$sep=explode('image/',$_FILES['file2']['type']); // Separamos image/
		$tipo=$sep[1]; // Optenemos el tipo de imagen que es
		if(($_FILES['file2']['type'] == "image/jpeg") || ($_FILES['file2']['type'] == "image/png")|| ($_FILES['file2']['type'] == "image/jpg")){ // Si el tipo de imagen a subir es el mismo de los permitidos
			$ruta="../Imagenes/profileImages/temp/profile_".$idu.".".$tipo;
			move_uploaded_file ( $_FILES [ 'file2' ][ 'tmp_name' ], "$destino/$cad.$tipo");  // Subimos el archivo a la carpeta temporal
		}else {
			echo "el tipo de archivo no es de los permitidos";/* Si no es del tipo permitido*/
		}
	}else {
		echo "El archivo supera el peso permitido.";/* Si supera el tamaño de permitido*/
	}
}


//se modifica el tamaño de la imagen de perfil
$max_dimention=400;
$new_ruta="../profileImages/upload/profile_".$idu.".".$tipo;
$ruta="../profileImages/temp/profile_".$idu.".".$tipo;
$res=smart_resize_image($ruta , null, $max_dimention , $max_dimention , false , $new_ruta , false , false ,100 );
//actualiza datos en el usuario
$new_ruta="../Imagenes/profileImages/upload/profile_".$idu.".".$tipo;
$sql1_update= "UPDATE users SET profile_image='$new_ruta' WHERE id_user='".$idu."' ";
$result_img = pg_query($conn,$sql1_update);
//redirecciona
header("location:../../sesion/userProfile.php?idu=myProfile");

?>
