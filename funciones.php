<?php

/* LISTADO DE FUNCIONES:
* obtenerCarpeta()
* obtiene el valor de la carpeta donde está la instalación del sistema
* Con un echo obtenerCarpeta() directamente se imprime el valor
* Similar a cantPosts() aplicable a cada item del formulario ubicado 
* en config.php
*
* guardarDatos()
* Función que guarda los datos de los campos del formulario de configuración
* ubicado en config.php
*
*/

function obtenerCarpeta() {

	/* Consultamos a base para que nos devuelva los valores guardados.
	* la primera vez que los muestre será lo que esté por default 
	* ver database.sql
	*/

	include 'conectar.php';
	$data="  SELECT config, valor 
			 FROM configuraciones
			 WHERE config = 'carpeta'
		  ";
	$resultado=mysqli_query($conectar,$data);

	/*
	* Una vez generada la consulta, obtenemos la información del array asociativa
	* mediante un foreach.
	* Dentro de ese foreach, preguntamos si la $key es exactamente igual al 
	* número de orden.
	*/

	foreach ($resultado as $key => $value) {
			$carpeta = $value['valor'];
			return $carpeta;
	}
	mysqli_close($conectar);
}


/*
* Función que nos devuelve la cantidad de posts que están guardados en base
*/
function cantPosts() {

	include 'conectar.php';
	$data="  SELECT config, valor 
			 FROM configuraciones
			 WHERE config = 'cantPosts'
		  ";
	$resultado=mysqli_query($conectar,$data);

	foreach ($resultado as $key => $value) {
			$cantPosts = $value['valor'];
			return $cantPosts;
	}
	mysqli_close($conectar);
}



/* Función que guarda en base los datos cargados en el archivo config.php 
* Se usa una sóla función para que se guarden los datos de todos los campos.
* Para eso metemos la función dentro de un for loop. El loop corre tantas
* veces como items hay en el formulario de config.php
*
*/
function guardarDatos() {

	// variables
	$carpeta = $_POST['carpeta'];
	$cantPosts = $_POST['cantPosts'];
	//$mostrarDatos = $_POST['mostrarDatos'];

	include 'conectar.php';
	mysqli_query($conectar,"UPDATE configuraciones
							SET valor='$carpeta'
							WHERE config='carpeta'");

	mysqli_query($conectar,"UPDATE configuraciones
							SET valor='$cantPosts'
							WHERE config='cantPosts'");

	mysqli_close($conectar);
	echo '<script>
	window.location.replace("index.php");
	</script>';
}


/* Esta función obtiene el item que buscamos de la base de datos y lo muestra
* El item es obtenido mediante $_GET, por lo que cuidamos de sanitizarlo con un 
* prepared statement
*/

function get_post($postId) {
	//si no hay un id no mostramos nada
	if (!$postId) {
		return false;
	}
	include 'conectar.php';
	$consulta = "SELECT * FROM post WHERE pid='".$postId."'
				";
	$resultado=mysqli_query($conectar,$consulta);
	//Una vez obtenidos los resultamos, los metemos en un array asociativo 
	//y generamos una variable individual para cada dato

	$post=mysqli_fetch_assoc($resultado);
	return $post; 
	/**
	 * devolvemos el array con todos los items
	 * para obtener los datos, usamos cada key del array, por ejemplo:
	 * el título está en $post['title'];, el id está en $post['pid'];
	 * etc.
	*/
}
