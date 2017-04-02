<?php
	extract($_POST);


	//comprueba el correo institucional con los aceptados por la plataforma para cada universidad
	$email_split=explode("@",$institutional_email);
	//selecciona la parte despues del arroba
	$supported_emails=array('uis.edu.co','correo.uis.edu.co','unab.edu.co','gmail.com');
	$size_array=count($supported_emails);
	$confirmation="false";
	for ($i=0; $i < 4 ; $i++) {
		if ($email_split[1] == $supported_emails[$i] ) {
			$confirmation="true";
		}
	}

	if ($confirmation=="true") {
		//si está dentro de los soportados hace el envio del email
		//correo al que va dirigido
		$to = "$institutional_email";
		//correo del que lo envia
		$headers = "From: info@uniway.com";
		//subject
		$subject ="Verificacion de correo electronico UNIWAY";
		//genera dos numeros

		//generacion del token
		function generateRandomNumber($length = 4) {
		    //solo letras del alfabeto
		    $characters = '1234567890';
		    $NumberLength = strlen($characters);
		    $randomNumber = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomNumber .= $characters[rand(0, $NumberLength - 1)];
		    }
		    return $randomNumber;
		}
		$rand= generateRandomNumber();
		$rand2= generateRandomNumber();
		$tkn=$rand*$rand2*$rand2;
		session_start();
		$_SESSION['tkn1_user_verif']= $rand;
		$_SESSION['tkn2_user_verif']= $rand2;

		$link="http://www.uniway.heliohost.org/sesion/userProfile.php?idu=myProfile&tkn=$tkn";
		//content
		$content="Por favor haz click en el siguiente enlace para completar tu verificacion de correo institucional \n $link \n $rand \n $rand2 \n si no haz solicitado una verificacion por favor haz caso omiso a este mensaje. \n Att: admin uniway.";
		//envia el correo
		mail($to,$subject,$content,$headers);

		//redirecciona (verification => true)
		header("location:../sesion/userProfile.php?idu=myProfile&vr=tru#verif_info");
	}else{
		header("location:../sesion/userProfile.php?idu=myProfile&vr=fal#verif_info");
	}

 ?>
