<?php session_start(); 

include 'header.php';

//incluímos el encabezado con los campos para loguearse
if (empty($_SESSION['usuario'])) include 'login.php';
else echo 'Estás logueado como '.$_SESSION['usuario'].' <a href="adminPosts.php">administración</a> | <a href="salir.php">salir</a>';

echo '<br><br>';

include 'listado.php';
include 'nuevoPost.php';


?>
</body>