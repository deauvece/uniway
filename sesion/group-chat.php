<?php
include("../php/functions.php"); //check the user type
checkLogin();
$conn=conectarse();

//si no viene con la variable de id_way lo redirecciona
$id_way_thisGroup=$_GET["id_way"];
if ($id_way_thisGroup){
//	session_start();
	//datos de usuario
	$idu=$_SESSION['id_usuario'];
	$name=$_SESSION['id_nombre_usuario'];
	$last_name=$_SESSION['id_apellido_usuario'];
	$full_name=$name." ".$last_name;
	$rute_img=$_SESSION['profile_image'];

	//check si es el recorrido del usuario
	$sql2="SELECT * FROM ways WHERE id_way='$id_way_thisGroup'  ";
	$result2=pg_query($conn, $sql2);
	$vector2=pg_fetch_array($result2);
	$id_way_owner=$vector2['id_user'];
	if ($id_way_owner!=$idu) {
		//check si pertenece al grupo
		$sql="SELECT * FROM usr_ways WHERE id_way='$id_way_thisGroup' AND id_user='$idu'  ";
		$result=pg_query($conn, $sql);
		$vector=pg_fetch_array($result);
		$size=pg_num_rows($result);
		if ($size==0) {
			header("location:home.php");
		}
	}

}else{
	header("location:home.php");
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mensajes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="icon" type="image/png" href="../Imagenes/favicon.png" />
		<link rel="stylesheet" type="text/css" href="../css/sesion.css">
		<!--Fuente texto-->
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
		<script src="../js/jquery-3.1.1.min.js"></script>
		<script src="../js/jquery-ui/jquery-ui.js"></script>
		<script src="../js/group_chat.js"></script>
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.structure.css">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.theme.css">
	</head>
	<body >
		<a href="home.php"><img id="back-chat" src="../Imagenes/leftw.png" /></a>
		<a href="home.php"><img id="logo-chat" src="../Imagenes/logo-name-white.png" /></a>
		<img id="info-button" src="../Imagenes/info.png"/>
		<nav class="nav-chat" >
			<ul>
				<a href="user_profile.php"><li><img src="<?php echo $rute_img ?>"/><span><?php echo $name; ?></span></li></a>
				<a href="home.php"><li>Inicio</li></a>
			</ul>
		</nav>
		<div class="container-chat">
			<section class="people" >
				<span class="title-usr">Miembros</span>
				<?php
					$sql10="SELECT * FROM usr_ways WHERE id_way='$id_way_thisGroup'";
					$result10=pg_query($conn, $sql10);
					while ($vector10=pg_fetch_array($result10)) {
						$user_query=$vector10['id_user'];
						$sql11="SELECT * FROM users WHERE id_user='$user_query'";
						$result11=pg_query($conn, $sql11);
						while ($vector11=pg_fetch_array($result11)) {
							$name_user=$vector11['names'];
							$last_name_user=$vector11['last_names'];
							$full_name_user=$name_user." ".$last_name_user;
							$profile_image_user=$vector11['profile_image'];
							if ($id_way_owner==$user_query) {
								echo "<span class='cond-group'>Cond</span>";
							}
							echo "<div class='usr-box'>";
							/*if ($id_way_owner==$idu && $id_way_owner!=$user_query) {
								echo "<img class='kick-usr' src='../Imagenes/kick-usr.png'/>";
							}*/
							echo "<img src='$profile_image_user'/>";
							echo "<span data-iduser='$user_query'>$full_name_user</span>";
							echo "</div>";
							if ($id_way_owner==$idu  && $idu!=$user_query) {
								echo "<span class='delete-usr-cht'>Eliminar del grupo</span>";
							}else {
								if ($user_query==$idu) {
									echo "<span class='out-usr-cht'>Salir del grupo</span>";
								}
							}
						}
					}
					if ($id_way_owner==$idu) {
						echo "<span id='delete-group' class='delete-group-usr-cht'>Eliminar grupo y recorrido</span>";
					}else {
						echo "<span id='out-group' class='delete-group-usr-cht'>Salir del grupo</span>";
					}
				?>
			</section>
			<section class="cht-box" >
				<div class="content-cht">
					<?php
						$sql22="SELECT * FROM comments WHERE id_way='$id_way_thisGroup' ORDER BY id_comm ";
						$result22=pg_query($conn, $sql22);
						while ($vector22=pg_fetch_array($result22)) {
							$id_user_comment=$vector22['id_user'];
							$name_user_comment=$vector22['name_user'];
							$user_comment=$vector22['body'];
							$comment_id=$vector22['id_comm'];
							$comment_split=explode("M",$comment_id);

							$time_comment=$vector22['creation_date'];
							$time_split=explode(" ",$time_comment);
							$time_split2=explode(":",$time_split[1]);
							$hour_comment=$time_split2[0].":".$time_split2[1];
					?>
					<div <?php if ($id_user_comment==$idu) {echo "class='comment-right'";}else{echo "class='comment-left'";} ?> data-id="<?php echo $comment_split[1] ?>" >
						<div class="box"  >
							<span class="name-coment"><?php if ($id_user_comment==$idu) {echo "Yo";}else{echo $name_user_comment ;} ?></span>
							<span class="content-coment" ><?php echo $user_comment ?><span class="time-coment" ><?php echo $hour_comment ?></span></span>
						</div>
					</div>
					<?php } 	?>
				</div>
				<div class="input-cht">
					<img id="send-button" src="../Imagenes/send.png"/>
					<textarea id="textarea-inpt" autofocus data-name-user="<?php echo $name ?>" data-way="<?php echo $id_way_thisGroup ?>" data-idu="<?php echo $idu ?>" placeholder="Escribe un mensaje..." ></textarea>
				</div>

			</section>
		</div>
		<div class="modal-box" id="modal-box">
			<div class="msg-out">
				<p>Confirmación</p>
				<span>¿Estás seguro que deseas salir del grupo?</span>
				<form action="../php/delete-user-way.php" method="post">
					<input type="hidden" name="id_way" value="<?php echo $id_way_thisGroup ?>">
					<input type="hidden" name="id_user" value="<?php echo $idu ?>">
					<button class="yes-confirm" type="submit">Si, salir</button>
				</form>
				<button class="no-confirm" type="button">Cancelar</button>
			</div>
			<div class="delete-way">
				<p>Confirmación</p>
				<span>
					¿Estás seguro que deseas eliminar el grupo? Ten encuenta
					que se eliminaran todos los datos relacionados a este.
				</span>
				<form action="../php/deleteWay.php" method="post">
					<input type="hidden" name="id_way" value="<?php echo $id_way_thisGroup ?>">
					<button class="yes-confirm" type="submit">Si, eliminar</button>
				</form>
				<button class="no-confirm" type="button">Cancelar</button>
			</div>
		</div>

	</body>
</html>
