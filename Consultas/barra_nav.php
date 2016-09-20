<?php
 //función de encabezado y colocación del titulo
 function hacer_barra_nav()
 {
 $barra='<!DOCTYPE html>
          <html lang="es">
          <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
                
          <link rel="stylesheet" href="../CSS/home-form-Style.css">
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
          </head>
          <body>
          <nav>
          	<ul>
          		<li>
          			<input type="checkbox" name="name" id="btn">
          			<div class="label">
          				<label for="btn"> <img src="menu1.png" alt="menu-ham" height="50" width="50" /> </label>
          			</div>
          			<ul class="sinmenu" >
          				<li>
          					<a href="../home_admin.php">Inicio</a>
          				</li>
          				<li>
          					<a href="../dataBase.html">Data Base</a>
          				</li>
          				<li>
          					<a href="../home_admin.php#misionyvision">Quienes somos</a>
          				</li>
					<li>
						<a href="#">ADMIN</a>
					</li>
				        <li>
					        <a href="../logout.php">Cerrar Sesion</a>
				        </li>
          		        </ul>
          		</li>
          	</ul>
          </nav>
        <!--LOGOOO-->
	<div id="logo">
		<a href="home.html">
		<img src="logo-only.png" height="50" />
		<img src="logo-name.png" height="40" id="nombre" />
		</a>
	</div>
          </body>
          </html>

          ';
 echo $barra;
 }
 ?>
