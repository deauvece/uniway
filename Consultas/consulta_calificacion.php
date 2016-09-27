<?PHP
// llamar la funciones
include("../Php/conec.php");
include("../Php/encabezado.php");
include("../Php/barra_nav.php");
     $conn=conectarse();
     $titulo="Consulta calificaciones";
     hacer_encabezado($titulo);
     hacer_barra_nav();
     extract($_POST);

     $sql1="SELECT* FROM calificacion WHERE id_calificacion='$codigo'";
     $result1 = pg_query($conn,$sql1);
     $numFilas = pg_numrows($result1);
     if  ($numFilas!=0)
     {
          if ($vector=pg_fetch_array($result1))
		{
               $id_calificacion=$vector["0"];
               $id_conductor=$vector["1"];
               $id_pasajero=$vector["2"];
               $calificacion=$vector["3"];
               $fecha_calificacion=$vector["4"];
               $hora_calificacion=$vector["5"];
               $comentario=$vector["6"];
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
                         <td>&nbsp;ID CALIFICACION&nbsp;</td>
                         <td><?PHP echo $id_calificacion; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;ID CONDUCTOR&nbsp;</td>
                         <td><?PHP echo $id_conductor;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;ID PASAJERO&nbsp;</td>
                         <td><?PHP echo $id_pasajero;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CALIFICACION&nbsp;</td>
                         <td><?PHP echo $calificacion;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;FECHA&nbsp;</td>
                         <td><?PHP echo $fecha_calificacion;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;HORA&nbsp;</td>
                         <td><?PHP echo $hora_calificacion;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;COMENTARIO&nbsp;</td>
                         <td><?PHP echo $comentario;?></td>
                    </tr>
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
