$(document).ready(function () {


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
