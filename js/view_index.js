$(document).ready(function () {

/*
Indice


//--evento(s) (pagina a la que afecta el evento(s) )

//menu opciones - burguer button (index)
//animacion de scroll (index)
//envia correo de contacto(index)
//cambia la barra de navegacion al hacer scroll (index)
//boton para regresar arriba - scroll to top button (index)
//verifica validez de los email en pagina de registro (register page)
//ventanas modal (index)
	//abrir ventanas modal
	//ocular ventanas modal

//Funciones reset password page


*/



//menu opciones - burguer button (index)
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
$(".sinmenu li a").click(function(){
	$(".sinmenu").css("left","100%");
});

//animacion de scroll (index)
$('a[href^="#"]').on('click',function (e) {
	var target = this.hash;
	var target2 = $(target);
	$('html, body').stop().animate(
		{'scrollTop': target2.offset().top},
		900,
		'swing',
		function () {
			window.location.hash = target;
		});
	var w =$( window ).width();
	if (w < 800) {
		$("#btn-label > img").hide().attr("src","Imagenes/bmenu.png").fadeIn("slow");
	}
});



//envia correo de contacto(index)
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

//cambia la barra de navegacion al hacer scroll (index)
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

//boton para regresar arriba - scroll to top button (index)
$(".scrolltop").click(function() {
	$("html, body").animate({ scrollTop: 0 }, "slow");
	return false;
});


//verifica validez de los email en pagina de registro (register page)
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

//ventanas modal (index)
	//abrir ventanas modal
		//mostrar formulario login
		$("#login").click(function(){
			var w =$( window ).width();
			if (w > 800) {
				$("#contact-box").fadeIn();
				$("#login-form").fadeIn().css("transform","translateY(450px)");
			}else{
				window.location="login-user.php";
			}
		});
		//mostrar formulario contacto
		$(".contact-modal").click(function(){
			$("#contact-box").fadeIn();
			$(".contact-form > h2, .contact-form input[type='submit'],.contact-form  input[type='button']").css({
				backgroundColor: "#b72c2c"
			});
			$(".contact-form").fadeIn().css("transform","translateY(-400px)");
		});
	//ocular ventanas modal
		//ocultar formulario login
		$("#close-login-form").click(function(){
			$("#login-form").fadeOut().css("transform","translateY(-450px)");
			$("#contact-box").fadeOut();
		});
		//ocultar formulario contacto
		$("#close-contact-form").click(function() {
			$("#contact-box").fadeOut();
			$(".contact-form").fadeOut().css("transform","translateY(400px)");
		});


//Funciones reset password page
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
