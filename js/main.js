
$(document).ready(function () {
	/*Funciones generales ----------------------------------------------------------------------------*/

	//fade in effect userProfile
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


	/*Funciones sesionOpen.php ----------------------------------------------------------------------------*/

		//hover buttons
		$("#pub-box").on({
		    click: function () {
			   $(this).css({
				   backgroundColor:"rgba(0, 0, 0, 0.7)",
				   color:"rgba(0, 0, 0, 0)",
			   });
			   $(".name,.time,.ini-desti,.comentario",this).hide();
			   $(".ruta, .btn-pedirCupo, .btn-eliminar",this).show();
		    },
		    mouseenter: function () {
			    $(this).css({
 				   backgroundColor:"#F5F8FA"
 			   });
		   },
		    mouseleave: function () {
			    $(this).css({
 				   backgroundColor:"white",
 				   color:"rgba(0, 0, 0, 1)",
 			   });
			   $(".name,.time,.ini-desti,.comentario",this).show();
			   $(".ruta, .btn-pedirCupo, .btn-eliminar",this).hide();
		    }
	    },".publicaciones, .publicaciones-n");


		$(".comments_info .add_comment label").on("click",function(){
			$(".comments_info .add_comment label").css({backgroundColor:"#F5F5F5",color:"black"});
			$(this).css({backgroundColor:"#009999",color:"white"});
		});

		$(".comments_info .add_comment textarea").on("focus",function(){
			$(".comments_info .add_comment button").fadeIn("slow");
			$(".score-box").fadeIn();
		});
		$("#modal-window-route").click(function(e){
			e.stopPropagation();
		});
		//error window
		$(".error_way").click(function(e){
			e.stopPropagation();
		});

		//ventana modal sesionopen.php USERS
	    $("#pub-box").on("click",".open-modal",function(){
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
	    $("#modal-window").click(function(e){
		    e.stopPropagation();
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
		$("#addRoute").click(function(e){
			e.stopPropagation();
		});
		$("#addRoute").click(function(e){
			e.stopPropagation();
		});
		//menu opciones
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
		$(".sinmenu li a").click(function(){
			$(".sinmenu").css("left","100%");
		});
		$("#btn").click(function(){
			var w =$( window ).width();
			var left = $(".sinmenu").css("left");
			w=w+"px";
			if (left==w) {
				$("#btn-label > img").hide().attr("src","Imagenes/closebmenu.png").fadeIn("slow");
				$(".sinmenu").css("left","0%");
			}else {
				$("#btn-label > img").hide().attr("src","Imagenes/bmenu.png").fadeIn("slow");
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
		//verifica contraseñas
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
		            //$('#profile_Image').prop('<img src="'+e.target.result+'" width="450" height="300"/>');
		        }
		        reader.readAsDataURL(this.files[0]);
		    }
		});
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
		//mostrar preview de la imagen del transporte a subir

		//cerrar mensaje cambios hecho update
		$(".update-done").click(function() {
			$(this).remove();
		});
		$(".update-done").delay( 1500 ).fadeOut( 400 );
		//agregar transporte
		$("#btn-transp").click(function(){
			$(".no_vehicle").hide();
			$("#btn-transp").css("display", "none");
			$("#transport-box").slideDown();
		});
		$("#close-transport").click(function(){
			$(".no_vehicle").show();
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
		$("#delete_transport_form").click(function(e){
	 	    e.stopPropagation();
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
			$("#modal_add_stop").hide();
		});
		$("#profile_Image").click(function(e){
			e.stopPropagation();
	     });
		//mostrar formulario agregar rutas add stop addstop
		$("#add-route-user").click(function(){
			$("#addRouteBox").fadeIn();
			$("#modal_add_stop").fadeIn();
		});
		$("#close_add_stop").click(function(){
			$("#addRouteBox").fadeOut();
			$("#modal_add_stop").fadeOut();
		});
		$("#modal_add_stop").click(function(e){
			e.stopPropagation();
	     });


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
		$(".big_container").click(function(){
			var w =$( window ).width();
			if (w<800) {
				$(".left-section").hide();
			}
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


		//agregar rutas

	/*Funciones home page ---------------------------------------------------------------------------------*/

		//verifica validez de los email pagina de registro
		$(".verif_email").on("change",function(){
			$.ajax({
				url: 'php/json_email_validator.php',
				type: 'get',
				data: {
					email: $(this).val()
				},
				dataType: 'json',
				success: function(array){
					if (array.isValid==false) {
						$(".erroremail").text("La dirección de correo no es válida.");
						$('.submit-btn').prop("disabled", true);
					}else{
						$(".erroremail").text("");
						$('.submit-btn').prop("disabled", false);
					}
				}
			});
		});

		//envia correo de contacto
		$(".enviarCorreo").on("click",function(){
					  $("form[name='cont-form']").validate({
					    rules: {
					      name_user: {
					        required: true,
					        maxlength: 25,
						   minlength: 4
					   	 },
					      subject: {
					        required: true,
					        maxlength: 35,
						   minlength: 4
					   	 },
					      content: {
					        required: true,
					        maxlength: 250
					      }
					    },
					    //mensajes de error
					    messages: {
					      name_user: {
					        required: "<span class=''>Ingresa un nombre valido</span>",
					        maxlength: "<span class=''>Tu nombre no puede tener mas de 25 caracteres</span>",
						   minlength: "<span class=''>Tu nombre no puede tener menos de 4 caracteres</span>"
					   	},
					      subject:{
					        required: "<span class=''>Ingresa un asunto valido</span>",
					        maxlength: "<span class=''>El asunto no puede tener mas de 35 caracteres</span>",
						   minlength: "<span class=''>El asunto no puede tener menos de 4 caracteres</span>"
					   	},
					      content: {
					        required: "<span class=''>Ingresa un comentario</span>",
					        maxlength: "<span class=''>Tu comentario no puede tener mas de 250 caracteres</span>"
					      }
					    },
					    //submit
					    submitHandler: function(form) {
						    $.ajax({
   			 				url: 'php/json_send_email.php',
   			 				type: 'post',
   			 				data: {
   			 					email: $("#email-contact").val(),
   			 					name: $("#nombre-contact").val(),
   			 					subject: $("#asunto-contact").val(),
   			 					content: $("#content-contact").val()
   			 				},
   			 				dataType: 'json',
   			 				success: function(array){
   			 					if (array.sended==false) {
   			 						console.log("no enviado");
   			 					}else{
									$(".contact-form > h2, .contact-form input[type='submit'],.contact-form  input[type='button']").css({
										backgroundColor: "#007272"
									});
									$(".contact-form").css({
										transition:"all 1.5s",
										transform:"translateY(-200vh)"
									});
									$("#contact-box").fadeOut("slow");
									$(".email_send").fadeIn().css("transform","translateY(-50px)").delay(1500).fadeOut();
									$("#email-contact").val("");
									$("#nombre-contact").val("");
									$("#asunto-contact").val("");
									$("#content-contact").val("");
   			 						console.log("enviado");
   			 					}
   			 				}
   			 			});
					    }
					  });
		});
		//cambia la barra de navegacion y scroll to top button
		$(window).scroll(function () {
		    var scroll = $(window).scrollTop();
		    if (scroll>100) {
			    $(".scrolltop").fadeIn();
			    var w =$( window ).width();
    				if (w > 800) {
					$("#logo img").css("height","30px");
					$(".home-nav").css({height:"60px",paddingTop:"15px"});
					$("header h2, header p").css({opacity:"0",});

				}
		    }else {
			    $(".scrolltop").fadeOut();
			    var w =$( window ).width();
    				if (w > 800) {
					$("#logo a img").css("height","45px");
					$(".home-nav").css({height:"70px",paddingTop:"20px"});
					$("header h2, header p").css({opacity:"1",});

				}

		    }
		});
		$(".scrolltop").click(function() {
		  $("html, body").animate({ scrollTop: 0 }, "slow");
		  return false;
		});
		//login user
		//contact-form index.html
		//open
		$("#login").click(function(){
			var w =$( window ).width();
			if (w > 800) {
				$("#contact-box").fadeIn();
				$("#login-form").fadeIn().css("transform","translateY(450px)");
			}else{
				window.location="login-user.php";
			}
		});
		$(".contact-modal").click(function(){
			$("#contact-box").fadeIn();
			$(".contact-form > h2, .contact-form input[type='submit'],.contact-form  input[type='button']").css({
				backgroundColor: "#b72c2c"
			});
			$(".contact-form").fadeIn().css("transform","translateY(-400px)");
		});
		//close
		$("#close-login-form").click(function(){
			$("#login-form").fadeOut().css("transform","translateY(-450px)");
			$("#contact-box").fadeOut();
		});

		$("#close-contact-form").click(function() {
			$("#contact-box").fadeOut();
			$(".contact-form").fadeOut().css("transform","translateY(400px)");
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
