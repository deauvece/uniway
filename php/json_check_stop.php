<?php

error_reporting(0);
include("../php/functions.php");
$conn=conectarse();
extract($_POST);

$name_stop=strtoupper($name_stop);

$sql="SELECT * FROM stops WHERE name='$name_stop'";
$result = pg_query($conn, $sql);

$vector=pg_fetch_array($result);
$result_name=$vector['name'];

if (!$result_name) {
	$result_name="fail";
}else{
	$result_name="success";
}

$array = array( 'val' => "$result_name" 	);
echo json_encode($array);
 ?>
