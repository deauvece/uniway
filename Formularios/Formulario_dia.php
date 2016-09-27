<!DOCTYPE html>
<html lang="es">

          <title>Formulario Dia</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body>
          <?PHP
     	     // llamar la funciones
     	     include("../Php/barra_nav.php");
     	     hacer_barra_nav();
          ?>
          <form  action="recibeDia.php" method="post">
               <table   >
               <tr>
                    <td colspan="2">
                         <h2 >Formulario Dia</h2>
                    </td>
               </tr>
               <tr>
                    <td>
                         Id Dia:
                    </td>
                    <td>
               	<select name="id_dia" required>
                         <option value="d01">d01</option>
                         <option value="d02">d02</option>
                         <option value="d03">d03</option>
                         <option value="d04">d04</option>
                         <option value="d05">d05</option>
                         <option value="d06">d06</option>
                         <option value="d07">d07</option>
                    </select>
                    </td>
               </tr>
               <tr>
                    <td>
                         Dias:
                    </td>
                    <td>
                    <select name="id_Dias" autofocus required>
                         <option value="lunes">Lunes</option>
                         <option value="martes">Martes</option>
                         <option value="miercoles">Miercoles</option>
                         <option value="jueves">Jueves</option>
                         <option value="viernes">Viernes</option>
                         <option value="sabado">Sabado</option>
                         <option value="domingo">Domingo</option>
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
