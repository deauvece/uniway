<?PHP
// llamar la funciones
include("functions.php");
$conn=conectarse();
extract($_POST);

$sql2="UPDATE users SET names='$names',last_names='$last_names',phone='$phone',email='$email' WHERE id_user='$id_user'  ";
$result2 = pg_query($conn, $sql2);

session_start();
$_SESSION['id_nombre_usuario']= $names;
$_SESSION['id_apellido_usuario']= $last_names;
$_SESSION['user_phone']= $phone;
$_SESSION['user_email']= $email;

header("location:../Sesion/userProfile.php?idu=myProfile");
?>
