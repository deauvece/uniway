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


	//hover delete user
	/*$(".people .usr-box").hover(function() {
		$(".people .usr-box .kick-usr").fadeToggle("fast");
	});*/
	//send the comment ENTER KEY
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
	//send the comment BUTTON
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
	$(".msg-out").click(function(e){
	     e.stopPropagation();
	});
	//modal window delete way
	$("#delete-group").click(function(){
	     $(".modal-box").fadeIn("fast");
		$(".msg-out").hide();
		$(".delete-way").show();
	});
	$(".delete-way").click(function(e){
	     e.stopPropagation();sdklfhasjkdfhsdjfsjkf
	});
	//options-info
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
	/*$(".cht-box").click(function(){
	     $(".container-chat .people").fadeOut();
	});*/


});
