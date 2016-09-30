//Amimaciones del menu desplegable SESION ABIERTA
	//para que cuando se clickee fuera del menu tambien se oculte
	function cerrarMenu() {
		document.getElementsByClassName('sinmenu')[0].style.webkitTransform = 'translateX(200%)';
	}
	//la funcion para cuando se hace click en el boton
	function menuDesplegable() {
		if (document.getElementById('btn').checked) {
			//get element by class devuelve un vector, se selecciona el primero en la posicion inicial 0
			 document.getElementsByClassName('sinmenu')[0].style.webkitTransform = 'translateX(1%)';
		}
		else {
			document.getElementsByClassName('sinmenu')[0].style.webkitTransform = 'translateX(200%)';
		}
	}
//Amimaciones del menu desplegable INICIO
