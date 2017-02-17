$(document).ready(function(){

	$("#search-input").on("keyup",function() {
		$(".publicaciones").hide();
		$(".ruta").hide();
		$("div").remove(".publicaciones-n");
		$("span").remove(".ruta-n");
		var sizeResult = $("#search-input").val().length;
		if (sizeResult==0) {
			$("div").remove(".publicaciones-n");
			$("div").remove(".ruta-n");
			$(".publicaciones").show();
		}else{
			$.ajax({
				url: '../Php/json_ways_query.php',
				type: 'get',
				data: {
					stop_query: $("#search-input").val().toUpperCase()
				},
				dataType: 'json',
				success: function(array){
					var id_users=[array.id_user1,array.id_user2,array.id_user3,array.id_user4,array.id_user5,array.id_user6,array.id_user7,array.id_user8,array.id_user9,array.id_user10];
					var hours=[array.time1,array.time2,array.time3,array.time4,array.time5,array.time6,array.time7,array.time8,array.time9,array.time10];
					var names=[array.name1,array.name2,array.name3,array.name4,array.name5,array.name6,array.name7,array.name8,array.name9,array.name10];
					var profile_images=[array.prof_img1,array.prof_img2,array.prof_img3,array.prof_img4,array.prof_img5,array.prof_img6,array.prof_img7,array.prof_img8,array.prof_img9,array.prof_img10];
					var comments=[array.comment1,array.comment2,array.comment3,array.comment4,array.comment5,array.comment6,array.comment7,array.comment8,array.comment9,array.comment10];
					var spots=[array.spot1,array.spot2,array.spot3,array.spot4,array.spot5,array.spot6,array.spot7,array.spot8,array.spot9,array.spot10];
					var toUniversity=[array.toUni1,array.toUni2,array.toUni3,array.toUni4,array.toUni5,array.toUni6,array.toUni7,array.toUni8,array.toUni9,array.toUni10];
					var ways_id=[array.way1,array.way2,array.way3,array.way4,array.way5,array.way6,array.way7,array.way8,array.way9,array.way10];
					var routes=[array.ruta1,array.ruta2,array.ruta3,array.ruta4,array.ruta5,array.ruta6,array.ruta7,array.ruta8,array.ruta9,array.ruta10];
					for (var i = 0; i < array.num_results; i++) {
						$("#pub-box").append("<div class='publicaciones-n' ><img class='open-modal' src='"+profile_images[i]+"' alt='"+id_users[i]+"' ></img><span class='cupo'>"+spots[i]+" cupos.</span><a href=''><span class='name'>"+names[i]+"</span></a><span class='time'>"+hours[i]+"</span><span class='comentario'>"+comments[i]+"</span><div class='botones'><button id='btn-pedirCupo' type='button' name='button'>Pedir cupo</button></div></div><span style='display:none' class='ruta-n' >Cañaveral - Fosunab - Paralela - CRA 27 - UIS</span>");
					}
				}
			});
		}
	});

	$("#pub-box").on("click",".publicaciones",function() {
		$(".ruta").hide();
		$(this).next().slideDown(100);
	});
	$("#pub-box").on("click",".publicaciones-n",function() {
		$(".ruta-n").hide();
		$(this).next().slideDown(100);
	});


});
