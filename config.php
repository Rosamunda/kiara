<?php
/*
* Desde aquí se realizan ciertas modificaciones del sistema
*/

include 'header.php';
?>


<form action="" name="configuraciones" method="POST">
	Carpeta de instalación: 
	<input type="text" name="carpeta" value="<?php echo obtenerCarpeta(); ?>" /><br>
	Cantidad de Posts en Inicio:
	<input type="text" name="cantPosts" value="<?php echo cantPosts(); ?>" /><br>	

	<input type="submit" name="submit" value="Guardar Datos">
</form>

<?php

/*
* las condiciones para guardarDatos() son que el usuario haya clickeado el botón
* y que el campo cantPosts sea un número entero.
* Como el campo $_POST['cantPosts'] en realidad es de texto, antes de evaluar si 
* su contenido es un integer, hay que convertir a entero el contenido.
* Para eso usamos intval() y luego para evaluar su condición de entero is_int()
*/
if($_SERVER['REQUEST_METHOD']=='POST'){
	$_POST['cantPosts'] = intval($_POST['cantPosts']);
	if (is_int($_POST['cantPosts'])) {
		guardarDatos();	
	} else { echo 'Oops! Error en la carga de datos. Los cambios no se guardaron';}

}
