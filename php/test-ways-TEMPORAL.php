<?php
error_reporting(0);
include("../php/functions.php");
$conn=conectarse();
$stop_query=$_GET['stop_query'];
$id_uni=$_GET['id_uni'];
//id del usuario actual
session_start();
$idu=$_SESSION['id_usuario'];

//Busca una parada para el texto introducido
$sql1="SELECT id_stop FROM stops WHERE name LIKE '$stop_query%' ";
$result1 = pg_query($conn, $sql1);
$vector=pg_fetch_array($result1);
$result_stop=$vector['id_stop'];

//Busca una ruta que tenga la parada y esté activa
$sql2="SELECT id_route FROM route_stop WHERE id_stop='$result_stop' AND status='active' ";
$result2 = pg_query($conn, $sql2);
while ($vector2=pg_fetch_array($result2))
     {
		$result_routes[]=$vector2['id_route'];
     }
	$size_result_routes=count($result_routes);

	for ($i=0; $i < $size_result_routes ; $i++) {
		//Busca un recorrido que tenga la ruta
		$query=$result_routes[$i];
		//MAXIMO DIEZ RESULTADOS
		$sql3="SELECT * FROM ways WHERE id_route='$query' AND id_u='$id_uni' ORDER BY spots DESC LIMIT 10 ";
		$result3 = pg_query($conn, $sql3);
		while ($vector3=pg_fetch_array($result3))
			{
				$ways_id=$vector3['id_way'];
				$hour=$vector3['hour'];
				$ruta=$vector3['id_route'];
				$query_route=$vector3['id_route'];
				$spots=$vector3['spots'];
				$toUniversity=$vector3['touniversity'];
				$comment=$vector3['comment'];
				$id_users=$vector3['id_user'];
					$sql11="SELECT * FROM users WHERE id_user='".$id_users."' ";
					$result11 = pg_query($conn, $sql11);
					$vector11=pg_fetch_array($result11);
					$userName=$vector11['names'];
					$userLastName=$vector11['last_names'];
					$full_name=$userName.$userLastName;
					$profile_image=$vector11['profile_image'];
		?>
				<div class="publicaciones" class="p-before">
					<img class="open-modal"  src="" alt="<?php echo $id_users ?>" />
					<span class="cupo">
						<?php echo $spots ?> cupos.
					</span>
					<a href="#">
						<span class="name"><?php echo $full_name ?></span>
					</a>
					<span class="time">En la universidad a las <?php echo $hour ?></span>
					<span class="comentario">
						<?php echo $comment ?>
					</span>
					<div class="botones">
						<button id='btn-pedirCupo' data-way='<?php echo $ways_id ?>'  data-usr='<?php echo $idu ?>' class='btn-pedirCupo' type='button'>Pedir cupo</button>
					</div>
					<div class="rt-title">
						Paradas
					</div>
				</div>
				<!--<span class='ruta' style='display:none' >-->
				<span class='ruta' >
					<?php
						//consulta las paradas de cada recorrido
						//consulta el id
						$sql30="SELECT * FROM route_stop WHERE id_route='$query_route' ";
						$result30 = pg_query($conn, $sql30);
						$vector30=pg_fetch_array($result30);
						for ($k=0; $k<5 ; $k++) {
							//consutla el nombre de la parada
							$stop_id=$vector30['id_stop'];
							$sql31="SELECT name FROM stops WHERE id_stop='$stop_id' ";
							$result31 = pg_query($conn, $sql31);
							$vector31=pg_fetch_array($result31);
							$name_stop=$vector31['name'];
							if (!$name_stop) {
								echo "";
							}else{
								echo "<span>".$name_stop."</span>";
								echo "&nbsp; &nbsp;";
							}
							$vector30=pg_fetch_array($result30);
							$cont_stop++;
						}
					?>
				</span>
					<?php

			}
	}

?>
