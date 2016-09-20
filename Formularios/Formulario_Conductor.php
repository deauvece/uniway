<!DOCTYPE html>
<html lang="es">
          <meta charset="utf-8">
          <title>Formulario Conductor</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
     </head>
     <body >
          <?PHP
     	     // llamar la funciones
     	     include("barra_nav.php");
     	     hacer_barra_nav();
          ?>
          <form  action="recibeConductor.php" method="post">
               <table >
               	<tr>
               		<td colspan="2">
               			<h2 >Formulario Conductor</h2>
               		</td>
               	</tr>
                    <tr>
                         <td colspan="2" >
                              <img class="perfil" src="usuario.png" width="200" height="200">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Id Conductor:
                         </td>
                         <td>
                              <select name="id_conductor" required>
                                   <option value="c0001">c0001</option>
                                   <option value="c0002">c0002</option>
                                   <option value="c0003">c0003</option>
                                   <option value="c0004">c0004</option>
                                   <option value="c0005">c0005</option>
                                   <option value="c0006">c0006</option>
                                   <option value="c0007">c0007</option>
                              </select>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Nombre:
                         </td>
                         <td>
                              <input type="text" pattern="[a-zA-Z0-9\s]+"  name="nombre" placeholder="Ingrese aqui su nombre" size="40"autofocus required>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Apellido:
                         </td>
                         <td>
                               <input type="text" pattern="[a-zA-Z0-9\s]+"  name="apellido" placeholder="Ingrese aqui su apellido" size="40" required>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Id Universidad:
                         </td>
                         <td>
                    	<select name="id_universidad" required>
                          <?PHP 
                               include("conec.php");
                               $conn=conectarse();
                               $sql1="SELECT * FROM universidad";
                               $result = pg_query($conn,$sql1);
                               while ($vector=pg_fetch_array($result))
                                    {
                                         ?>

                                         <option value="<?PHP echo $vector['id_universidad']?>" >
                                         <?PHP echo $vector['nombre']; ?>
                                         </option>
                                            
                                         <?PHP    
                                    }
                          ?>
                         </select>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Genero:
                         </td>
                         <td>
                              <input type="radio" name="genero" value="g01"> Masculino
                              <input type="radio" name="genero" value="g02"> Femenino
                              <input type="radio" name="genero" value="g03"> Otro
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Fecha de nacimiento:
                         </td>
                         <td>
                              <input type="date" name="fecha_nac" required>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Ciudad:
                         </td>
                         <td>
                              <select name="Ciudad" required >
                              <option value="bucaramanga">Bucaramanga</option>
                              <option value="piedecuesta">Piedecuesta</option>
                              <option value="floridablanca">Floridablanca</option>
                              <option value="giron">Giron</option>
                              <option value="lebrija">Lebrija</option>
                              <option value="otra">Otra</option>
                              </select>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Telefono:
                         </td>
                         <td>
                               <input type="tel" pattern="[0-9]{10}" name="telefono" size="40" placeholder="Telefono celular" maxlength="10" required>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Documento:
                         </td>
                         <td>
                              <input type="text" pattern="[0-9]{10,15}" name="documento" size="40" placeholder="C.C / T.I" maxlength="15">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Correo Institucional:
                         </td>
                         <td>
                              <input type="email" name="correoInstitucional" size="40" placeholder="ejemplo@tucorreo.com">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Correo:
                         </td>
                         <td>
                              <input type="email" name="correo" size="40" placeholder="ejemplo@tucorreo.com" required>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Contraseña:
                         </td>
                         <td>
                              <input type="password" name="contrasena" colspan="2" size="40" placeholder="Contraseña" required>
                         </td>
                    </tr>

                    <tr>
                         <td>
                              Profesion:
                         </td>
                         <td>
                              <input type="radio" name="profesion" value="Estudiante"> Estudiante
                              <input type="radio" name="profesion" value="Profesor"> Profesor
                              <input type="radio" name="profesion" value="Trabajador"> Empleado
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Pico y placa:
                         </td>
                         <td>
                              <select name="picoYplaca" required>
                                   <option value="d01">Lunes</option>
                                   <option value="d02">Martes</option>
                                   <option value="d03">Miercoles</option>
                                   <option value="d04">Jueves</option>
                                   <option value="d05">Viernes</option>
                              </select>
                         </td>
                    </tr>
                    <tr>
                         <td  colspan="2">
                              <input class="boton" type="reset" name="borrar" value="Borrar información">
                         </td>
                    </tr>
                    <tr>
                         <td  colspan="2">
                              <input class="boton" type="submit" name="registrar" value="Crear cuenta" >
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
