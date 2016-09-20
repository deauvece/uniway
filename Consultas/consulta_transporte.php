<?PHP
     // llamar la funciones
     include("conec.php");
     include("encabezado.php");
     include("barra_nav.php");
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
               $id_color=$vector["6"];
               $modelo_transporte=$vector["7"];
               $wifi=$vector["8"];
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
                         <td>&nbsp;ID TRANSPORTE&nbsp;</td>
                         <td><?PHP echo $id_transporte; ?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;PLACAS&nbsp;</td>
                         <td><?PHP echo $placas;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;CUPOS&nbsp;</td>
                         <td><?PHP echo $cupos;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;TIPO TRANSPORTE&nbsp;</td>
                         <td><?PHP echo $tipo_transporte;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;AIRE ACONDICIONADO&nbsp;</td>
                         <td><?PHP echo $aire_acondicionado;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;PRECIO&nbsp;</td>
                         <td><?PHP echo $precio;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;COLOR&nbsp;</td>
                         <td><?PHP echo $id_color;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;MODELO TRANSPORTE&nbsp;</td>
                         <td><?PHP echo $modelo_transporte;?></td>
                    </tr>
                    <tr>
                         <td>&nbsp;WIFI&nbsp;</td>
                         <td><?PHP echo $wifi;?></td>
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
