$(document).ready(function () {
	/*Funciones generales ----------------------------------------------------------------------------*/
	//scroll efect
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

	/*Funciones sesionOpen.php ----------------------------------------------------------------------------*/
		$("#pub-box").on('click','.btn-pedirCupo',function(){
			var way = $(this).attr("data-way");
			$.ajax({
				url: '../php/add-usr-ways.php',
				type: 'get',
				data: {
					id_user_q: $(this).attr("data-usr"),
					id_way_q: $(this).attr("data-way")
				},
				dataType: 'json',
				success: function(array){
					if (array.state=="yes") {
						var url="../sesion/group-chat.php?id_way="+way;
						window.location=url;
					}else {
						$(".modal-window").hide();
						$(".modal-box").fadeIn("fast");
						$(".error_way span").text(array.message);
						$(".error_way").fadeIn();
					}
				}
			});

		});
		//error window
		$(".error_way").click(function(){
			event.stopPropagation();
		});
		$(".error_way button").click(function(){
			location.reload();
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

		//update page when there's new updates
		$("#new-updates").click(function(){
			location.reload();
		});
		//crear recorrido
		$("#btn-add").click(function(){
			$("#addRouteBox").fadeIn();
			$("#addRoute").show();
			$('#timepicker').lolliclock({autoclose:true});
		});
		$("#closeAddRoute").click(function(){
			$("#addRouteBox").fadeOut();
			$("#addRoute").hide();
		});
		//json user data query
		$("#pub-box").on('click','img',function(){
			$.ajax({
				url: '../php/json_user_query.php',
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
					//transport
					$("#user_transport_type").text(array.tipo);
					$("#user_transport_model").text(array.model);
					$("#user_transport_license_plate").text(array.license_plate);
					if (array.wifi=="f") {
						$("#user_transport_wifi").text("No");
					}else{
						$("#user_transport_wifi").text("Si");
					}
					if (array.air_conditioner=="f") {
						$("#user_transport_air_conditioner").text("No");
					}else{
						$("#user_transport_air_conditioner").text("Si");
					}
					if (!array.image) {
						$("#user_transport_image").attr("src", "../Imagenes/transportImages/default.png");
					}else {
						$("#user_transport_image").attr("src", array.image);
					}
					$("#user_transport_price").text(array.price);
					//rutas del usuario
					$("div").remove(".rts-box");
					var ar_span=[array.stop11,array.stop12,array.stop13,array.stop14,array.stop15,array.stop21,array.stop22,array.stop23,array.stop24,array.stop25,array.stop31,array.stop32,array.stop33,array.stop34,array.stop35,array.stop41,array.stop42,array.stop43,array.stop44,array.stop45,array.stop51,array.stop52,array.stop53,array.stop54,array.stop55];
					var k=0;
					for (var i = 0; i < array.num_routes; i++) {
						if (ar_span[k]) {
							var span1="<span>"+ar_span[k]+"</span>";
							k++;
						}else {	var span1="";  k++;}
						if (ar_span[k]) {
							var span2="<span>"+ar_span[k]+"</span>";
							k++;
						}else {	var span2=""; k++;}
						if (ar_span[k]) {
							var span3="<span>"+ar_span[k]+"</span>";
							k++;
						}else {   var span3=""; k++;}
						if (ar_span[k]) {
							var span4="<span>"+ar_span[k]+"</span>";
							k++;
						}else {	var span4=""; k++;}
						if (ar_span[k]) {
							var span5="<span>"+ar_span[k]+"</span>";
							k++;
						}else {	var span5="";  k++;}
						var text ="<div class='rts-box'>"+span1+span2+span3+span4+span5+"</div>";
						$(".routes_info").append(text);
					}
				}
			});

		});
		//menu opciones
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


		//modal-window  mostrar datos, rutas, comentarios, vehiculo
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
		$(".update-done").click(function() {
			$(this).remove();
		});
	/*Funciones userProfile.php ---------------------------------------------------------------------------*/
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
			//agregar rutas
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

			//numero de paradas variables
			$("#num_stops").change(function(){
				var num = $(this).val();
				$("input").remove(".paradas");
				var cont=0;
				for (var i = 1; i <= num ; i++) {
					$("#spots-select").before( "<input type='text' class='paradas ui-autocomplete-input' name='stop"+i+"' placeholder='Ingresa una parada' autocomplete='off' required >" );
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
		 	    event.stopPropagation();
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
			//busqueda de paradas
			$("#addRoute").on("keyup","input",function(){
				$( ".paradas" ).autocomplete({
					source: '../php/json_stops.php'
				});
			});

			//menu opciones
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
	/*Funciones home page ---------------------------------------------------------------------------------*/
		//login user
		$("#login").click(function(){
			var w =$( window ).width();
			if (w > 800) {
				$("#login-form").fadeToggle("fast");
			}else{
				window.location="login-user.php";
			}
		});
		//contact-form index.html
		$("#contact-modal").click(function(){
			$("#contact-box").fadeIn();
		});
		$("#close-contact-form").click(function() {
			$("#contact-box").fadeOut();
		});

});
