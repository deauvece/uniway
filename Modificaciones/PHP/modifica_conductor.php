<?PHP
// llamar la funciones
include("conec.php");
$conn=conectarse();
extract($_POST);
$sql1= "UPDATE conductor SET  id_conductor='".$id_conductor."',nombres='".$nombres."'
,apellidos='".$apellidos."',id_genero='".$id_genero."',fecha_nacimiento='".$fecha_nacimiento."'
,profesion='".$profesion."' ,ciudad='".$ciudad."' ,telefono='".$telefono."' ,correo='".$correo."'
,id_dia='".$id_dia."' ,password='".$password."' ,correo_inst='".$correo_inst."' ,documento='".$documento."'
,id_universidad='".$id_universidad."'  where id_conductor='".$id_conductor."'";
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
