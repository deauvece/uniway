<?PHP
// llamar la funciones
include("functions.php");
$conn=conectarse();
extract($_POST);

//true=> usuario activo
$status_user="true";
$sql3="UPDATE users SET status_way='$status_user' WHERE id_user='$id_user'";
$result3 = pg_query($conn, $sql3);

$sql="INSERT INTO ways (hour,id_user,id_route,spots,touniversity,comment,id_u,max_spots) VALUES ('$timepicker','$id_user','$id_ruta','$spots','$touniversity','$comment','$id_u','$spots')";
$result = pg_query($conn, $sql);

//lo agrega a usr_ways
$sql4="SELECT * FROM ways WHERE id_user='$id_user'";
$result4 = pg_query($conn,$sql4);
$vector4=pg_fetch_array($result4);
$id_way_this = $vector4['id_way'];

$sql00="INSERT INTO usr_ways (id_user,id_way) VALUES ('$id_user','$id_way_this')";
$result00 = pg_query($conn, $sql00);


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

header("location:../sesion/sesionOpen.php");
?>
