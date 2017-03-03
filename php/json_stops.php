<?php
class Ajax {
  public $buscador;

  public function Buscar($a){
    $b=strtoupper($a);
    $this->buscador = $b;
    
    //se hace la conexion con la base de datos
    include("../php/functions.php");
    $conn=conectarse();
    $sql1="SELECT * FROM stops WHERE name LIKE '%$this->buscador%' ";
    $result1 = pg_query($conn, $sql1);
    while ($vector=pg_fetch_array($result1))
         {
           $resultado[]=$vector['name'];
         }
    return $resultado;
  }
}

$busqueda= new Ajax();
echo json_encode($busqueda->Buscar($_GET['term'])) ;









?>
