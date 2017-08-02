$(document).ready(function () {

	//loading image
	$("#usr_img").hide();

	//CONSULTA LAS PARADAS DE UN DETEMRINADO RECORRIDO (WAY) SESIONOPEN
	$(document).on('click touchstart', '.ruta', function() {

		var data= $(this).parent().attr("data-way");
		$.ajax({
			url: '../php/json_stops_query.php',
			type: 'get',
			data: {
				id_way: data
			},
			dataType: 'json',
			success: function(array){
				var array_stops=[];
				array_stops[0]=array.stp1;
				array_stops[1]=array.stp2;
				array_stops[2]=array.stp3;
				array_stops[3]=array.stp4;
				array_stops[4]=array.stp5;
				$("#stp1").text(array.stp1);
				$("#stp2").text(array.stp2);
				$("#stp3").text(array.stp3);
				$("#stp4").text(array.stp4);
				$("#stp5").text(array.stp5);
				//genera el mapa
				var directionsService = new google.maps.DirectionsService;
				var directionsDisplay = new google.maps.DirectionsRenderer;
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 10,
					center: {lat: 7.13, lng: -73.13}
				});
				directionsDisplay.setMap(map);

				var waypts = [];
			   	  for (var i = 0; i < array.tam; i++) {
			   	    if (i!=0 || i!=array.tam-1) {
			   		 waypts.push({
			   		   location: array_stops[i],
			   		   stopover: true
			   		 });
			   	    }
			   	  }
			   	  directionsService.route({
			   	    origin: array_stops[0],
			   	    destination: array_stops[(array.tam)-1],
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
		});
	});

	//LIMPIA LAS PUBLICACIONES
	$("#search-input").on("keyup",function() {
			var sizeResult = $("#search-input").val().length;
			if (sizeResult==0) {
				$(".no-results").css("display","none");
				$("div").remove(".p-before");
				$(".publicaciones").show();
				$(".result-txt").remove();
				$(document).attr("title", "Uniway");
			}
	});




	//AGREGA LAS PUBLICACIONES MAS RECIENTES AL CARGAR LA PAGINA
	var publications_box=$("#pub-box").val();
	if (!publications_box) {
		$.ajax({
			url: '../php/json_ways_query.php',
			type: 'get',
			data: {
				id_uni: $("#status_feed").attr("class")
			},
			dataType: 'json',
			success: function(array){
				$("#pub-box .spinner").hide();
				$("#pub-box").append(array.output);
			}
		});
	}


	//MUESTRA NUEVAS PUBLICACIONES
	$("#new-updates").click(function(){
		$(".publicaciones").remove();
		$(this).hide();
		$("#pub-box .spinner").show();
		$.ajax({
			url: '../php/json_ways_query.php',
			type: 'get',
			data: {
				id_uni: $("#status_feed").attr("class")
			},
			dataType: 'json',
			success: function(array){
				$("#pub-box .spinner").hide();
				$("#pub-box").append(array.output);
			}
		});
	});
	//actualiza publicaciones al mostrar un error
	$(".error_way button").click(function(){
		$(".publicaciones").remove();
		$(this).parent().hide();
		$("#modal-box").hide();
		$("#pub-box .spinner").show();
		$.ajax({
			url: '../php/json_ways_query.php',
			type: 'get',
			data: {
				id_uni: $("#status_feed").attr("class")
			},
			dataType: 'json',
			success: function(array){
				$("#pub-box .spinner").hide();
				$("#pub-box").append(array.output);
			}
		});
	});


	$("#usr_img").hide();
	//CARGA LOS DATOS DEL USUARIO
	$.ajax({
		url: '../php/json_user_query.php',
		type: 'get',
		data: {
			id_user_query: $("#id_usr").val()
		},
		dataType: 'json',
		success: function(array){
			$(".options .spinner").hide();
			$("#usr_img").show();
			$(".put_image_profile").attr("src",array.profile_image)
			if (array.usr_active=="true") {
				$("#logout").before("<a href='group-chat.php?id_way="+array.way_active+"'><li><span></span><img src='../Imagenes/mensaje.png' class='icono' alt='iconos' />Ver conversación</li></a>");
			}
			if (array.usr_active=="true") {
				$(".dinamic_button").html("<a href='group-chat.php?id_way="+array.way_active+"' ><button  data='Ver conversación' style='background-color:#C74444' id='btn-see' type='button' name='button'><img height='25px' src='../Imagenes/group.png'  /></button></a>");
			}else{
				if (array.is_driver=="t") {
					$(".dinamic_button").html("<button id='btn-add' type='button' name='button 'data='Crear recorrido' >+</button>");
				}
			}
			var idu = $("#id_usr").val();
			$("#input_add_comment").attr("data-usr-make", idu);
			$("#score_usr").text(array.score_user);
		}
	});

	//PEDIR UN CUPO EN UNA PUBLICACION
	/*agregar => Si una publicacion ha sido eliminada y aun así aparece en el feed de otro usuario y pide cupo*/
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

	//ventana modal sesionopen.php ROUTES
	$(document).on("click touchend", ".ruta", function () {
		$(".modal-box").fadeIn("fast");
		$("#modal-window-route").fadeIn("fast");
	});

	//ELIMINA COMENTARIO
	$(".comment-box").on("click","button",function(){
		var id_user =$(this).attr("data-usr");
		var id_user_make =$(this).attr("data-usr-make");
		var this_button= $(this);
		$.ajax({
			url: '../php/json_delete_comment_user.php',
			type: 'post',
			data: {
				id_user: id_user,
				id_user_make:id_user_make
			},
			dataType: 'json',
			success: function(array){
				if (array.response=="success") {
					this_button.parent().fadeOut();
				}
			}
		});
	});
	//AGREGA COMENTARIO
	$("#send_comment").on("click",function(){
		var textarea = $(".comments_info .add_comment textarea");
		var textarea_val= textarea.val();
		var checkbox = $( ".score-box input:checked" ).val();
		textarea.val('');
		if (textarea_val && checkbox!=null) {
			$.ajax({
				url: '../php/json_add_comment_usr.php',
				type: 'post',
				data: {
					id_user: $(input_add_comment).attr("data-usr"),
					id_user_make: $(input_add_comment).attr("data-usr-make"),
					text: textarea_val,
					score: $( ".score-box input:checked" ).val()
				},
				dataType: 'json',
				success: function(array){
					if (array.response=="success") {
						var id_user=$(input_add_comment).attr("data-usr");
						var id_user_make=$(input_add_comment).attr("data-usr-make");
						//delete "nocomments"
						$("#no_cm").remove();
						$(".comm_fail").hide();
						var image_usr=$("#us_img").val();
						var name_usr= $("#usr_name").val();
						var scor_usr=$( ".score-box input:checked" ).val();
						var btn = "<button id='del-cm-btn' data-usr='"+id_user+"' data-usr-make='"+id_user_make+"'>Eliminar</button>";
						var element = "<div class='cm-box'><img src='"+image_usr+"'/><label for=''>"+name_usr+" - <span id='comm-score'>"+scor_usr+"</span></label><span>"+textarea_val+"</span>"+btn+"</div>";
						$(".comments_info").append(element);
					}else{
						$(".comm_fail").fadeIn("slow");
						$(".comm_fail").text(array.response);
					}
				}
			});
		}else if (!textarea_val) {
			$(".comm_fail").fadeIn("slow");
			$(".comm_fail").text("Debes realizar un comentario.");
		}else if (checkbox==null) {
			$(".comm_fail").fadeIn("slow");
			$(".comm_fail").text("Debes seleccionar una calificación.");
		}
	});

	//CONSULTA DATOS DE LOS USUARIOS EN LAS PUBLICACIONES (MODAL WINDOW-FEED)
	$("#pub-box").on('click','.open-modal',function(){
		//comment form
		$(".comm_fail").hide();
		$(".cm-box").hide();
		var idu = $(this).attr("alt");
		$("#input_add_comment").attr("data-usr",idu);
		//show-hide comment form
		var idu_user_sesion= $("#id_usr").val();
		if (idu==idu_user_sesion) {
			$(".add_comment").hide();
		}else {
			$(".add_comment").show();
		}

		$.ajax({
			url: '../php/json_user_query.php',
			type: 'get',
			data: {
				id_user_query: $(this).attr("alt")
			},
			dataType: 'json',
			success: function(array){
				//basic info
				$(".user_img_query").attr("src", array.profile_image);
				$(".user_name_query").text(array.full_name);
				$(".user_university_query").text(array.university_name);
				$(".user_email_query").text(array.email);
				$(".user_phone_query").text(array.phone);
				$(".user_score> span").text(array.score_user);
				//verified user
				$(".user_verified_query").text(array.is_verified);
					if (array.is_verified=='t') {
						$(".verif_wrap").css("background-color","#002A2A")
						$(".user_status_query").attr("style","color:#007272");
						$(".user_status_query").text("Usuario verificado");
					}else{
						//#002A2A = verde
						//#CE3232 = rojo
						$(".verif_wrap").css("background-color","#CE3232")
						$(".user_status_query").attr("style","color:#B72C2C");
						$(".user_status_query").text("Usuario no verificado");
					}
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
				//comentarios
				$(".comment-box").html(array.comments_html);

			}
		});

	});

	//CONSULTA LAS PUBLICACIONES AL PRESIONAR ENTER
	$("#search-input").keypress(function (e) {

	var sizeResult = $("#search-input").val().length;
	var search = $("#search-input").val().split(",");
	var search_stop= search[0];

	if (e.which == 13 && sizeResult!=0 ) {
		$(".no-results").css("display:none");
		$(".publicaciones").hide();
		$("div").remove(".p-before");
		$(".result-txt").remove();
		$(".no-results").remove();

		//spinner
		$("#pub-box .spinner").show();

			var id_user= $("#id_usr").val();
			//para comprobar si el usuario ya está en otro recorrido
			var id_way_usr= $("#way_usr_active").val(); //vacio si no está activo
			$.ajax({
				url: '../php/json_ways_query.php',
				type: 'get',
				data: {
					stop_query: search_stop,
					id_uni: $("#status_feed").attr("class")
				},
				dataType: 'json',
				success: function(array){
					$("#pub-box .spinner").hide();
					if (array.nr==1) {
						$("#pub-box").append(array.output);
					}else{
						$("#pub-box").append(array.output);
					}
				}
			});

		}
	});
	//CONSULTA LAS PUBLICACIONES AL HACER CLICK EN LA IMAGEN
	$("#search_image").on("click",function() {
		var sizeResult = $("#search-input").val().length;
		var search = $("#search-input").val().split(",");
		var search_stop= search[0];
	if (sizeResult!=0 ) {
		$(".no-results").css("display:none");
		$(".publicaciones").hide();
		$("div").remove(".p-before");
		$(".result-txt").remove();
		$(".no-results").remove();

		//spinner
		$("#pub-box .spinner").show();


			var id_user= $("#id_usr").val();
			//para comprobar si el usuario ya está en otro recorrido
			var id_way_usr= $("#way_usr_active").val(); //vacio si no está activo
			$.ajax({
				url: '../php/json_ways_query.php',
				type: 'get',
				data: {
					stop_query: search_stop,
					id_uni: $("#status_feed").attr("class")
				},
				dataType: 'json',
				success: function(array){
					$("#pub-box .spinner").hide();
					if (array.output) {
						$("#pub-box").append(array.output);
					}else{
						$(".no-results").css("display","block");
					}
				}
			});

		}
	});
	//REVISA SI HAY PUBLICACIONES NUEVAS
	function check(){
		$.ajax({
			url: '../php/json_check_status.php',
			type: 'get',
			data: {
				rdn_string: $("#status_feed").attr("value"),
				id_uni: $("#status_feed").attr("class")
			},
			dataType: 'json',
			success: function(array){
				if (array.update=="true") {
					$("#new-updates").fadeIn();
					$(document).attr("title", "Uniway (1)");
					clearInterval(interval);
				}
			}
		});
	}
	//1000 = 1 segundo
	var interval = setInterval(check, 5000);




});
