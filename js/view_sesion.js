
$(document).ready(function () {


/*
	Indice both pages
	Indice home.php
	Indice user_profile.php
*/




/*
Indice both pages

//previene que no se envien los formularios  al presionar enter
//clear search input
//mostrar informacion y generar mapa
//funcion crear mapa
//funcion agregar paradas
//adsaklds
//eliminar paradas del formulario
//envia los datos del formulario de ruta
*/


//previene que no se envien los formularios  al presionar enter
$(document).on("keypress", "form", function(event) {
    return event.keyCode != 13;
});


//clear search input
$('#query, #search-input').on('focus', function() {
	$(this).val('');
});

//mostrar informacion y generar mapa
var array_stops=[];
var max_stops=5;
//primera parada = universidad
var first_stop = $("select[name=stop1]").val();
array_stops[0]=first_stop;
//cada vez que cambie, se actualiza el valor
$('#modal_add_stop > select').on('change', function() {
	first_stop = this.value;
	array_stops[0]=first_stop;
	createMap();
})


//funcion crear mapa
function createMap() {
		var size_array = array_stops.length;
		//si ya hay dos paradas se muestra el mapa
		if (size_array > 1) {
			//genera el mapa
			$("#map_stops").css("height","500px");
			var directionsService = new google.maps.DirectionsService;
			var directionsDisplay = new google.maps.DirectionsRenderer;
			var map = new google.maps.Map(document.getElementById('map_stops'), {
				zoom: 10,
				center: {lat: 7.13, lng: -73.13}
			});
			directionsDisplay.setMap(map);

			var waypts = [];
			  for (var i = 0; i < size_array; i++) {
			    if (i!=0 || i!=size_array-1) {
				 waypts.push({
				   location: array_stops[i],
				   stopover: true
				 });
			    }
			  }
			  directionsService.route({
			    origin: array_stops[0],
			    destination: array_stops[(size_array)-1],
			    waypoints: waypts,
			    //true para reordenar los waypoints
			    optimizeWaypoints: false,
			    travelMode: 'DRIVING'
			  }, function(response, status) {
			    if (status === 'OK') {
				 directionsDisplay.setDirections(response);
				 var route = response.routes[0];
			    } else {
				 console.log('Directions request failed due to ' + status + ' (stop doesnt exist)');
			    }
		    });

		}
}
//funcion agregar paradas
function addStop() {
	var count = array_stops.length;
	//se le suma el destino/origen universidad

	//determina si muestra boton para eliminar ultima parada
	if (count>0) {
		$(".delete_stop").fadeIn();
	}

	if (count<max_stops) {
		//se quita el erroe en caso de que esté
		$("#modal_add_stop .error").css("display","none");
		//se agrega a cont-stops para que el usuario la vea
		var info = $("#query").val();
		index=count+1;
		$(".cont-stops").append("<input class='query' id='stop"+index+"' name='stop"+index+"' disabled type='text'  value='"+info+"'>");
		//se agrega al vector array_stops
		array_stops[count]=info;
		//crea el mapa
		createMap();

	}else{
		console.log(count);
		$("#modal_add_stop .error").css("display","block");
	}

}

//adsaklds
$("#add_stop").on("click",function () {
	var sizeResult = $("#query").val().length;
	if (sizeResult!=0 ) {
		addStop();
	}

});
$("#query").keypress(function (e) {
	var sizeResult = $("#query").val().length;
	if (e.which == 13 && sizeResult!=0 ) {
		addStop();
	}
});


//eliminar paradas del formulario
$(".delete_stop").on("click", function(){
	var count = array_stops.length;
	//si solo hay dos paradas y se elimina el boton desaparece
	if (count==2) { $(this).hide(); }
	//y se quita el error en caso de que esté
	$("#modal_add_stop .error").css("display","none");
	array_stops.splice(count-1, 1);
	$(".cont-stops input:last-child").remove();
	//si hay al menos dos parada se genera el mapa (inicial + parada(input))
	if (count>1) {
		createMap();
	}

});

//envia los datos del formulario de ruta
$('#form_stops> button[type=submit]').on('click', function(e){
   $(".errorVal").css("display","none");
   e.preventDefault();
   //input rute name
   var len = $('#rute_name').val().length;
   //minimo una parada
   var count = $(".cont-stops input").length;
   //se le suma el destino/origen universidad
   if (len > 4 && len < 20 && count>0) {
	   //envia el formulario
	   $.ajax({
		  url: '../php/addRoute.php',
		  type: 'post',
		  data: {
			  stop1: $("select[name=stop1]").val(),
			  stop2: $("#form_stops #stop2").val(),
			  stop3: $("#form_stops #stop3").val(),
			  stop4: $("#form_stops #stop4").val(),
			  stop5: $("#form_stops #stop5").val(),
			  rute_name: $("#rute_name").val(),
			  id_user: $("#usr_id").val()
		  },
		  dataType: 'json',
		  success: function(array){
			  //para mostrar la ruta creada
			  location.reload();
		  }
	  });
  }else{
	  $(".errorVal").css("display","block");
  }
});






/*
Indice home.php

//agregar calificaciones y comentarios a los usuarios en ventana modal
//modal windows prevent default - para que no se cierren al hacer click
//abrir ventanas modal
	//users information modal
	//add route - addroute
	//dinamic button - addway - add way
	//abrir ventana modal del recorrido -> controller
//cerrar ventanas modal
//responsive para las opciones de la ventana modal de la informacion de los usuarios de las publicaciones
//menu opciones - burguer button - responsive

*/






//agregar calificaciones y comentarios a los usuarios en ventana modal
	$(".comments_info .add_comment label").on("click",function(){
		$(".comments_info .add_comment label").css({backgroundColor:"#F5F5F5",color:"black"});
		$(this).css({backgroundColor:"#009999",color:"white"});
	});
	$(".comments_info .add_comment textarea").on("focus",function(){
		$(".comments_info .add_comment button").fadeIn("slow");
		$(".score-box").fadeIn();
	});


//modal windows prevent default - para que no se cierren al hacer click
	$("#modal-window-route").click(function(e){
		e.stopPropagation();
	});
	$(".error_way").click(function(e){
		e.stopPropagation();
	});
	$("#modal-window").click(function(e){
		e.stopPropagation();
	});
	$("#addRoute").click(function(e){
		e.stopPropagation();
	});

//abrir ventanas modal
	//users information modal
	$("#pub-box").on("click",".open-modal",function(){
		$(".modal-box").fadeToggle("fast");
		$(".modal-window").fadeToggle("fast");
	});
	//add route - addroute
	$("#add-route-user-feed").on("click",function() {
		$(".modal-box").fadeIn("fast");
		$("#modal_add_stop").fadeIn("fast");
	});
	//dinamic button - addway - add way
	$(".dinamic_button").on("click","#btn-add",function(){
		$("#addRouteBox").fadeIn();
		$("#addRoute").show();
	});
	//date and time picker
		//time
		$("#timepicker").lolliclock({
			autoclose:true,
		});
		$("#timepicker").on("click", function(){
			$("#datepicker_root").slideUp("fast");
		});
		//date
		$("#datepicker").pickadate({
			  monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			  monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
			  weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
			  weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			  formatSubmit: 'dddd/dd/mm/yyyy',
			  format: 'dddd, dd mmm, yyyy'
		});
		$("#datepicker").on("click",function(){
			$("#datepicker_root").slideToggle("fast");
		});
		$("#datepicker_root > *").on("click",function(){
			$("#datepicker_root").slideUp("fast");
		});

//cerrar ventanas modal
    $("#modal-box").click(function() {
	    $(".modal-box").fadeOut("fast");
	    $(".modal-window").fadeOut("fast");
	    $("#modal-window-route").fadeOut("fast");
	    $("#modal_add_stop").fadeOut("fast");
    });
    $("#close_add_stop_feed").click(function() {
	    $(".modal-box").fadeOut("fast");
	    $("#modal_add_stop").fadeIn("fast");
    });
    $("#back2").click(function() {
	    $(".modal-box").fadeOut("fast");
	    $("#modal-window-route").fadeOut("fast");
    });
    $("#back").click(function() {
	    $(".modal-box").fadeOut("fast");
	    $(".modal-window").fadeOut("fast");
    });
    $("#closeAddRoute").click(function(){
	    $("#addRouteBox").fadeOut();
	    $("#addRoute").hide();
    });

//responsive para las opciones de la ventana modal de la informacion de los usuarios de las publicaciones
	$(".info_options").click(function(){
		var val = $(this).attr("value");
		var options=["transport_info","routes_info","comments_info", "data_info"];
		$("span").remove(".li_underline");
			if (val== options[0]) {
				$(".transport_info").show();
				$(".routes_info").hide();
				$(".comments_info").hide();
				$(".data_info").hide();
				$(this).html("<span class='li_underline'></span>Vehiculo");
			}else {
				if (val== options[1]) {
					$(".transport_info").hide();
					$(".routes_info").show();
					$(".comments_info").hide();
					$(".data_info").hide();
					$(this).html("<span class='li_underline'></span>Rutas");
				}else {
					if (val== options[2]) {
						$(".transport_info").hide();
						$(".routes_info").hide();
						$(".comments_info").show();
						$(".data_info").hide();
						$(this).html("<span class='li_underline'></span>Comentarios");
					}else {
						if (val== options[3]) {
							$(".transport_info").hide();
							$(".routes_info").hide();
							$(".comments_info").hide();
							$(".data_info").show();
							$(this).html("<span class='li_underline'></span>Datos");
						}
					}
				}
			}
	});


//menu opciones - burguer button - responsive
	$("#bmenuw").click(function(){
		var state = $(".sesion_container_1").css("display");
		if (state=="block"){
			$("#bmenuw").hide().attr("src","../Imagenes/bmenuw.png").fadeIn("slow");
			$(".sesion_container_1").fadeOut();
		}else{
			$("#bmenuw").hide().attr("src","../Imagenes/closebmenuw.png").fadeIn("slow");
			$(".sesion_container_1").fadeIn();
		}
	});



/*
Indice user_profile.php

//menu opciones
//efecto slide en las opciones del menu
//verifica contraseñas iguales
//mostrar preview de la imagen de perfil a subir
//mostrar preview de la imagen de transporte a subir
//mostrar nombre de las imagenes a subir
//cerrar mensaje cambios hechos
//formulario agregar transporte
	//mostrar formulario para agregar transporte
	//ocultar formulario para agregar transporte
//ventanas modal
	//prevent default ventanas modal
	//abrir ventanas modal
	//cerrar ventanas modal
//eliminar rutas - controller

*/

//menu opciones
$("#bmenu").click(function(){
	var state = $(".left-section").css("display");
	if (state=="block"){
		$("#bmenu").hide().attr("src","../Imagenes/bmenuw.png").fadeIn("slow");
		$(".left-section").fadeOut();
	}else{
		$("#bmenu").hide().attr("src","../Imagenes/closebmenuw.png").fadeIn("slow");
		$(".left-section").fadeIn();
	}
});
//efecto slide en las opciones del menu
$(".options-left-section ul a").on("click",function(){
	var name_id= $(this).attr("href");
	$(".big_container > div").hide();
	$(name_id).slideDown();

	var w =$( window ).width();
	if (w<800) {
		$(".left-section").hide();
		$("#bmenu").hide().attr("src","../Imagenes/bmenuw.png").fadeIn("slow");
	}

});
//verifica contraseñas iguales
$('#pass1').keyup(function() {
	var pswd = $(this).val();
	if (pswd.length < 8 && pswd.length > 1 ) {
		$('.message').html('La contraseña debe tener mínimo 8 caracteres').css('color', '#921E1E');
		$('#submit-btn-reg').prop("disabled", true);
	}else if ($('#pass1').val() != $('#pass2').val()) {
		$('.message').html('Las contraseñas no coinciden.').css('color', '#921E1E');
		$('#submit-btn-reg').prop("disabled", true);
	}
	else {
		$('.message').html("");
		$('#submit-btn-reg').prop("disabled", false);
	}
});
$('#pass2').keyup(function() {
	if ($('#pass1').val() != $('#pass2').val()) {
		$('.message').html('Las contraseñas no coinciden.').css('color', '#921E1E');
		$('#submit-btn-reg').prop("disabled", true);
	}else {
		$('.message').html("");
		$('#submit-btn-reg').prop("disabled", false);
	}
});

//mostrar preview de la imagen de perfil a subir
$("#uploadBtn2").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#big_image').prop("src","");
		  $('#big_image').prop("src",e.target.result);
		  $("#profile_Image button").show();
        }
        reader.readAsDataURL(this.files[0]);
    }
});
//mostrar preview de la imagen de transporte a subir
$("#uploadBtn").change(function () {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#transport_image').prop("src","");
		  $('#transport_image').prop("src",e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});
//mostrar nombre de las imagenes a subir
	//imagen de usuario a subir
	$("#uploadBtn").change(function(){
		$(".file_label").text( $(this).val().replace(/.*(\/|\\)/, '') );
	});
	//imagen de transporte a subir
	$("#uploadBtn2").change(function(){
		$(".file_label").text( $(this).val().replace(/.*(\/|\\)/, '') );
	});

//cerrar mensaje cambios hechos
$(".update-done").click(function() {  $(this).remove(); });
$(".update-done").delay( 1500 ).fadeOut( 400 );


//formulario agregar transporte
	//mostrar formulario para agregar transporte
	$("#btn-transp").click(function(){
		$(".no_vehicle").hide();
		$("#btn-transp").css("display", "none");
		$("#transport-box").slideDown();
	});
	//ocultar formulario para agregar transporte
	$("#close-transport").click(function(){
		$(".no_vehicle").show();
		$("#btn-transp").fadeIn("slow");
		$("#transport-box").slideUp();
	});



//ventanas modal
	//prevent default ventanas modal
	$("#delete_transport_form").click(function(e){
 	    e.stopPropagation();
     });
	$("#profile_Image").click(function(e){
		e.stopPropagation();
	});
	$("#modal_add_stop").click(function(e){
		e.stopPropagation();
	});
	//abrir ventanas modal
		//eliminar transporte
		$("#delete-button").click(function(){
			$("#addRouteBox").fadeIn();
			$("#delete_transport_form").show();
		});
		//cambiar imagen de usuario
		$("#little_img").click(function(){
			$("#addRouteBox").fadeIn();
			$("#profile_Image").show();
		});
		//agregar rutas
		$("#add-route-user").click(function(){
			$("#addRouteBox").fadeIn();
			$("#modal_add_stop").fadeIn();
		});
	//cerrar ventanas modal
		//eliminar transporte
		$("#cancel-delete").click(function(){
			$("#addRouteBox").fadeOut();
			$("#delete_transport_form").hide();
		});
		//cambiar imagen de usuario
		$("#cancel_img").click(function(){
			$("#addRouteBox").fadeOut();
			$("#profile_Image").hide();
		});
		//agregar rutas
		$("#close_add_stop").click(function(){
			$("#addRouteBox").fadeOut();
			$("#modal_add_stop").fadeOut();
		});
		//todas
		$("#addRouteBox").click(function(){
			$("#addRouteBox").fadeOut();
			$("#delete_transport_form").hide();
		});
		//todas
		$("#addRouteBox").click(function(){
			$("#addRouteBox").fadeOut();
			$("#profile_Image").hide();
			$("#modal_add_stop").hide();
		});





//eliminar rutas - controller
$(".del_route").on("click", function(){
	var route = $(this);

	$.ajax({
		url: '../php/deleteRoute.php',
		type: 'get',
		data: {
			id_route: $(this).attr("data-id")
		},
		dataType: 'json',
		success: function(array){
			if(array.val=="success"){
				route.parent().fadeOut("fast");
				$(".error-del").text("Se ha eliminado la ruta.");
			}else{
				$(".error-del").text("La ruta existe actualmente en una publicación y no se puede eliminar.");
			}
		}
	});

});


});
