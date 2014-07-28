<?php
/*
* Desde aquí se realizan ciertas modificaciones del sistema
*/

include 'header.php';
?>


<form action="" name="configuraciones" method="POST">
	Carpeta de instalación: 
	<input type="text" name="carpeta" value="<?php echo obtenerCarpeta(); ?>" /><br>

	<br><input type="submit" name="submit" value="Guardar configuración">
</form>

<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
	guardarDatos();
}
