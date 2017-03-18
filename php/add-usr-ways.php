<?php
error_reporting(0);
include("../php/functions.php");
$conn=conectarse();
$id_user_q=$_GET['id_user_q'];
$id_way_q=$_GET['id_way_q'];

//status  yes== si se agrega al grupo del recorrido
//no=  no se agrega al grupo del recorrido
$status="yes";
$message="";

//busca los cupos disponibles en el recorrido
$sql="SELECT * FROM ways WHERE id_way='$id_way_q'";
$result=pg_query($conn, $sql);
$vector=pg_fetch_array($result);
$spots=$vector['spots'];
if ($spots==0) {
	$status="no";
	$message="Lo sentimos, ya no hay cupos disponibles en este recorrido";
}
//buscar que no esté en otro recorrido (solo puede estar en uno)
$sql0="SELECT * FROM users WHERE id_user='$id_user_q'";
$result0=pg_query($conn, $sql0);
$vector0=pg_fetch_array($result0);
$status_usr=$vector0['status_way'];
$name_usr=$vector0['names'];
	//true=>usuario ya está activo
if ($status_usr=="true") {
	$status="no";
	$message="No puedes pedir otro cupo mientras estés en otro recorrido";
}

if ($status=="yes") {
	//se actualizan los datos y se agrega al grupo
	//actualiza estado del usuario
	//true==activo
	$sql1="UPDATE users SET status_way='true' WHERE id_user='$id_user_q' ";
	$result1 = pg_query($conn, $sql1);
	//actualiza datos del recorrido
	//////////////////////////////////// si va a actualizar y ya está en cero? atomicidad!
	$spots=$spots-1;
	$sql2="UPDATE ways SET spots='$spots' WHERE id_way='$id_way_q' ";
	$result2 = pg_query($conn, $sql2);
	//lo agrega al grupo del recorrido
	$sql3="INSERT INTO usr_ways (id_user,id_way) VALUES ('$id_user_q','$id_way_q')";
	$result3 = pg_query($conn, $sql3);
	//notifica la entrada del usuario
	$comm=$name_usr." se ha unido al grupo.";
	$sql4="INSERT INTO comments (body,name_user,id_way,id_user) VALUES ('$comm','Uniway','$id_way_q','none')";
	$result4 = pg_query($conn, $sql4);
}


$array = array(
	'state' => "$status",
	'message'=> "$message"
);
echo json_encode($array);
?>
