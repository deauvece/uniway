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
$rute_img=$_SESSION['profile_image'];

$email_public=$_SESSION['email_public'];
$phone_public=$_SESSION['phone_public'];
$license_plate_public=$_SESSION['license_plate_public'];

if ($is_driver=='t') {
	$sql11="SELECT * FROM transports WHERE id_user='$idu'";
	$result11 = pg_query($conn, $sql11);
	$vectorTransport=pg_fetch_array($result11);

	$license_plate=$vectorTransport['license_plate'];
	$model=$vectorTransport['model'];
	$air_conditioner=$vectorTransport['air_conditioner'];
	$wifi=$vectorTransport['wifi'];
	$price=$vectorTransport['price'];
	$type=$vectorTransport['type'];
	$image=$vectorTransport['image'];
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Uniway / Perfil</title>
    		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="../CSS/sesionOpen.css">
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
		<nav class="navProfile" >
			<ul>
				<li> <a href="sesionOpen.php">Ir atrás</a></li>
				<li> <span>/ Configuración de usuario</span></li>
			</ul>
			<img id="bmenu" src="../Imagenes/bmenu.png" width="30px" />
		</nav>
		<section class="left-section" >
			<section class="logo-section" >
				<a href="sesionOpen.php">
					<img src="../Imagenes/logo-only.png" alt="" />
					<img src="../Imagenes/logo-name.png" alt="" />
				</a>
			</section>
			<section class="generalInfo">
				<img id="little_img" src="<?php echo $rute_img;?>"/>
				<section class="options-left-section">
					<ul>
						<a href="#basicInfo"><li><span></span>Información básica</li></a>
						<a href="#transportInfo"><li><span></span>Transporte</li></a>
						<a href="#userRutesBox"><li <?php if ($is_driver=='f') { echo " style='display:none'";} ?>><span></span>Rutas</li></a>
							<a href="#qualificationsBox"><li><span></span>Comentarios</li></a>
						<a href="#basicInfo"><li><span></span>Verificar cuenta</li></a>
						<li>
							<span></span><a href="../Php/logout.php">Cerrar sesión</a>
						</li>
					</ul>
				</section>
			</section>
		</section>

		<div class="big_container">
			<div class="basicInfo" id="basicInfo">
				<div class="title">
					informacion básica
					<span>Cambia las configuraciones básicas de tu cuenta.</span>
				</div>
				<form action="../Php/update-user.php" method="post">
					<ul>
						<li>
							<label for="">Nombres</label>
							<input type="text" name="names" value="<?php echo "$name"; ?>">
						</li>
						<li>
							<label for="">Apellidos</label>
							<input type="text" name="last_names" value="<?php echo "$last_name"; ?>">
						</li>
						<li>
							<label for="">Universidad</label>
							<input type="text" disabled name="name" value="<?php echo "$university"; ?>">
						</li>
						<li>
							<label for="">Sexo</label>
							<input type="text" name="sex" value="<?php echo "$sex"; ?>">
						</li>
						<li>
							<label for="">Telefono</label>
							<input type="text" name="phone" value="<?php echo "$phone"; ?>">
						</li>
						<li>
							<label for="">Correo</label>
							<input type="text" name="email" value="<?php echo "$email"; ?>">
						</li>
						<input type="text" name="id_user" hidden value="<?php echo "$idu"; ?>">
					</ul>
					<div class="security">
						
						<h4>Visibildiad de los datos</h4>
						<span>
							Esta configuración solo afecta la visibildad de los datos para los usuarios que no están compartiendo algún vehiculo contigo.
						</span>
						<ul>
							<li>
								<span>Mantener mi direccion de correo electronico privado</span>
								<input type="checkbox" value="f" name="email_public" <?php if ($email_public=="f") {	echo "checked";	}	?>  >
							</li>
							<li>
								<span>Mantener mi direccion de numero de telefono privado </span>
								<input type="checkbox" value="f" name="phone_public"  <?php if ($phone_public=="f") {	echo "checked";	}	?>  >
							</li>
							<?php if ($is_driver=="t") {  ?>
								<li>
									<span>Mantener las placas de mi vehiculo privadas</span>
									<input type="checkbox" value="f" name="license_plate_public" <?php if ($license_plate_public=="f") {	echo "checked";	}	?> >
								</li>
							<?php  }	?>
						</ul>
					</div>
					<button type="submit" name="button" >Guardar</button>
				</form>
			</div>
			<div class="transportInfo" id="transportInfo">
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
					<form id="transport-box" action="../Php/addTransport.php" method="post" enctype="multipart/form-data">
						<input type="text" name="id_user" hidden value="<?php echo "$idu";?>">
						<ul>
							<li>
								<label for="">Placa</label>
								<input type="text" placeholder="xxxnnn ( Sin guiones )" name="license_plate" required>
							</li>
							<li>
								<label for="">Tipo de vehiculo</label>
								<select name="type" required>
									<option value="Carro">Carro</option>
									<option value="Moto">Moto</option>
									<option value="Camioneta">Camioneta</option>
									<option value="Van">Minivan</option>
								</select>

							</li>
							<li>
								<label for="">Modelo</label>
								<input type="text" name="model">
							</li>
							<li>
								<label for="">Aire acondicionado</label>
								<div class="radio">
									<!--M(masculino) F(femenino)-->
										<input type="radio" id="radio_airs" name="air_conditioner" value="yes" required>
										<label for="radio_airs">Si</label>
										<input type="radio" id="radio_airn" name="air_conditioner" value="no">
										<label for="radio_airn">No</label>
								</div>
							</li>
							<li>
								<label for="">Precio</label>
								<input type="text" required placeholder="Se recomienda un valor de 2000 COP" name="price">
							</li>
							<li>
								<label for="">Wi-fi</label>
								<div class="radio">
									<!--M(masculino) F(femenino)-->
										<input type="radio" id="radio_wfs" name="wifi" value="yes" required>
										<label for="radio_wfs">Si</label>
										<input type="radio" id="radio_wfn" name="wifi" value="no">
										<label for="radio_wfn">No</label>
								</div>
							</li>
							<li>
								<label for="">Foto del vehículo</label>
								<label class="file_label" for="uploadBtn">Selecciona una foto</label>
								<input id="uploadBtn" type="file"  name="file" accept="image/*" />
							</li>
							<input type="hidden" name="id_user" value="<?php echo "$idu"; ?>">
						</ul>
						<button type="button" name="button" id="close-transport"  >Cancelar</button>
						<button type="submit" name="button" >Guardar</button>
					</form>
					<?php
					}else{
						//Muestra la informacion del transporte
						?>
						<form id="form-update-transport" action="../Php/update-transport.php" method="post" enctype="multipart/form-data">
							<ul>
								<li>
									<label for="">Placas</label>
									<input type="text" disabled name="license_plate" value="<?php echo "$license_plate";?>">
								</li>
								<li>
									<label for="">Modelo</label>
									<input type="text" name="model" value="<?php echo "$model";?>">
								</li>
								<li>
									<label for="">Precio</label>
									<input type="text" name="price" value="<?php echo "$price";?>">
								</li>
								<li>
									<label >Tipo </label>
									<select name="type">
										<option value="Camioneta"
										<?php if ($type=="Camioneta") {
											echo " selected ";
										}?>>Camioneta</option>
										<option value="Carro" <?php if ($type=="Carro") {
											echo " selected ";
										}?>>Carro</option>
										<option value="Moto" <?php if ($type=="Moto") {
											echo " selected ";
										}?>>Moto</option>
										<option value="Minivan" <?php if ($type=="Minivan") {
											echo " selected ";
										}?>>Minivan</option>
									</select>
								</li>
								<li>
									<label >Aire acondicionado</label>
									<select name="air_conditioner">
										<option value="yes"
										<?php if ($air_conditioner=="t") {
											echo " selected ";
										}?>>Si</option>
										<option value="no" <?php if ($air_conditioner=="f") {
											echo " selected ";
										}?>>No</option>
									</select>
								</li>
								<li>
									<label >Wi-fi</label>
									<select  name="wifi">
										<option value="yes"
										<?php if ($wifi=="t") {
											echo " selected ";
										}?>>Si</option>
										<option value="no" <?php if ($wifi=="f") {
											echo " selected ";
										}?>>No</option>
									</select>
								</li>
								<li>
									<label >Imagen </label>
									<img src="<?php echo "$image"; ?>"/>
									<label class="file_label" for="uploadBtn">Selecciona una foto</label>
									<input id="uploadBtn" type="file" name="file" accept="image/*"/>
								</li>
							</ul>
							<input type="hidden" name="id_user" value="<?php echo "$idu"; ?>">
							<button id="delete-button" type="button" name="button" >Eliminar Vehículo</button>
							<button type="submit" name="button" >Guardar</button>
						</form>

<?php
}
?>

			</div>




