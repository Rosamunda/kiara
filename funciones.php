<?php

/* LISTADO DE FUNCIONES:
* obtenerCarpeta()
* obtiene el valor de la carpeta donde está la instalación del sistema
* Con un echo obtenerCarpeta() directamente se imprime el valor
*
*
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
	$data="  SELECT cid, config, valor 
			 FROM configuraciones 
				 ";
	$resultado=mysqli_query($conectar,$data);

	/*
	* Una vez generada la consulta, obtenemos la información del array asociativa
	* mediante un foreach.
	* Dentro de ese foreach, preguntamos si la $key es exactamente igual al 
	* número de orden.
	*/

	foreach ($resultado as $key => $value) {
		if ($key==0) {
			$carpeta = $value['valor'];
			return $carpeta;
		}
	}

}