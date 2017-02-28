<?php
error_reporting(0);
include("../php/functions.php");

$id_user_query=$_GET['id_user_query'];
$conn=conectarse();
$sql3="SELECT * FROM users WHERE id_user='$id_user_query'";
$result3 = pg_query($conn,$sql3);
$vector=pg_fetch_array($result3);

$names = $vector['names'];
$last_names = $vector['last_names'];
$phone = $vector['phone'];
$sex = $vector['sex'];
$email = $vector['email'];
$is_driver = $vector['is_driver'];
$id_u = $vector['id_u'];
$is_verified = $vector['is_verified'];
$profile_image = $vector['profile_image'];
$email_public = $vector['email_public'];

if ($email_public=="f") {
	$email="No disponible";
}
$phone_public = $vector['phone_public'];
if ($phone_public=="f") {
	$phone="No disponible";
}

$full_name = $names." ".$last_names;

//university name and acornym query
$id_university=$vector['id_u'];
$sql11="SELECT * FROM universities WHERE id_u='$id_university'";
$result11 = pg_query($conn, $sql11);
$vectorUniversity11=pg_fetch_array($result11);

$university_acr=$vectorUniversity11["acronym"];
$university_name=$vectorUniversity11["name"];


$sql22="SELECT * FROM transports WHERE id_user='$id_user_query'";
$result22 = pg_query($conn, $sql22);
$vectorTransport=pg_fetch_array($result22);

$license_plate=$vectorTransport['license_plate'];
$model=$vectorTransport['model'];
$air_conditioner=$vectorTransport['air_conditioner'];
$wifi=$vectorTransport['wifi'];
$price=$vectorTransport['price'];
$type=$vectorTransport['type'];
$image=$vectorTransport['image'];

$license_plate_public = $vector['license_plate_public'];
if ($license_plate_public=="f") {
	$license_plate="No disponible";
}

$ar_stops=array('stop11','stop12','stop13','stop14','stop15','stop21','stop22','stop23','stop24','stop25'
,'stop31','stop32','stop33','stop34','stop35','stop41','stop42','stop43','stop44','stop45','stop51','stop52','stop53','stop54','stop55');

$sql2="SELECT id_route FROM routes WHERE id_user='$id_user_query'";
$result2 = pg_query($conn, $sql2);
while ($vector2=pg_fetch_array($result2))
     {
		$result_routes[]=$vector2['id_route'];
     }
$size_result_routes=count($result_routes);


$array = array(
	'full_name' => "$full_name",
	'phone' => "$phone",
	'sex' => "$sex",
	'email' => "$email",
	'is_driver' => "$is_driver",
	'is_verified' => "$is_verified",
	'university_acr' => "$university_acr",
	'university_name' => "$university_name",
	'profile_image' => "$profile_image",
	'license_plate' => "$license_plate",
	'model' => "$model",
	'air_conditioner' => "$air_conditioner",
	'wifi' => "$wifi",
	'price' => "$price",
	'tipo' => "$type",
	'image' => "$image",
	'num_routes' => "$size_result_routes"
);


$n=0;
for ($i=0; $i < $size_result_routes ; $i++) {
	//busca las paradas de la ruta
	$query=$result_routes[$i];
	$sql33="SELECT * FROM route_stop WHERE id_route='$query'";
	$result33 = pg_query($conn, $sql33);
	$vector33=pg_fetch_array($result33);
	for ($k=0; $k < 5 ; $k++) {
		$result_stops[]=$vector33['id_stop'];
		$vector33=pg_fetch_array($result33);
	}
	$size_result_stops=count($result_stops);
	for ($j=0; $j < $size_result_stops ; $j++) {
		$query_stop=$result_stops[$j];
		$sql4="SELECT name FROM stops WHERE id_stop='$query_stop'";
		$result4 = pg_query($conn, $sql4);
		$vector4=pg_fetch_array($result4);
		$array[$ar_stops[$n]]=$vector4['name'];
		$n++;
	}
	//libera el array
	unset($result_stops);
}

echo json_encode($array);
?>
