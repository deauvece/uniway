<?php 
include("email_validator.php");
$email=$_GET['email'];

$validator = new \EmailValidator\Validator();           
$isValid=True;

if($validator->isSendable($email)){
	$isValid=True;
}else{
	$isValid=False;
}


$array = array(
	"isValid"=>$isValid
);
echo json_encode($array);

?>
