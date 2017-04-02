<?php
function checkLogin() {
	session_start();
	if ($_SESSION['activo'] == false) {
	  header("location:../login-user.php?errorSesion=si");
	}else {
	  $name = $_SESSION['id_nombre_usuario'] ;
	  $last_name = $_SESSION['id_apellido_usuario'] ;
	  $full_name= $name ." ". $last_name;
	}
	/*if ($_SESSION['admin']=='f') {
	  header("location:maintenance.php");
	  exit();
  }*/
}
function conectarse()
{
   if (!($conn=pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uniway password=P?'oG0s+")))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }

  if (!pg_dbname())
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
  return $conn;
}
?>
