<?php
error_reporting(0);
include("../Php/functions.php");
$conn=conectarse();
$stop_query=$_GET['stop_query'];

//Busca una parada para el texto introducido
$sql1="SELECT id_stop FROM stops WHERE name LIKE '%$stop_query%' ";
$result1 = pg_query($conn, $sql1);
$vector=pg_fetch_array($result1);
$result_stop=$vector['id_stop'];

//Busca una ruta que tenga la parada y esté activa
$sql2="SELECT id_route FROM route_stop WHERE id_stop='".$result_stop."' AND status='active' ";
$result2 = pg_query($conn, $sql2);
while ($vector2=pg_fetch_array($result2))
     {
		$result_routes[]=$vector2['id_route'];
     }
	$size_result_routes=count($result_routes);

	for ($i=0; $i < $size_result_routes ; $i++) {
		//Busca un recorrido que tenga la ruta
		$query=$result_routes[$i];
		$sql3="SELECT id_way FROM ways WHERE id_route='".$query."' ";
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
	$profile_images=array('prof_img1','prof_img2','prof_img3','prof_img4','prof_img5','prof_img6','prof_img7','prof_img8','prof_img9','prof_img10');
	$comments=array('comment1','comment2','comment3','comment4','comment5','comment6','comment7','comment8','comment9','comment10');
	$spots=array('spot1','spot2','spot3','spot4','spot5','spot6','spot7','spot8','spot9','spot10');
	$toUniversity=array('toUni1','toUni2','toUni3','toUni4','toUni5','toUni6','toUni7','toUni8','toUni9','toUni10');
	$ways_id=array('way1','way2','way3','way4','way5','way6','way7','way8','way9','way10');
	$rutas=array('ruta1','ruta2','ruta3','ruta4','ruta5','ruta6','ruta7','ruta8','ruta9','ruta10');
	$array = array(
		'num_results' => $size_result_ways,
		'textsended' => "$stop_query"
	);
	for ($i=0; $i < $size_result_ways ; $i++) {
		$query=$result_way[$i];
		$sql3="SELECT * FROM ways WHERE id_way='".$query."' ";
		$result3 = pg_query($conn, $sql3);
		while ($vector3=pg_fetch_array($result3))
			{
				$array[$ways_id[$i]]=$vector3['id_way'];
				$array[$hours[$i]]=$vector3['hour'];
				$array[$rutas[$i]]=$vector3['id_route'];
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
					$array[$profile_images[$i]]=$vector11['profile_image'];
			}
	}


echo json_encode($array);
?>
