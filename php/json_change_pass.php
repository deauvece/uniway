<?php
	include("../php/functions.php");
	$change_pass_email=$_GET['change_pass_email'];
	$response="succes";

	//verifica si email==null
	if (!$change_pass_email) {
		$response="no_email";
	}else{

	//verifica si el email está en la BD
		$conn=conectarse();
		$sql="SELECT * FROM users WHERE email='$change_pass_email'";
		$result=pg_query($conn,$sql);
		$num_result= pg_num_rows($result);
		if ($num_result==0) {
	//no existe un usuario con este email
			$response="doesnt_exist";
		}else{
			$vector=pg_fetch_array($result);
			$id_user=$vector['id_user'];
	//genera la nueva contraseña
			//creacion del caracter aleatorio de tamaño 12
			function generateRandomString($length = 12) {
			    //solo letras del alfabeto
			    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			    $charactersLength = strlen($characters);
			    $randomString = '';
			    for ($i = 0; $i < $length; $i++) {
			        $randomString .= $characters[rand(0, $charactersLength - 1)];
			    }
			    return $randomString;
			}
			$rand= generateRandomString();
	//envia un correo con las instrucciones
	//crea un codigo de confirmacion de cambio de contraseña
			$pass_conf_code=generateRandomString();
			$sql2="UPDATE users SET pass_conf_code='$pass_conf_code' WHERE email='$change_pass_email'  ";
			$result2 = pg_query($conn, $sql2);
			$mess="\nHaz solicitado un cambio de contraseña\n\nTu nueva contraseña es: $rand\nPara aplicar los cambios y modificar la contraseña haz click en el siguiente enlace\n uniway.heliohost.org/php/make_change_pass.php?nwps=$rand&idusr=$id_user&cnfcd=$pass_conf_code";
			mail($change_pass_email,"Uniway | Solicitud cambio de contraseña",$mess,"From: info@uniway.com");
			$response="success";
		}
	}

	$array = array(
		'response' => "$response"
	);
	echo json_encode($array);

?>
