<?php
     session_start();
     if ($_SESSION['id_nombre_usuario']) {
          session_destroy();
          header("location:home.html");
     }else{
          header("location:home.html");
     }
 ?>
