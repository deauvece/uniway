<!DOCTYPE html>
<html>
	<head>
		<title>Uniway</title>
    		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="../css/sesionOpen.css">
		<link rel="icon" type="image/png" href="../Imagenes/favicon.png" />
		<!--Fuente texto-->
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
		<!--jquery-->
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.structure.css">
		<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.theme.css">
		<!--timepicker-->
		<link rel="stylesheet" type="text/css" href="../js/lolliclock.css">
		<script src="../js/jquery-3.1.1.min.js"></script>
		<script src="../js/jquery-ui/jquery-ui.js"></script>
		<script src="../js/lolliclock.js"></script>
	</head>
	<body>
		<div id="modal_add_stop">
			<form action="../php/addRoute.php" name="form_stops" method="post">
				<p>Crea una ruta</p>
				<input type="text" class="query" name="name_rute" placeholder="Escribe un nombre para la ruta" required="">
				<span>Selecciona una de las universidades como destino/origen de tu ruta</span>
				<select class="firs-stop" name="stop1">
					<option value="Universidad Industrial de Santander - Calle 9">Universidad industrial de santander (UIS), Sede principal</option>
					<option value="Universidad industrial de santander (UIS), Salud">Universidad industrial de santander (UIS), Salud</option>
					<option value="Unab - Calle 42, Bucaramanga">Universidad Autónoma de Bucaramanga (UNAB), Cabecera</option>
					<option value="FOSUNAB, Floridablanca - Santander">FOSUNAB, Salud</option>
				</select>
				<span>Escribe y selecciona de las opciones que se muestran al escribir, el mapa se generará automaticamente. ( minimo 1, máximo 4 paradas contando el destino )</span>
				<div class="query_box">
					<input type="text" class="query" id="query" placeholder="Busca una parada" onFocus="initAutocomplete_stop()" required />
					<button id="add_stop" type="button">Agregar</button>
				</div>
				<span class="error">No puedes agregar más de 4 paradas</span>
				<div class="cont-stops">
					<p>Paradas</p>
				</div>
				<button type="button" class="delete_stop">Eliminar ultima parada</button>
				<div id="map_stops">
				</div>
				<button type="submit" name="button">Crear</button>
			</form>
		</div>
	<script>
		//autocompletar
		var autocomplete;
		var autocompleteListener;
		function initAutocomplete_stop() {
			var options = {
			componentRestrictions: {country: "col"}
			};
			autocomplete = new google.maps.places.Autocomplete( ($('#query')[0])  ,  options );
			//vacia el input
			google.maps.event.addListener(autocomplete, 'place_changed', function() {
				$('#query').val("");
			});
		}
		//mostrar informacion y generar mapa
		var array_stops=[];
		var max_stops=5;
		//primera parada = universidad
		var first_stop = $("select[name=stop1]").val();
		array_stops[0]=first_stop;
		//cada vez que cambie, se actualiza el valor
		$('#modal_add_stop > select').on('change', function() {
			first_stop = this.value;
			array_stops[0]=first_stop;
			createMap();
		})


		function createMap() {
				var size_array = array_stops.length;
				//si ya hay dos paradas se muestra el mapa
				if (size_array > 1) {
					//genera el mapa
					$("#map_stops").css("height","500px");
					var directionsService = new google.maps.DirectionsService;
					var directionsDisplay = new google.maps.DirectionsRenderer;
					var map = new google.maps.Map(document.getElementById('map_stops'), {
						zoom: 10,
						center: {lat: 7.13, lng: -73.13}
					});
					directionsDisplay.setMap(map);

					var waypts = [];
					  for (var i = 0; i < size_array; i++) {
					    if (i!=0 || i!=size_array-1) {
						 waypts.push({
						   location: array_stops[i],
						   stopover: true
						 });
					    }
					  }
					  directionsService.route({
					    origin: array_stops[0],
					    destination: array_stops[(size_array)-1],
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
		}
		function addStop() {
			var count = $(".cont-stops input").length;
			//se le suma el destino/origen universidad
			count=count+1;

			//determina si muestra boton para eliminar ultima parada
			if (count>0) {
				$(".delete_stop").fadeIn();
			}
			//si hay al menos una parada ya se puede enviar el formulario
			if (count>1) {
				$("#query").prop('required',false);
			}


			if (count<max_stops) {
				//se quita el erroe en caso de que esté
				$("#modal_add_stop .error").css("display","none");
				//se agrega a cont-stops para que el usuario la vea
				var info = $("#query").val();
				$(".cont-stops").append("<input class='query' name='stop"+(count+1)+"' disabled type='text'  value='"+info+"'>");
				

				//se agrega al vector array_stops
				array_stops[count]=info;
				//crea el mapa
				createMap();
			}else{
				$("#modal_add_stop .error").css("display","block");
			}

		}
		$("#add_stop").on("click",function () {
			var sizeResult = $("#query").val().length;
			if (sizeResult!=0 ) {
				addStop();
			}

		});

		$("#query").keypress(function (e) {
			var sizeResult = $("#query").val().length;
			if (e.which == 13 && sizeResult!=0 ) {
				addStop();
			}
		});


		$(".delete_stop").on("click", function(){
			var count = $(".cont-stops input").length;
			//si solo hay una parada y se elimina el boton desaparece
			if (count==1) { $(this).hide(); }
			//y se quita el error en caso de que esté
			$("#modal_add_stop .error").css("display","none");
			array_stops.splice(count, 1);
			$(".cont-stops input:last-child").remove();
			//si hay al menos una parada se genera el mapa (inicial + parada(input))
			if (count>0) {
				createMap();
			}
			//si hay solo una parada (la inicial) no se puede enviar el formulario
			if (count<1) {
				$("#query").prop('required',true);
			}
		});
		//previene que no se envien los formularios  al presionar enter
		$(document).on("keypress", "form", function(event) {
		    return event.keyCode != 13;
		});

	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzRbb1jMuRuD6sgd53qwhd7lvJ8h8OSUk&libraries=places" async defer></script>
	</body>
</html>
