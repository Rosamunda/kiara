<?php
/* Listado de mensajes PUBLICADOS en el sitio.
* Los draft no aparecerán acá, solamente en el listado del admin.
* Por eso en la consulta pedimos que traiga todos los posts 
* WHERE published='1'
*/

//Incluímos la conexión alojada en $conectar
include 'conectar.php';

$consulta="  SELECT pid, date, title, body, published 
			 FROM post 
			 WHERE published='1'
			 ";

$resultado=mysqli_query($conectar,$consulta);

foreach ($resultado as $key => $value) {
	echo '<br>Item id'.$value['pid'].'<br>'.$value['date'].'<br>'.
	$value['title'].'<br>'.$value['body'].'<br>'.
	'Está publicado? '.$value['published'].'<br>';
}

