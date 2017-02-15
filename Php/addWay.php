<?PHP
// llamar la funciones
include("functions.php");
$conn=conectarse();
extract($_POST);
$sql="INSERT INTO ways (hour,id_user,id_route,spots,touniversity,comment) VALUES ('$timepicker','$id_user','$id_ruta','$spots','$touniversity','$comment')";
$result = pg_query($conn, $sql);
//para identificar que la ruta del recorrido se encuentra en alguna publicacion
$status="active";
$sql2="UPDATE route_stop SET status='$status' WHERE id_route='$id_ruta'  ";
$result2 = pg_query($conn, $sql2);

?>
<!--vuelve a la pagina anterior-->
<script type="text/javascript">window.history.go(-1);</script>
