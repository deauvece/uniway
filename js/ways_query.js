$(document).ready(function(){

	$("#search-input").on("keyup",function() {
		var sizeResult = $("#search-input").val().length;
		if (sizeResult==0) {
			$(".no-results").css("display","none");
			$("div").remove(".publicaciones-n");
			$("span").remove(".ruta-n");
			$(".publicaciones").show();
			$(".ruta").show();
		}else{
			$(this).autocomplete({
				source: '../php/json_stops.php'
			});
		}
	});

	//search by ENTER
	$("#search-input").keypress(function (e) {
	var sizeResult = $("#search-input").val().length;
	if (e.which == 13 && sizeResult!=0 ) {
		$(".no-results").css("display:none");
		$(".publicaciones").hide();
		$(".ruta").hide();
		$("div").remove(".publicaciones-n");
		$("span").remove(".ruta-n");
			var id_user= $("#id_user_json").attr("value");
			//para comprobar si el usuario ya está en otro recorrido
			var id_way_usr= $("#way_usr_active").val(); //vacio si no está activo
			$.ajax({
				url: '../php/json_ways_query.php',
				type: 'get',
				data: {
					stop_query: $("#search-input").val().toUpperCase(),
					id_uni: $("#status_feed").attr("class")
				},
				dataType: 'json',
				success: function(array){
					var id_users=[array.id_user1,array.id_user2,array.id_user3,array.id_user4,array.id_user5,array.id_user6,array.id_user7,array.id_user8,array.id_user9,array.id_user10];
					var hours=[array.time1,array.time2,array.time3,array.time4,array.time5,array.time6,array.time7,array.time8,array.time9,array.time10];
					var names=[array.name1,array.name2,array.name3,array.name4,array.name5,array.name6,array.name7,array.name8,array.name9,array.name10];
					var profile_Imagenes=[array.prof_img1,array.prof_img2,array.prof_img3,array.prof_img4,array.prof_img5,array.prof_img6,array.prof_img7,array.prof_img8,array.prof_img9,array.prof_img10];
					var comments=[array.comment1,array.comment2,array.comment3,array.comment4,array.comment5,array.comment6,array.comment7,array.comment8,array.comment9,array.comment10];
					var spots=[array.spot1,array.spot2,array.spot3,array.spot4,array.spot5,array.spot6,array.spot7,array.spot8,array.spot9,array.spot10];
					var toUniversity=[array.toUni1,array.toUni2,array.toUni3,array.toUni4,array.toUni5,array.toUni6,array.toUni7,array.toUni8,array.toUni9,array.toUni10];
					var ways_id=[array.way1,array.way2,array.way3,array.way4,array.way5,array.way6,array.way7,array.way8,array.way9,array.way10];
					var routes=[array.ruta1,array.ruta2,array.ruta3,array.ruta4,array.ruta5,array.ruta6,array.ruta7,array.ruta8,array.ruta9,array.ruta10];
					var stops_way=[array.stop11,array.stop12,array.stop13,array.stop14,array.stop15,array.stop21,array.stop22,array.stop23,array.stop24,array.stop25,
								array.stop31,array.stop32,array.stop33,array.stop34,array.stop35,array.stop41,array.stop42,array.stop43,array.stop44,array.stop45,array.stop51,array.stop52,array.stop53,array.stop54,array.stop55,
								array.stop61,array.stop62,array.stop63,array.stop64,array.stop65,array.stop71,array.stop72,array.stop73,array.stop74,array.stop75,
								array.stop81,array.stop82,array.stop83,array.stop84,array.stop85,array.stop91,array.stop92,array.stop93,array.stop94,array.stop95,array.stop101,array.stop102,array.stop103,array.stop104,array.stop105];

					if (array.num_results!=0) {
						$(".no-results").css("display","none");
						// var j Para el conteo de las distintaas Paradas
						var j=0;
						for (var i = 0; i < array.num_results; i++) {
							var text0;
							if (toUniversity[i]=='true') {
								text0 = "En la universidad a las ";
							}else{
								text0 = "Saliendo de la universidad a las ";
							}
							if (id_users[i]==id_user) {
								button = "<a href='group-chat.php?id_way="+ways_id[i]+"'><button class='btn-eliminar' type='button'>Ver</button></a>";
							}else{
								button = "<button id='btn-pedirCupo' data-way="+ways_id[i]+" data-usr="+id_user+" class='btn-pedirCupo' type='button'>Pedir cupo</button>";
							}
							$("#pub-box").append("<div class='publicaciones-n' ><img class='open-modal' src='"+profile_Imagenes[i]+"' alt='"+id_users[i]+"' ></img><span class='cupo'>"+spots[i]+" cupos.</span><a href=''><span class='name'>"+names[i]+"</span></a><span class='time'>"+text0+hours[i]+"</span><span class='comentario'>"+comments[i]+"</span><div class='botones'>"+button+"</div><div class='rt-title'>Paradas</div></div><span class='ruta-n'>"+stops_way[j+0]+"&nbsp;&nbsp;&nbsp;"+stops_way[j+1]+"&nbsp;&nbsp;&nbsp;"+stops_way[j+2]+"&nbsp;&nbsp;&nbsp;"+stops_way[j+3]+"&nbsp;&nbsp;&nbsp;"+stops_way[j+4]+"</span>");
							j=j+5;
						}

					}else{
						$(".no-results").css("display","block");
					}
				}
			});

		}
	});
	//search by ENTER
	$("#search_image").on("click",function() {
	var sizeResult = $("#search-input").val().length;
	if (sizeResult!=0 ) {
		$(".no-results").css("display:none");
		$(".publicaciones").hide();
		$(".ruta").hide();
		$("div").remove(".publicaciones-n");
		$("span").remove(".ruta-n");
			var id_user= $("#id_user_json").attr("value");
			//para comprobar si el usuario ya está en otro recorrido
			var id_way_usr= $("#way_usr_active").val(); //vacio si no está activo
			$.ajax({
				url: '../php/json_ways_query.php',
				type: 'get',
				data: {
					stop_query: $("#search-input").val().toUpperCase(),
					id_uni: $("#status_feed").attr("class")
				},
				dataType: 'json',
				success: function(array){
					var id_users=[array.id_user1,array.id_user2,array.id_user3,array.id_user4,array.id_user5,array.id_user6,array.id_user7,array.id_user8,array.id_user9,array.id_user10];
					var hours=[array.time1,array.time2,array.time3,array.time4,array.time5,array.time6,array.time7,array.time8,array.time9,array.time10];
					var names=[array.name1,array.name2,array.name3,array.name4,array.name5,array.name6,array.name7,array.name8,array.name9,array.name10];
					var profile_Imagenes=[array.prof_img1,array.prof_img2,array.prof_img3,array.prof_img4,array.prof_img5,array.prof_img6,array.prof_img7,array.prof_img8,array.prof_img9,array.prof_img10];
					var comments=[array.comment1,array.comment2,array.comment3,array.comment4,array.comment5,array.comment6,array.comment7,array.comment8,array.comment9,array.comment10];
					var spots=[array.spot1,array.spot2,array.spot3,array.spot4,array.spot5,array.spot6,array.spot7,array.spot8,array.spot9,array.spot10];
					var toUniversity=[array.toUni1,array.toUni2,array.toUni3,array.toUni4,array.toUni5,array.toUni6,array.toUni7,array.toUni8,array.toUni9,array.toUni10];
					var ways_id=[array.way1,array.way2,array.way3,array.way4,array.way5,array.way6,array.way7,array.way8,array.way9,array.way10];
					var routes=[array.ruta1,array.ruta2,array.ruta3,array.ruta4,array.ruta5,array.ruta6,array.ruta7,array.ruta8,array.ruta9,array.ruta10];
					var stops_way=[array.stop11,array.stop12,array.stop13,array.stop14,array.stop15,array.stop21,array.stop22,array.stop23,array.stop24,array.stop25,
								array.stop31,array.stop32,array.stop33,array.stop34,array.stop35,array.stop41,array.stop42,array.stop43,array.stop44,array.stop45,array.stop51,array.stop52,array.stop53,array.stop54,array.stop55,
								array.stop61,array.stop62,array.stop63,array.stop64,array.stop65,array.stop71,array.stop72,array.stop73,array.stop74,array.stop75,
								array.stop81,array.stop82,array.stop83,array.stop84,array.stop85,array.stop91,array.stop92,array.stop93,array.stop94,array.stop95,array.stop101,array.stop102,array.stop103,array.stop104,array.stop105];

					if (array.num_results!=0) {
						$(".no-results").css("display","none");
						// var j Para el conteo de las distintaas Paradas
						var j=0;
						for (var i = 0; i < array.num_results; i++) {
							var text0;
							if (toUniversity[i]=='true') {
								text0 = "En la universidad a las ";
							}else{
								text0 = "Saliendo de la universidad a las ";
							}
							if (id_users[i]==id_user) {
								button = "<a href='group-chat.php?id_way="+ways_id[i]+"'><button class='btn-eliminar' type='button'>Ver</button></a>";
							}else{
								button = "<button id='btn-pedirCupo' data-way="+ways_id[i]+" data-usr="+id_user+" class='btn-pedirCupo' type='button'>Pedir cupo</button>";
							}
							$("#pub-box").append("<div class='publicaciones-n' ><img class='open-modal' src='"+profile_Imagenes[i]+"' alt='"+id_users[i]+"' ></img><span class='cupo'>"+spots[i]+" cupos.</span><a href=''><span class='name'>"+names[i]+"</span></a><span class='time'>"+text0+hours[i]+"</span><span class='comentario'>"+comments[i]+"</span><div class='botones'>"+button+"</div><div class='rt-title'>Paradas</div></div><span class='ruta-n'>"+stops_way[j+0]+"&nbsp;&nbsp;&nbsp;"+stops_way[j+1]+"&nbsp;&nbsp;&nbsp;"+stops_way[j+2]+"&nbsp;&nbsp;&nbsp;"+stops_way[j+3]+"&nbsp;&nbsp;&nbsp;"+stops_way[j+4]+"</span>");
							j=j+5;
						}

					}else{
						$(".no-results").css("display","block");
					}
				}
			});

		}
	});
	//CHECK FOR WAYS UPDATES
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
