<?PHP
// llamar la funciones
include("functions.php");
$conn=conectarse();
extract($_POST);

$sql2="UPDATE transports SET model='$model',price='$price',type='$type',air_conditioner='$air_conditioner',wifi='$wifi' WHERE id_user='$id_user'  ";
$result2 = pg_query($conn, $sql2);


$file=$_FILES["file"];
if (!$file) {
	$ruta="../Imagenes/transportImages/default.png";
	$sql1_update= "UPDATE transports SET image='$ruta' WHERE license_plate='".$license_plate."' ";
	$result_img = pg_query($conn,$sql1_update);
}else{
	$idu=$id_user;
	$cad = "transport_image_".$idu;
	$tamano = $_FILES[ 'file' ][ 'size' ]; // Leemos el tamaño del fichero en bytes
	$tamaño_max="2000000"; // Tamaño maximo permitido son 2 megabytes
	if( $tamano < $tamaño_max){ // Comprovamos el tamaño
		 $destino = '../Imagenes/transportImages' ; // Carpeta donde se guardara
		 $sep=explode('image/',$_FILES['file']['type']); // Separamos image/
		 $tipo=$sep[1]; // Optenemos el tipo de imagen que es
		 if(($_FILES['file']['type'] == "image/jpeg") || ($_FILES['file']['type'] == "image/png")|| ($_FILES['file']['type'] == "image/jpg")){ // Si el tipo de imagen a subir es el mismo de los permitidos

			$ruta="../Imagenes/transportImages/transport_image_".$idu.".".$tipo;
			$sql1_update= "UPDATE transports SET image='$ruta' WHERE id_user='".$id_user."' ";
			$result_img = pg_query($conn,$sql1_update);
			move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], "$destino/$cad.$tipo");  // Subimos el archivo
			header("location:../Sesion/userProfile.php?idu=myProfile");
		 }else {
		   echo "el tipo de archivo no es de los permitidos";/* Si no es el tipo permitido lo decimos*/
		 }
	}else {
	    echo "El archivo supera el peso permitido.";/* Si supera el tamaño de permitido lo decimos*/
	  }
}

?>