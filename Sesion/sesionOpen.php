<?php
include("../Php/functions.php"); //check the user type
checkLogin();
$conn=conectarse();
//datos de usuario
$idu=$_SESSION['id_usuario'];
$name=$_SESSION['id_nombre_usuario'];
$last_name=$_SESSION['id_apellido_usuario'];
$phone=$_SESSION['user_phone'];
$sex=$_SESSION['user_sex'];
$email=$_SESSION['user_email'];
$is_driver=$_SESSION['is_driver'];
$id_university=$_SESSION['id_university'];
$is_verified=$_SESSION['is_verified'];
$university=$_SESSION['user_university'];
$rute_img=$_SESSION['profile_image'];
$university_acr=$_SESSION['user_university_acr'];

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Uniway</title>
    		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="../CSS/sesionOpen.css">
		<link rel="icon" type="image/png" href="../Imagenes/favicon.png" />
		<!--Fuente texto-->
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">

		<script src="../JS/jquery-3.1.1.min.js"></script>
		<script src="../JS/jquery-ui/jquery-ui.js"></script>
		<script src="../JS/main.js"></script>
		<script src="../JS/ways_query.js"></script>

		<link rel="stylesheet" type="text/css" href="../JS/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../JS/jquery-ui/jquery-ui.structure.css">
		<link rel="stylesheet" type="text/css" href="../JS/jquery-ui/jquery-ui.theme.css">

		<script src="../JS/lolliclock.js"></script>
		<link rel="stylesheet" type="text/css" href="../JS/lolliclock.css">



	</head>
	<body>
		<a name="inicio"></a>
		<!--Nav bar-->
		<nav class="navFeed" >
			<div class="left">
				<img src="../Imagenes/logo-name.png" alt="logo"/>
			</div>
			<div class="center">
				<a href="#inicio">
					<img src="../Imagenes/logo-only.png" alt="logo"/>
				</a>
			</div>
			<!--Menu responsive-->
			<ul>
				<li>
					<input type="checkbox" name="name" id="btn" onclick='menuDesplegable()' >
					<div class="label">
						<label for="btn"> <img src="../Imagenes/menu1.png" alt="menu-ham" height="50" width="50" /> </label>
					</div>
					<ul class="sinmenu" >
						<li>
							<a href="userProfile.php?idu=myProfile">
								<img 	src="<?php echo $rute_img;?>" alt="" />
							</a>
							<span> <?php echo $name; ?></span>
						</li>
						<li>
							<a href="userProfile.php?idu=myProfile">Configuracion</a>
						</li>
						<li>
							<a href="#">Mensajes</a>
						</li>
						<li>
							<a href="#">Contacto</a>
						</li>
						<li>
							<a href="#">Ayuda</a>
						</li>
						<li>
							<a href="../Php/logout.php">Cerrar sesión</a>
						</li>
					</ul>
				</li>
			</ul>
			<!--fin menu responsive-->
			<div class="right">
				<a href="userProfile.php?idu=myProfile">
				<img src="../Imagenes/config.png" alt="settings" />
				</a>
			</div>
		</nav>

		<!--options section (left)-->
		<section class="options">
			<img id="logo-nav" src="../Imagenes/logo-name-white.png" alt="logo"/>
			<a href="userProfile.php?idu=myProfile">
				<img src="<?php echo $rute_img;?>" alt="" />
			</a>
			<span class="nombre"><?php echo $full_name; ?></span>
			<a class="editar" href="userProfile.php?idu=myProfile" >Editar perfil</a>

			<div class="other-options">
				<ul class="lista">
					<a href="#"><li><span></span><img src="../Imagenes/puntuacion.png" class="icono" alt="iconos" />Puntuacion   4,5</li></a>
					<a href="#"><li><span></span><img src="../Imagenes/ruta.png" class="icono" alt="iconos" /> Rutas creadas     4</li></a>
					<a href="#"><li><span></span><img src="../Imagenes/mensaje.png" class="icono" alt="iconos" /> Mensajes   8</li></a>
					<a href="../Php/logout.php"><li><span></span><img src="../Imagenes/logout.png" class="icono" alt="iconos" /> Cerrar sesion</li></a>
				</ul>
			</div>
			<!--buscar otra manera para el hr-->
			<hr color="#161717" >
			<div class="other-options">
				<ul class="lista">
					<li><span></span>Conectar con facebook </li>
					<li><span></span>Recomendar a un amigo</li>
					<li><span></span>Estadisticas</li>
					<li><span></span>Contacto</li>
					<li><span></span>Ayuda</li>
				</ul>
			</div>
		</section>


		<!--recomended section (right)-->
		<section class="news">
			<span class="title" >Seccion de noticias</span>
			<img src="../Imagenes/news.png" width="100%" />
		</section>
		<!--ads section (right)-->
		<section class="ads">
			<span class="copy" >©2016 Uniway</span>
			<div class="links">
				<a href="#">Sobre nosotros</a>
				<a href="#">Ayuda</a>
				<a href="#">Condiciones</a>
				<a href="#">Privacidad</a>
				<a href="#">Marca</a>
				<a href="#">Blog</a>
				<a href="#">Desarrolladores</a>
				<a href="#">Multimedia</a>
				<a href="#">Anuncios</a>
				<a href="#">Empleos</a>
				<a href="#">Cookies</a>
			</div>
		</section>



		<!--feeeeeeeeeeeeeeeeeeeeeed section (center)-->
		<button id="btn-add" type="button" name="button">+</button>

		<section class="find">
			<button id="btn-find" type="button" name="button"> <img src="../Imagenes/search.png" alt="" /></button>
			<input id="search-input" class="search" type="text" name="name" placeholder="Busca una ruta!">
		</section>


		<div id="addRouteBox">
			<form  action="../Php/addWay.php" method="post" id="addRoute">
				<button type="button" id="closeAddRoute" > X </button>
				<p>
					Publica un recorrido.
				</p>
				<input type="hidden" name="id_user"  value="<?php echo $idu; ?>">
				<span id="commentTitle" >Selecciona una de tus rutas:</span>
