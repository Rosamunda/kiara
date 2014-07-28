<?php
/*
* Desde aquí se realizan ciertas modificaciones del sistema
*/

include 'header.php';
include 'funciones.php';
?>


<form action="" name="configuraciones" method="POST">
	Carpeta de instalación: 
	<input type="text" name="carpeta" value="<?php echo $obtenerCarpeta();?>" /><br>

</form>

<?php
