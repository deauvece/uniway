<?php
error_reporting(0);
include("../php/functions.php");
$conn=conectarse();
$id_way=$_GET['id_way'];


$sql22="SELECT * FROM ways WHERE id_way='$id_way'";
$result22=pg_query($conn, $sql22);
$vector22=pg_fetch_array($result22);
$id_route=$vector22['id_route'];


$sql33="SELECT * FROM route_stop WHERE id_route='$id_route'";
$result33=pg_query($conn, $sql33);
$array = array(
	"stp1"=>"",
	"stp2"=>"",
	"stp3"=>"",
	"stp4"=>"",
	"stp5"=>"",
	"stp6"=>"",
	"size"=>""
);
$names=["stp1","stp2","stp3","stp4","stp5","stp6"];
$cont=0;
while ($vector33=pg_fetch_array($result33)) {
	$id_stop=$vector33['id_stop'];
	$sql44="SELECT name FROM stops WHERE id_stop='$id_stop'";
	$result44=pg_query($conn, $sql44);
	$vector44=pg_fetch_array($result44);
	$array[$names[$cont]]=$vector44['name'];
	$cont++;
}
$array["tam"]=$cont;
echo json_encode($array);
?>
