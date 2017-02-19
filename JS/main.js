$(document).ready(function () {


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
				$(".user_img_query").attr("src", array.profile_image);
				$(".user_name_query").text(array.full_name);
				$(".user_university_query").text(array.university_acr);
				$(".user_email_query").text(array.email);
				$(".user_phone_query").text(array.phone);
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
	$("#login").click(function(){
		var w =$( window ).width();
		if (w > 800) {
			$("#login-form").fadeToggle("fast");
		}else{
			window.location="login-user.php";
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
    $("#back").click(function() {
	    $(".modal-box").fadeOut("fast");
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

			$("#btn").click(function(){
				$(".sinmenu").fadeToggle("fast");
			});


			//modal-window sesionOpen mostrar datos, rutas, comentarios, vehiculo
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

});
