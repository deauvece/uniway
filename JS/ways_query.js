$(document).ready(function(){
	$('#search-input').keyup(function(){
		$(this).val($(this).val().toUpperCase());
	});
	$("#search-input").keyup(function() {
		$.ajax({
			    url: '../Php/json_ways_query.php',
			    type: 'get',
			    data: {
				    id_user_query: $("#search-input").val()
			    },
			    dataType: 'json',
			    success: function(array){
				    $("#ways_query_results").text(array.textsended);
			    }
    			});
	});


});