<?php
//consulta las rutas del usuario y las muestra como opcion
$sql_routes="SELECT id_route FROM usr_routes WHERE id_user='$idu'";
$result_routes = pg_query($conn, $sql_routes);
$numFilas_routes = pg_num_rows($result_routes);
$contador=1;
if  ($numFilas_routes!=0)
{
	while($vector_routes=pg_fetch_array($result_routes))
	{
		$id_ruta= $vector_routes['id_route'];
		?>
			<div class="rutaXBox">
			<input type="radio" id="ruta<?php echo $contador; ?>" name="id_ruta" value="<?php echo $id_ruta; ?>" required>
			<label for="ruta<?php echo $contador; ?>"></label>
			<select name="ruta<?php echo $contador; ?>" id="opt-routes" class="opt-routes" >
			<option value="" selected >Ruta <?php echo $contador; ?></option>
		<?php
		//se imprimen las paradas
		$sql_stops="SELECT id_stop FROM route_stop WHERE id_route='$id_ruta'";
		$result_stops = pg_query($conn, $sql_stops);
		while($vector_stops=pg_fetch_array($result_stops))
		{
			$id_parada=$vector_stops['id_stop'];
			//selecciono el nombre de cada parada
			$sql_allstops="SELECT name FROM stops WHERE id_stop='$id_parada'";
			$result_allstops = pg_query($conn, $sql_allstops);
			while($vector_allstops=pg_fetch_array($result_allstops))
			{
				$nameStop=$vector_allstops['name'];
				?><option value="<?php echo $nameStop; ?>" disabled ><?php echo $nameStop; ?></option><?php
			}
		}
		?>
		</select>
		</div>
		<?php
		$contador=$contador + 1;
	}
}else{
	echo "No hay rutas disponibles";
}
?>
				<span id="commentTitle" >Selecciona los cupos disponibles:</span>
				<select name="spots" >
					<option value="1">1 cupo</option>
					<option value="2">2 cupos</option>
					<option value="3">3 cupos</option>
					<option value="4" selected >4 cupos</option>
				</select>
				<span id="commentTitle" >Selecciona una hora:</span>
				<input id="timepicker" type="text" name="timepicker" required>

				<div class="finish_start">
					<span>El recorrido comienza o termina en la universidad</span>
						<input type="radio" id="start" name="touniversity" value="false" required>
							<label id="start_l" for="start"></label>
						<input type="radio" id="finish" name="touniversity" value="true" required>
							<label id="finish_l" for="finish"></label>
				</div>
				<span id="commentTitle" >Informacion adicional:</span>
				<textarea name="comment" rows="3" cols="31"></textarea>

				<button type="submit" >Crear</button>
			</form>
		</div>
		<div id="ways_query_results" style="text-align:center">

		</div>
		<section id="pub-box">
