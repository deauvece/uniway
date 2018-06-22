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
//enviar y recibir mensajes
	//realiza la conexion con el servidor
	//funcion en caso de error
	//funcion al cargar la pagina
	//funcion para enviar mensajes
	//funcion para recibir mensajes
	//funcion cerrar la conexion con el servidor al cerrar la ventana



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


//enviar y recibir mensajes

	//realiza la conexion con el servidor
		var ws="ws://localhost:8080?way=";
		var way = $("#textarea-inpt").attr("data-way");
		ws=ws+way;
		var conn = new WebSocket(ws);
	//funcion en caso de error
		conn.onerror = function (error) {
			console.log("an error occurred when sending/receiving data");
		};
	//funcion al cargar la pagina
		conn.onopen = function(e){
			console.log("Connection established!");
		};
	//funcion para enviar mensajes
		//eventos: enter / boton
		$("#send-button").on("click",function(){
			var val=$('#textarea-inpt').val();
			if (val.length > 1 ) {
				sendMess(val);//se envia el mensaje
				$('#textarea-inpt').val('');
			}
		});
		$('#textarea-inpt').keypress(function (e) {
			if(e.which  == 13) {
				e.preventDefault();
				var val=$('#textarea-inpt').val();
				if (val.length > 1 ) {
					sendMess(val);//se envia el mensaje
				}
				$('#textarea-inpt').val('');
			}
		});
		//envia el mensaje
		function sendMess(val){
			//contenido del mensaje
				//hora actual
				now = new Date();
				time = now.getHours()+":"+now.getHours();
			var message = [];
				//el caracter '°' separa la informacion del mensaje
			message[0] = $('#textarea-inpt').attr("data-name-user")+"°";
			message[1] = time+"°";;
			message[2] = $('#textarea-inpt').attr("data-way")+"°";;
			message[3] = $('#textarea-inpt').attr("data-idu")+"°";;
			message[4] = val;
			//el mensaje debe ser de tamaño mayor a 1
			if (message[4].length > 1 ) {
				//se envia al resto de usuarios conectados
				conn.send(message);
				//se agrega a la base de datos
				$.ajax({
					url: '../php/add-comment.php',
					type: 'get',
					data: {
						id_user: $('#textarea-inpt').attr("data-idu"),
						name_user: $('#textarea-inpt').attr("data-name-user"),
						id_way: $('#textarea-inpt').attr("data-way"),
						comment: message[4]
					},
					dataType: 'json',
					success: function(array){
						//se muestra en pantalla
						var mes ="<div class='comment-right' data-id="+message[3]+" ><div class='box'><span class='name-coment'>Yo</span><span class='content-coment' >"+message[4]+"<span class='time-coment' >"+time+"</span></span></div></div>";
						$('.content-cht').append(mes);
						$('.content-cht').animate({"scrollTop": $('.content-cht')[0].scrollHeight}, "fast");
						delete now,time;
					}
				});
			}
		};
	//funcion para recibir mensajes
		conn.onmessage = function(e){
			var message = e.data;
			message=message.split("°");
			message[1]=message[1].substring(1);
			message[4]=message[4].substring(1);
			var mes ="<div class='comment-left' data-id="+message[3]+" ><div class='box'><span class='name-coment'>"+message[0]+"</span><span class='content-coment' >"+message[4]+"<span class='time-coment' >"+message[1]+"</span></span></div></div>";
			$('.content-cht').append(mes);
			$('.content-cht').animate({"scrollTop": $('.content-cht')[0].scrollHeight}, "fast");
		};

	//funcion cerrar la conexion con el servidor al cerrar la ventana
		$(window).bind("beforeunload", function() {
			conn.onclose = function(e){
				console.log("client out");
			};
		})


});
