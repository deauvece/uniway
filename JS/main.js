//animacion crear ruta userProfile.php addroute
function crearRuta(){
	var formBox=document.getElementById('addRouteBox');

	if (formBox.style.display== 'block') {
		formBox.style.display = 'none';
	}else {
		formBox.style.display = 'block';
	}
}
//animacion subir imagen userProfile.php
function subirImagen(){
	var uploadFormBox=document.getElementById('profile_Image');

	if (uploadFormBox.style.display == 'inline-block') {
		uploadFormBox.style.display = 'none';
	}else {
		uploadFormBox.style.display = 'inline-block';
	}
}

//busqueda de paradas en userProfile.php
	$( function() {
	 $( "#buscar" ).autocomplete({
		 source: 'ajax.php'
	 });
	} );

	$( function() {
		 $( "#buscar2" ).autocomplete({
			 source: 'ajax.php'
		 });
	} );

	$( function() {
		 $( "#buscar3" ).autocomplete({
			 source: 'ajax.php'
		 });
	 } );

	$( function() {
		 $( "#buscar4" ).autocomplete({
			 source: 'ajax.php'
		 });
	} );
	$( function() {
		 $( "#buscar5" ).autocomplete({
			 source: 'ajax.php'
		 });
	 } );




//Amimaciones del menu desplegable SESION ABIERTA
	//para que cuando se clickee fuera del menu tambien se oculte
	function cerrarMenu() {
		document.getElementsByClassName('sinmenu')[0].style.webkitTransform = 'translateX(200%)';
	}
	//la funcion para cuando se hace click en el boton
	function menuDesplegable() {
		if (document.getElementById('btn').checked) {
			//get element by class devuelve un vector, se selecciona el primero en la posicion inicial 0
			 document.getElementsByClassName('sinmenu')[0].style.webkitTransform = 'translateX(1%)';
		}
		else {
			document.getElementsByClassName('sinmenu')[0].style.webkitTransform = 'translateX(200%)';
		}
	}
//Amimaciones del menu desplegable INICIO



//Animacion cambio de opcion en la pagina del perfil
	var datosLabel = document.getElementById("datosLabel");
	var redesLabel = document.getElementById("redesLabel");
	var calificacionesLabel = document.getElementById("calificacionesLabel");

	var vectorBasicInfo = document.getElementsByClassName('basicInfo');
	var vectorRutes = document.getElementsByClassName('userRutesBox');
	var vectorCalificaciones = document.getElementsByClassName('qualificationsBox');
	var i,j,k,m;

	datosLabel.onclick=function(){
		for (i = 0; i < vectorBasicInfo.length; i++) {
			vectorBasicInfo[i].style.display="block";
		}
		for (j = 0; j < vectorRutes.length; j++) {
			vectorRutes[j].style.display="none";
		}
		for (k = 0; k < vectorCalificaciones.length; k++) {
			vectorCalificaciones[k].style.display="none";
		}
	}
	rutasLabel.onclick=function(){
		for (i = 0; i < vectorBasicInfo.length; i++) {
			vectorBasicInfo[i].style.display="none";
		}
		for (j = 0; j < vectorRutes.length; j++) {
			vectorRutes[j].style.display="block";
		}
		for (k = 0; k < vectorCalificaciones.length; k++) {
			vectorCalificaciones[k].style.display="none";
		}
	}
	calificacionesLabel.onclick=function(){
		for (i = 0; i < vectorBasicInfo.length; i++) {
			vectorBasicInfo[i].style.display="none";
		}
		for (j = 0; j < vectorRutes.length; j++) {
			vectorRutes[j].style.display="none";
		}
		for (k = 0; k < vectorCalificaciones.length; k++) {
			vectorCalificaciones[k].style.display="block";
		}
	}
