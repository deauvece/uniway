<!DOCTYPE html>
<html lang="es">

          <title>Formulario Color</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body>
  <?PHP
     // llamar la funciones
     include("../Php/barra_nav.php");
     hacer_barra_nav();
  ?>
          <form  action="recibeColor.php" method="post">
               <table  >
               <tr>
                    <td colspan="2">
                         <h2 >Formulario Color</h2>
                    </td>
               </tr>
               <tr>
                    <td>
                         Id Color:
                    </td>
                    <td>
               	<select name="id_color" required>
                         <option value="cl01">cl01</option>
                         <option value="cl02">cl02</option>
                         <option value="cl03">cl03</option>
                         <option value="cl04">cl04</option>
                         <option value="cl05">cl05</option>
                         <option value="cl06">cl06</option>
                         <option value="cl07">cl07</option>
                    </select>
                    </td>
               </tr>
               <tr>
                    <td>
                         Colores
                    </td>
                    <td>
                    <select name="id_colores" autofocus required>
                         <option value="verde">Verde</option>
                         <option value="azul">Azul</option>
                         <option value="negro">Negro</option>
                         <option value="rojo">Rojo</option>
                         <option value="blanco">Blanco</option>
                         <option value="gris">Gris</option>
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