<?php
//Hace la consulta de todos los recorridos disponibles
$sql_ways="SELECT * FROM ways ";
$result_ways= pg_query($conn, $sql_ways);
$numFilas_ways = pg_num_rows($result_ways);
$cont_ways=1;
if  ($numFilas_ways!=0)
	 {
		while($vector_ways=pg_fetch_array($result_ways))
		{
			//datos de cada recorrido
			$id_way=$vector_ways['id_way'];
			$hour=$vector_ways['hour'];
			$id_user_w=$vector_ways['id_user'];
			$id_route=$vector_ways['id_route'];
			$spots=$vector_ways['spots'];
			$touniversity=$vector_ways['touniversity'];
			//datos del usuario que publica
			$sql1_name="SELECT names, last_names, profile_image FROM users WHERE id_user='$id_user_w'";
			$result1_name = pg_query($conn, $sql1_name);
			$vector_name=pg_fetch_array($result1_name);
			$first_names=$vector_name['names'];
			$last_names=$vector_name['last_names'];
			$profile_image_user=$vector_name['profile_image'];
			$full_name_user=$first_names." ".$last_names;
			//datos del recorrido publicado
			$sql1_goto="SELECT touniversity, hour, comment FROM ways WHERE id_way='$id_way'";
			$result1_goto = pg_query($conn, $sql1_goto);
			$vector_goto=pg_fetch_array($result1_goto);
			$gotouniversity=$vector_goto['touniversity'];
			$hour=$vector_goto['hour'];
			$comentario=$vector_goto['comment'];
?>

				<div class="publicaciones" onclick='cerrarMenu();'>
					<img class="open-modal"  src="<?php echo $profile_image_user; ?>" alt="<?php echo $id_user_w; ?>" />
					<span class="cupo">
						<?php echo $spots; ?> cupos.
					</span>
					<a href="#">
						<span class="name">
							<?php echo $full_name_user;?>
						</span>
					</a>
					<span class="time">
						<?php
						if ($gotouniversity=="false") {
							echo "Saliendo de la universidad a las ",$hour;
						}else{
							echo "En la universidad a las ",$hour;
						}
						?>
					</span>
					<span class="ruta" >
						- Cañaveral / UIS
					</span>
					<span class="comentario">
						<?php echo $comentario;?>
					</span>
					<div class="botones">
						<button id="btn-pedirCupo" type="button" name="button">Pedir cupo</button>
						<button id="btn-verRuta" type="button" name="button">Ver ruta</button>
					</div>
				</div>
				<?php
			}}//cierra las llaves del while e if
			?>
		</section>

	<div id="modal-box" class="modal-box">
		<section   id="modal-window" class="modal-window">
			<div class="encb">
				<img id="user_img_query" src="../Imagenes/perfil.png"  alt="user imageeeee"/>
				<div class="block">
					<label for="user_name_query">Nombre</label>
					<span id="user_name_query">Nombre usuario</span>
				</div>
				<div class="block">
					<label for="user_university_query">Universidad</label>
					<span id="user_university_query" >Universidad UIS</span>
				</div>
				<div class="block">
					<label for="user_score">Calificacion</label>
					<span id="user_score">4.5</span>
				</div>
				<div class="block">
					<label for="user_email_query">Correo</label>
					<span id="user_email_query">correo@ejemplo.com</span>
				</div>
				<div class="block">
					<label for="user_phone_query">telefono</label>
					<span id="user_phone_query">3183524157</span>
				</div>

			</div>
			<div class="info-usr">
				<ul>
					<li><span class="li_underline"></span>Vehículo</li>
					<li>Rutas</li>
					<li>Comentarios</li>
				</ul>
				<div class="transport-info">

				</div>
				<div class="routes-info">

				</div>
				<div class="comments-info">

				</div>
			</div>
		</section>
	</div>
	</body>
</html>
