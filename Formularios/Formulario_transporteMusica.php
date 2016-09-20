<!DOCTYPE html>
<html lang="es">
             
          <title>Formulario Musica-Transporte</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body>
          <?PHP
     	     // llamar la funciones
     	     include("barra_nav.php");
     	     hacer_barra_nav();
          ?>
          <form  action="recibeMusicaTransporte.php" method="post">
               <table >
               <tr>
                    <td colspan="2">
                         <h2 >Formulario Musica-Transporte</h2>
                    </td>
               </tr>
               <tr>
                    <td>
                         Id Musica:
                    </td>
                    <td>
                    <select name="id_musica">
                          <?PHP 
                               include("conec.php");
                               $conn=conectarse();
                               $sql1="SELECT * FROM musica";
                               $result = pg_query($conn,$sql1);
                               while ($vector=pg_fetch_array($result))
                                    {
                                         ?>

                                         <option value="<?PHP echo $vector['id_musica']?>">
                                         <?PHP echo $vector['generos']; ?>
                                         </option>
                                            
                                         <?PHP    
                                    }
                          ?>
                    </select>
                    </td>
               </tr>

               <tr>
                    <td>
                         Id Tranporte:
                    </td>
                    <td>
                         <select name="id_tranporte">
                          <?PHP 
                               $conn=conectarse();
                               $sql1="SELECT * FROM transporte";
                               $result = pg_query($conn,$sql1);
                               while ($vector=pg_fetch_array($result))
                                    {
                                         ?>

                                         <option value="<?PHP echo $vector['id_transporte']?>">
                                         <?PHP echo $vector['placas']; ?>
                                         </option>
                                            
                                         <?PHP    
                                    }
                          ?>
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
