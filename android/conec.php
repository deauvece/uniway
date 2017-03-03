<?PHP
function conectarse()
{
   if (!($conn=pg_connect("host=localhost user=deauvece port=5432 dbname=deauvece_uniway password=P?'oG0s+")))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }

  if (!pg_dbname())
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
  return $conn;
}
?>
