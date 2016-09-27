<?PHP
// llamar la funciones
include("../Php/conec.php");
include("../Php/encabezado.php");
include("../Php/barra_nav.php");
     $conn=conectarse();
     $titulo="Consulta comentario_conductor";
     hacer_encabezado($titulo);
     hacer_barra_nav();
     extract($_POST);

     $sql1="SELECT* FROM comentario_conductor WHERE id_comentario_conductor='$codigo'";
     $result1 = pg_query($conn,$sql1);
     $numFilas = pg_numrows($result1);
     if  ($numFilas!=0)
     {
          if ($vector=pg_fetch_array($result1))
		{
               $id_comentario_conductor=$vector["0"];
     		$id_conductor=$vector["1"];
               $id_ruta=$vector["2"];
               $hora=$vector["3"];
               $fecha=$vector["4"];
               $contenido=$vector["5"];
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
                         <td>&nbsp;ID COMENT_COND&nbsp;</td>
                         <td> <?PHP echo $id_comentario_conductor; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;ID CONDUCTOR&nbsp;</td>
                         <td> <?PHP echo $id_conductor; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;ID RUTA&nbsp;</td>
                         <td> <?PHP echo $id_ruta; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;HORA&nbsp;</td>
                         <td> <?PHP echo $hora; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;FECHA&nbsp;</td>
                         <td> <?PHP echo $fecha; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CONTENIDO&nbsp;</td>
                         <td> <?PHP echo $contenido; ?></td>
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
