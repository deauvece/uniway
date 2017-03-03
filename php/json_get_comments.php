<?php
	error_reporting(0);
	include("../php/functions.php");
	$conn=conectarse();
	session_start();
	//datos de usuario
	$idu=$_SESSION['id_usuario'];
	$name=$_SESSION['id_nombre_usuario'];

	$id_way=$_GET['id_way'];
	$num_comment=$_GET['last_comment_id'];

	$sql22="SELECT * FROM comments WHERE id_way='$id_way'";
	$result22=pg_query($conn, $sql22);
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
			?>
			<div <?php if ($id_user_comment==$idu) {echo "class='comment-right'";}else{echo "class='comment-left'";} ?> data-id="<?php echo $comment_split[1] ?>" >
				<div class="box"  >
					<span class="name-coment"><?php echo $name_user_comment ?></span>
					<span class="content-coment" ><?php echo $user_comment ?><span class="time-coment" ><?php echo $hour_comment ?></span></span>
				</div>
			</div>
			<?php
			}
		}
		?>
