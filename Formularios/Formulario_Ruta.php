<!DOCTYPE html>
<html lang="es">
          <meta charset="utf-8">
          <title>Formulario Ruta</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body >
          <?PHP
     	     // llamar la funciones
     	     include("barra_nav.php");
     	     hacer_barra_nav();
          ?>
          <font>
          <form  action="recibeRuta.php" method="post">
               <table  >
               	<tr>
                         <td colspan="2">
                              <h2 >Formulario Ruta</h2>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Id Ruta:
                         </td>
                         <td>
                              <select name="id_ruta" required>
                                   <option value="r001">r001</option>
                                   <option value="r002">r002</option>
                                   <option value="r003">r003</option>
                                   <option value="r004">r004</option>
                                   <option value="r005">r005</option>
                                   <option value="r006">r006</option>
                                   <option value="r007">r007</option>
                              </select>
                         </td>
                    <tr>

                    <tr>
                         <td>
                              Hora:
                         </td>
                         <td>
                              <input type="time" name="hora"  autofocus required>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Ida o Salida:
                         </td>
                         <td>
                              <input type="radio" name="idaOsalida" value="ida">Ida
                              <input type="radio" name="idaOsalida" value="Salida">Salida
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Cupos disponibles:
                         </td>
                         <td>
                              <select name="cupos" required>
                                   <option value="1">Un cupo</option>
                                   <option value="2">Dos cupos</option>
                                   <option value="3">Tres cupos</option>
                                   <option value="4" selected>Cuatro cupos</option>
                                   <option value="5">Cinco cupos</option>
                              </select>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Dia:
                         </td>
                         <td>
                              <select name="picoYplaca" required>
                                   <option value="d01">Lunes</option>
                                   <option value="d02">Martes</option>
                                   <option value="d03">Miercoles</option>
                                   <option value="d04">Jueves</option>
                                   <option value="d05">Viernes</option>
                              </select>
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
