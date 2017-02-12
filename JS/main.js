$(document).ready(function () {

	//prueba de json 9/2/2017
	$(".open-modal").click(function(){
		$.ajax({
			url: '../Sesion/json_user_query.php',
			type: 'get',
			data: {
				id_user_query: $(this).attr("alt")
			},
			dataType: 'json',
			success: function(array){
				$("#user_img_query").attr("src", array.profile_image);
				$("#user_name_query").text(array.full_name);
				$("#user_university_query").text(array.university_acr);
				$("#user_email_query").text(array.email);
				$("#user_phone_query").text(array.phone);
			}
		});

	});



	//login user home.html
	var bin=0;
		$("#login").click(function(){
			if (bin==0) {
				$("#login-form ").fadeIn();
				bin=1;
			}else{
				$("#login-form ").fadeOut();
				bin=0;
			}
		});
	//contact-form home.html
	$("#contact-modal").click(function(){
		$("#contact-box").fadeIn();
	});
	$("#close-contact-form").click(function() {
		$("#contact-box").fadeOut();
	});

	//crear recorrido sesionopen.php
	$("#btn-add").click(function(){
		$("#addRouteBox").fadeIn();
		$('#timepicker').lolliclock({autoclose:true});
	});
	$("#closeAddRoute").click(function(){
		$("#addRouteBox").fadeOut();
	});

	//agregar transporte userprofile.php
	$("#btn-transp").click(function(){
		$("#btn-transp").css("display", "none");
		$("#transport-box").slideDown();
	});
	$("#close-transport").click(function(){
		$("#btn-transp").fadeIn("slow");
		$("#transport-box").slideUp();
	});
	//agregar ruta userprofile.php
	$("#add-route-user").click(function(){
		$("#addRouteBox").fadeIn();
	});
	$("#closeAddRoute").click(function(){
		$("#addRouteBox").fadeOut();
	});

	//cambiar imagen userprofile.php
	$("#little_img").click(function(){
		$("#image_box").css("display", "inline-block");
		$("#profile_Image").fadeIn();
	});
	$("#cancel_img").click(function(){
		$("#image_box").fadeOut();
	});

	//ventana modal sesionopen.php
    $(".open-modal").click(function(){
	    $(".modal-box").fadeIn("fast");
    });
    $("#modal-box").click(function(){
	    $(".modal-box").fadeOut("fast");
    });
    $("#modal-window").click(function(){
	    event.stopPropagation();
    });

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

});





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
