<?PHP
// llamar la funciones
include("functions.php");
$conn=conectarse();
extract($_POST);
$sql="INSERT INTO ways (hour,id_user,id_route,spots,touniversity,comment,id_u) VALUES ('$timepicker','$id_user','$id_ruta','$spots','$touniversity','$comment','$id_u')";
$result = pg_query($conn, $sql);
//para identificar que la ruta del recorrido se encuentra en alguna publicacion
$status="active";
$sql2="UPDATE route_stop SET status='$status' WHERE id_route='$id_ruta'  ";
$result2 = pg_query($conn, $sql2);


//creacion del caracter aleatorio de tamaño
function generateRandomString($length = 20) {
    //solo letras del alfabeto
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$rand=generateRandomString();
$sql22="UPDATE status_feed SET random_string='$rand' WHERE id_status='$id_u'  ";
$result2 = pg_query($conn, $sql22);

header("location:../Sesion/sesionOpen.php");
?>
