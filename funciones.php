<?php

/* LISTADO DE FUNCIONES:
* obtenerCarpeta()
* obtiene el valor de la carpeta donde está la instalación del sistema
* Con un echo obtenerCarpeta() directamente se imprime el valor
*
* guardarDatos()
*
*
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

/* Función que guarda en base los datos cargados en el archivo config.php 
* Agregarle parámetros para que nos sirva para todos los guardados?
*/
function guardarDatos() {

	include 'conectar.php';
	$guardar= " UPDATE configuraciones
				SET valor='".$_POST['carpeta']."'
				WHERE config='carpeta'
		 			 ";
	mysqli_query($conectar,$guardar);
	mysqli_close($conectar);
	header('Location: config.php');
}