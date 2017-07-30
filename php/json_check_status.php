<?php

	//Consulta actualizaciones en las publicaciones de la universidad del usuario


	error_reporting(0);
	include("../php/functions.php");
	$conn=conectarse();
	$rdn_string_0=$_GET['rdn_string'];
	$id_uni=$_GET['id_uni'];

	$sql="SELECT random_string FROM universities WHERE id_u='$id_uni'";
	$result = pg_query($conn, $sql);
	$vector=pg_fetch_array($result);
	$rdn_database=$vector['random_string'];
	$update="";
	if ($rdn_string_0 != $rdn_database) {
		//hubo alguna publicacion de algun recorrido
		$array = array( 'update' => "true" 	);
		echo json_encode($array);
	}else {
		//no hay nuevas publicaciones
		$array = array( 'update' => "false" 	);
		echo json_encode($array);
	}

?>
