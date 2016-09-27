<?PHP
// llamar la funciones
include("../../Php/conec.php");
$conn=conectarse();
extract($_POST);
$sql1= "UPDATE ruta_conductor SET  id_conductor='".$id_conductor."',id_ruta='".$id_ruta."' where id_conductor='".$id_conductor."'";
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
