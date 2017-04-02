<?PHP
// llamar la funciones
error_reporting(0);
include("functions.php");
$conn=conectarse();
extract($_GET);

//elimina
$sql="DELETE FROM routes WHERE id_route='$id_route'";
$result = pg_query($conn, $sql);

?>
