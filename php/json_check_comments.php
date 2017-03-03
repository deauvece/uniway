<?php
	error_reporting(0);
	include("../php/functions.php");
	$conn=conectarse();

	$id_way=$_GET['id_way'];
	$num_comment=$_GET['last_comment_id'];
	//$id_comment="COM".$num_comment;

	$sql="SELECT * FROM comments WHERE id_way='$id_way' ORDER BY id_comm DESC LIMIT 1  ";
	$result = pg_query($conn, $sql);
	$vector=pg_fetch_array($result);
	//se obtiene el id del ultimo comentario del recorrido y se hace un split para obtener el num del id
	$last_comment_BD=$vector['id_comm'];
	$last_split=explode("M",$last_comment_BD);
	$num_commentBD=$last_split[1];
	$status="";
	//si el comentario de la bd es mas reciente (mayor) se actualizan los comentarios
	if ($num_commentBD == $num_comment) {
		$status="iguales";
	}else {
		$status="no_iguales";
	}

	$array = array( 'state' => "$status" 	);
	echo json_encode($array);

?>
