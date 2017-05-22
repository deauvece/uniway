<?php
error_reporting(0);
include("../php/functions.php");
$conn=conectarse();
#POST
$id_user=$_POST['id_user'];
$id_user_make=$_POST['id_user_make'];


$sql="DELETE FROM qualifications WHERE id_user='$id_user' AND id_user_make='$id_user_make'";
$result = pg_query($conn, $sql);
if ($conn) {
	//inserta el comentario
	$response="success";
}else{
	$response="error";
}


$array = array(
	'response'=> "$response"
);
echo json_encode($array);
?>
