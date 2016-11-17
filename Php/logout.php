<?php
     session_start();
     if ($_SESSION['id_nombre_usuario']) {
            session_unset(); //unset borra todas las variables del array global $_session
            session_destroy(); //La llamada a session_destroy() eliminará toda la información asociada con la sesión en el servidor.
            header("location:../home.html");
     }else{
          header("location:../home.html");
     }
 ?>
