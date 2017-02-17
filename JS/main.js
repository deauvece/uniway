$(document).ready(function () {
	//CHECK FOR WAYS UPDATES
	function check(){

		$.ajax({
			url: '../Php/json_check_status.php',
			type: 'get',
			data: {
				rdn_string: $("#status_feed").attr("value"),
				id_uni: $("#status_feed").attr("class")
			},
			dataType: 'json',
			success: function(array){
				if (array.update=="true") {
					$("#new-updates").fadeIn();
					clearInterval(interval);
				}
			}
		});
	}
	//1000 = 1 segundo
	var interval = setInterval(check, 5000);

	//update page when there's new updates
	$("#new-updates").click(function(){
		location.reload();
	});

	//json user query
	$("#pub-box").on('click','img',function(){
		$.ajax({
			url: '../Php/json_user_query.php',
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

	//scroll efect on userprofile.php
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
		$("#addRoute").show();
		$('#timepicker').lolliclock({autoclose:true});
	});
	$("#closeAddRoute").click(function(){
		$("#addRouteBox").fadeOut();
		$("#addRoute").hide();
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
	//input file transport image userprofile.php
	$("#uploadBtn").change(function(){
		$(".file_label").text( $(this).val().replace(/.*(\/|\\)/, '') );
	});
	$("#uploadBtn2").change(function(){
		$(".file_label").text( $(this).val().replace(/.*(\/|\\)/, '') );
	});
	//agregar paradas userprofile.php
	$("#add-route-user").click(function(){
		$("#addRouteBox").fadeIn();
		$("#addRoute").show();
	});
	$("#closeAddRoute").click(function(){
		$("#addRouteBox").fadeOut();
		$("#addRoute").hide();
	});
	$("#addRouteBox").click(function(){
		$("#addRouteBox").fadeOut();
		$("#addRoute").hide();
	});
	$("#addRoute").click(function(){
 	    event.stopPropagation();
     });

	//numero de paradas variables en userprofile -- creacion de rutas
	$("#num_stops").change(function(){
		var num = $(this).val();
		$("input").remove(".paradas");
		var cont=0;
		for (var i = 1; i <= num ; i++) {
			$("#spots-select").before( "<input type='text' class='paradas ui-autocomplete-input' name='stop"+i+"' placeholder='Ingresa una parada' autocomplete='off' required >" );
		}
	});


	//eliminar transporte userprofile.php
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
 	    event.stopPropagation();
     });


	//cambiar imagen userprofile.php
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

	//ventana modal sesionopen.php
    $("#pub-box").on("click","img",function(){
	    $(".modal-box").fadeIn("fast");
    });


    $("#modal-box").click(function(){
	    $(".modal-box").fadeOut("fast");
    });
    $("#modal-window").click(function(){
	    event.stopPropagation();
    });

	//busqueda de paradas en userProfile.php
			$("#addRoute").on("keyup","input",function(){
				$( ".paradas" ).autocomplete({
					source: '../Php/json_stops.php'
				});
				$('.paradas').keyup(function(){
					$(this).val($(this).val().toUpperCase());
				});
			});

			//menu opciones userProfile.php
			$("#bmenu").click(function(){
				$(".left-section").fadeToggle();
			});
			$(".big_container").click(function(){
				var w =$( window ).width();
				if (w<800) {
					$(".left-section").fadeOut();
				}
			});
			$(".left-section").click(function(){
		 	    event.stopPropagation();
		     });
			//menu opciones sesionOpen.php
			$("#bmenuw").click(function(){
				$(".options").fadeToggle();
			});
			$("#pub-box").click(function(){
				var w =$( window ).width();
				if (w<800) {
					$(".options").fadeOut();
				}

			});
			$(".options").click(function(){
			    event.stopPropagation();
			});
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
