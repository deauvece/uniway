<?php
     extract($_POST);
     error_reporting(0);
     include("conec.php");
     include("hash_pass.php");
     if (isset($correo)) {
          $conn=conectarse();

          $sql3="SELECT * FROM users WHERE email='$correo'";
          $result3 = pg_query($conn,$sql3);
          $vector=pg_fetch_array($result3);
          $encrypt_pass =$vector['password'];
          $verif= password_verify($contrasena, $encrypt_pass );
          //si definitivamente no encontro el id para usuario o no es el correcto
          if (!$verif) {
              header("location:../login-user.php?errorusuario=si");
          }else{
              //si lo encontró inicia sesion y define las variables de sesion
              session_start();
              $_SESSION['id_usuario']= $vector['id_user'];
              $_SESSION['id_nombre_usuario']= $vector['names'];
              $_SESSION['id_apellido_usuario']= $vector['last_names'];
              $_SESSION['activo'] = true;
              $_SESSION['admin'] = $vector['is_admin'];
              if($vector['is_admin']=='t') {
                header("location:../Sesion/sesionOpen.php");
              }else {
                header("location:../Sesion/maintenance.php");
              }
            }
          }

 ?>
