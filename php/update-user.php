<?PHP
// llamar la funciones
include("functions.php");
include("hash_pass.php");
$conn=conectarse();
extract($_POST);


if (isset($_POST["email_public"])) {
	$email_public="f";
}else {
	$email_public="t";
}
if (isset($_POST["phone_public"])) {
	$phone_public="f";
}else {
	$phone_public="t";
}
if (isset($_POST["license_plate_public"])) {
	$license_plate_public="f";
}else {
	$license_plate_public="t";
}


//si ha cambiado la contraseña
echo $id_user;
echo "<br>";
echo $names;
echo "<br>";
echo "$phone";
echo "<br>";

if (!$nw_ps) {
	$sql2="UPDATE users SET names='$names',last_names='$last_names',phone='$phone',sex='$sex',email='$email' , email_public='$email_public' , phone_public='$phone_public' , license_plate_public='$license_plate_public' WHERE id_user='$id_user'  ";
}else{
	$encrpt_pswd= password_hash($nw_ps,PASSWORD_DEFAULT);
	$sql2="UPDATE users SET names='$names',last_names='$last_names',phone='$phone',sex='$sex',email='$email',password='$encrpt_pswd' , email_public='$email_public' , phone_public='$phone_public' , license_plate_public='$license_plate_public' WHERE id_user='$id_user'  ";
}

$result2 = pg_query($conn, $sql2);

session_start();
$_SESSION['id_nombre_usuario']= $names;
$_SESSION['id_apellido_usuario']= $last_names;
$_SESSION['user_phone']= $phone;
$_SESSION['user_email']= $email;
$_SESSION['user_sex']= $sex;
$_SESSION['email_public']= $email_public;
$_SESSION['phone_public']= $phone_public;
$_SESSION['license_plate_public']= $license_plate_public;

$sql11="SELECT * FROM users WHERE id_user='$id_user'";
$result11 = pg_query($conn, $sql11);
$vectorprueba=pg_fetch_array($result11);


echo "<br>cambios <br>";
echo $vectorprueba['names'];
echo "<br>";
echo $vectorprueba['phone'];


header("location:../sesion/userProfile.php?idu=myProfile&update=done");
?>
