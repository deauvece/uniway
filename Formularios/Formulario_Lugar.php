<!DOCTYPE html>
<html lang="es">
          
          <title>Formulario Lugar</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body >
          <?PHP
     	     // llamar la funciones
     	     include("barra_nav.php");
     	     hacer_barra_nav();
          ?>
          <form  action="recibeLugar.php" method="post" enctype="multipart/form-data">
               <table  >
               	<tr>
                         <td colspan="2">
                              <h2 >Formulario Lugar</h2>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Id Lugar:
                         </td>
                         <td>
                              <select name="id_lugar" required>
                                   <option value="l001">l001</option>
                                   <option value="l002">l002</option>
                                   <option value="l003">l003</option>
                                   <option value="l004">l004</option>
                                   <option value="l005">l005</option>
                                   <option value="l006">l006</option>
                                   <option value="l007">l007</option>
                              </select>
                         </td>
                    <tr>

                    <tr>
                         <td>
                              Dirección:
                         </td>
                         <td>
                              <input type="text" name="direccion" size="40" autofocus required>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Puedes especificar <br/> mejor la parada:
                         </td>
                         <td>
                              <textarea name="especifiacion" cols="39" rows="5"></textarea>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Foto del lugar:
                         </td>
                         <td>
                              <input type="file" name="file" accept="image/*" required>
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
