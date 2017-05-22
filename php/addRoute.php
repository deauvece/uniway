<?PHP
// llamar la funciones
error_reporting(0);
include("functions.php");
$conn=conectarse();
extract($_POST);

//creacion del caracter aleatorio de tamaño CINCOO
function generateRandomString($length = 12) {
    //solo letras del alfabeto
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$rand= generateRandomString();
//insersion en la tabla de rutas
$sql="INSERT INTO routes (spots,id_user,rand) VALUES ('4','$id_user','$rand')";
$result = pg_query($conn, $sql);

//busqueda del id de la ruta
$sql_busqueda="SELECT id_route FROM routes WHERE rand='$rand'";
$result1 = pg_query($conn,$sql_busqueda);
$vector=pg_fetch_array($result1);
$id_route=$vector['id_route'];
//insersion en la tabla de usr_routes
$sql_user_routes="INSERT INTO usr_routes (id_user,id_route) VALUES ('$id_user','$id_route')";
$result_user_routes= pg_query($conn, $sql_user_routes);

//creacion de la relacion ruta-paradas
$vector_stops[0]=$stop1;
$vector_stops[1]=$stop2;
$vector_stops[2]=$stop3;
$vector_stops[3]=$stop4;
$vector_stops[4]=$stop5;
//POR AHORA SON CINCO PARADAS O MENOS
for ($i=0; $i < 5 ; $i++) {
  //busqueda del id de la parada
  if($vector_stops[$i]){

	$sql_search_id_stop_1="SELECT id_stop FROM stops WHERE name='$vector_stops[$i]'";
	$result_id_stop_1 = pg_query($conn,$sql_search_id_stop_1);
	$vector_STP_1=pg_fetch_array($result_id_stop_1);
	$id_stp_1=$vector_STP_1['id_stop'];


	if ($id_stp_1) {
		//insersion en la tabla compuesta si encuentra la parada
		$status="sleep";
		$sql_routes_stops_1="INSERT INTO route_stop (id_route,id_stop,status) VALUES ('$id_route','$id_stp_1','$status')";
		$result_insert_1= pg_query($conn, $sql_routes_stops_1);
	}else{
		//Si no está en la BD la crea
		$sql_insert_stop_0="INSERT INTO stops(name) VALUES ('$vector_stops[$i]')";
		$result_insert_stop= pg_query($conn, $sql_insert_stop_0);
		//la busca para insertarla en route_stop
		$sql_search_id_stop_2="SELECT id_stop FROM stops WHERE name='$vector_stops[$i]'";
		$result_id_stop_2 = pg_query($conn,$sql_search_id_stop_2);
		$vector_STP_2=pg_fetch_array($result_id_stop_2);
		$id_stp_1=$vector_STP_2['id_stop'];

		//insersion en la tabla compuesta si encuentra la parada
		$status="sleep";
		$sql_routes_stops_1="INSERT INTO route_stop (id_route,id_stop,status) VALUES ('$id_route','$id_stp_1','$status')";
		$result_insert_1= pg_query($conn, $sql_routes_stops_1);
	}
  }

}
header("location:../sesion/userProfile.php?idu=myProfile#userRutesBox");
?>
