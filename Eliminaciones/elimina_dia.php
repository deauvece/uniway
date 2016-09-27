<?PHP
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
extract($_POST);
include("../Php/conec.php");
$conn=conectarse();
$sql1= "DELETE FROM dia where id_dia='".$codigo."'";
$result1 = pg_query($conn,$sql1);
if($result1==0)
{
	?>

		<script type="text/javascript">
                     alert("ERROR, el registro no se ha podido eliminar");
                     window.history.go(-1);
               </script>

	<?php
}
else
{
	?>

		<script type="text/javascript">
                     alert("El registro ha sido eliminado con exito! actualiza la pagina para ver los cambios.");
                     window.history.go(-1);
               </script>

	<?php
}
?>
