<?PHP
/*================Se hace el proceso para comprobar el recaptcha===================*/
// coge la librería recaptcha
require_once "recaptchalib.php";

//Para imprimir los datos enviados por el formulario, solo era para comprobar
/*foreach ($_POST as $key => $value) {
echo '<p><strong>' . $key.':</strong> '.$value.'</p>';
}*/

//clave secreta
$secret = "6LdlABcUAAAAAN8n0ysKFiyhC9BkICAl_Ztw3oJh";
//respuesta vacía
$response = null;
//comprueba la clave secreta
$reCaptcha = new ReCaptcha($secret);

// si se detecta la respuesta como enviada
if ($_POST["g-recaptcha-response"]) {
$response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}

if ($response != null && $response->success) {
			//si hubo exito se procede a hacer el registro del usuario
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
			  $names=strtolower($names);
			  $last_names=strtolower($last_names);
			  $profile_image="../Imagenes/profileImages/upload/perfil.png";
			  $sql3="INSERT INTO users ( names, last_names, phone, email, password, id_u,profile_image)
			  VALUES ('$names', '$last_names', '$phone', '$email', '$encrpt_pswd', '$id_u', '$profile_image')";
			  $result = pg_query($conn, $sql3);
			  header("location:../login-user.php");
			}
   } else {
	   header("location:../register_user.php?error_captcha=y");
   }

/*===========================================================================================*/

?>