<div class="userRutesBox" id="userRutesBox" <?php if ($is_driver=='f') { echo "style='display:none'";} ?> >
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
				  ?><span class="stop"><?php echo $nameStop; ?></span><?php
				}
		}
		echo "</div>";
	 }
}else { echo "no hay rutas disponibles";  }
?>
   <div class="box-button">
	   <button class="userAddRutes" id="add-route-user"  type="button" name="button">Agregar</button>
   </div>
</div>


			<!--calificaciones del usuario-->
			<div class="qualificationsBox" id="qualificationsBox">
				<div class="title">
					Comentarios y calificaciones
					<span>Comentarios y calificaciones que otros usuarios te han hecho.</span>
				</div>
				<div class="qualifications">
					<span class="number">4,7</span>
					<img src="../Imagenes/perfil.png"/>
					<span class="name">Julian Andres Perez</span>
					<span class="comment">Muy buena conductora, siempre llega a tiempo</span>
				</div>
				<div class="qualifications">
					<span class="number">5,0</span>
					<img src="../Imagenes/perfil.png"/>
					<span class="name">James Duarte</span>
					<span class="comment">No sabe manejaaaaaaaaaaaaaaar</span>
				</div>
				<div class="qualifications">
					<span class="number">4,5</span>
					<img src="../Imagenes/perfil.png"/>
					<span class="name">Ivonne Paola Hincapié Zárate</span>
					<span class="comment">Re puntual</span>
				</div>
				<div class="qualifications">
					<span class="number">4,7</span>
					<img src="../Imagenes/perfil.png"/>
					<span class="name">Santiago Rendon Patiño</span>
					<span class="comment"></span>
				</div>
				<div class="qualifications">
					<span class="number">1,0</span>
					<img src="../Imagenes/perfil.png"/>
					<span class="name">Javier Rueda</span>
					<span class="comment">Pesimo servicio, nunca llegó.</span>
				</div>
			</div>

		</div>



    <div id="addRouteBox">
	      <form action="../Php/addRoute.php" method="post" id="addRoute">
		        <button type="button" id="closeAddRoute"  > X </button>
		        <p>
		          Escribe y selecciona una parada.
		        </p>
			   <select id="num_stops" name="num_stops" >
			          <option value="2">2 paradas</option>
			          <option value="3">3 paradas</option>
			          <option value="4">4 paradas</option>
					<option value="5" selected>5 paradas</option>
		        </select>
		        <input type="text" class="paradas" name="stop1" placeholder="Ingresa una parada" autocomplete="off" required >
		        <input type="text" class="paradas" name="stop2" placeholder="Ingresa una parada" autocomplete="off" required >
		        <input type="text" class="paradas" name="stop3" placeholder="Ingresa una parada" autocomplete="off" required >
		        <input type="text" class="paradas" name="stop4" placeholder="Ingresa una parada" autocomplete="off" required >
		        <input type="text" class="paradas" name="stop5" placeholder="Ingresa una parada" autocomplete="off" required >
		        <select id="spots-select" name="spots" >
			          <option value="1">1 cupo</option>
			          <option value="2">2 cupos</option>
			          <option value="3">3 cupos</option>
			          <option value="4" selected >4 cupos</option>
		        </select>
		        <input type="hidden" name="id_user"  value="<?php echo $idu; ?>">
		        <button type="submit" >Crear</button>
	      </form>
		 <form id="delete_transport_form" action="../Php/deleteTransport.php" method="post">
			 <span>¿Estás seguro que deseas eliminar este vehículo? Toda la información relacionada a este también se eliminará.</span>
			 <input type="text" hidden name="id_user"  value="<?php echo "$idu";?>">
			 <input type="text" hidden name="license_plate"  value="<?php echo "$license_plate";?>">
			 <button type="submit" name="button" >Sí, eliminar</button>
			 <button id="cancel-delete" type="button" name="button" >No, cancelar</button>
		 </form>
		 <!--formulario para subir la imagen-->
		 <form id="profile_Image"  action="../Imagenes/profileImages/subirImagen.php" method="post" enctype="multipart/form-data" >
			 <img id="big_image" src="<?php echo $rute_img;?>"  />
			 <label class="file_label" for="uploadBtn2">Selecciona una foto</label>
			 <input id="uploadBtn2" type="file" name="file2" accept="image/*"/>
			 <button type="submit">Subir</button>
		 </form>
    </div>
    <?php if (isset($_GET["update"])=="done"){ ?>
	    <div class="update-done">
	    		Se han hecho los cambios
	    </div>
    <?php  }  ?>
</body>
</html>
