<?PHP
// llamar la funciones
error_reporting(0);
include("functions.php");
$conn=conectarse();
extract($_GET);

//comprueba si no está en una publicacion (si está en una no se puede eliminar)
$sql0="SELECT * FROM ways WHERE id_route='$id_route'";
$result0 = pg_query($conn, $sql0);
$vector=pg_fetch_array($result0);
$route=$vector['id_route'];

if (!$route) {
	$result="success";
	//elimina la ruta
	$sql="DELETE FROM routes WHERE id_route='$id_route'";
	$result2 = pg_query($conn, $sql);
}else{
	$result="fail";
}


$array = array( 'val' => "$result" 	);

echo json_encode($array);

?>
