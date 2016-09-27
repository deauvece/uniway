<?PHP
// llamar la funciones
include("../../Php/conec.php");
$conn=conectarse();
extract($_POST);
$sql1= "UPDATE transporte SET  id_transporte='".$id_transporte."',placas='".$placas."'
,cupos='".$cupos."',tipo_transporte='".$tipo_transporte."',aire_acondicionado='".$aire_acondicionado."'
,precio='".$precio."' ,modelo_transporte='".$modelo_transporte."' ,wifi='".$wifi."'
,id_color='".$id_color."' where id_transporte='".$id_transporte."'";
$result1 = pg_query($conn,$sql1);

if($result1==0)
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
