$(document).ready(function () {


/*
Indice chat

//menu de opciones e informacion de usuarios
//hace scroll hasta el final de la caja de comentarios
//modifica el tamaño del chat al tamaño de la ventana
//ventanas modal
	//prevent default
	//abrir ventanas modal
	//cerrar ventanas modal
//envia el comentario al presionar enter
//envia el comentario al presionar el boton de enviar
//actualiza los comentarios cada x segundos



*/

//menu de opciones e informacion de usuarios
	$("#info-button").click(function(){
		var state = $(".people").css("display");
		if (state=="block"){
			$("#info-button").prop("src","../Imagenes/info.png");
			console.log("none");
		}else{
			$("#info-button").prop("src","../Imagenes/closebmenuw.png");
			console.log("block");
		}
	     $(".container-chat .people").fadeToggle();
	});

//hace scroll hasta el final de la caja de comentarios
	$('.content-cht').animate({
		"scrollTop": $('.content-cht')[0].scrollHeight}, "fast"
	);

//modifica el tamaño del chat al tamaño de la ventana
	var alt = $( window ).height();
	alt= alt-60;
	$(".container-chat").css( "height", alt );


//ventanas modal
	//prevent default
		$(".delete-way").click(function(e){
			e.stopPropagation();
		});
		$(".msg-out").click(function(e){
			e.stopPropagation();
		});
	//abrir ventanas modal
		//salir del recorrido
		$("#out-group").click(function(){
			$(".modal-box").fadeIn("fast");
			$(".msg-out").show();
			$(".delete-way").hide();
		});
		//eliminar el recorrido
		$("#delete-group").click(function(){
			$(".modal-box").fadeIn("fast");
			$(".msg-out").hide();
			$(".delete-way").show();
		});
	//cerrar ventanas modal
		//salir del recorrido y eliminar recorrido
		$(".no-confirm").click(function(){
			$(".modal-box").fadeOut("fast");
			$(".msg-out").hide();
			$(".delete-way").hide();
		});
		//todas
		$("#modal-box").click(function(){
			$(".modal-box").fadeOut("fast");
			$(".msg-out").hide();
			$(".delete-way").hide();
		});

//envia el comentario al presionar enter
	$('#textarea-inpt').keypress(function (e) {
		var hgth = $(this).val().length;
		if (e.which == 13) {
			if (hgth > 0) {
				$.ajax({
					url: '../php/add-comment.php',
					type: 'get',
					data: {
						id_user: $(this).attr("data-idu"),
						name_user: $(this).attr("data-name-user"),
						id_way: $(this).attr("data-way"),
						comment: $(this).val()
					},
					dataType: 'json',
					success: function(array){
						$('.content-cht').animate({"scrollTop": $('.content-cht')[0].scrollHeight}, "fast");
						$(this).val('');
					}
				});
			}
			$(this).val('');
		  e.preventDefault();
		}
	});

//envia el comentario al presionar el boton de enviar
	$('#send-button').on("click",function() {
		var hgth = $('#textarea-inpt').val().length;
			if (hgth > 0) {
				$.ajax({
					url: '../php/add-comment.php',
					type: 'get',
					data: {
						id_user: $('#textarea-inpt').attr("data-idu"),
						name_user: $('#textarea-inpt').attr("data-name-user"),
						id_way: $('#textarea-inpt').attr("data-way"),
						comment: $('#textarea-inpt').val()
					},
					dataType: 'json',
					success: function(array){
						$('.content-cht').animate({"scrollTop": $('.content-cht')[0].scrollHeight}, "fast");
						$('#textarea-inpt').val('');
					}
				});
			}
			$('#textarea-inpt').val('');
	});

//actualiza los comentarios cada x segundos
	function update_cmt(){
		var idway = $("#textarea-inpt").attr("data-way");
		var lastcommentid = $(".content-cht > div:last-child").attr("data-id");

		  $.ajax({
			  url: '../php/json_check_comments.php',
			  type: 'get',
			  data: {
				  id_way:idway,
				  last_comment_id: lastcommentid
			  },
			  dataType: 'json',
			  success: function(array){
				  if (array.state=="same") {
				  }else{
					  $('.content-cht').append(array.cms);
					  $('.content-cht').animate({"scrollTop": $('.content-cht')[0].scrollHeight}, "fast");
				  }
			  }
		  });
	}
	//1000 = 1 segundo
	var interval = setInterval(update_cmt, 1000);

});
