<?PHP
// llamar la funciones
include("functions.php");
$conn=conectarse();
extract($_POST);

//elimina todos los veheiculos relacionados con el usuario, por ahora siempre hay un solo vehuculo
$sql="DELETE FROM ways WHERE id_way='$id_way'";
$result = pg_query($conn, $sql);

session_start();
//datos de usuario
$idu=$_SESSION['id_usuario'];
$sql1="UPDATE users SET status_way='false' WHERE id_user='$idu' ";
$result1 = pg_query($conn, $sql1);

header("location:../sesion/sesionOpen.php");
?>
