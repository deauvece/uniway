<?PHP
extract($_POST);
include("functions.php");
include("hash_pass.php");
$conn=conectarse();
//comprueba que no exista el correo electornico
$sql1="SELECT email FROM users";
$resultado = pg_query($conn,$sql1);
$existemail="false";
while ($vector=pg_fetch_array($resultado))
     {
        $emailbd= $vector['email'];
          if ($email == $emailbd) {
            $existemail="true";
          }
     }
if ($existemail!="false") {
  header("location:../register_user.php?emailerror=true");
}else{
  $encrpt_pswd= password_hash($password,PASSWORD_DEFAULT);
  //imagen predeterminada de perfil
  $profile_image="../Imagenes/profileImages/upload/perfil.png";
  $sql3="INSERT INTO users ( names, last_names, phone, sex, email, password, id_u,profile_image)
  VALUES ('$names', '$last_names', '$phone', '$sex', '$email', '$encrpt_pswd', '$id_u', '$profile_image')";
  $result = pg_query($conn, $sql3);
  header("location:../login-user.php");
}
?>
