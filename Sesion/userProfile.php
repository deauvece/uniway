<?php
//se comprueba si ha iniciado sesion
session_start();
if ($_SESSION['activo'] == false) {
  header("location:../login-user.php?errorSesion=si");
}else {
  $name = $_SESSION['id_nombre_usuario'] ;
  $last_name = $_SESSION['id_apellido_usuario'] ;
  $full_name= $name ." ". $last_name;
}
if ($_SESSION['admin']=='f') {
  header("location:maintenance.php");
  exit();
}
	// Activar errores
  ini_set('display_errors', 'On');
  ini_set('display_errors', 1);
	//consulta del id para obtener todos los datos
	//id obtenido por la url
	$var=$_GET["idu"];
	if ($var=='myProfile') {
		$idu=$_SESSION['id_usuario'] ;
	}else{
		$idu=$var;
	}
	//consulta de datos
	include("../Php/conec.php");
	$conn=conectarse();
	$sql1="SELECT * FROM users WHERE id_user='$idu'";
	$result1 = pg_query($conn, $sql1);
	$numFilas = pg_num_rows($result1);
	if  ($numFilas!=0)
     {
          if ($vector=pg_fetch_array($result1))
          {
	          $name=$vector["1"];
	          $last_name=$vector["2"];
						$full_name = $name." ".$last_name;
						$phone=$vector["3"];
						$sex=$vector["4"];
						$email=$vector["5"];
						$is_driver=$vector["7"];
						//id de la universidad
						$id_university=$vector["8"];
						$is_verified=$vector["10"];


						$sql1="SELECT * FROM universities WHERE id_u='$id_university'";
						$result1 = pg_query($conn, $sql1);
						$vector=pg_fetch_array($result1);
						$university= $vector["name"];
						$university_acr= $vector["acronym"];

					}
	}else {
		echo "No hay filas en el resultado";
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Uniway</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="sesionOpen.css">
		<link rel="icon" type="image/png" href="../Imagenes/favicon.png" />
		<link rel="stylesheet" href="jquery-ui.min.css">
		<script src="../JS/jquery-3.1.1.min.js"></script>
		<script src="../JS/jquery-ui.min.js"></script>

	</head>
	<body>
		<!--Nav bar-->
		<nav class="navProfile" >
			<ul>
				<li> <a href="sesionOpen.php"><img src="back.png" alt="go back" /></a></li>
				<li><img src="config.png" alt="settings" /></li>
				<li><a href="#"><img src="../Imagenes/logo-name.png" alt="" /></a></li>
			</ul>
		</nav>
		<section class="topSection" >
			<section class="generalInfo">
        <?php
          //saber si el usuario ya ha cambiado la imagen de perfil predeterminada
          $sql1_image="SELECT profile_image FROM users WHERE id_user='$idu'";
          $result1_image = pg_query($conn, $sql1_image);
          $vector_img=pg_fetch_array($result1_image);
          $rute_img=$vector_img['profile_image'];
          if ($rute_img==NULL) {
            //si no la ha cambiado se pone la predeterminada
            ?><img onclick="subirImagen()" src="perfil.png" alt="user image"/><?php
          }else{
            //si la cambió, se busca por el id del usuario en la ruta predeterminada
            ?><img onclick="subirImagen()" src="<?php echo $rute_img;?>" alt="" /><?php
          }
        ?>
        <!--formulario para subir la imagen-->
        <form id="profile_Image"  action="../Imagenes/profileImages/subirImagen.php" method="post" enctype="multipart/form-data" >
          <input type="file" name="file" accept="image/*" required>
          <?php if ($rute_img==NULL) {
            //si no la ha cambiado se pone la predeterminada
            ?><button type="submit" name="button">Subir</button><?php
          }else{
            //si la cambió, se busca por el id del usuario en la ruta predeterminada
            ?><button type="submit" name="button">Actualizar</button><?php
          }
        ?>
        </form>


				<div class="moreInfo">
					<span class="infoGen"> <span class="title">Universidad</span> <?php echo $university; ?> (<?php echo $university_acr; ?>)</span><br>
					<span class="infoGen"> <span class="title">Carrera</span> Ingenieria Industrial </span><br>
					<span class="infoGen"> <span class="title">Correo</span><?php echo $email; ?> </span><br>
					<span class="infoGen"> <span class="title">Telefono</span> <?php echo $phone; ?> </span><br>
				</div>
				<div class="content">
					<span class="name"> <?php echo $full_name; ?> </span>
					<span class="score">4.8</span>
					<?php
								if ($is_verified=='t') {
									?><span class="verif" ><img src="check.png" alt="user verificated" />Verificado</span><?php
								}else {
									?><span class="verif" ><img src="cross.png" alt="user verificated" />Verificado</span><?php
								}
					?>
				</div>
			</section>
		</section>
		<section class="infoOptions" >
			<ul>
				<li>
					<label id="rutasLabel" for="rutas">Rutas</label>
					<input type="radio" id="rutas" name="typeInfo" checked>
				</li>
				<li>
					<label id="calificacionesLabel" for="calificaciones">Calificaciones</label>
					<input type="radio" id="calificaciones" name="typeInfo">
				</li>
				<li>
					<label id="datosLabel"  for="datos">Datos</label>
					<input type="radio" id="datos" name="typeInfo" >
				</li>
			</ul>
		</section>


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


		<section class="selectedOptions" >
			<!--BASCI INFO (DATOS)-->
			<div class="basicInfoBox">
				<div class="basicInfo">
					<span class="title">Universidad</span>
					<span class="content"><?php echo $university; ?> (<?php echo $university_acr; ?>)</span>
				</div>
				<div class="basicInfo">
					<span class="title">Edad</span>
					<span class="content">21.</span>
				</div>
				<?php if ($is_driver=='t') {
					?>
					<div id="transport" class="basicInfo">
						<span class="title">Transporte</span>
						<span class="content"> Spark GT modelo 2015 </span>
						<img src="transport.jpg" alt="user transport" />
					</div>
					<?php
				}
				?>
				<div class="basicInfo">
					<span class="title">Correo</span>
					<span class="content"><?php echo $email; ?>.</span>
				</div>
				<div class="basicInfo">
					<span class="title">Telefono</span>
					<span class="content"><?php echo $phone; ?>.</span>
				</div>
			</div>

			</div>
			<!--RUTAS (RUTAS DEL USUARIO SÍ ES CONDUCTOR)-->
			<div class="userRutesBox">
				<div class="title">
					Rutas
				</div>

        <?php
        $conn=conectarse();
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
                  ?>
                  <button type="button">Mapa</button>
                </div>
                <?php

                }

            }else {
              echo "no hay rutas disponibles";
            }
        ?>
        <a onclick="crearRuta()" class="userAddRutes"><img src="mapa.png" alt="" /></a>

			</div>

			<!--calificaciones del usuario-->
			<div class="qualificationsBox">
				<div class="title">
					Calificaciones
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


		</section>
		<script src="../JS/main.js" > </script>
	</body>
</html>
