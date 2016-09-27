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
                         <td> <?PHP echo $id_pasajero; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;NOMBRE&nbsp;</td>
                         <td> <?PHP echo $nombres; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;APELLIDO&nbsp;</td>
                         <td> <?PHP echo $apellidos; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;GENERO&nbsp;</td>
                         <td> <?PHP echo $genero; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;FECHA NAC&nbsp;</td>
                         <td> <?PHP echo $fecha_nacimiento; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CIUDAD&nbsp;</td>
                         <td> <?PHP echo $ciudad; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;TELEFONO&nbsp;</td>
                         <td> <?PHP echo $telefono; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CORREO&nbsp;</td>
                         <td> <?PHP echo $correo; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;PROFESION&nbsp;</td>
                         <td> <?PHP echo $profesion; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CONTRASEÑA&nbsp;</td>
                         <td> <?PHP echo $password; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;DOCUMENTO&nbsp;</td>
                         <td> <?PHP echo $documento; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CORREO INST&nbsp;</td>
                         <td> <?PHP echo $correo_inst; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;UNIVERSIDAD&nbsp;</td>
                         <td> <?PHP echo $universidad; ?></td>
                    </tr>
<?PHP
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
               <?PHP
          }

     ?>
	     <tr>
	          <td colspan="2">
	            <a href="../consultar.html"> <button class="botonVolver" >Volver</button> </a>
	          </td>
	     </tr>
	</table>
</body>
</html>
