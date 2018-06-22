<?php

//Consulta las publicaciones para una parada determinada (buscador) o las más actuales


include("../php/functions.php"); //make_publications() conectarse()
$conn=conectarse();
//recibe los datos
session_start();
$idu=$_SESSION['id_usuario'];
//$input_query=$_GET['stop_query'];
$id_uni=$_GET['id_uni'];
//$opt_search=$_GET['opt_search'];
$input_query="";

/*
Esquema general

	if (recibió datos){
		//hace una busqueda en las publicaciones para los datos recibidos
	}else{
		//consulta las ultimas 30 publicaciones
	}

	return echo json_encode
	{ output: "string con las publicaciones resultantes"}

*/


//busca una publicacion activa del usuario si es que tiene
$sql20="SELECT * FROM usr_ways WHERE id_user='$idu'";
$result20 = pg_query($conn, $sql20);
$vector20=pg_fetch_array($result20);
$way_active=$vector20['id_way'];

if ($id_uni && $input_query) {
		$input_query=strtolower($input_query);
		//realiza la consulta de publicaciones para una parada (BUSQUEDA) o para un usario dependiendo de opt_search
		if ($opt_search=="user") {
			//Busca una publicacion de algun usuario con un nombre como el de la busqueda
			$sql_usr="SELECT id_user FROM users WHERE names LIKE '%$input_query%' LIMIT 10 ";
			$result_usr = pg_query($conn, $sql_usr);
			while ($vector_usr=pg_fetch_array($result_usr)){
				$result_query[]=$vector_usr['id_user'];
		     }
			$size_result=count($result_query);

		}else{
			//Busca una parada para el texto introducido
			$sql1="SELECT id_stop FROM stops WHERE name LIKE '%$input_query%' ";
			$result1 = pg_query($conn, $sql1);
			$vector=pg_fetch_array($result1);
			$result_stop=$vector['id_stop'];
			//Busca una ruta que tenga la parada y esté activa
			$sql2="SELECT id_route FROM route_stop WHERE id_stop='$result_stop' AND status='active' ";
			$result2 = pg_query($conn, $sql2);
			while ($vector2=pg_fetch_array($result2))
		     {
				$result_query[]=$vector2['id_route'];
		     }
			$size_result=count($result_query);

		}
		$output="<p class='result-txt'>Resultados de la busqueda.</p>";
		for ($i=0; $i < $size_result ; $i++) {
			//Busca un recorrido que tenga la ruta
			$query=$result_query[$i];
			//MAXIMO DIEZ RESULTADOS, si se cambia toca aumentar las variables en todos los arrrays
			//dependiendo de la opcion de busqueda se cambia el query
			if ($opt_search=="user") {
				$sql3="SELECT * FROM ways WHERE id_user='$query' AND id_u='$id_uni' ORDER BY id_way DESC LIMIT 10 ";
			}else{
				$sql3="SELECT * FROM ways WHERE id_route='$query' AND id_u='$id_uni' ORDER BY id_way DESC LIMIT 10 ";
			}
			$result3 = pg_query($conn, $sql3);
			$numFilas_ways = pg_num_rows($result3);
			$cont_ways=1;
			if  ($numFilas_ways!=0){
				while ($vector3=pg_fetch_array($result3)){
					//datos de cada recorrido
					$id_way=$vector3['id_way'];
					$hour=$vector3['hour'];
					$id_user_w=$vector3['id_user'];
					$id_route=$vector3['id_route'];
					$spots=$vector3['spots'];
					$touniversity=$vector3['touniversity'];
					//datos del usuario que publica
					$sql1_name="SELECT names, last_names, profile_image FROM users WHERE id_user='$id_user_w'";
					$result1_name = pg_query($conn, $sql1_name);
					$vector_name=pg_fetch_array($result1_name);
					$first_names=$vector_name['names'];
					$last_names=$vector_name['last_names'];
					$profile_image_user=$vector_name['profile_image'];
					$full_name_user=$first_names." ".$last_names;
					//datos del recorrido publicado
					$sql1_goto="SELECT touniversity,date, hour, comment, id_route FROM ways WHERE id_way='$id_way'";
					$result1_goto = pg_query($conn, $sql1_goto);
					$vector_goto=pg_fetch_array($result1_goto);
					$gotouniversity=$vector_goto['touniversity'];
					$hour=$vector_goto['hour'];
					$date=$vector_goto['date'];
					$date_vec=explode(",",$date);
					$comentario=$vector_goto['comment'];
					$id_route_query=$vector_goto['id_route'];
					//parada inicio-final
					$cont_stop=0;
					$all_stops=array();
					//si el recorrido termina en la universidad ($start_uni=false) se cambia el orden de las rutas
					if (!$touniversity) {
						$sql30="SELECT * FROM route_stop WHERE id_route='$id_route_query' DESC";
					}else {
						$sql30="SELECT * FROM route_stop WHERE id_route='$id_route_query'";
					}

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

					$class="p-before";
					if ($id_user_w==$idu || ($status_usr=="true" && $id_way==$way_usr_active) || $way_active==$id_way ) {
						$button="<a href='group-chat.php?id_way=$id_way'><img src='../Imagenes/group.png'/>Chat</a>";
					}else{
						$button="<a class='btn-pedirCupo' data-way='$id_way' data-usr='$idu'><img src='../Imagenes/pedir.png'/>Pedir</a>";
					}
					//crear el <div> de una publicacion
					$out_pub=make_publications(
										   $class,
										   $profile_image_user,
										   $id_user_w,
										   $full_name_user,
										   $comentario,
										   $inicio_stp,
										   $fin_stp,
										   $date_vec,
										   $hour,
										   $id_way,
										   $button,
										   $spots	);
					$output=$output.$out_pub;
				}
			}
		}

		//no results
		$nr=1;
		if ($output=="<p class='result-txt'>Resultados de la busqueda.</p>") {
			$output=$output."<span class='no-results'>No hay resultados</span>";
			$nr=0;
		}
		$array = array(
			'output' => "$output",
			'nr' => "$nr"
		);
		echo json_encode($array);


}else{
	//consulta los datos de los ultimos 30 recorridos
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
				$sql1_goto="SELECT touniversity,date, hour, comment, id_route FROM ways WHERE id_way='$id_way'";
				$result1_goto = pg_query($conn, $sql1_goto);
				$vector_goto=pg_fetch_array($result1_goto);
				$gotouniversity=$vector_goto['touniversity'];
				$hour=$vector_goto['hour'];
				$date=$vector_goto['date'];
				$date_vec=explode(",",$date);
				$comentario=$vector_goto['comment'];
				$id_route_query=$vector_goto['id_route'];
				//parada inicio-final
				$cont_stop=0;
				$all_stops=array();

				//si el recorrido termina en la universidad ($start_uni=true) se cambia el orden de las rutas
				if ($touniversity == "true" ) {
					$sql30="SELECT * FROM route_stop WHERE id_route='$id_route_query' ORDER BY creation_date DESC";
				}else {
					$sql30="SELECT * FROM route_stop WHERE id_route='$id_route_query'";
				}
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

				$class="";
				if ($id_user_w==$idu || ($status_usr=="true" && $id_way==$way_usr_active) || $way_active==$id_way ) {
					$button="<a href='group-chat.php?id_way=$id_way'><img src='../Imagenes/group.png'/>Chat</a>";
				}else{
					$button="<a class='btn-pedirCupo' data-way='$id_way' data-usr='$idu'><img src='../Imagenes/pedir.png'/>Pedir</a>";
				}
				//crear el <div> de una publicacion
				$out_pub=make_publications(
									   $class,
									   $profile_image_user,
									   $id_user_w,
									   $full_name_user,
									   $comentario,
									   $inicio_stp,
									   $fin_stp,
									   $date_vec,
									   $hour,
									   $id_way,
									   $button,
									   $spots	);
				$output=$output.$out_pub;
			}}

			//cierra las llaves del while e if

			$array = array(
				'output' => "$output"
			);
			if (strlen($output)==0) {
				$array['output']="No hay resultados";
			}
	    		echo json_encode($array);
}
?>
