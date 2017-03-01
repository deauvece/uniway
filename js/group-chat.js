$(document).ready(function () {
	//scroll to bottom of comments box
	var cmt_box = $('.content-cht');
	cmt_box.scrollTop(cmt_box.prop("scrollHeight"));

	//send the comment
	$('#textarea-inpt').keypress(function (e) {
	  if (e.which == 13) {

		  $.ajax({
			  url: '../php/add-comment.php',
			  type: 'get',
			  data: {
				  name_user: $(this).attr("data-name-user"),
				  id_way: $(this).attr("data-way"),
				  comment: $(this).val()
			  },
			  dataType: 'json',
			  success: function(array){
				  location.reload();
			  }
		  });
	    e.preventDefault();
	    $(this).val('');
	  }
	});


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
