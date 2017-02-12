<?php
// Activar errores
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include("../Php/functions.php"); //check the user type
checkLogin();

//consulta del id para obtener todos los datos
$var=$_GET["idu"];
if ($var=='myProfile') {	$idu=$_SESSION['id_usuario'] ;
}else{$idu=$var;}

//user info
$conn=conectarse();
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

$sql_img_account="SELECT profile_image FROM users WHERE id_user='$idu'";
$result_img_account = pg_query($conn, $sql_img_account);
$vector_img_account=pg_fetch_array($result_img_account);
$rute_img= $vector_img_account['profile_image'];

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Uniway / Perfil</title>
    		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="sesionOpen.css">
		<link rel="icon" type="image/png" href="../Imagenes/favicon.png" />
		<!--Fuente texto-->
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">

		<script src="../JS/jquery-3.1.1.min.js"></script>
		<script src="../JS/jquery-ui/jquery-ui.js"></script>
		<script src="../JS/main.js"></script>
		<link rel="stylesheet" type="text/css" href="../JS/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../JS/jquery-ui/jquery-ui.structure.css">
		<link rel="stylesheet" type="text/css" href="../JS/jquery-ui/jquery-ui.theme.css">

	</head>
	<body>
		<section class="left-section" >
			<section class="logo-section" >
				<a href="sesionOpen.php">
					<img src="../Imagenes/logo-only.png" alt="" />
					<img src="../Imagenes/logo-name.png" alt="" />
				</a>
			</section>
			<section class="generalInfo">
				<img id="little_img" onclick="subirImagen()" src="<?php echo $rute_img;?>"/>
				<div id="image_box">
					<!--formulario para subir la imagen-->
					<form id="profile_Image"  action="../Imagenes/profileImages/subirImagen.php" method="post" enctype="multipart/form-data" >
						<img id="big_image" src="<?php echo $rute_img;?>"  />
						<label for="file_input">Elige una imagen</label>
						<input id="file_input" type="file" name="file" accept="image/*" required>
						<button type="submit" name="button">Subir</button>
					     <button id="cancel_img" type="button" onclick="subirImagen()" name="button">x</button>
					</form>
				</div>
				<section class="options-left-section">
					<ul>
						<li><span></span>Rutas</li>
						<li><span></span>Comentarios</li>
						<li><span></span>Información básica</li>
						<li><span></span>Transporte</li>
						<li><span></span>Verificar cuenta</li>
						<li>
							<span></span><a href="../Php/logout.php">Cerrar sesión</a>
						</li>
					</ul>
				</section>
			</section>
		</section>
		<nav class="navProfile" >
			<ul>
				<li> <a href="sesionOpen.php">Ir atrás</a></li>
				<li> <span>/ Configuración de usuario</span></li>
			</ul>
		</nav>
		<div class="big_container">
			<div class="basicInfo">
				<div class="title">
					informacion básica
					<span>Cambia las configuraciones básicas de tu cuenta.</span>
				</div>
					<ul>
						<li>
							<label for="">Nombres</label>
							<input type="text" name="name" value=" <?php echo "$name"; ?> ">
						</li>
						<li>
							<label for="">Apellidos</label>
							<input type="text" name="name" value="<?php echo "$last_name"; ?>">
						</li>
						<li>
							<label for="">Universidad</label>
							<input type="text" disabled name="name" value="<?php echo "$university"; ?>">
						</li>
						<li>
							<label for="">Sexo</label>
							<input type="text" name="name" value="<?php echo "$sex"; ?>">
						</li>
						<li>
							<label for="">Telefono</label>
							<input type="text" name="name" value="<?php echo "$phone"; ?>">
						</li>
						<li>
							<label for="">Correo</label>
							<input type="text" name="name" value="<?php echo "$email"; ?>">
						</li>
						<li>
							<label for="">Contraseña</label>
							<input type="password" name="name" value="">
						</li>
					</ul>
					<button type="button" name="button" >Guardar</button>
			</div>
			<div class="basicInfo">
				<div class="title">
					Transporte
					<span>Agrega información de un vehiculo para compartir tus rutas con los demás usuarios.</span>
				</div>
				<?php if ($is_driver=="f") {
				//formulario para agregar un transporte
				?>
					<div class="add-transport-box">
						<button type="button" id="btn-transp"  name="button" >Agregar</button>
					</div>
					<form id="transport-box" action="addTransport.php" method="post">
						<ul>
							<li>
								<label for="">Placa</label>
								<input type="text" placeholder="xxx-nnn" name="name" value="">
							</li>
							<li>
								<label for="">Tipo de vehiculo</label>
								<select name="type_transport">
									<option value="Carro">Carro</option>
									<option value="Moto">Moto</option>
									<option value="Camioneta">Camioneta</option>
									<option value="Van">Minivan</option>
								</select>

							</li>
							<li>
								<label for="">Modelo</label>
								<input type="text" name="name" value="">
							</li>
							<li>
								<label for="">Aire acondicionado</label>
								<div class="radio">
									<!--M(masculino) F(femenino)-->
										<input type="radio" id="radio_airs" name="cool_air" value="si" required>
										<label for="radio_airs">Si</label>
										<input type="radio" id="radio_airn" name="cool_air" value="no">
										<label for="radio_airn">No</label>
								</div>
							</li>
							<li>
								<label for="">Precio</label>
								<input type="text" placeholder="Se recomienda un valor de 2000 COP" name="name" value="">
							</li>
							<li>
								<label for="">Wi-fi</label>
								<div class="radio">
									<!--M(masculino) F(femenino)-->
										<input type="radio" id="radio_wfs" name="wifi" value="si" required>
										<label for="radio_wfs">Si</label>
										<input type="radio" id="radio_wfn" name="wifi" value="no">
										<label for="radio_wfn">No</label>
								</div>
							</li>
							<li>
								<label for="">Selecciona el color</label>
								<input type="color" name="name" value="">
							</li>
							<input type="hidden" name="id_user" value="<?php echo "$idu"; ?>">
						</ul>
						<button type="button" name="button" id="close-transport"  >Cancelar</button>
						<button type="button" name="button" >Guardar</button>
					</form>
					<?php
					}else{
						//Muestra la informacion del transporte
						echo "soy conductor";
					}
					 ?>

			</div>




