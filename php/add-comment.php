<?php
error_reporting(0);
include("../php/functions.php");
$conn=conectarse();
$id_user=$_GET['id_user'];
$name_user=$_GET['name_user'];
$id_way=$_GET['id_way'];
$comment=$_GET['comment'];

$sql="INSERT INTO comments (body,name_user,id_way,id_user) VALUES ('$comment','$name_user','$id_way','$id_user')";
$result = pg_query($conn, $sql);

$array = array(
	'send'=> "$comment"
);
echo json_encode($array);
?>
