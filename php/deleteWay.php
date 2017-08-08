<?PHP
// llamar la funciones
error_reporting(0);
include("functions.php");
$conn=conectarse();
extract($_POST);

//cambia el estado de todos los usuarios que estan en el grupo
$sql2="SELECT * FROM usr_ways WHERE id_way='$id_way'";
$result2 = pg_query($conn, $sql2);
while ($vector2=pg_fetch_array($result2)) {
	$id_user=$vector2['id_user'];
	$sql22="UPDATE users SET status_way='false' WHERE id_user='$id_user' ";
	$result22 = pg_query($conn, $sql22);
}

//elimina todos los vehiculos relacionados con el usuario, por ahora siempre hay un solo vehiculo
$sql="DELETE FROM ways WHERE id_way='$id_way'";
$result = pg_query($conn, $sql);


session_start();
//datos de usuario
$idu=$_SESSION['id_usuario'];
$sql1="UPDATE users SET status_way='false' WHERE id_user='$idu' ";
$result1 = pg_query($conn, $sql1);

header("location:../sesion/home.php");
?>