<div class="userRutesBox">
	<div class="title">
		Rutas
		<span>Crea y elimina las rutas de tus recorridos.</span>
	</div>
<?php
//selecciono todas las rutas del usuario
$sql_routes="SELECT id_route FROM usr_routes WHERE id_user='$idu'";
$result_routes = pg_query($conn, $sql_routes);
$numFilas_routes = pg_num_rows($result_routes);
if  ($numFilas_routes!=0)
 {
      while($vector_routes=pg_fetch_array($result_routes))
      {
		?> <div class="userRutes"> <?php
		$id_ruta= $vector_routes['id_route'];
		//selecciono todas las paradas de esa ruta
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
				  ?><span class="stop"><?php echo $nameStop; ?>
				  </span><?php
				}
		}
		echo "</div>";
	 }
}else { echo "no hay rutas disponibles";  }
?>
   <div class="box-button">
	   <button class="userAddRutes" id="add-route-user" onclick="crearRuta()" type="button" name="button">Agregar</button>
   </div>
</div>


			<!--calificaciones del usuario-->
			<div class="qualificationsBox">
				<div class="title">
					Comentarios y calificaciones
					<span>Comentarios y calificaciones que otros usuarios te han hecho.</span>
				</div>
				<div class="qualifications">
					<span class="number">4,7</span>
					<img src="perfil.png"/>
					<span class="name">Julian Andres Perez</span>
					<span class="comment">Muy buena conductora, siempre llega a tiempo</span>
				</div>
				<div class="qualifications">
					<span class="number">5,0</span>
					<img src="perfil.png"/>
					<span class="name">James Duarte</span>
					<span class="comment">No sabe manejaaaaaaaaaaaaaaar</span>
				</div>
				<div class="qualifications">
					<span class="number">4,5</span>
					<img src="perfil.png"/>
					<span class="name">Ivonne Paola Hincapié Zárate</span>
					<span class="comment">Re puntual</span>
				</div>
				<div class="qualifications">
					<span class="number">4,7</span>
					<img src="perfil.png"/>
					<span class="name">Santiago Rendon Patiño</span>
					<span class="comment"></span>
				</div>
				<div class="qualifications">
					<span class="number">1,0</span>
					<img src="perfil.png"/>
					<span class="name">Javier Rueda</span>
					<span class="comment">Pesimo servicio, nunca llegó.</span>
				</div>
			</div>

		</div>



    <div id="addRouteBox">
	      <form action="../Php/addRoute.php" method="post" id="addRoute">
		        <button type="button" id="closeAddRoute" onclick="crearRuta()" > X </button>
		        <p>
		          Escribe y selecciona una parada.
		        </p>
		        <input type="text" class="paradas" id="buscar" name="stop1" placeholder="Ingresa una parada" autocomplete="off" required >
		        <input type="text" class="paradas" id="buscar2" name="stop2" placeholder="Ingresa una parada" autocomplete="off" required >
		        <input type="text" class="paradas" id="buscar3" name="stop3" placeholder="Ingresa una parada" autocomplete="off" required >
		        <input type="text" class="paradas" id="buscar4" name="stop4" placeholder="Ingresa una parada" autocomplete="off" required >
		        <input type="text" class="paradas" id="buscar5" name="stop5" placeholder="Ingresa una parada" autocomplete="off" required >
		        <select name="spots" >
		          <option value="1">1 cupo</option>
		          <option value="2">2 cupos</option>
		          <option value="3">3 cupos</option>
		          <option value="4" selected >4 cupos</option>
		        </select>
		        <input type="hidden" name="id_user"  value="<?php echo $idu; ?>">
		        <button type="submit" >Crear</button>
	      </form>
    </div>
</body>
</html>
