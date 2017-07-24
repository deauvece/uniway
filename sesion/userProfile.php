<?php
// Activar errores
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include("../php/functions.php"); //check the user type
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

#Para actualizar rápido de la imagen de perfil
$sql111="SELECT profile_image FROM users WHERE id_user='$idu'";
$result111 = pg_query($conn, $sql111);
$prof_img=pg_fetch_array($result111);
$rute_img=$prof_img['profile_image'];

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
		<link rel="stylesheet" type="text/css" href="../css/sesionOpen.css">
		<link rel="icon" type="image/png" href="../Imagenes/favicon.png" />
		<!--Fuente texto-->
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.structure.css">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.theme.css">

	</head>
	<body>
		<nav class="navProfile" >
			<ul>
				<li> <a href="sesionOpen.php">Inicio</a></li>
				<li> <span>/ Configuración de usuario</span></li>
			</ul>
			<img id="bmenu" src="../Imagenes/bmenuw.png" width="30px" />
		</nav>
		<section class="left-section" >
			<section class="generalInfo">
				<img id="little_img" src="<?php echo $rute_img;?>"/>
				<section class="options-left-section">
					<ul>
						<a href="#basicInfo"><li>Información básica</li></a>
						<a href="#verif_info"><li>Verificar cuenta</li></a>
						<a href="#transportInfo"><li>Transporte</li></a>
						<a href="#userRutesBox"><li <?php if ($is_driver=='f') { echo " style='display:none'";} ?>>Rutas</li></a>
						<a href="#qualificationsBox"><li>Comentarios</li></a>
						<a href="../php/logout.php"><li>Cerrar sesión</li></a>
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
				<form action="../php/update-user.php" method="post">
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
							<label for="">Telefono</label>
							<input type="text" name="phone" value="<?php echo "$phone"; ?>">
						</li>
						<li>
							<label for="">Correo</label>
							<input type="text" name="email" value="<?php echo "$email"; ?>">
						</li>
						<li>
							<label for="">Sexo</label>
							<select name="sex">
								<option value="M" <?php if ($sex=="M"){echo "selected";} ?> >Masculino</option>
								<option value="F" <?php if ($sex=="F"){echo "selected";} ?> >Femenino</option>
							</select>
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
			<div class="transportInfo" id="verif_info" >
				<div class="title">
					Verificar correo institucional
					<span>Al verificar tu cuenta de correo institucional mejoras tu credibilidad ante toda la comunidad y aumenta la seguridad de la plataforma evitando que personas ajenas a tu universidad presten el servicio.</span>
				</div>
				<div class="verif_info">
				<?php
				//si recibe el token => ya ha hecho el proceso para verificar el correo institucional
					if (isset($_GET["tkn"])){
						$tkn=$_GET["tkn"];
						//comprueba el tkn
						$rand=$_SESSION['tkn1_user_verif'];
						$rand2=$_SESSION['tkn2_user_verif'];
						$verif_tkn=$rand*$rand2*$rand2;
						if ($tkn==$verif_tkn) {
							//cambia is verified en la base de datos
							$sql00="UPDATE users SET  is_verified='t' WHERE id_user='$idu'  ";
							$result00 = pg_query($conn, $sql00);
							//cambia is verified en los datos de sesion
							$_SESSION['is_verified']='t';
							$is_verified='t';
							?>
							<p>Felicitaciones el proceso de verficicación de correo institucional se ha hecho correctamente.</p>
							<?php
						}else{
							?>
							<p>El proceso de autenticación del token para la verificación del correo institucional no se ha realizado correctamente, por favor contacte a un administrador.</p>
							<?php
						}
					}

				//muestra el estado del usuario (verificado o no)
					if ($is_verified=="t") {
						//muestra la verificación de correo
						?>
						<div class="verfied-user">
							Correo institucional verificado!
						</div>
						<?php
					}else{
						//si no está verificado muestra el formulario para verificarse
						?>
							<form action="../php/verif-institutional.php" method="post">
								<label for="inst-email">Escribe tu correo institucional</label>
								<input id="inst-email" type="email" name="institutional_email" required>
								<?php
								if ( isset($_GET["vr"]) ){
									$var=$_GET["vr"];
									if ($var=="fal") {
										echo "<span style='color:#B72C2C' >El correo institucional introducido no está dentro de los soportados por la plataforma</span>";
									}else{
										echo "<span>Se ha enviado un mensaje de verificacion al correo introducido!.</span>";
									}
								}else{
									echo "<span>Se enviara un mensaje al correo introducido con un enlace para verificar.</span>";
								}
								 ?>
								<button type="submit" name="button" >Verificar</button>
							</form>
					<?php
					}
					?>
			</div>
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
					<form id="transport-box" action="../php/addTransport.php" method="post" enctype="multipart/form-data">
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
								<input type="text" required placeholder="Se recomienda un valor de 2000" name="price">
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
						<form id="form-update-transport" action="../php/update-transport.php" method="post" enctype="multipart/form-data">
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
									<?php if (!$image){ $image="../Imagenes/transportImages/default.png";}?>
									<img src="<?php echo "$image"; ?>"/>
									<label class="file_label" for="uploadBtn" style='background-color:#B72C2C' >Selecciona una foto</label>
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
					echo "<span class='del_route' data-id='$id_ruta' >ELIMINAR</span>";
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
							  $nameStop_vec=explode(",",$nameStop);
							  ?><span class="stop"><?php echo $nameStop_vec[0]; ?></span><?php
							}
					}
					echo "</div>";
				 }
			}else { echo "<p style='font-size:90%'>No hay rutas disponibles</p>";  }
			?>
				<form action="../php/addRoute.php" name="form_stops" method="post" id="addRoute2">
					<div class="new-add">
						<select class="firs-stop" name="stop1">
							<option value="Universidad Industrial de Santander - Calle 9">Universidad industrial de santander (UIS), Sede principal</option>
							<option value="Cra. 32 #29-31, Bucaramanga, Santander">Universidad industrial de santander (UIS), Salud</option>
							<option value="Unab - Calle 42, Bucaramanga">Universidad Autónoma de Bucaramanga (UNAB), Cabecera</option>
							<option value="FOSUNAB, Floridablanca - Santander">FOSUNAB, Salud</option>
						</select>
						<input type="text" class="paradas2" id="stop2" name="stop2" placeholder="Busca una parada" autocomplete="off" required />
						<button id="hide_stp_2" class="hide_stop" type="button">x</button>
						<input type="text" class="paradas2" id="stop3" name="stop3" placeholder="Busca una parada" autocomplete="off" required />
						<button id="hide_stp_3" class="hide_stop" type="button">x</button>
						<input type="text" class="paradas2" id="stop4" name="stop4" placeholder="Busca una parada" autocomplete="off" required />
						<button id="hide_stp_4" class="hide_stop" type="button">x</button>
						<input type="text" class="paradas2" id="stop5" name="stop5" placeholder="Busca una parada" autocomplete="off" required />
						<button id="hide_stp_5" class="hide_stop" type="button">x</button>
						<input type="hidden" name="id_user"  value="<?php echo $idu; ?>">
					</div>
					<button class="userAddRutes" id="add-route-user2"  type="submit" name="button">Enviar</button>
				</form>
				<span class="error-del"></span>
				<div class="box-button">
				   <button class="userAddRutes" id="add-route-user"  type="button" name="button">Agregar ruta</button>
				</div>
			</div>
			<div class="qualificationsBox" id="qualificationsBox">
				<div class="title">
					Comentarios y calificaciones
					<span>Comentarios y calificaciones que otros usuarios te han hecho.</span>
				</div>
				<?php
					$sql_cm="SELECT * FROM qualifications WHERE id_user='$idu'";
					$restul_cm=pg_query($conn,$sql_cm);
					$num_result = pg_num_rows($restul_cm);
					if ($num_result!=0) {
						while($vector_cm=pg_fetch_array($restul_cm))
						{
							$id_user_make=$vector_cm['id_user_make'];
							$sql_us="SELECT * FROM users WHERE id_user='$id_user_make'";
							$restul_us=pg_query($conn,$sql_us);
							$vector_us=pg_fetch_array($restul_us);
							$name_us=$vector_us['names'];
							$last_name_us=$vector_us['last_names'];
							$full_name_us=$name_us." ".$last_name_us;
							$image_us=$vector_us['profile_image'];
							$score=$vector_cm['score'];
							$comment=$vector_cm['comment'];
							$text="<div class='qualifications'><span class='number'>".$score."</span><img src='".$image_us."'/><span class='name'>".$full_name_us."</span><span class='comment'>".$comment."</span></div>";
							echo "$text";

						}
					}else{
						echo "<div class='qualifications'>No hay comentarios.</div>";
					}
				?>
			</div>
		</div>



	    <div id="addRouteBox">
			 <form id="delete_transport_form" action="../php/deleteTransport.php" method="post">
				 <span>¿Estás seguro que deseas eliminar este vehículo? Toda la información relacionada a este también se eliminará.</span>
				 <input type="text" hidden name="id_user"  value="<?php echo "$idu";?>">
				 <input type="text" hidden name="license_plate"  value="<?php echo "$license_plate";?>">
				 <button type="submit" name="button" >Sí, eliminar</button>
				 <button id="cancel-delete" type="button" name="button" >No, cancelar</button>
			 </form>
			 <!--formulario para subir la imagen-->
			 <form id="profile_Image"  action="../Imagenes/profileImages/subirImagen.php" method="post" enctype="multipart/form-data" >
				 <img id="big_image" src="<?php echo $rute_img;?>"  />
				 <label class="file_label" for="uploadBtn2" style='background-color:#B72C2C' >Selecciona una foto</label>
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
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui/jquery-ui.js"></script>
<script src="../js/main.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzRbb1jMuRuD6sgd53qwhd7lvJ8h8OSUk&libraries=places&callback=initAutocomplete" async defer></script>
</html>
