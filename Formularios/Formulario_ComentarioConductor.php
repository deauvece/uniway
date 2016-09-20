<!DOCTYPE html>
<html lang="es">
          
          <title>Comentario Conductor</title>
          
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body >
          <?PHP
     	     // llamar la funciones
     	     include("barra_nav.php");
     	     hacer_barra_nav();
          ?>

          <form  action="recibeComentarioConductor.php" method="post">
               <table   >
               	<tr>
                         <td colspan="2">
                              <h2 >Comentario Conductor</h2>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Id comentario_conductor:
                         </td>
                         <td>
                              <select name="id_comentario_conductor" required>
                                   <option value="cc0001">cc0001</option>
                                   <option value="cc0002">cc0002</option>
                                   <option value="cc0003">cc0003</option>
                                   <option value="cc0004">cc0004</option>
                                   <option value="cc0005">cc0005</option>
                                   <option value="cc0006">cc0006</option>
                                   <option value="cc0007">cc0007</option>
                              </select>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Ruta:
                         </td>
                         <td>
                              <select name="id_ruta" required>
                                    <?PHP 
                                         include("conec.php");
                                         $conn=conectarse();
                                         $sql1="SELECT * FROM ruta";
                                         $result = pg_query($conn,$sql1);
                                         while ($vector=pg_fetch_array($result))
                                              {
                                                   ?>

                                                   <option value="<?PHP echo $vector['id_ruta']?>" >
                                                   <?PHP echo $vector['id_ruta']; ?>
                                                   </option>
                                                      
                                                   <?PHP    
                                              }
                                    ?>
                              </select>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Conductor:
                         </td>
                         <td>
                              <select name="id_conductor" required>
                                   <?PHP
                                         $conn=conectarse();
                                         $sql1="SELECT * FROM conductor";
                                         $result = pg_query($conn,$sql1);
                                         while ($vector=pg_fetch_array($result))
                                              {
                                                   ?>

                                                   <option value="<?PHP echo $vector['id_conductor']?>" >
                                                   <?PHP echo $vector['nombres']; ?>
                                                   <?PHP echo $vector['apellidos']; ?>
                                                   </option>
                                                      
                                                   <?PHP    
                                              }
                                   ?>
                              </select>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Hora:
                         </td>
                         <td>
                              <input type="time" name="hora" required>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Fecha del comentario:
                         </td>
                         <td>
                              <input type="date" name="fecha_comentario" required>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Comentario:
                         </td>
                         <td>
                              <textarea name="contenido" cols="39" rows="5" autofocus required></textarea>
                         </td>
                    </tr>
                    <tr>
                         <td  colspan="2">
                              <input class="boton" type="reset" name="borrar" value="Borrar información">
                         </td>
                    </tr>
                    <tr>
                         <td  colspan="2">
                              <input class="boton" type="submit" name="registrar" value="Enviar datos" >
                         </td>

                    </tr>


               <tr>
                     <td  colspan="2">
                          <a href="../dataBase.html">
                              <input class="boton" type="button" name="volver" value="Volver" >
                          </a>
                     </td>

                </tr>

               </table>
          </form>

     </body>
</html>
