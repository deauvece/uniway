<?PHP
// llamar la funciones
include("functions.php");
$conn=conectarse();
extract($_POST);

$sql="DELETE * INTO transports WHERE licence_plate='$license_plate'";
$result = pg_query($conn, $sql);


$sql2="UPDATE users SET is_driver='false' WHERE id_user='$id_user'  ";
$result2 = pg_query($conn, $sql2);
session_start();
$_SESSION['is_driver']= "f";
header("location:../Sesion/userProfile.php?idu=myProfile");
?>
