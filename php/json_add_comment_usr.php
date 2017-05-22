<?php
error_reporting(0);
include("../php/functions.php");
$conn=conectarse();
#POST
$id_user=$_POST['id_user'];
$id_user_make=$_POST['id_user_make'];
$comment=$_POST['text'];
$score=$_POST['score'];

//consulta si ya hay un comentario de ese usuario al otro
$sql="SELECT * FROM qualifications WHERE id_user='$id_user' AND id_user_make='$id_user_make' ";
$result=pg_query($conn,$sql);
$num_result= pg_num_rows($result);
if ($num_result==0) {
	//inserta el comentario
	$sql0="INSERT INTO qualifications (id_user,id_user_make,comment,score) VALUES ('$id_user','$id_user_make','$comment', '$score')";
	$result0=pg_query($conn, $sql0);
	$response="success";
}else{
	$response="Ya has calificado a este usuario";
}


$array = array(
	'response'=> "$response"
);
echo json_encode($array);
?>
