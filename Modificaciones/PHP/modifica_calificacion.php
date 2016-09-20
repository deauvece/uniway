<?PHP
// llamar la funciones
include("conec.php");
$conn=conectarse();
extract($_POST);
$sql1= "UPDATE calificacion SET  id_calificacion='".$id_calificacion."',id_conductor='".$id_conductor."',id_pasajero='".$id_pasajero."',calificacion='".$calificacion."',fecha_calificacion='".$fecha_calificacion."' ,hora_calificacion='".$hora_calificacion."' ,comentario='".$comentario."' where id_calificacion='".$id_calificacion."'";
$result1 = pg_query($conn,$sql1);

if($result1===0)
{
     ?>

		<script type="text/javascript">
                alert("ERROR, no se ha podido hacer la modificacion. intente de nuevo");
                window.history.go(-1);
          </script>

	<?php
}
else
{
     ?>

		<script type="text/javascript">
                     alert("YUJUU!! El registro ha sido modificado con exito!");
                     window.history.go(-2);
          </script>

	<?php
}
?>
