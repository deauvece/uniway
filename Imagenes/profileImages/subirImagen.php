<?php
include("../../Php/conec.php");
$conn=conectarse();
extract($_POST);
//ide del usuario para el nombre de la imagen a subir
session_start();
$idu=$_SESSION['id_usuario'];
$cad = "profile_".$idu;

$tamano = $_FILES[ 'file' ][ 'size' ]; // Leemos el tamaño del fichero
$tamaño_max="50000000000"; // Tamaño maximo permitido
if( $tamano < $tamaño_max){ // Comprovamos el tamaño
      $destino = 'upload' ; // Carpeta donde se guardara
      $sep=explode('image/',$_FILES["file"]["type"]); // Separamos image/
      $tipo=$sep[1]; // Optenemos el tipo de imagen que es
      if(($_FILES['file']['type'] == "image/jpeg") || ($_FILES['file']['type'] == "image/png")){ // Si el tipo de imagen a subir es el mismo de los permitidos


          $ruta="../Imagenes/profileImages/upload/profile_".$idu.".".$tipo;
          $sql1_update= "UPDATE users SET profile_image='$ruta' WHERE id_user='".$idu."' ";
          $result_img = pg_query($conn,$sql1_update);
          move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' .$cad.'.'.$tipo);  // Subimos el archivo

          header("location:../../Sesion/userProfile.php?idu=myProfile");
      }else {
        echo "el tipo de archivo no es de los permitidos";/* Si no es el tipo permitido lo decimos*/
      }
}else {
    echo "El archivo supera el peso permitido.";/* Si supera el tamaño de permitido lo decimos*/
  }

?>
