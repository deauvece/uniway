<?PHP
     // llamar la funciones
     include("../Php/conec.php");
     include("../Php/encabezado.php");
     include("../Php/barra_nav.php");
     $conn=conectarse();
     $titulo="Consulta transporte";
     hacer_encabezado($titulo);
     hacer_barra_nav();
     extract($_POST);

     $sql1="SELECT* FROM transporte WHERE id_transporte='$codigo'";
     $result1 = pg_query($conn,$sql1);
     $numFilas = pg_numrows($result1);
     if  ($numFilas!=0)
     {
          if ($vector=pg_fetch_array($result1))
		{
               $id_transporte=$vector["0"];
     		$placas=$vector["1"];
               $cupos=$vector["2"];
               $tipo_transporte=$vector["3"];
               $aire_acondicionado=$vector["4"];
               $precio=$vector["5"];
               $modelo_transporte=$vector["6"];
               $wifi=$vector["7"];
               $id_color=$vector["8"];
?>
               <form action="PHP/modifica_transporte.php" method="POST">
               <table id="consulta">
                    <tr>
                         <td colspan="2" >
                              <h2>
                                   Resultados de la consulta:
                              </h2>
                         </td>
                    </tr>
                    <tr>
                         <td>&nbsp;ID TRANSPORTE&nbsp;</td>
                         <td> <input type="text" name="id_transporte" readonly value="<?PHP echo $id_transporte; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;PLACAS&nbsp;</td>
                         <td> <input type="text" name="placas" value="<?PHP echo $placas;?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CUPOS&nbsp;</td>
                         <td> <input type="text" name="cupos" value="<?PHP echo $cupos;?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;TIPO TRANSPORTE&nbsp;</td>
                         <td> <input type="text" name="tipo_transporte" value="<?PHP echo $tipo_transporte;?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;AIRE ACONDICIONADO&nbsp;</td>
                         <td> <input type="text" name="aire_acondicionado" value="<?PHP echo $aire_acondicionado;?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;PRECIO&nbsp;</td>
                         <td> <input type="text" name="precio" value="<?PHP echo $precio;?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;COLOR&nbsp;</td>
                         <td> <input type="text" name="id_color" value="<?PHP echo $id_color;?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;MODELO TRANSPORTE&nbsp;</td>
                         <td> <input type="text" name="modelo_transporte" value="<?PHP echo $modelo_transporte;?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;WIFI&nbsp;</td>
                         <td> <input type="text" name="wifi" value="<?PHP echo $wifi;?>"></td>
                    </tr>
                    <tr>
                         <td colspan="2">
                           <input type="submit" class="botonVolver" name="modificar" value="Modificar">
                         </td>
                    </tr>
                 <tr>
                    <td colspan="2">
     		            <input type="button" class="botonVolver" onclick="window.location = 'http://uniway.heliohost.org/modificar.html'" value="Volver">
                    </td>
                 </tr>
          </table>
          </form>
     </body>
     </html>
                    <?php
                    }
                    pg_free_result($result1);
                    pg_close($conn);
          }else{
               ?>
               <table id="consulta">
                    <tr>
                         <td colspan="2" >
                              <h2>
                                   Resultados de la consulta:
                              </h2>
                         </td>
                    </tr>
                    <tr>
                         <td colspan="2">
                              NO SE HA ENCONTRADO NINGUN ELEMENTO EN LA TABLA
                         </td>
                    </tr>
            <tr>
               <td colspan="2">
                      <a href="../modificar.html"> <button class="botonVolver" >Volver</button> </a>
               </td>
            </tr>
          </table>
     </body>
     </html>
               <?PHP
          }

     ?>
