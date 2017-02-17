<?PHP
// llamar la funciones
include("functions.php");
$conn=conectarse();
extract($_POST);

//elimina todos los veheiculos relacionados con el usuario, por ahora siempre hay un solo vehuculo
$sql="DELETE FROM ways WHERE id_way='$id_way'";
$result = pg_query($conn, $sql);

header("location:../Sesion/sesionOpen.php");
?>
