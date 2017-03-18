<?PHP
// llamar la funciones
include("functions.php");
$conn=conectarse();
extract($_POST);

//notifica la salida del usuario al grupo
$sql0="SELECT * FROM users WHERE id_user='$id_user'";
$result0 = pg_query($conn, $sql0);
$vector0=pg_fetch_array($result0);
$name_usr=$vector0['names'];

$comm=$name_usr." ha salido del grupo.";
$sql4="INSERT INTO comments (body,name_user,id_way,id_user) VALUES ('$comm','Uniway','$id_way','none')";
$result4 = pg_query($conn, $sql4);

//elimina al usuario del grupo
$sql="DELETE FROM usr_ways WHERE id_user='$id_user'";
$result = pg_query($conn, $sql);

//cambia el estado del usuario
$sql1="UPDATE users SET status_way='false' WHERE id_user='$id_user'";
$result1 = pg_query($conn, $sql1);

//cambia los cupos disponibles del recorrido +1
$sql2="SELECT * FROM ways WHERE id_way='$id_way'";
$result2 = pg_query($conn, $sql2);
$vector2=pg_fetch_array($result2);
$spots=$vector2['spots'];

$spots++;
$sql3="UPDATE ways SET spots='$spots' WHERE id_way='$id_way'";
$result3 = pg_query($conn, $sql3);

header("location:../sesion/sesionOpen.php");
?>
