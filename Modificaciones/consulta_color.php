<?PHP
     // llamar la funciones
     include("../Php/conec.php");
     include("../Php/encabezado.php");
     include("../Php/barra_nav.php");
     $conn=conectarse();
     $titulo="Consulta Colores";
     hacer_encabezado($titulo);
     hacer_barra_nav();
     extract($_POST);

     $sql1="SELECT* FROM color WHERE id_color='$codigo'";
     $result1 = pg_query($conn,$sql1);
     $numFilas = pg_numrows($result1);
     if  ($numFilas!=0)
     {
          if ($vector=pg_fetch_array($result1))
		{
               $id_color=$vector["0"];
     		$colores=$vector["1"];
?>
               <form action="PHP/modifica_color.php" method="POST">
               <table id="consulta">
                    <tr>
                         <td colspan="2" >
                              <h2>
                                   Resultados de la consulta:
                              </h2>
                         </td>
                    </tr>
                    <tr>
                         <td>&nbsp;ID COLOR&nbsp;</td>
                         <td> <input type="text" name="id_color" value="<?PHP echo $id_color; ?>" readonly ></td>
                    </tr>
                    <tr>
                         <td>&nbsp;ID CONDUCTOR&nbsp;</td>
                         <td> <input type="text" name="colores" value="<?PHP echo $colores; ?>"></td>
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
