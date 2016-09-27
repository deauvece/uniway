<?php
     extract($_POST);
     include("conec.php");
     //se puede con correo o contraseña
     if (isset($correo)) {
          $conn=conectarse();
          session_start(); //si esta bien puesta acá?

          //se busca primero por pasajeross
          $sql1="SELECT* FROM pasajero WHERE correo='$correo' AND password='$contrasena' ";
          $result1 = pg_query($conn,$sql1);
          $numFilas = pg_numrows($result1);
          //tal vez haya problema por los tres igualessss en el if, no?
          if ($numFilas===0) {
               //si no se encontró nada en pasajero se busca en ccondutor
               $sql2="SELECT* FROM conductor WHERE correo='$correo' AND password='$contrasena' ";
               $result2 = pg_query($conn,$sql2);
               $numFilas2 = pg_numrows($result2);
               if ($numFilas2===0) {
                    //busca en admin
                    $sql3="SELECT* FROM administrador WHERE correo='$correo' AND password='$contrasena' ";
                    $result3 = pg_query($conn,$sql3);
                    $numFilas3 = pg_numrows($result3);
                    if ($numFilas3===0) {
                         header("location:../login-user.php?errorusuario=si");
                    }else{
                         $vector=pg_fetch_array($result3);
                         //si definitivamente no encontro el id para administrador o no es el correcto
                         if (!$vector['id_administrador']) {
                              header("location:../login-user.php?errorusuario=si");
                         }else{
                              //si lo encontró inicia sesion y define las variables de sesion
                              $_SESSION['id_usuario']= $vector['id_administrador'];
                              $_SESSION['id_nombre_usuario']= $vector['nombres'];
                              header("location:../dataBase.html");
                         }
                    }

               }else{
                    $vector=pg_fetch_array($result2);
                    //si definitivamente no encontro el id para conductor o no es el correcto
                    if (!$vector['id_conductor']) {
                         header("location:../login.html");
                    }else{
                         //si lo encontró inicia sesion y define las variables de sesion
                         $_SESSION['id_usuario']= $vector['id_conductor'];
                         $_SESSION['id_nombre_usuario']= $vector['nombres'];
                         header("location:../Sesion/sesionOpen.html");
                    }

               }

          }else{
               $vector=pg_fetch_array($result1);
               //si definitivamente no encontro el id para conductor o no es el correcto
               if (!$vector['id_pasajero']) {
                    header("location:../login.html");
               }else{
                    //si lo encontró inicia sesion y define las variables de sesion
                    $_SESSION['id_usuario']= $vector['id_pasajero'];
                    $_SESSION['id_nombre_usuario']= $vector['nombres'];
                    header("location:../Sesion/sesionOpen.html");
               }
          }
     }

 ?>
