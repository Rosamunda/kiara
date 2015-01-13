<br><br>
<?php
/*
* Formulario de modificación de opciones personales del usuario administrador
* 
*/

include 'header.php';

?>
<form name="modificarUsuario" action="" method="POST">
<h2>Modificación de Datos Personales</h2>
Username: <input type="text" name="username" />  
Nombre Completo: <input type="text" name="nombre" />  
Email: <input type="text" name="email" />  
Clave: <input type="text" name="pass" />  
<input type="submit" class="button [radius round alert]" name="modificarDatos" value="Modificar datos">
<br>
</form>

<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
	/* VARIABLES */
	$usuario = $_POST['username'];
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$clave = $_POST['pass'];
	$uid = 1; //harcodeo el user id del admin

	//verificamos si el usuario está logueado
		if (empty($_SESSION['usuario'])) {
		echo '<br>Debes estar logueado para acceder.';
		}
		else {
			include 'conectar.php';
			//usamos $consulta1 en lugar de $consulta porque con los includes la variable ya existe.
			$consulta1 = mysqli_prepare($conectar,
							"UPDATE usuario 
							 SET username = ?, pass = ?, name = ?, email = ?
							 WHERE uid = '".$uid."'
							");
			if ($consulta1) {
				//enganchamos la sustitución con el valor sanitizado
				mysqli_stmt_bind_param( $consulta1, 'ssss', $usuario, $clave, $nombre, $email);
				//ejecutamos el statement
				mysqli_stmt_execute($consulta1);
				echo 'Se guardaron los cambios';
				mysqli_stmt_close($consulta1);
			}
			else {  echo 'Hubo un error! El cambio no se guardó!';
					echo mysqli_error($conectar1);
				}
			
			//usamos header() para que recargue la página.
			echo '<script>window.location.replace("index.php");</script>';
			session_destroy();

		}

}

