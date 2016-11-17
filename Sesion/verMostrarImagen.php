<?php
//aqui se muestra la imagen que se subi
    session_start();
    $idu=$_SESSION['id_usuario'];
    if(!$idu){
      echo "no hay idu";
      echo "<br>";
    }
    $ruta="../Imagenes/profileImages/upload/profile_".$idu;
    echo $ruta;
    echo "<br>";

    ?>
<!DOCTYPE html> 
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <title>Ver mostrar imagen</title>
  </head>
  <body>
    <form  action="../Imagenes/profileImages/subirImagen.php" method="post" enctype="multipart/form-data" >
      <input type="file" name="file" accept="image/*" required>
      <br>
      <br>
      <button type="submit" name="button">Subir imagen</button>
    </form>
    <br>
    <br>
    <br>
    <p>
      Esta es la imagen que se subio
    </p>
    <img src="<?php echo $ruta;?>" alt="" />

  </body>
</html>
