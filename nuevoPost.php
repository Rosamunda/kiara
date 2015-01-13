<?php
/*
* Formulario de carga de nuevos mensajes (posts).
* 
*/
?>
<br>
<form name="nuevoPost" action="" method="POST">
<h2>Nuevo mensaje</h2>
Título: <input type="text" name="titulo" />  
Cuerpo del mensaje: <textarea name="cuerpo"> </textarea>
<div class="panel callout radius right"><b>Publicar?</b> <input type="checkbox" name="publicado" checked></div>
<input type="submit" class="button [radius round alert]" name="enviarPost" value="Guardar">
<br>
</form>

<?php

/* VARIABLES */
$titulo = $_POST['titulo'];
$cuerpo = $_POST['cuerpo'];

// Cuando el usuario hace un submit...
if($_SERVER['REQUEST_METHOD']=='POST'){

//Indicamos cuándo el mensaje está publicado y cuándo no
if (empty($_POST['publicado'])) {
	$publicado = 0;
} else {$publicado = 1;}


/* Conectamos a la base de datos. Para más información sobre los pasos seguidos,
* ver los comentarios publicados en login.php 
* buscamos la base y contiene (respetar el orden de los campos!):
	pid int unsigned not null auto_increment primary key,
	date datetime not null,
	title char(200) not null,
	body text not null,
	published int not null DEFAULT '0'
* por eso la carga de datos debe ser date, title, body, published	
* el formato es:
INSERT INTO nombreTabla(nombrecampo1, nombrecampo2, etc)
VALUES ('$variableGenerada1', '$variableGenerada2', '$etc')
* Para determinar la fecha del post, usamos CURDATE() 
* @See http://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html#function_curdate
*/

	if (empty($_SESSION['usuario'])) {
		echo '<br>Debes estar logueado para publicar mensajes.';
		}
		else {
			include 'conectar.php';
			//preparamos la consulta a la base para evitar posible sql injection
			//usamos NOW() en lugar de CURDATE()
			$consulta = mysqli_prepare($conectar,
							"INSERT INTO post(date, title, body, published) 
							 VALUES (NOW(), ? , ?, ?)
							");
			if ($consulta) {
				//enganchamos la sustitución con el valor sanitizado
				//la función mysqli_stmt_bind_param tiene como parámetros la consulta a la base,
				//el o los tipos de contenido que se agregan, ej string donde anotamos s,
				//y el contenido a agregar, que puede ser una variable.
				//ver http://php.net/manual/en/mysqli-stmt.bind-param.php
				mysqli_stmt_bind_param( $consulta, 'ssi', $titulo, $cuerpo, $publicado);
				//ejecutamos el statement
				mysqli_stmt_execute($consulta);
				echo 'Nuevo mensaje creado';
			}
			else {echo 'Hubo un error! El post no se guardó.';}
			mysqli_stmt_close($consulta);
			//usamos header() para que recargue la página.
			header('Location: index.php');

		}
}