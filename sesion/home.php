<?php
include("../php/functions.php"); //check the user type
checkLogin();
$conn=conectarse();
//datos de usuario
$idu=$_SESSION['id_usuario'];
$name=$_SESSION['id_nombre_usuario'];
$last_name=$_SESSION['id_apellido_usuario'];
$full_name=$name.$last_name;
$is_driver=$_SESSION['is_driver'];
$id_university=$_SESSION['id_university']; //name
$id_university=$_SESSION['user_id_university'];//id


$sql00="SELECT * FROM users WHERE id_user='$idu'";
$result00=pg_query($conn, $sql00);
$vector00=pg_fetch_array($result00);
$status_usr=$vector00['status_way'];
$us_img=$vector00['profile_image'];
if ($status_usr=="true") {
	//true=>activo
	//Busca el recorrido que pidio
	$sql10="SELECT id_way FROM usr_ways WHERE id_user='$idu'";
	$result10=pg_query($conn, $sql10);
	$vector10=pg_fetch_array($result10);
	$way_usr_active=$vector10['id_way'];
}

//Para el estado de actualizacion de las publicaiones
$sql_random="SELECT random_string FROM universities WHERE id_u='$id_university' ";
$result_random= pg_query($conn, $sql_random);
$vector_random=pg_fetch_array($result_random);
$rdnString=$vector_random['random_string'];

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Uniway</title>
    		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/sesion.css">
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
			<li><a href="home.php"><img src="../Imagenes/logo-name-white.png" alt="logo"/></a></li>
			<img id="bmenuw" src="../Imagenes/bmenuw.png" width="30px" />
		</ul>
	</nav>
	<div class="sesion_container">
		<div class="sesion_container_1">
			<section class="options">
				<a href="home.php"><img id="logo-nav" src="../Imagenes/logo-name-white.png" alt="logo"/></a>
				<div class="spinner spinner-1"></div>
				<a href="user_profile.php">
					<img id="usr_img" src="" title="Editar perfil" class="put_image_profile" alt="profile image" />
				</a>
				<br>
				<a class="editar" href="user_profile.php" >Editar perfil</a>
				<!--options section (left)-->
				<div class="other-options">
					<ul class="lista">
						<a href=""><li id='score_li'><img src="../Imagenes/puntuacion.png" class="icono" alt="iconos" /> &nbsp; &nbsp;<span id="score_usr"></span></li></a>
						<?php if ($is_driver=='t') {
							?>
							<a id="add-route-user-feed"><li><img src="../Imagenes/add.png" class="icono" alt="iconos" />Agregar ruta</li></a>
							<?php
						} ?>
						<a id="logout" href="../php/logout.php"><li><img src="../Imagenes/logout.png" class="icono" alt="iconos" /> Cerrar sesion</li></a>
					</ul>
				</div>
				<hr color="#161717" >
				<div class="other-options">
					<ul class="lista">
						<li><span></span>Buscar usuario</li>
						<li><span></span>Contacto</li>
						<li><span></span>Ayuda</li>
					</ul>
				</div>
			</section>
		</div>

		<div class="sesion_container_2">
		<!--feeeeeeeeeeeeeeeeeeeeeed section (center)-->
			<div class="find">
				<input id="search-input" class="search onAuto" type="text" name="name" placeholder="Busca un recorrido por lugar o usuario" autocomplete="off" >
				<img id="search_image" src="../Imagenes/search.png" alt="" />
			</div>
			<div id="search_options">
				<p>Filtros de busqueda:</p>
				<input id="user_opt" type="radio" name="opt_serch" value="user">
				<label for="user_opt">Usuario</label>
				<input id="stop_opt" type="radio" name="opt_serch" value="stop" checked>
				<label for="stop_opt">Lugar</label>
			</div>
			<a id='new-updates'><span>Hay nuevas publicaciones</span></a>
			<div id="pub-box">
				<div class="spinner spinner-1"></div>
			</div>
		</div>
		<div class="sesion_container_3">
			<section class="ads">
				<!--<img src="../Imagenes/news.png" width="100%" />-->
			</section>
			<!--ads section (right)-->
			<section class="news">
				<span class="copy" >©2017 Uniway</span>
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

		</div>

	</div>

	<section class="dinamic_button">
	</section>

	<div id="addRouteBox" <?php if ($is_driver=='f') { echo "style='display:none'";} ?>>
		<form  action="../php/addWay.php" method="post" id="addRoute">
			<img id="closeAddRoute" src="../Imagenes/leftw.png" />
			<p>
				Publica un recorrido.
			</p>
			<input id="id_user_json" type="hidden" name="id_user"  value="<?php echo $idu; ?>">
			<input type="hidden" name="id_u"  value="<?php echo $id_university; ?>">
			<span class="commentTitle" >Selecciona una de tus rutas:</span>
			<?php
			//consulta las rutas del usuario y las muestra como opcion
			$sql_routes="SELECT id_route FROM routes WHERE id_user='$idu'";
			$result_routes = pg_query($conn, $sql_routes);
			$numFilas_routes = pg_num_rows($result_routes);
			$contador=1;
			if  ($numFilas_routes!=0)
			{
				while($vector_routes=pg_fetch_array($result_routes))
				{
					$id_ruta= $vector_routes['id_route'];

					//rute_name
					$sql_rute_name="SELECT rute_name FROM routes WHERE id_route='$id_ruta'";
					$result_rute_name = pg_query($conn, $sql_rute_name);
					$vector_rute_name=pg_fetch_array($result_rute_name);
					$rute_name= $vector_rute_name['rute_name'];

					?>
					<div class="rutaXBox">
						<input type="radio" id="ruta<?php echo $contador; ?>" name="id_ruta" value="<?php echo $id_ruta; ?>" required>
						<label for="ruta<?php echo $contador; ?>"></label>
						<select name="ruta<?php echo $contador; ?>" id="opt-routes" class="opt-routes" >
						<option value="" selected ><?php echo $rute_name; ?></option>
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
							$nameStop_vec=explode(",",$nameStop);
							?><option value="<?php echo $nameStop_vec[0]; ?>" disabled ><?php echo $nameStop_vec[0]; ?></option><?php
						}
					}
					?>
						</select>
					</div>
					<?php
					$contador=$contador + 1;
				}
			}else{
				echo "<p style='font-size:70%; text-align:center'>No tienes rutas disponibles <br> <a href='user_profile.php#userRutesBox'> CREAR</a> </p>";
			}
			?>
			<span class="commentTitle" >Selecciona los cupos disponibles:</span>
			<select name="spots" >
				<option value="1">1 cupo</option>
				<option value="2">2 cupos</option>
				<option value="3">3 cupos</option>
				<option value="4" selected >4 cupos</option>
			</select>
			<span class="commentTitle" >Selecciona una hora:</span>
			<input id="timepicker" type="text" name="timepicker" autocomplete="off" required placeholder="Haz click">

			<div class="finish_start">
				<span id="fs_text" >El recorrido comienza o termina en la universidad</span>
				<div class="rutaXBox">
					<input id="start_l" type="radio" name="touniversity" value="false" required>
					<label for="start_l"></label>
					<span>Termina</span>
				</div>
				<div class="rutaXBox">
					<input id="end_l" type="radio" name="touniversity" value="true" >
					<label for="end_l"></label>
					<span>Comienza</span>
				</div>
			</div>
			<span class="commentTitle" >Informacion adicional:</span>
			<textarea name="comment" rows="3" cols="31" required></textarea>

			<button type="submit" <?php if($contador==1){echo "disabled";} ?> >Crear</button>
		</form>
	</div>

	<div id="modal-box" class="modal-box">
		<section   id="modal-window" class="modal-window">
			<img id="back" src="../Imagenes/leftw.png" />
			<div class="wrap1">
				<div class="verif_wrap"></div>
				<img id="user_img_query" class="user_img_query" src="../Imagenes/perfil.png"  alt="imagen de usuario"/>
			</div>
			<div class="info-usr">
				<div class="user_score">
					<span id="user_score">4.5</span>
					<img src="../Imagenes/puntuacion.png"/>
				</div>
				<ul>
					<li id="data_option" class="info_options" value="data_info" ><span class='li_underline'></span>Datos</li>
					<li class="info_options" value="transport_info" >Vehículo</li>
					<li class="info_options" value="routes_info" >Rutas</li>
					<li class="info_options" value="comments_info" >Comentarios</li>
				</ul>
				<div class="data_info">
					<div class="encb2">
						<div class="block">
							<label for="user_status_query">Estado</label>
							<span id="user_status_query" class="user_status_query" style="color:#B72C2C"  >Usuario no verificado</span>
						</div>
						<div class="block">
							<label for="user_name_query">Nombre</label>
							<span id="user_name_query" class="user_name_query">Nombre usuario</span>
						</div>
						<div class="block">
							<label for="user_university_query">Universidad</label>
							<span id="user_university_query" class="user_university_query" >Universidad </span>
						</div>
						<div class="block">
							<label for="user_email_query">Correo</label>
							<span id="user_email_query" class="user_email_query">correo@ejemplo.com</span>
						</div>
						<div class="block">
							<label for="user_phone_query">Telefono</label>
							<span id="user_phone_query" class="user_phone_query">3133333333</span>
						</div>

					</div>
				</div>
				<div class="transport_info">
					<div class="tr-box">
						<label for="user_transport_model">Modelo</label>
						<span id="user_transport_model" ></span>
					</div>
					<div class="tr-box">
						<div class="img-box">
							<img id="user_transport_image" src="" width="80%" />
						</div>
					</div>
					<div class="tr-box">
						<label for="user_transport_type">Tipo</label>
						<span id="user_transport_type" ></span>
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
					<form class="add_comment" action="" method="post">
						<textarea name="comment" placeholder="¿Ya has viajado con este usuario? Califícalo!" ></textarea>
						<div class="score-box">
							<label for="score1">1</label>
								<input type="radio" name="score" id="score1" value="1"/>
							<label for="score2">2</label>
								<input type="radio" name="score" id="score2" value="2"/>
							<label for="score3">3</label>
								<input type="radio" name="score" id="score3" value="3"/>
							<label for="score4">4</label>
								<input type="radio" name="score" id="score4" value="4"/>
							<label for="score5">5</label>
								<input type="radio" name="score" id="score5" value="5"/>
						</div>
						<button id="send_comment" type="button" name="button">Enviar</button>
						<input type="hidden" id="input_add_comment" data-usr="" data-usr-make=""/>
					</form>
					<div class="comm_fail"></div>
					<div class="comment-box"></div>
				</div>
			</div>
		</section>
		<div class="error_way">
			<p>Error</p>
			<span></span>
			<button type="button">Vale</button>
		</div>
		<section id="modal-window-route">
			<img id="back2" src="../Imagenes/left4.png" />
			<div id="map">
			</div>
			<div class="cont-stops">
				<p>Paradas</p>
				<span id="stp1"></span>
				<span id="stp2"></span>
				<span id="stp3"></span>
				<span id="stp4"></span>
				<span id="stp5"></span>
			</div>
		</section>
		<?php if ($is_driver=='t') {
			?>
			<div id="modal_add_stop">
			    <img id="close_add_stop_feed" src="../Imagenes/leftw.png" />
			    <form id="form_stops" action="../php/addRoute.php" name="form_stops" method="post">
				    <p>Crea una ruta</p>
				    <input type="text" class="query" id="rute_name" name="rute_name" placeholder="Escribe un nombre para la ruta" >
				    <span>Selecciona una de las universidades como destino/origen de tu ruta</span>
				    <select class="firs-stop" name="stop1">
					    <option value="Universidad Industrial de Santander - Calle 9">Universidad industrial de santander (UIS), Sede principal</option>
					    <option value="Universidad industrial de santander (UIS), Salud">Universidad industrial de santander (UIS), Salud</option>
					    <option value="Unab - Calle 42, Bucaramanga">Universidad Autónoma de Bucaramanga (UNAB), Cabecera</option>
					    <option value="FOSUNAB, Floridablanca - Santander">FOSUNAB, Salud</option>
				    </select>
				    <span>Escribe y selecciona de las opciones que se muestran al escribir, el mapa se generará automaticamente. ( minimo 1, máximo 4 paradas contando el destino )</span>
				    <div class="query_box">
					    <input type="text" class="query" id="query" placeholder="Busca una parada" onFocus="initAutocomplete_stop()" />
					    <button id="add_stop" type="button">Agregar</button>
				    </div>
				    <span class="error">No puedes agregar más de 4 paradas</span>
				    <div class="cont-stops">
					    <p>Paradas</p>
				    </div>
				    <button type="button" class="delete_stop">Eliminar ultima parada</button>
				    <div id="map_stops">
				    </div>
				    <input id="usr_id" type="hidden" name="id_user"  value="<?php echo $idu ?>">
				    <span class="errorVal">El nombre de tamaño minimo 4 y maximo 25, agregar al menos una parada.</span>
				    <button type="submit" name="button">Crear</button>
			    </form>
		    </div>
			<?php
		} ?>
	</div>

	<input type="hidden" id="id_usr" value="<?php echo $idu; ?>">
	<input type="hidden" id="usr_name" value="<?php echo $full_name; ?>">
	<input type="hidden" id="way_usr_active" value="<?php echo $way_usr_active; ?>">
	<input type="hidden" id="us_img" value="<?php echo $us_img; ?>">
	<input id='status_feed' type='button' hidden class='<?php echo "$id_university"; ?>' value='<?php echo "$rdnString"; ?>'>



	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/jquery-ui/jquery-ui.js"></script>
	<script src="../js/view_sesion.js"></script>
	<script src="../js/controller_home.js"></script>
	<script src="../js/lolliclock.js"></script>
	<script>
		//autocompletar search
		var autocomplete2;
		function initAutocomplete_search() {
			var options = {
			componentRestrictions: {country: "col"}
			};
			autocomplete2 = new google.maps.places.Autocomplete( ($('#search-input')[0])  ,  options );
		}

		//autocompletar paradas
		var autocomplete;
		function initAutocomplete_stop() {
			var options = {
			componentRestrictions: {country: "col"}
			};
			autocomplete = new google.maps.places.Autocomplete( ($('#query')[0])  ,  options );
		}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzRbb1jMuRuD6sgd53qwhd7lvJ8h8OSUk&libraries=places" async defer></script>
</body>
</html>
