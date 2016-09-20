<!DOCTYPE html>
<html lang="es">
          
          <title>Formulario Genero</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body >
          <?PHP
     	     // llamar la funciones
     	     include("barra_nav.php");
     	     hacer_barra_nav();
          ?>
          <form  action="recibeGenero.php" method="post">
               <table  >
               <tr>
                    <td colspan="2">
                         <h2 >Formulario Genero</h2>
                    </td>
               </tr>
               <tr>
                    <td>
                         Id Genero:
                    </td>
                    <td>
               	<select name="id_genero" required>
                         <option value="g01">g01</option>
                         <option value="g02">g02</option>
                         <option value="g03">g03</option>

                    </select>
                    </td>
               </tr>
               <tr>
                    <td>
                         Genero:
                    </td>
                    <td>
                    <select name="generos" autofocus required>
                         <option value="masculino">Masculino</option>
                         <option value="femenino">Femenino</option>
                         <option value="otro">Otro</option>

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
