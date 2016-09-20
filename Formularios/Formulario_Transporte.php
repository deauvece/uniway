<!DOCTYPE html>
<html lang="es">
          <meta charset="utf-8">
          <title>Formulario Transporte</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body>
          <?PHP
     	     // llamar la funciones
     	     include("barra_nav.php");
     	     hacer_barra_nav();
          ?>     
          <form  action="recibeTransporte.php" method="post">
               <table  >
               	<tr>
                         <td colspan="2">
                              <h2 >Formulario Transporte</h2>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Id Tranporte:
                         </td>
                         <td>
                              <select name="id_tranporte" required>
                                   <option value="t0001">t0001</option>
                                   <option value="t0002">t0002</option>
                                   <option value="t0003">t0003</option>
                                   <option value="t0004">t0004</option>
                                   <option value="t0005">t0005</option>
                                   <option value="t0006">t0006</option>
                                   <option value="t0007">t0007</option>
                              </select>
                         </td>
                    <tr>

                    <tr>
                         <td>
                              Placas:
                         </td>
                         <td>
                              <input type="text" pattern="[A-Z a-z 0-9]{6}" name="placas" placeholder="Ingrese las placas del transporte sin guion" size="40" maxlength="6" autofocus required>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Cupos:
                         </td>
                         <td>
                              <select name="cupos">
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
                              Tipo de transporte:
                         </td>
                         <td>
                              <select name="tipoTransporte" required >
                                   <option value="Carro">Carro</option>
                                   <option value="Camioneta">Camioneta</option>
                                   <option value="Moto">Moto</option>
                              </select>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Aire acondicionado:
                         </td>
                         <td>
                              <input type="radio" name="aireAcondicionado" value="si">Si
                              <input type="radio" name="aireAcondicionado" value="no">No
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Wi-fi:
                         </td>
                         <td>
                              <input type="radio" name="wifi" value="si">Si
                              <input type="radio" name="wifi" value="no">No
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Precio:
                         </td>
                         <td>
                              <input type="text" pattern="[0-9]{4}" name="precio" size="40" placeholder="2000 (recomendado)" maxlength="4" required>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Color del Transporte:
                         </td>
                         <td>
                              <select name="color" required>
                                   <?PHP 
                                         include("conec.php");
                                         $conn=conectarse();
                                         $sql1="SELECT * FROM color";
                                         $result = pg_query($conn,$sql1);
                                         while ($vector=pg_fetch_array($result))
                                              {
                                                   ?>

                                                   <option value="<?PHP echo $vector['id_color']?>">
                                                   <?PHP echo $vector['colores']; ?>
                                                   </option>
                                                      
                                                   <?PHP    
                                              }
                                   ?>
                              </select>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Modelo Trasporte:
                         </td>
                         <td>
                              <input type="text" name="modelo_transporte" placeholder="Especifica el modelo del carro/moto" size="40">
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
