<?php
error_reporting(0);
include("../Php/functions.php");

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

$full_name = $names." ".$last_names;

//university name and acornym query
$id_university=$vector['id_u'];
$sql11="SELECT * FROM universities WHERE id_u='$id_university'";
$result11 = pg_query($conn, $sql11);
$vectorUniversity11=pg_fetch_array($result11);

$university_acr=$vectorUniversity11["acronym"];
$university_name=$vectorUniversity11["name"];


$array = array(
	'full_name' => "$full_name",
	'phone' => "$phone",
	'sex' => "$sex",
	'email' => "$email",
	'is_driver' => "$is_driver",
	'is_verified' => "$is_verified",
	'university_acr' => "$university_acr",
	'university_name' => "$university_name",
	'profile_image' => "$profile_image"
);
echo json_encode($array);
?>
