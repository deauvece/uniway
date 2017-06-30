<?php
	extract($_POST);
	//correo al que va dirigido
	$to = "deauvece@gmail.com";
	//correo del que lo envia
	$headers = "From: $email";
	//envia el correo
	mail($to,$subject,$content,$headers);


	//envia correo de constancia al usuario
	$mess="Haz enviado un correo de contacto a uniway, te estaremos respondiendo lo más pronto posible, si no enviaste ningun correo por favor haz caso omiso ha este mensaje. Att: admin uniway";
	$bool=mail($email,"Contacto Uniway",$mess,"From: info@uniway.com");

	$sended=True;
	if ($bool==False) {
		$sended=False;
	}
	$array = array(
		"sended"=>$sended
	);
	echo json_encode($array);
 ?>
