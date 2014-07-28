<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kiara App</title>
<link type="text/css" rel="stylesheet" href="estilos.css" />

</head>

<body>
<?php

	//incluímos el encabezado con los campos para loguearse
	if (empty($_SESSION['usuario'])) include 'login.php';
	else {
	?>
		Estás logueado como <?php echo $_SESSION['usuario']; ?> 
		<a href="<?php echo $carpeta;?>">inicio</a> | 
		<a href="adminPosts.php">administrar posts</a> | 
		<a href="config.php">configuraciones</a> | 
		<a href="salir.php">salir</a>
		<br><br>
	<?php
	}
