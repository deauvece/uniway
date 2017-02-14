<?php
error_reporting(0);
include("../Php/functions.php");
$conn=conectarse();

$id_user_query=$_GET['id_user_query'];
$array = array(
	'textsended' => "$id_user_query"
);
echo json_encode($array);
?>
