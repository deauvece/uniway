<?php

     extract($_POST);
     error_reporting(0);
     include("functions.php");
     include("hash_pass.php");
     if (isset($correo)) {
          $conn=conectarse();
          $sql3="SELECT * FROM users WHERE email='$correo'";
          $result3 = pg_query($conn,$sql3);
          $vector=pg_fetch_array($result3);
          $encrypt_pass =$vector['password'];
          $verif= password_verify($contrasena, $encrypt_pass );
          if (!$verif) {
              header("location:../login-user.php?errorusuario=si");
          }else{
              session_start();
              $_SESSION['id_usuario']= $vector['id_user'];
              $_SESSION['id_nombre_usuario']= $vector['names'];
              $_SESSION['id_apellido_usuario']= $vector['last_names'];
		    $_SESSION['user_phone']= $vector['phone'];
		    $_SESSION['user_sex']= $vector['sex'];
		    $_SESSION['user_email']= $vector['email'];
		    $_SESSION['is_driver']= $vector['is_driver'];
		    $_SESSION['id_university']= $vector['id_u'];
		    $_SESSION['is_verified']= $vector['is_verified'];
		    $_SESSION['profile_image']= $vector['profile_image'];
              $_SESSION['activo'] = true;
              $_SESSION['admin'] = $vector['is_admin'];
		    $_SESSION['email_public'] = $vector['email_public'];
		    $_SESSION['phone_public'] = $vector['phone_public'];
		    $_SESSION['license_plate_public'] = $vector['license_plate_public'];

		    //university name and acornym query
		    $id_university=$vector['id_u'];
		    $_SESSION['user_id_university']=$id_university;
		    $sql11="SELECT * FROM universities WHERE id_u='$id_university'";
		    $result11 = pg_query($conn, $sql11);
		    $vectorUniversity11=pg_fetch_array($result11);
		    $_SESSION['user_university_acr']= $vectorUniversity11["acronym"];
		    $_SESSION['user_university']= $vectorUniversity11["name"];

              if($vector['is_admin']=='t') {
                header("location:../sesion/sesionOpen.php");
              }else {
                header("location:../sesion/maintenance.php");
              }
            }
          }

 ?>
