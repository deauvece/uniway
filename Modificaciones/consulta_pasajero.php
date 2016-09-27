<?PHP
     // llamar la funciones
     include("../Php/conec.php");
     include("../Php/encabezado.php");
     include("../Php/barra_nav.php");
     $conn=conectarse();
     $titulo="Consulta pasajero";
     hacer_encabezado($titulo);
     hacer_barra_nav();
     extract($_POST);
     $sql1="SELECT* FROM pasajero WHERE id_pasajero='$codigo'";
     $result1 = pg_query($conn,$sql1);
     $numFilas = pg_numrows($result1);
     if  ($numFilas!=0)
     {
          if ($vector=pg_fetch_array($result1))
		{
               $id_pasajero=$vector["0"];
     		$nombres=$vector["1"];
               $apellidos=$vector["2"];
               $genero=$vector["3"];
               $fecha_nacimiento=$vector["4"];
               $ciudad=$vector["5"];
               $telefono=$vector["6"];
               $correo=$vector["7"];
               $profesion=$vector["8"];
               $password=$vector["9"];
               $documento=$vector["10"];
               $correo_inst=$vector["11"];
               $universidad=$vector["12"];
?>
               <form action="PHP/modifica_pasajero.php" method="POST">
               <table id="consulta">
                    <tr>
                         <td colspan="2" >
                              <h2>
                                   Resultados de la consulta:
                              </h2>
                         </td>
                    </tr>
                    <tr>
                         <td>&nbsp;ID PASAJERO&nbsp;</td>
                         <td> <input type="text" name="id_pasajero" readonly value="<?PHP echo $id_pasajero; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;NOMBRE&nbsp;</td>
                         <td> <input type="text" name="nombres" value="<?PHP echo $nombres; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;APELLIDO&nbsp;</td>
                         <td> <input type="text" name="apellidos" value="<?PHP echo $apellidos; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;GENERO&nbsp;</td>
                         <td> <input type="text" name="id_genero" value="<?PHP echo $genero; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;FECHA NAC&nbsp;</td>
                         <td> <input type="text" name="fecha_nacimiento" value="<?PHP echo $fecha_nacimiento; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CIUDAD&nbsp;</td>
                         <td> <input type="text" name="ciudad" value="<?PHP echo $ciudad; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;TELEFONO&nbsp;</td>
                         <td> <input type="text" name="telefono" value="<?PHP echo $telefono; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CORREO&nbsp;</td>
                         <td> <input type="text" name="correo" value="<?PHP echo $correo; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;PROFESION&nbsp;</td>
                         <td> <input type="text" name="profesion" value="<?PHP echo $profesion; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CONTRASEÑA&nbsp;</td>
                         <td> <input type="text" name="password" value="<?PHP echo $password; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;DOCUMENTO&nbsp;</td>
                         <td> <input type="text" name="documento" value="<?PHP echo $documento; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CORREO INST&nbsp;</td>
                         <td> <input type="text" name="correo_inst" value="<?PHP echo $correo_inst; ?>"></td>
                    </tr>
                    <tr>
                         <td>&nbsp;UNIVERSIDAD&nbsp;</td>
                         <td> <input type="text" name="id_universidad" value="<?PHP echo $universidad; ?>"></td>
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
