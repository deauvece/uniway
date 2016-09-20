<!DOCTYPE html>
<html lang="es">
          <meta charset="utf-8">
          <title>Formulario Calificacion</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body>
     <?PHP
	     // llamar la funciones
	     include("barra_nav.php");
	     hacer_barra_nav();
     ?>

          <form  action="recibeCalificacion.php" method="post">
               <table >
               <tr>
                    <td colspan="2">
                         <h2 >Formulario Calificacion</h2>
                    </td>
               </tr>
               <tr>
                    <td>
                         Id Calificacion:
                    </td>
                    <td>
                         <select name="id_calificacion" required>
                              <option value="k001">k001</option>
                              <option value="k002">k002</option>
                              <option value="k003">k003</option>
                              <option value="k004">k004</option>
                              <option value="k005">k005</option>
                              <option value="k006">k006</option>
                              <option value="k007">k007</option>
                         </select>
                    </td>
               </tr>
               <tr>
                    <td>
                         Id Conductor:
                    </td>
                    <td>
                         <select name="id_Conductor" required>
                                   <?PHP 
                                         include("conec.php");
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
                                                   pg_free_result($result);
						   pg_close($conn);
                                   ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>
                         Id Pasajero:
                    </td>
                    <td>
                    <select name="id_Pasajero" required>
                                   <?PHP 

                                         $conn=conectarse();
                                         $sql1="SELECT * FROM pasajero";
                                         $result = pg_query($conn,$sql1);
                                         while ($vector=pg_fetch_array($result))
                                              {
                                                   ?>

                                                   <option value="<?PHP echo $vector['id_pasajero']?>">
                                                   <?PHP echo $vector['nombres']; ?>
                                                   <?PHP echo $vector['apellidos']; ?>
                                                   </option>
                                                      
                                                   <?PHP    
                                              }
                                                   pg_free_result($result);
						   pg_close($conn);
                                   ?>
                    </select>
                    </td>
               </tr>
               <tr>
                    <td>
                         Calificacion:
                    </td>
                    <td>
                         <table id="calificacion" cellpadding="15" >
                         <tr>
                              <td>
                                   1<input type="radio" name="calificacion" value="1">
                              </td>
                              <td>
                                   2<input type="radio" name="calificacion" value="2">
                              </td>
                              <td>
                                   3<input type="radio" name="calificacion" value="3">
                              </td>
                              <td>
                                   4<input type="radio" name="calificacion" value="4">
                              </td>
                              <td>
                                   5<input type="radio" name="calificacion" value="5" >
                              </td>
                         </tr>

                         </table>
                    </td>
               </tr>
               <tr>
                    <td>
                         Comentario:
                    </td>
                    <td>
                         <textarea name="comentario" rows="4" cols="40" autofocus placeholder="¿Algun comentario sobre tu experiencia con el/la conductor/conductora?"></textarea>
                    </td>
               </tr>
               <tr>
                    <td>
                         Fecha:
                    </td>
                    <td>
                         <input type="date" name="fecha_calificacion" required>
                    </td>
               </tr>
               <tr>
                    <td>
                         Hora:
                    </td>
                    <td>
                         <input type="time" name="hora_calificacion" required>
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
