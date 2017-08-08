<?PHP
// llamar la funciones
include("functions.php");
$conn=conectarse();
extract($_POST);

//elimina todos los veheiculos relacionados con el usuario, por ahora siempre hay un solo vehuculo
$sql="DELETE FROM transports WHERE id_user='$id_user'";
$result = pg_query($conn, $sql);


$sql2="UPDATE users SET is_driver='no' WHERE id_user='$id_user'  ";
$result2 = pg_query($conn, $sql2);

session_start();
$_SESSION['is_driver']= "f";
header("location:../sesion/user_profile.php");
?>
