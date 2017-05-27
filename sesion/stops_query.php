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
$university_acr=$_SESSION['user_university_acr'];
$id_university=$_SESSION['user_id_university'];

#Para actualizar rápido de la imagen de perfil
$sql111="SELECT profile_image FROM users WHERE id_user='$idu'";
$result111 = pg_query($conn, $sql111);
$prof_img=pg_fetch_array($result111);
$rute_img=$prof_img['profile_image'];


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
						<?php if ($status_usr=="true") { echo "<a href='group-chat.php?id_way=$way_usr_active'><li><span></span><img src='../Imagenes/mensaje.png' class='icono' alt='iconos' /> Conversación</li></a>";} ?>
						<a href="../php/logout.php"><li><span></span><img src="../Imagenes/logout.png" class="icono" alt="iconos" /> Cerrar sesion</li></a>
					</ul>
				</div>
				<hr color="#161717" >
				<div class="other-options">
					<ul class="lista">
						<li><span></span>Agregar paradas</li>
						<li><span></span>Buscar usuario</li>
						<li><span></span>Contacto</li>
						<li><span></span>Ayuda</li>
					</ul>
				</div>
		</section>
		<section class="container-stops">
			<input id="autocomplete" type="text" class="stop_query" name="stop_query" placeholder="Parada a buscar">
			<div class="result">
				<img class="stop_image" src="../Imagenes/confianza.jpg"/>
				<p class="stop_name">
					Nombre de la parada
				</p>
				<p class="stop_descrip">
					descripcion de la parada y direccion exacta
				</p>
				<p class="stop_birth">
					fecha de creacion
				</p>
				<button type="button" name="button">Ubicación</button>
			</div>
			<div class="stop_autor">
				<img src="../Imagenes/user-real-4.jpg" alt="" />
				<span class="autor_name" >Nombre del autor/modificador</span>
				<span  class="date_stop">12/23/2017</span>
			</div>


		</section>

	<input type="hidden" id="way_usr_active" value="<?php echo $way_usr_active; ?>">
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/jquery-ui/jquery-ui.js"></script>
	<script src="../js/main.js"></script>
	<script src="../js/ways_query.js"></script>
	<script src="../js/lolliclock.js"></script>

	<script>
       var placeSearch, autocomplete;
       var componentForm = {
	    	street_number: 'short_name',
	    	route: 'long_name',
	    	locality: 'long_name',
	    	administrative_area_level_1: 'short_name',
	    	country: 'long_name',
	    	postal_code: 'short_name'
       };
       function initAutocomplete() { autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete'))); }
     </script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzRbb1jMuRuD6sgd53qwhd7lvJ8h8OSUk&libraries=places&callback=initAutocomplete" async defer></script>



	</body>
</html>
