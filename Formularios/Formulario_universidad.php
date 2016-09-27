<!DOCTYPE html>
<html lang="es">
          <meta charset="utf-8">
          <title>Formulario Universidad</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body>
          <?PHP
     	     // llamar la funciones
     	     include("../Php/barra_nav.php");
     	     hacer_barra_nav();
          ?>
          <form  action="recibeUniversidad.php" method="post">
               <table >
               <tr>
                    <td colspan="2">
                         <h2 >Formulario Universidad</h2>
                    </td>
               </tr>
               <tr>
                    <td>
                         Id Universidad:
                    </td>
                    <td>
               	<select name="id_universidad" required>
                         <option value="u01">u01</option>
                         <option value="u02">u02</option>
                         <option value="u03">u03</option>
                         <option value="u04">u04</option>
                         <option value="u05">u05</option>
                         <option value="u06">u06</option>
                         <option value="u07">u07</option>
                         <option value="u08">u08</option>
                         <option value="u09">u09</option>
                         <option value="u10">u10</option>
                    </select>
                    </td>
               </tr>
               <tr>
                    <td>
                         Nombre:
                    </td>
                    <td>
                    <select name="nombre"  required>
                         <option value="Universidad Industrial de Santander (UIS)">Universidad Industrial de Santander (UIS)</option>
                         <option value="Universidad Pontificia Bolivariana  (UPB)">Universidad Pontificia Bolivariana (UPB)</option>
                         <option value="Universidad Autonoma de Bucaramanga (UNAB)">Universidad Autonoma de Bucaramanga (UNAB)</option>
                         <option value="Universidad de Santander (UDES)">Universidad de Santander (UDES)</option>
                         <option value="Universidad de Investigacion y Desarrollo (UDI)">Universidad de Investigacion y Desarrollo (UDI)</option>
                         <option value="Universidad Santo Tomas">Universidad Santo Tomas</option>
                         <option value="Universidad Manuela Beltran">Universidad Manuela Beltran</option>
                         <option value="Universidad Antonio Nariño">Universidad Antonio Nariño</option>
                         <option value="Universidad Francisco de Paula santander">Universidad Francisco de Paula santander</option>
                         <option value="Unidades Tecnologicas de Santander (UTS)">Unidades Tecnologicas de Santander (UTS)</option>
                    </select>
                    </td>
               </tr>
               <tr>
                    <td>
                         Sede:
                    </td>
                    <td>
                         <input autofocus required type="text" name="sede" placeholder="Pincipal, A, B, (Otra ciudad), etc." size="40">
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
