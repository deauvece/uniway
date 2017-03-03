<?PHP
// llamar la funciones
include("conec.php");
$conn=conectarse();
extract($_POST);

$sql="INSERT INTO ways (hour,id_user,id_route,spots,touniversity,comment) VALUES ('$time','$id_user','$id_ruta','$spots','$touniversity','$comment')";
$result = pg_query($conn, $sql);
?>
<!--vuelve a la pagina anterior-->
<script type="text/javascript">window.history.go(-1);</script>
