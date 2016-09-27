<?php
 //función de encabezado y colocación del titulo
 function hacer_barra_nav()
 {
 $barra='<!DOCTYPE html>
          <html lang="es">
          <head>    
          <link rel="stylesheet" href="../CSS/home-form-Style.css">
          <meta name="viewport" content="width=device-width,initial-scale=1.0">
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          </head>
          <body>
          <nav>
          	<ul>
          		<li>
          			<input type="checkbox" name="name" id="btn">
          			<div class="label">
          				<label for="btn"> <img src="../Imagenes/menu1.png" alt="menu-ham" height="50" width="50" /> </label>
          			</div>
          			<ul class="sinmenu" >
          				<li>
          					<a href="../home.html">Inicio</a>
          				</li>
          				<li>
          					<a href="../dataBase.html">Data Base</a>
          				</li>
          				<li>
          					<a href="../contacto.html">Contacto</a>
          				</li>
          				<li>
          					<a href="../home.html#misionyvision">Quienes somos</a>
          				</li>
          				<li>
          					<a href="../fail.html">Como funciona</a>
          				</li>
          				<li>
          					<a href="../fail.html">Inicia Sesion</a>
          				</li>
          			</ul>
          		</li>
          	</ul>
          </nav>
        <!--LOGOOO-->
	<div id="logo">
		<a href="home.html">
		<img src="../Imagenes/logo-only.png" height="50" />
		<img src="../Imagenes/logo-name.png" height="40" id="nombre" />
		</a>
	</div>
          </body>
          </html>

          ';
 echo $barra;
 }
 ?>
