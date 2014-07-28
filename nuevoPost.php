<?php
/*
* Formulario de carga de nuevos mensajes (posts).
* 
*/
?>
<br>
<form name="nuevoPost" action="" method="POST">
Título: <input type="text" name="titulo" />  
Cuerpo del mensaje: <textarea name="cuerpo"> </textarea>
Se publica? <input type="checkbox" name="publicado" checked>
<input type="submit" name="enviarPost" value="Guardar">
<br>
</form>

<?php

// Todo comienza cuando el usuario hace un submit...

if($_SERVER['REQUEST_METHOD']=='POST'){

/* VARIABLES
* TO-DO hay que tomar alguna medida para evitar una SQL injection!
*/
$titulo = $_POST['titulo'];
$cuerpo = $_POST['cuerpo'];

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

	if (empty($_SESSION['usuario'])) {echo '<br>Debes estar logueado para publicar mensajes.';}
		else {
			include 'conectar.php';
			$consulta = " 	INSERT INTO post(date, title, body, published)
							VALUES (CURDATE(), '$titulo', '$cuerpo', '$publicado')
						";
			$nuevoPost=mysqli_query($conectar,$consulta);
			if ($nuevoPost) {echo 'Nuevo mensaje creado';}
			else {echo 'Hubo un error! El post no se guardó.';}
			mysqli_close($conectar);
			//usamos header() para que recargue la página.
			header('Location: index.php');
		}
}