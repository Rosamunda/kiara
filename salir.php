<?php 
/*
* Este archivo gestiona el logout del usuario, donde matamos la sesión.
* TO-DO: Hacer la salida con jQuery.
*/
    session_start();
    
    if(empty($_SESSION['usuario'])){
		echo 'No saliste porque no estabas adentro... <a href="index.php">Volver a inicio</a>';
    }else{
        session_unset(); //destruye todas las variables de sesión
        session_destroy(); // finaliza la sesión
        echo 'Has salido correctamente <a href="index.php">Volver a inicio</a>';
         }
    die();
    
?>