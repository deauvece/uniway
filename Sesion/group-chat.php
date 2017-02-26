<?php
include("../Php/functions.php"); //check the user type
checkLogin();
$conn=conectarse();

//si no viene con la variable de id_way lo redirecciona
$id_way_thisGroup=$_GET["id_way"];
if ($id_way_thisGroup){
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
			header("location:sesionOpen.php");
		}
	}

}else{
	header("location:sesionOpen.php");
}



?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mensajes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="icon" type="image/png" href="../Imagenes/favicon.png" />
		<link rel="stylesheet" type="text/css" href="../CSS/sesionOpen.css">
		<!--Fuente texto-->
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
		<script src="../JS/jquery-3.1.1.min.js"></script>
		<script src="../JS/jquery-ui/jquery-ui.js"></script>
		<script src="../JS/group-chat.js"></script>
		<link rel="stylesheet" type="text/css" href="../JS/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../JS/jquery-ui/jquery-ui.structure.css">
		<link rel="stylesheet" type="text/css" href="../JS/jquery-ui/jquery-ui.theme.css">
	</head>
	<body >
		<a href="sesionOpen.php"><img id="logo-chat" src="../Imagenes/logo-name-white.png" /></a>
		<nav class="nav-chat" >
			<ul>
				<a href="userProfile.php?idu=myProfile"><li><img src="<?php echo $rute_img ?>"/><span><?php echo $name; ?></span></li></a>
				<a href="sesionOpen.php"><li>Inicio</li></a>
			</ul>
		</nav>
		<div class="container-chat">
			<section class="people" >
				<span class="title-usr">Participantes</span>
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
					<div class="comment-left">
						<div class="box">
							<span class="name-coment">Sergio Leo Alvarez </span>
							<span class="content-coment" >Hola muchachos como están?</span>
						</div>
					</div>
					<div class="comment-left">
						<div class="box">
							<span class="name-coment">Sergio Leo Alvarez </span>
							<span class="content-coment" >Cambio de lugar, los espero en el parqueadero frente a industrial</span>
						</div>
					</div>
					<div class="comment-right">
						<div class="box">
							<span class="name-coment">Yo</span>
							<span class="content-coment" >Breve menores</span>
						</div>
					</div>
					<div class="comment-left">
						<div class="box">
							<span class="name-coment">Raúl Calderón</span>
							<span class="content-coment" >Ole creo que ya no puedo ir, srry baai</span>
						</div>
					</div>
					<div class="comment-center">
						Raul Caldeŕon ha salido del grupo
					</div>
					<div class="comment-left">
						<div class="box">
							<span class="name-coment">Sergio Leo Alvarez </span>
							<span class="content-coment" >Hola muchachos como están?</span>
						</div>
					</div>
					<div class="comment-left">
						<div class="box">
							<span class="name-coment">Sergio Leo Alvarez </span>
							<span class="content-coment" >Cambio de lugar, los espero en el parqueadero frente a industrial</span>
						</div>
					</div>
					<div class="comment-right">
						<div class="box">
							<span class="name-coment">Yo</span>
							<span class="content-coment" >Breve menores</span>
						</div>
					</div>
					<div class="comment-left">
						<div class="box">
							<span class="name-coment">Raúl Calderón</span>
							<span class="content-coment" >Ole creo que ya no puedo ir, srry baai</span>
						</div>
					</div>
					<div class="comment-center">
						Raul Caldeŕon ha salido del grupo
					</div>
				</div>
				<div class="input-cht">
					<textarea name="name"  placeholder="Escribe un mensaje..." ></textarea>
				</div>

			</section>
		</div>
		<div class="modal-box" id="modal-box">
			<div class="msg-out">
				<span>¿Estás seguro que deseas salir del grupo?</span>
				<form action="../Php/delete-user-way.php" method="post">
					<input type="hidden" name="id_way" value="<?php echo $id_way_thisGroup ?>">
					<input type="hidden" name="id_user" value="<?php echo $idu ?>">
					<button class="yes-confirm" type="submit">Si</button>
				</form>
				<button class="no-confirm" type="button">Cancelar</button>
			</div>
			<div class="delete-way">
				<span>
					¿Estás seguro que deseas eliminar el grupo? Ten encuenta
					que se eliminaran todos los datos relacionados a este.
				</span>
				<form action="../Php/deleteWay.php" method="post">
					<input type="hidden" name="id_way" value="<?php echo $id_way_thisGroup ?>">
					<button class="yes-confirm" type="submit">Si</button>
				</form>
				<button class="no-confirm" type="button">Cancelar</button>
			</div>
		</div>

	</body>
</html>
