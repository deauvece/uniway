$(document).ready(function () {
	//update comments
	//scroll to bottom of comments box
	$('.content-cht').animate({"scrollTop": $('.content-cht')[0].scrollHeight}, "fast");



	function update_cmt(){
		var idway = $("#textarea-inpt").attr("data-way");
		var lastcommentid = $(".content-cht > div:last-child").attr("data-id");

		  $.ajax({
			  url: '../php/json_check_comments.php',
			  type: 'get',
			  data: {
				  id_way: $("#textarea-inpt").attr("data-way"),
				  last_comment_id: $(".content-cht > div:last-child").attr("data-id")
			  },
			  dataType: 'json',
			  success: function(array){
				  if (array.state=="iguales") {
					  console.log("no hay comentarios");
				  }else{
					  console.log("Hay comentarios nuevos");
					  var send="../php/json_get_comments.php?id_way="+idway+"&last_comment_id="+lastcommentid
					  //$('.content-cht').load(send);
					  $.ajax({ type: "GET",
						     url: send,
						     success : function(text)
						     {
						         $('.content-cht').append(text);
						     }
						});
						$('.content-cht').animate({"scrollTop": $('.content-cht')[0].scrollHeight}, "fast");
				  }
			  }
		  });

	}
	//1000 = 1 segundo
	var interval = setInterval(update_cmt, 1000);


	//hover delete user
	/*$(".people .usr-box").hover(function() {
		$(".people .usr-box .kick-usr").fadeToggle("fast");
	});*/
	//send the comment
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
	//height
	var alt = $( window ).height();
	alt= alt-60;
	$(".container-chat").css( "height", alt );


	//modal window salir
	$("#out-group").click(function(){
	     $(".modal-box").fadeIn("fast");
		$(".msg-out").show();
		$(".delete-way").hide();
	});
	$("#modal-box").click(function(){
	     $(".modal-box").fadeOut("fast");
		$(".msg-out").hide();
		$(".delete-way").hide();
	});
	$(".no-confirm").click(function(){
	     $(".modal-box").fadeOut("fast");
		$(".msg-out").hide();
		$(".delete-way").hide();
	});
	$(".msg-out").click(function(){
	     event.stopPropagation();
	});
	//modal window delete way
	$("#delete-group").click(function(){
	     $(".modal-box").fadeIn("fast");
		$(".msg-out").hide();
		$(".delete-way").show();
	});
	$(".delete-way").click(function(){
	     event.stopPropagation();
	});


});