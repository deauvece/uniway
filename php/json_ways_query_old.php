<?php

//Consulta las publicaciones para una parada determinada (buscador) o las más actuales

error_reporting(0);
include("../php/functions.php");
$conn=conectarse();
$stop_query=$_GET['stop_query'];
$id_uni=$_GET['id_uni'];

session_start();
$idu=$_SESSION['id_usuario'];


//publicacion activa del usuario si es que tiene
$sql20="SELECT * FROM usr_ways WHERE id_user='$idu'";
$result20 = pg_query($conn, $sql20);
$vector20=pg_fetch_array($result20);
$way_active=$vector20['id_way'];



if ($id_uni && $stop_query) {
	//realiza la consulta de publicaciones para una parada (BUSQUEDA)

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
		//MAXIMO DIEZ RESULTADOS, si se cambia toca aumentar las variables en todos los arrrays
		$sql3="SELECT * FROM ways WHERE id_route='$query' AND id_u='$id_uni' ORDER BY id_way DESC LIMIT 10 ";
		$result3 = pg_query($conn, $sql3);
		while ($vector3=pg_fetch_array($result3))
			{
				$result_way[]=$vector3['id_way'];
			}
	}

		//cuales de ellas no estan vacias
		$size_result_ways=count($result_way);
		//arrays para los nombres
		$id_userss=array('id_user1','id_user2','id_user3','id_user4','id_user5','id_user6','id_user7','id_user8','id_user9','id_user10');
		$hours=array('time1','time2','time3','time4','time5','time6','time7','time8','time9','time10');
		$names=array('name1','name2','name3','name4','name5','name6','name7','name8','name9','name10');
		$profile_Imagenes=array('prof_img1','prof_img2','prof_img3','prof_img4','prof_img5','prof_img6','prof_img7','prof_img8','prof_img9','prof_img10');
		$comments=array('comment1','comment2','comment3','comment4','comment5','comment6','comment7','comment8','comment9','comment10');
		$spots=array('spot1','spot2','spot3','spot4','spot5','spot6','spot7','spot8','spot9','spot10');
		$toUniversity=array('toUni1','toUni2','toUni3','toUni4','toUni5','toUni6','toUni7','toUni8','toUni9','toUni10');
		$ways_id=array('way1','way2','way3','way4','way5','way6','way7','way8','way9','way10');
		$rutas=array('ruta1','ruta2','ruta3','ruta4','ruta5','ruta6','ruta7','ruta8','ruta9','ruta10');

		$stops_way=array('stop11','stop12','stop13','stop14','stop15','stop21','stop22','stop23','stop24','stop25'
					 ,'stop31','stop32','stop33','stop34','stop35','stop41','stop42','stop43','stop44','stop45','stop51','stop52','stop53','stop54','stop55',
					  'stop61','stop62','stop63','stop64','stop65','stop71','stop72','stop73','stop74','stop75'
					 ,'stop81','stop82','stop83','stop84','stop85','stop91','stop92','stop93','stop94','stop95','stop101','stop102','stop103','stop104','stop105');
		$array = array(
			'num_results' => $size_result_ways,
			'textsended' => "$stop_query"
		);
		$size2=$size_result_ways-1;
		$cont_stop=0;
		for ($i=0; $i < $size_result_ways  ; $i++) {
			$query=$result_way[$size2];
			$sql3="SELECT * FROM ways WHERE id_way='$query' ";
			$result3 = pg_query($conn, $sql3);
			while ($vector3=pg_fetch_array($result3))
				{
					$array[$ways_id[$i]]=$vector3['id_way'];
					$array[$hours[$i]]=$vector3['hour'];
					$array[$rutas[$i]]=$vector3['id_route'];
					$query_route=$vector3['id_route'];
					$array[$spots[$i]]=$vector3['spots'];
					$array[$toUniversity[$i]]=$vector3['touniversity'];
					$array[$comments[$i]]=$vector3['comment'];
					$array[$id_userss[$i]]=$idu=$vector3['id_user'];
						$sql11="SELECT * FROM users WHERE id_user='".$idu."' ";
						$result11 = pg_query($conn, $sql11);
						$vector11=pg_fetch_array($result11);
						$userName=$vector11['names'];
						$userLastName=$vector11['last_names'];
						$array[$names[$i]]=$userName." ".$userLastName;
						$array[$profile_Imagenes[$i]]=$vector11['profile_image'];
				}
				$size2--;
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
					$array[$stops_way[$cont_stop]]="";
				}else{
					$nameStop_vec=explode(",",$name_stop);
					$array[$stops_way[$cont_stop]]="$nameStop_vec[0]";
				}

				$vector30=pg_fetch_array($result30);

				$cont_stop++;
			}
		}

	echo json_encode($array);
}else{
	//consulta los datos de los ultimos 30 recorridos de la universidad guardados en waysArray
	$sql_ways="SELECT * FROM ways WHERE id_u='$id_uni' ORDER BY id_way DESC LIMIT 30";
	$result_ways= pg_query($conn, $sql_ways);
	$numFilas_ways = pg_num_rows($result_ways);
	$cont_ways=1;
	$output="";
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
				$sql1_goto="SELECT touniversity, hour, comment, id_route FROM ways WHERE id_way='$id_way'";
				$result1_goto = pg_query($conn, $sql1_goto);
				$vector_goto=pg_fetch_array($result1_goto);
				$gotouniversity=$vector_goto['touniversity'];
				$hour=$vector_goto['hour'];
				$comentario=$vector_goto['comment'];
				$id_route_query=$vector_goto['id_route'];
				//parada inicio-final
				$cont_stop=0;
				$all_stops=array();
				$sql30="SELECT * FROM route_stop WHERE id_route='$id_route_query'";
				$result30 = pg_query($conn, $sql30);
				while ($vector30=pg_fetch_array($result30)){
					$stop_id=$vector30['id_stop'];
					$sql31="SELECT name FROM stops WHERE id_stop='$stop_id' ";
					$result31 = pg_query($conn, $sql31);
					$vector31=pg_fetch_array($result31);
					$name_stop=$vector31['name'];
					$nameStop_vec=explode(",",$name_stop);
					array_push($all_stops,$nameStop_vec[0]);
					$cont_stop++;
				}
				$inicio_stp=$all_stops[0];
				$fin_stp=$all_stops[$cont_stop-1];

				$output=$output."
					<div class='publicaciones' data-way='$id_way' class='p-before'>
					<img class='open-modal'   src=".$profile_image_user." alt=".$id_user_w." />
					<span class='cupo'>
						".$spots." cupos.
					</span>
					<a href='#'>
						<span class='name'>
							".$full_name_user."
						</span>
					</a>
					<span class='time'>";
					$output=$output."Hora de salida:".$hour;
					$output=$output."</span>";
					$output=$output."<span class='ini-desti'> <span class='ini'>Inicio:</span>$inicio_stp<br> <span class='desti'>Fin:</span>$fin_stp</span>";
					$output=$output."<span class='comentario'>".$comentario."</span>";
					$output=$output."<div class='botones'>";

					if ($id_user_w==$idu) {
						$output=$output."<a href='group-chat.php?id_way=$id_way'><button class='btn-eliminar' type='button'>Chat</button></a>";
					}else{
						if ($status_usr=="true" && $id_way==$way_usr_active) {
							$output=$output."<a href='group-chat.php?id_way=$id_way'><button class='btn-eliminar' type='button'>Ver</button></a>";
						}else{
							//"VER" SI YA ES LA PUBLICACION QUE SE PIDIÓ
							if ($way_active==$id_way) {
								$output=$output."<a href='group-chat.php?id_way=".$id_way."'><button  class='btn-eliminar' type='button'>Ver</button></a>";
							}else{
								$output=$output."<button id='btn-pedirCupo' data-way='$id_way' data-usr='$idu' class='btn-pedirCupo' type='button'>Pedir cupo</button>";
							}
						}
					}
					$output=$output."</div></div>";
					$output=$output."<span class='ruta'>Ver mapa</span>";

			}}

			//cierra las llaves del while e if


			$array = array(
			    'output' => "$output"
		    );
	    		echo json_encode($array);
}
?>
