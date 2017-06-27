<?php

	//Consulta si hay cambios en los comentarios de una conversación (CHAT)

	session_start();
	//datos de usuario
	$idu=$_SESSION['id_usuario'];

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

	$array = array();

	if ($num_commentBD == $num_comment) {
		$status="same";
	}else {
		//trae todos los comentarios
		$sql22="SELECT * FROM comments WHERE id_way='$id_way' ORDER BY id_comm";
		$result22=pg_query($conn, $sql22);
		$text="";

		while ($vector22=pg_fetch_array($result22)) {
			$comment_id=$vector22['id_comm'];
			$comment_split=explode("M",$comment_id);
			$num_commentBD=$comment_split[1];
			//si es un comentario más reciente del que hay en el chat
			if ($num_commentBD > $num_comment) {
				$id_user_comment=$vector22['id_user'];
				$name_user_comment=$vector22['name_user'];
				$user_comment=$vector22['body'];

				$time_comment=$vector22['creation_date'];
				$time_split=explode(" ",$time_comment);
				$time_split2=explode(":",$time_split[1]);
				$hour_comment=$time_split2[0].":".$time_split2[1];

				$side_comment="";
				if ($id_user_comment==$idu) {$side_comment="class='comment-right'";}else{$side_comment="class='comment-left'";}
				$text=$text."<div ".$side_comment." data-id='".$comment_split[1]."' ><div class='box'  ><span class='name-coment'>".$name_user_comment."</span><span class='content-coment' >".$user_comment."<span class='time-coment' >".$hour_comment."</span></span></div></div>";
				}
			}

	}

	$array = array(
		'state' => "$status",
		'cms' => $text
	);
	echo json_encode($array);

?>
