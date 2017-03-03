<?php
include("../php/functions.php"); //check the user type
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
$id_university=$_SESSION['user_id_university'];

$sql00="SELECT * FROM users WHERE id_user='$idu'";
$result00=pg_query($conn, $sql00);
$vector00=pg_fetch_array($result00);
$status_usr=$vector00['status_way'];
if ($status_usr=="true") {
	//true=>activo
	//Busca el recorrido que pidio
	$sql10="SELECT id_way FROM usr_ways WHERE id_user='$idu'";
	$result10=pg_query($conn, $sql10);
	$vector10=pg_fetch_array($result10);
	$way_usr_active=$vector10['id_way'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Uniway</title>
    		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="../css/sesionOpen.css">
		<link rel="icon" type="image/png" href="../Imagenes/favicon.png" />
		<!--Fuente texto-->
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
		<!--jquery-->
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.structure.css">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.theme.css">
		<!--timepicker-->
		<link rel="stylesheet" type="text/css" href="../js/lolliclock.css">



	</head>
	<body>
		<nav id="nav_feed">
			<ul>
				<li><a href="sesionOpen.php"><img src="../Imagenes/logo-name-white.png" alt="logo"/></a></li>
				<img id="bmenuw" src="../Imagenes/bmenuw.png" width="30px" />
			</ul>
		</nav>

		<!--options section (left)-->
		<section class="options">
			<a href="sesionOpen.php"><img id="logo-nav" src="../Imagenes/logo-name-white.png" alt="logo"/></a>
			<a href="userProfile.php?idu=myProfile">
				<img src="<?php echo $rute_img;?>" alt="" />
			</a>
			<br>
			<a class="editar" href="userProfile.php?idu=myProfile" >Editar perfil</a>

			<div class="other-options">
				<ul class="lista">
					<a href="#"><li><span></span><img src="../Imagenes/puntuacion.png" class="icono" alt="iconos" />Puntuacion   4,5</li></a>
					<a href="#"  <?php if ($is_driver=='f') { echo "style='display:none'";} ?> ><li><span></span><img src="../Imagenes/ruta.png" class="icono" alt="iconos" /> Rutas creadas     4</li></a>
					<a href="#"><li><span></span><img src="../Imagenes/mensaje.png" class="icono" alt="iconos" /> Mensajes   8</li></a>
					<a href="../php/logout.php"><li><span></span><img src="../Imagenes/logout.png" class="icono" alt="iconos" /> Cerrar sesion</li></a>
				</ul>
			</div>
			<!--buscar otra manera para el hr-->
			<hr color="#161717" >
			<div class="other-options">
				<ul class="lista">
					<li><span></span>Agregar paradas</li>
					<li><span></span>Buscar usuario</li>
					<!--<li><span></span>Estadisticas</li>-->
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
		<button id="btn-add" <?php if ($is_driver=='f' || $status_usr=="true") { echo "style='display:none'";} ?> type="button" name="button">+</button>

		<section class="find">
			<input id="search-input" class="search" type="text" name="name" placeholder="Busca una ruta!" autocomplete="off" autofocus>
			<img src="../Imagenes/search.png" alt="" />
		</section>


		<div id="addRouteBox" <?php if ($is_driver=='f') { echo "style='display:none'";} ?>>
			<form  action="../php/addWay.php" method="post" id="addRoute">
				<button type="button" id="closeAddRoute" > X </button>
				<p>
					Publica un recorrido.
				</p>
				<input id="id_user_json" type="hidden" name="id_user"  value="<?php echo $idu; ?>">
				<input type="hidden" name="id_u"  value="<?php echo $id_university; ?>">
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
		<a id='new-updates'><span>Ver nuevas publicaciones</span></a>
		<section id="pub-box">
		<span class="no-results">No hay resultados</span>
<?php

//consulta los datos de los ultimos 30 recorridos de la universidad guardados en waysArray
$sql_ways="SELECT * FROM ways WHERE id_u='$id_university' ORDER BY id_way DESC LIMIT 30";
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

				<div class="publicaciones" class="p-before">
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
					<span class="comentario">
						<?php echo $comentario;?>
					</span>
					<div class="botones">
						<?php
						 	if ($id_user_w==$idu) {
								echo "<a href='group-chat.php?id_way=$id_way'><button class='btn-eliminar' type='button'>Ver</button></a>";
						 	}else{
								if ($status_usr=="true" && $id_way==$way_usr_active) {
									echo "<a href='group-chat.php?id_way=$id_way'><button class='btn-eliminar' type='button'>Ver</button></a>";
								}else{
									echo "<button id='btn-pedirCupo' data-way='$id_way' data-usr='$idu' class='btn-pedirCupo' type='button'>Pedir cupo</button>";
								}
							}
						 ?>
					</div>
					<div class="rt-title">
						Paradas
					</div>
				</div>
				<!--<span class='ruta' style='display:none' >-->
				<span class='ruta' >
				<?php
					//busqueda de las paradas
					$sql="SELECT id_stop FROM route_stop WHERE id_route='$id_route'";
					$result= pg_query($conn, $sql);
					while ($vect=pg_fetch_array($result)) {
						$id_stop=$vect['id_stop'];
						$sql0="SELECT name FROM stops WHERE id_stop='$id_stop'";
						$result0= pg_query($conn, $sql0);
						while ($vect0=pg_fetch_array($result0)) {
							$nameStop=$vect0['name'];
							echo "<span>";
							echo "$nameStop";
							echo "</span>";
							echo " &nbsp; &nbsp;";
						}
					}
				 ?>
				 </span>
			<?php
		}}//cierra las llaves del while e if
		?>
		</section>
		<?php
			$sql_random="SELECT random_string FROM status_feed WHERE id_status='$id_university' ";
			$result_random= pg_query($conn, $sql_random);
			$vector_random=pg_fetch_array($result_random);
			$rdnString=$vector_random['random_string'];
		?>
		<input id='status_feed' type='button' hidden class='<?php echo "$id_university"; ?>' value='<?php echo "$rdnString"; ?>'>
	<div id="modal-box" class="modal-box">
		<section   id="modal-window" class="modal-window">
			<div class="encb">
				<img id="user_img_query" class="user_img_query" src="../Imagenes/perfil.png"  alt="user imageeeee"/>
				<div class="block">
					<label for="user_name_query">Nombre</label>
					<span id="user_name_query" class="user_name_query">Nombre usuario</span>
				</div>
				<div class="block">
					<label for="user_university_query">Universidad</label>
					<span id="user_university_query" class="user_university_query" >Universidad UIS</span>
				</div>
				<div class="block">
					<label for="user_score">Calificacion</label>
					<span id="user_score" class="user_score">4.5</span>
				</div>
				<div class="block">
					<label for="user_email_query">Correo</label>
					<span id="user_email_query" class="user_email_query">correo@ejemplo.com</span>
				</div>
				<div class="block">
					<label for="user_phone_query">telefono</label>
					<span id="user_phone_query" class="user_phone_query">3183524157</span>
				</div>
			</div>
			<div class="info-usr">
				<ul>
					<li id="data_option" class="info_options" value="data_info" >Datos</li>
					<li class="info_options" value="transport_info" ><span class='li_underline'></span>Vehículo</li>
					<li class="info_options" value="routes_info" >Rutas</li>
					<li class="info_options" value="comments_info" >Comentarios</li>
				</ul>
				<div class="data_info">
					<div class="encb2">
						<div class="block">
							<label for="user_name_query">Nombre</label>
							<span id="user_name_query" class="user_name_query">Nombre usuario</span>
						</div>
						<div class="block">
							<label for="user_university_query">Universidad</label>
							<span id="user_university_query" class="user_university_query" >Universidad UIS</span>
						</div>
						<div class="block">
							<label for="user_score">Calificacion</label>
							<span id="user_score" class="user_score">4.5</span>
						</div>
						<div class="block">
							<label for="user_email_query">Correo</label>
							<span id="user_email_query" class="user_email_query">correo@ejemplo.com</span>
						</div>
						<div class="block">
							<label for="user_phone_query">telefono</label>
							<span id="user_phone_query" class="user_phone_query">3183524157</span>
						</div>

					</div>
				</div>
				<div class="transport_info">
					<div class="tr-box">
						<label for="user_transport_type">Tipo</label>
						<span id="user_transport_type" ></span>
					</div>
					<div class="tr-box">
						<label for="user_transport_model">Modelo</label>
						<span id="user_transport_model" ></span>
					</div>
					<div class="tr-box">
						<label for="user_transport_image">Imagen</label>
						<img id="user_transport_image" src="" width="80%" />
					</div>
					<div class="tr-box">
						<label for="user_transport_license_plate">Placas</label>
						<span id="user_transport_license_plate" ></span>
					</div>
					<div class="tr-box">
						<label for="user_transport_price">Precio</label>
						<span id="user_transport_price" ></span>
					</div>
					<div class="tr-box">
						<label for="user_transport_wifi">Wi-fi</label>
						<span id="user_transport_wifi" ></span>
					</div>
					<div class="tr-box">
						<label for="user_transport_air_conditioner">Aire acondicionado</label>
						<span id="user_transport_air_conditioner" ></span>
					</div>
				</div>
				<div class="routes_info">
				</div>
				<div class="comments_info">
					<div class="cm-box">
						<img src="../Imagenes/user-real-2.jpg"  />
						<label for="">Nathalia Acevedo</label>
						<span>Muy buen conductor! llega siempre a tiem asd onductor! siempr e  asasdasdasdasd asd a tiempo asdaas as das d asd as dasd</span>
					</div>
					<div class="cm-box">
						<img src="../Imagenes/user-real-1.jpg"  />
						<label for="">Nathalia Acevedo</label>
						<span>Muy buen conductor! llega siempre a tiem asd onductor! siempr e  asasdasdasdasd asd a tiempo asdaas as das d asd as dasd</span>
					</div>
					<div class="cm-box">
						<img src="../Imagenes/user-real-4.jpg"  />
						<label for="">Nathalia Acevedo</label>
						<span>Muy buen conductor! llega siempre a tiem asd onductor! siempr e  asasdasdasdasd asd a tiempo asdaas as das d asd as dasd</span>
					</div>
					<div class="cm-box">
						<img src="../Imagenes/user-real-3.jpg"  />
						<label for="">Nathalia Acevedo</label>
						<span>Muy buen conductor! llega siempre a tiem asd onductor! siempr e  asasdasdasdasd asd a tiempo asdaas as das d asd as dasd</span>
					</div>
				</div>
			</div>
			<img id="back" src="../Imagenes/left4.png" />
		</section>
		<div class="error_way">
			<span></span>
			<button type="button">Vale</button>
		</div>
	</div>
	<input type="hidden" id="way_usr_active" value="<?php echo $way_usr_active; ?>">
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/jquery-ui/jquery-ui.js"></script>
	<script src="../js/main.js"></script>
	<script src="../js/ways_query.js"></script>
	<script src="../js/lolliclock.js"></script>
	</body>
</html>
