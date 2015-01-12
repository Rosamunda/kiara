<?php
/* Listado de mensajes PUBLICADOS en el sitio.
* Los draft no aparecerán acá, solamente en el listado del admin.
* Por eso en la consulta pedimos que traiga todos los posts 
* WHERE published='1'
*/

//Incluímos la conexión alojada en $conectar
include 'conectar.php';

/*
* La variable $cantPosts que viene de funciones.php, necesitada para la consulta
* a la base, solamente mantiene su valor dentro de la función cantPosts() que
* por otra parte devuelve el valor de $cantPosts.
* Es por ello que metemos el valor que devuelve cantPosts() en la variable 
* $cantPosts -variable cuyo valor se le asigna dentro de este nuevo scope-
*/

$cantPosts = cantPosts();

$consulta="  SELECT pid, date, title, body, published 
			 FROM post 
			 WHERE published='1'
			 ORDER BY pid DESC
			 LIMIT 0, $cantPosts
			 ";

$resultado=mysqli_query($conectar,$consulta);

	foreach ($resultado as $key => $value) {
	echo '<h2>'.$value['title'].'</h2>'.$value['body'].'<br>'.
	'<b><i>Item id '.$value['pid'].' del '.$value['date'].'</i></b><br><hr> <br>';
}
