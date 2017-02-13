<?PHP
// llamar la funciones
include("functions.php");
$conn=conectarse();
extract($_POST);

echo "$id_user";
echo "<br>";
echo "$license_plate";

$sql="DELETE FROM transports WHERE id_user='$id_user'";
$result = pg_query($conn, $sql);


$sql2="UPDATE users SET is_driver='no' WHERE id_user='$id_user'  ";
$result2 = pg_query($conn, $sql2);

session_start();
$_SESSION['is_driver']= "f";
header("location:../Sesion/userProfile.php?idu=myProfile");
?>
