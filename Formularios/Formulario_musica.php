<!DOCTYPE html>
<html lang="es">

          <title>Formulario Musica</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body >
          <?PHP
     	     // llamar la funciones
     	     include("../Php/barra_nav.php");
     	     hacer_barra_nav();
          ?>
          <form  action="recibeMusica.php" method="post">
               <table  >
               <tr>
                    <td colspan="2">
                         <h2 >Formulario Musica</h2>
                    </td>
               </tr>
               <tr>
                    <td>
                         Id Musica:
                    </td>
                    <td>
               	<select name="id_musica">
                         <option value="m01">m01</option>
                         <option value="m02">m02</option>
                         <option value="m03">m03</option>
                         <option value="m04">m04</option>
                         <option value="m05">m05</option>
                         <option value="m06">m06</option>
                         <option value="m07">m07</option>
                    </select>
                    </td>
               </tr>
               <tr>
                    <td>
                         Id Genero:
                    </td>
                    <td>
                    <select name="id_Generos"autofocus required>
                         <option value="Rock">Rock</option>
                         <option value="Salsa">Salsa</option>
                         <option value="Reggaeton">Reggaeton</option>
                         <option value="Tropipop">Tropipop</option>
                         <option value="Vallenato">Vallenato</option>
                         <option value="Radio-Fm">Radio-Fm</option>
                         <option value="Otro">Otro</option>
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
