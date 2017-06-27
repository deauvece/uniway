var placeSearch, autocomplete;
var componentForm = {
street_number: 'short_name',
route: 'long_name',
locality: 'long_name',
administrative_area_level_1: 'short_name',
country: 'long_name',
postal_code: 'short_name'
};
function initAutocomplete() {
	var options = {
	componentRestrictions: {country: "col"}
	};
	//FORM-USERPROFILE
	autocomplete = new google.maps.places.Autocomplete(
	  ($('.new-add > #stop1')[0]),options
	);
	autocomplete2 = new google.maps.places.Autocomplete(
	  ($('.new-add > #stop2')[0]),options
	);
	autocomplete3 = new google.maps.places.Autocomplete(
	  ($('.new-add > #stop3')[0]),options
	);
	autocomplete4 = new google.maps.places.Autocomplete(
	  ($('.new-add > #stop4')[0]),options
	);
	autocomplete5 = new google.maps.places.Autocomplete(
	  ($('.new-add > #stop5')[0]),options
  );
	//FEED-SESIONOPEN
	autocomplete = new google.maps.places.Autocomplete(
	  (document.getElementById('search-input')),options
  );

}
$(document).ready(function () {
	/*Funciones generales ----------------------------------------------------------------------------*/

	//fade in effect userProfile
	$(".options-left-section ul a").on("click",function(){
		var name_id= $(this).attr("href");
		$(".big_container > div").hide();
		$(name_id).slideDown();
	});
	//scroll efect
	/*
	$('a[href^="#"]').on('click',function (e) {
		var target = this.hash;
		var $target = $(target);
		$('html, body').stop().animate(
			{'scrollTop': $target.offset().top},
			900,
			'swing',
			function () {
				window.location.hash = target;
			});
		});
	*/

	/*Funciones sesionOpen.php ----------------------------------------------------------------------------*/
		$(".comments_info .add_comment label").on("click",function(){
			$(".comments_info .add_comment label").css({backgroundColor:"#F5F5F5",color:"black"});
			$(this).css({backgroundColor:"#009999",color:"white"});
		});

		$(".comments_info .add_comment textarea").on("focus",function(){
			$(".comments_info .add_comment button").fadeIn("slow");
			$(".score-box").fadeIn();
		});
		$("#modal-window-route").click(function(event){
			if (event.stopPropagation){
				  event.stopImmediatePropagation();
			   }
			   else if(window.event){
				 window.event.cancelBubble=true;
			   }
		});
		//error window
		$(".error_way").click(function(){
			return false;
		});
		$(".error_way button").click(function(){
			location.reload();
		});

		//ventana modal sesionopen.php USERS
	    $("#pub-box").on("click","img",function(){
		    $(".modal-box").fadeToggle("fast");
		    $(".modal-window").fadeToggle("fast");
	    });

	    //cierra las ventanas
	    $("#modal-box").click(function() {
		    $(".modal-box").fadeOut("fast");
		    $(".modal-window").fadeOut("fast");
		    $("#modal-window-route").fadeOut("fast");
	    });
	    $("#back2").click(function() {
		    $(".modal-box").fadeOut("fast");
		    $(".modal-window").fadeOut("fast");
		    $("#modal-window-route").fadeOut("fast");
	    });
	    $("#back").click(function() {
		    $(".modal-box").fadeOut("fast");
		    $(".modal-window").fadeOut("fast");
		    $("#modal-window-route").fadeOut("fast");
	    });
	    $("#modal-window").click(function(){
		    event.stopPropagation();
	    });


		//update page when there's new updates
		$("#new-updates").click(function(){
			location.reload();
		});
		//crear recorrido
		$(".dinamic_button").on("click","#btn-add",function(){
			$("#addRouteBox").fadeIn();
			$("#addRoute").show();
			$('#timepicker').lolliclock({autoclose:true});
		});
		$("#closeAddRoute").click(function(){
			$("#addRouteBox").fadeOut();
			$("#addRoute").hide();
		});
		$("#addRoute").click(function(event){
			if (event.stopPropagation){
			       event.stopPropagation();
			   }
			   else if(window.event){
			      window.event.cancelBubble=true;
			   }
		});
		$("#addRoute").click(function(event){
			if (event.stopPropagation){
			       event.stopImmediatePropagation();
			   }
			   else if(window.event){
			      window.event.cancelBubble=true;
			   }
		});
		//menu opciones
		$("#bmenuw").click(function(){
			$(".options").toggle();
		});
		$("#pub-box").click(function(){
			var w =$( window ).width();
			if (w<800) {
				$(".options").hide();
			}
		});
		$(".sinmenu li a").click(function(){
			$(".sinmenu").css("left","100%");
		});
		$("#btn").click(function(){
			var w =$( window ).width();
			var left = $(".sinmenu").css("left");
			w=w+"px";
			if (left==w) {
				$(".sinmenu").css("left","0%");
			}else {
				$(".sinmenu").css("left","100%");
			}
		});

		//RESPONSIVE EN LA VENTANA MODAL
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



	/*Funciones userProfile.php ---------------------------------------------------------------------------*/

		//cerrar mensaje cambios hecho update
		$(".update-done").click(function() {
			$(this).remove();
		});
		$(".update-done").delay( 1500 ).fadeOut( 400 );
		//agregar transporte
		$("#btn-transp").click(function(){
			$("#btn-transp").css("display", "none");
			$("#transport-box").slideDown();
		});
		$("#close-transport").click(function(){
			$("#btn-transp").fadeIn("slow");
			$("#transport-box").slideUp();
		});

		//input file transport image
		$("#uploadBtn").change(function(){
			$(".file_label").text( $(this).val().replace(/.*(\/|\\)/, '') );
		});
		$("#uploadBtn2").change(function(){
			$(".file_label").text( $(this).val().replace(/.*(\/|\\)/, '') );
		});
		//numero de paradas variables
		$("#num_stops").change(function(){
			var num = $(this).val();
			$("input").remove(".paradas");
			var cont=0;
			for (var i = 1; i <= num ; i++) {
				$("#spots-select").before( "<input type='text' class='paradas ui-autocomplete-input' name='stop"+i+"' placeholder='Ingresa una parada' autocomplete='off' required />" );
			}
		});

		//eliminar transporte de usuario
		$("#delete-button").click(function(){
			$("#addRouteBox").fadeIn();
			$("#delete_transport_form").show();
		});
		$("#addRouteBox").click(function(){
			$("#addRouteBox").fadeOut();
			$("#delete_transport_form").hide();
		});
		$("#cancel-delete").click(function(){
			$("#addRouteBox").fadeOut();
			$("#delete_transport_form").hide();
		});
		$("#delete_transport_form").click(function(){
	 	    return false;
	     });

		//cambiar imagen de usuario
		$("#little_img").click(function(){
			$("#addRouteBox").fadeIn();
			$("#profile_Image").show();
		});
		$("#cancel_img").click(function(){
			$("#addRouteBox").fadeOut();
			$("#profile_Image").hide();
		});
		$("#addRouteBox").click(function(){
			$("#addRouteBox").fadeOut();
			$("#profile_Image").hide();
		});
		$("#profile_Image").click(function(){
	 	    event.stopPropagation();
	     });


		//menu opciones
		$("#bmenu").click(function(){
			$(".left-section").toggle();
		});
		$(".big_container").click(function(){
			var w =$( window ).width();
			if (w<800) {
				$(".left-section").hide();
			}
		});

		//agregar rutas
		$("#add-route-user").click(function(){
			$(".new-add").slideToggle();
			$(this).hide();
			$("#add-route-user2").show();
			$(".error-del").text("");
		});
		//eliminar paradas
		/*$("#hide_stp_1").on("click",function(){
			$("#stop1").fadeOut();
			$(this).hide();
		});
		$("#hide_stp_2").on("click",function(){
			$("#stop2").fadeOut();
			$(this).hide();
		});*/
		$("#hide_stp_3").on("click",function(){
			$("#stop3").attr("required", false);
			$("#stop3").fadeOut();
			$(this).remove();
		});
		$("#hide_stp_4").on("click",function(){
			$("#stop4").attr("required", false);
			$("#stop4").fadeOut();
			$(this).remove();
		});
		$("#hide_stp_5").on("click",function(){
			$("#stop5").attr("required", false);
			$("#stop5").fadeOut();
			$(this).remove();
		});

		//eliminar rutas
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


	/*Funciones home page ---------------------------------------------------------------------------------*/
		//confirma correo enviado
		var pathname = window.location.href;
	 	if (pathname=="http://uniway.heliohost.org/?email=true"  || pathname=="http://localhost/Uniway/uniway/index.html?eml=true") {
			$(".email_send").fadeIn().delay(1500).fadeOut();
		}
		//cambia la barra de navegacion
		$(window).scroll(function (event) {
		    var scroll = $(window).scrollTop();
		    if (scroll>100) {
			    var w =$( window ).width();
    				if (w > 800) {
					$("#logo img").css("height","35px");
					$(".home-nav").css({height:"55px",});
					$("header h2").css({fontSize:"250%",});
				}
		    }else {
			    var w =$( window ).width();
    				if (w > 800) {
					$("#logo a img").css("height","45px");
					$(".home-nav").css({height:"70px",});
					$("header h2").css({fontSize:"300%",});
				}

		    }
		});
		//login user
		//contact-form index.html
		$("#login").click(function(){
			var w =$( window ).width();
			if (w > 800) {
				$("#contact-box").fadeIn();
				$("#login-form").fadeIn().css("transform","translateY(450px)");
			}else{
				window.location="login-user.php";
			}
		});
		$("#contact-modal").click(function(){
			$("#contact-box").fadeIn();
			$(".contact-form").fadeIn().css("transform","translateY(-375px)");
		});

		$("#close-login-form").click(function(){
			$("#login-form").fadeOut().css("transform","translateY(-450px)");
			$("#contact-box").fadeOut();
		});
		$("#close-contact-form").click(function() {
			$("#contact-box").fadeOut();
			$(".contact-form").fadeOut().css("transform","translateY(375px)");
		});

		/*Funciones reset password page ---------------------------------------------------------------------------------*/
		$("#change_pass").click(function() {
			$.ajax({
				url: 'php/json_change_pass.php',
				type: 'get',
				data: {
					change_pass_email: $("#change_pass_email").val()
				},
				dataType: 'json',
				success: function(array){

					if (array.response=="no_email") {
						$("#change_pass_error").fadeIn("slow").text("Debes introducir una dirección de correo electrónico.")
					}else if (array.response=="doesnt_exist") {
						$("#change_pass_error").fadeIn("slow").text("Este correo no existe en nuestra base de datos.")
					}else if (array.response=="success") {
						$("#change_pass_error").fadeIn("slow").text("Hemos enviado las instrucciones a tu email, si no lo encuentras revisa en la carpeta de spam!")
					}
				}
			});
		});


});
