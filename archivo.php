<div style="margin-top:3%;"></div><?php
/* Listado de mensajes PUBLICADOS en el sitio.
* Los draft no aparecerán acá, solamente en el listado del admin.
* Por eso en la consulta pedimos que traiga todos los posts 
* WHERE published='1'
*/

//Incluímos la conexión alojada en $conectar
include 'conectar.php';
include 'header.php';
/*
* La variable $cantPosts que viene de funciones.php, necesitada para la consulta
* a la base, solamente mantiene su valor dentro de la función cantPosts() que
* por otra parte devuelve el valor de $cantPosts.
* Es por ello que metemos el valor que devuelve cantPosts() en la variable 
* $cantPosts -variable cuyo valor se le asigna dentro de este nuevo scope-
*/

?>
    <div class="row">
      <div class="large-9 columns">
      <h1><div style="float:right;color: rgb(170, 54, 4);font-weight: bold;">Archivo</div></h1><br><br>
<?php

$consulta="  SELECT pid, date, title, body, published 
			 FROM post 
			 WHERE published='1'
			 ORDER BY pid DESC
			 ";

$resultado=mysqli_query($conectar,$consulta);
	//la base tiene la fecha guardada mediante la función mySQL NOW(). Para mostrarla podemos
	//asignarle el formato desde MySQL usando DATE_FORMAT() o desde PHP 
	//(ver: http://stackoverflow.com/questions/1535246/format-date-from-database y http://us.php.net/manual/en/function.strtotime.php#100144)
	foreach ($resultado as $key => $value) {
	//formateamos la fecha y la metemos en una variable
	$fecha = date('d-m-Y', strtotime($value['date']));

	echo '<span class="label label-info">'.$fecha.'</span><h2><a href="post.php?postId='.$value['pid'].'">'.$value['title'].'</a></h2>'.$value['body'].'<br>'.
	'<b>Id '.$value['pid'].'</b><br><hr> <br>';
}
?>
      </div>
    </div>
<?php