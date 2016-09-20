<?PHP
// llamar la funciones
include("conec.php");
$conn=conectarse();
extract($_POST);
$sql1= "UPDATE pasajero SET  id_pasajero='".$id_pasajero."',nombres='".$nombres."'
,apellidos='".$apellidos."',id_genero='".$id_genero."',fecha_nacimiento='".$fecha_nacimiento."'
,ciudad='".$ciudad."' ,telefono='".$telefono."' ,correo='".$correo."' ,profesion='".$profesion."'
,password='".$password."' ,documento='".$documento."' ,correo_inst='".$correo_inst."'
,id_universidad='".$id_universidad."'  where id_pasajero='".$id_pasajero."'";
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
