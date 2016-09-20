<?PHP
     // llamar la funciones
     include("conec.php");
     include("encabezado.php");
     include("barra_nav.php");
     $conn=conectarse();
     $titulo="Consulta comentario_pasajero";
     hacer_encabezado($titulo);
     hacer_barra_nav();
     extract($_POST);

     $sql1="SELECT* FROM comentario_pasajero WHERE id_comentario_pasajero='$codigo'";
     $result1 = pg_query($conn,$sql1);
     $numFilas = pg_numrows($result1);
     if  ($numFilas!=0)
     {
          if ($vector=pg_fetch_array($result1))
		{
               $id_comentario_pasajero=$vector["0"];
     		$id_pasajero=$vector["1"];
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
                         <td>&nbsp;ID COMENT_PSJ&nbsp;</td>
                         <td> <?PHP echo $id_comentario_pasajero; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;ID CONDUCTOR&nbsp;</td>
                         <td> <?PHP echo $id_pasajero; ?></td>
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
