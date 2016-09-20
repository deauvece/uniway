<!DOCTYPE html>
<html lang="es">
          <meta charset="utf-8">
          <title>Formulario Pasajero</title>
          <link rel="stylesheet" href="../CSS/formStyle.css" >
          <meta name="viewport" content="width=device-width,initial-scale=1.0">

     </head>
     <body >
          <?PHP
     	     // llamar la funciones
     	     include("barra_nav.php");
     	     hacer_barra_nav();
          ?>
          <form  action="recibePasajero.php" method="post">
               <table   >
          		<tr>
          			<td colspan="2">
          				<h2 >Formulario Pasajero</h2>
          			</td>
          		</tr>
                    <tr>
                         <td colspan="2" >
                              <img class="perfil" src="usuario.png" width="200" height="200">
                         </td>
                    </tr>
                    <tr>
                         <td>
                              Id Pasajero:
                         </td>
                         <td>
                              <select name="id_pasajero" required>
                                   <option value="p0001">p0001</option>
                                   <option value="p0002">p0002</option>
                                   <option value="p0003">p0003</option>
                                   <option value="p0004">p0004</option>
                                   <option value="p0005">p0005</option>
                                   <option value="p0006">p0006</option>
                                   <option value="p0007">p0007</option>
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

                                         <option value="<?PHP echo $vector['id_universidad']?>">
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
                               <input type="tel" pattern="[0-9]{10}"  name="telefono" size="40" placeholder="Telefono celular" maxlength="10" required>
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
