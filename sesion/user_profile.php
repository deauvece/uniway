<?php
// Activar errores
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include("../php/functions.php"); //check the user type
checkLogin();



//user info
$conn=conectarse();
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
		<link rel="stylesheet" type="text/css" href="../css/sesion.css">
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
				<li> <a href="home.php">Inicio</a></li>
				<li> <span>/ Configuración de usuario</span></li>
			</ul>
			<img id="bmenu" src="../Imagenes/bmenuw.png" width="30px" />
		</nav>
		<section class="left-section" >
			<section class="generalInfo">
				<div class="edit_img_box">
					<img id="little_img" src="<?php echo $rute_img;?>" alt="Cambiar foto de perfil"/>
					<a id="edit_img"><img src="../Imagenes/edity.png" /></a>
				</div>
				<section class="options-left-section">
					<ul>
						<a href="#basicInfo"><li>Información básica</li></a>
						<a href="#verif_info"><li>Verificar cuenta</li></a>
						<a href="#transportInfo"><li>Transporte</li></a>
						<a href="#userRutesBox"><li <?php if ($is_driver=='f') { echo " style='display:none'";} ?>>Rutas</li></a>
						<a href="#qualificationsBox"><li>Comentarios</li></a>
						<a id="logout" href="../php/logout.php">Cerrar sesion</a>
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
						<div class="block_data">
							<label for="">Nombres</label>
							<input type="text" name="names" value="<?php echo "$name"; ?>">
						</div>
						<div class="block_data">
							<label for="">Apellidos</label>
							<input type="text" name="last_names" value="<?php echo "$last_name"; ?>">
						</div>
						<div class="block_data">
							<label for="">Universidad</label>
							<input type="text" disabled name="name" value="<?php echo "$university"; ?>">
						</div>
						<div class="block_data">
							<label for="">Telefono</label>
							<input type="text" name="phone" value="<?php echo "$phone"; ?>">
						</div>
						<div class="block_data">
							<label for="">Correo</label>
							<input type="text" name="email" value="<?php echo "$email"; ?>">
						</div>

						<div class="block_data">
							<label for="">Sexo</label>
							<select name="sex">
								<option value="M" <?php if ($sex=="M"){echo "selected";} ?> >Masculino</option>
								<option value="F" <?php if ($sex=="F"){echo "selected";} ?> >Femenino</option>
							</select>
						</div>

						<div class="block_data" id="change_password">
							Cambia tu contraseña
						</div>
						<div class="block_data">
							<label for="pass1">Nueva contraseña</label>
							<input id="pass1" type="password" name="nw_ps" autocomplete="off">
						</div>
						<div class="block_data">
							<label for="pass2">Introduce de nuevo la contraseña</label>
							<input id="pass2" type="password" name="nw_ps2"  autocomplete="off">
						</div>
						<input type="text" name="id_user" hidden value="<?php echo "$idu"; ?>">

					<div class="message">

					</div>
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
					<button id="submit-btn-reg" type="submit" name="button" >Guardar cambios</button>
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
					<p class="no_vehicle">
						Actualmente no tienes ningún vehiculo.
					</p>
					<div class="add-transport-box">
						<button type="button" id="btn-transp"  name="button" >Agregar</button>
					</div>
					<form id="transport-box" action="../php/addTransport.php" method="post" enctype="multipart/form-data">
						<input type="text" name="id_user" hidden value="<?php echo "$idu";?>">
							<div class="block_data">
								<label for="">Placa</label>
								<input type="text" placeholder="xxxnnn ( Sin guiones )" name="license_plate" required>
							</div>
							<div class="block_data">
								<label for="">Tipo de vehiculo</label>
								<select name="type" required>
									<option value="Carro">Carro</option>
									<option value="Moto">Moto</option>
									<option value="Camioneta">Camioneta</option>
									<option value="Van">Minivan</option>
								</select>

							</div>
							<div class="block_data">
								<label for="">Modelo</label>
								<input type="text" name="model">
							</div>
							<div class="block_data">
								<label for="">Aire acondicionado</label>
								<div class="radio">
									<!--M(masculino) F(femenino)-->
										<input type="radio" id="radio_airs" name="air_conditioner" value="yes" required>
										<label for="radio_airs">Si</label>
										<input type="radio" id="radio_airn" name="air_conditioner" value="no">
										<label for="radio_airn">No</label>
								</div>
							</div>
							<div class="block_data">
								<label for="">Precio</label>
								<input type="text" required placeholder="Se recomienda un valor de 2000" name="price">
							</div>

							<div class="block_data">
								<label for="">Wi-fi</label>
								<div class="radio">
									<!--M(masculino) F(femenino)-->
										<input type="radio" id="radio_wfs" name="wifi" value="yes" required>
										<label for="radio_wfs">Si</label>
										<input type="radio" id="radio_wfn" name="wifi" value="no">
										<label for="radio_wfn">No</label>
								</div>
							</div>
							<div class="block_data">
								<label for="">Foto del vehículo</label>
								<img id="transport_image" src="../Imagenes/transportImages/default.png" alt="" />
								<label class="file_label" for="uploadBtn">Selecciona una foto</label>
								<input id="uploadBtn" type="file"  name="file" accept="image/*" />
							</div>
							<input type="hidden" name="id_user" value="<?php echo "$idu"; ?>">

						<button type="button" name="button" id="close-transport"  >Cancelar</button>
						<button type="submit" name="button" >Guardar cambios</button>
					</form>
					<?php
					}else{
						//Muestra la informacion del transporte
						?>
						<form id="form-update-transport" action="../php/update-transport.php" method="post" enctype="multipart/form-data">

								<div class="block_data">
									<label for="">Placas</label>
									<input type="text" disabled name="license_plate" value="<?php echo "$license_plate";?>">
								</div>
								<div class="block_data">
									<label for="">Modelo</label>
									<input type="text" name="model" value="<?php echo "$model";?>">
								</div>
								<div class="block_data">
									<label for="">Precio</label>
									<input type="text" name="price" value="<?php echo "$price";?>">
								</div>
								<div class="block_data">
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
								</div>
								<div class="block_data">
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
								</div>
								<div class="block_data">
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
								</div>
								<div class="block_data">
									<label >Imagen </label>
									<?php if (!$image){ $image="../Imagenes/transportImages/default.png";}?>
									<img id="transport_image" src="<?php echo "$image"; ?>"/>
									<label class="file_label" for="uploadBtn" >Selecciona una foto</label>
									<input id="uploadBtn" type="file" name="file" accept="image/*"/>
								</div>

							<input type="hidden" name="id_user" value="<?php echo "$idu"; ?>">
							<button id="delete-button" type="button" name="button" >Eliminar Vehículo</button>
							<button type="submit" name="button" >Guardar cambios</button>
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
			$sql_routes="SELECT id_route FROM routes WHERE id_user='$idu'";
			$result_routes = pg_query($conn, $sql_routes);
			$numFilas_routes = pg_num_rows($result_routes);
			if  ($numFilas_routes!=0)
			 {
			      while($vector_routes=pg_fetch_array($result_routes))
			      {
					?> <div class="userRutes"><?php
					$id_ruta= $vector_routes['id_route'];

					$sql_rute_name="SELECT rute_name FROM routes WHERE id_route='$id_ruta'";
					$result_rute_name = pg_query($conn, $sql_rute_name);
					$vector_rute_name=pg_fetch_array($result_rute_name);
					$rute_name= $vector_rute_name['rute_name'];

					echo "<span class='del_route' data-id='$id_ruta' >ELIMINAR</span><span class='rute_name'>$rute_name</span> ";
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
				<span class="error-del"></span>

				   <button class="userAddRutes" id="add-route-user"  type="button" name="button">Agregar ruta</button>

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
			 <form id="delete_transport_form" action="../php/deleteTransport.php" method="POST">
				 <p>Confirmar eliminación</p>
				 <span>¿Estás seguro que deseas eliminar este vehículo? Toda la información relacionada a este también se eliminará.</span>
				 <input type="text" hidden name="id_user"  value="<?php echo "$idu";?>">
				 <input type="text" hidden name="license_plate"  value="<?php echo "$license_plate";?>">
				 <button type="submit" >Sí, eliminar</button>
				 <button id="cancel-delete" type="button" name="button" >No, cancelar</button>
			 </form>
			 <!--formulario para subir la imagen-->
			 <form id="profile_Image"  action="../Imagenes/profileImages/subirImagen.php" method="post" enctype="multipart/form-data" >
				 <p>
				 	Cambia tu foto de perfil
				 </p>
				 <img id="big_image" src="<?php echo $rute_img;?>"  />
				 <div class="inputs_pf_image">
					 <label class="file_label" for="uploadBtn2" style='background-color:#B72C2C' >Selecciona una foto</label>
					 <input id="uploadBtn2" type="file" name="file2" accept="image/*" required/>
					 <button type="submit">Subir</button>
				 </div>
			 </form>
			 <div id="modal_add_stop">
				<img id="close_add_stop" src="../Imagenes/leftw.png" />
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
	    </div>
	    <?php if (isset($_GET["update"])=="done"){ ?>
		    <div class="update-done">
		    		Se han hecho los cambios
		    </div>
	    <?php  }  ?>



<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/jquery-ui/jquery-ui.js"></script>
<script src="../js/view_sesion.js"></script>
<!--date and time picker-->
<script src="../js/picker.js"></script>
<script src="../js/picker.date.js"></script>
<script src="../js/lolliclock.js"></script>
<script>
	//autocompletar
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
