<?PHP
     // llamar la funciones
     include("conec.php");
     include("encabezado.php");
     include("barra_nav.php");
     $conn=conectarse();
     $titulo="Consulta ruta";
     hacer_encabezado($titulo);
     hacer_barra_nav();
     extract($_POST);
     $sql1="SELECT* FROM ruta WHERE id_ruta='$codigo'";
     $result1 = pg_query($conn,$sql1);
     $numFilas = pg_numrows($result1);
     if  ($numFilas!=0)
     {
          if ($vector=pg_fetch_array($result1))
          {
               $id_ruta=$vector["0"];
     		$hora=$vector["1"];
               $cupos=$vector["2"];
               $id_dia=$vector["3"];
               $ida_salida=$vector["4"];
     ?>
               <form action="PHP/modifica_ruta.php" method="POST">
               <table id="consulta">
                    <tr>
                         <td colspan="2" >
                              <h2>
                                   Resultados de la consulta:
                              </h2>
                         </td>
                    </tr>
                    <tr>
                         <td>&nbsp;ID RUTA&nbsp;</td>
                         <td> <input type="text" name="id_ruta" readonly value="<?PHP echo $id_ruta; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;HORA&nbsp;</td>
                         <td> <input type="text" name="hora" value="<?PHP echo $hora;?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CUPOS&nbsp;</td>
                         <td> <input type="text" name="cupos" value="<?PHP echo $cupos;?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;DIA&nbsp;</td>
                         <td> <input type="text" name="id_dia" value="<?PHP echo $id_dia;?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;IDA O SALIDA&nbsp;</td>
                         <td> <input type="text" name="ida_salida" value="<?PHP echo $ida_salida;?>"></td>
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
