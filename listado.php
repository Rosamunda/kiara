<?php
//Incluímos la conexión alojada en $conectar
include 'conectar.php';

$consulta="  SELECT pid, date, title, body, published 
			 FROM post ";

$resultado=mysqli_query($conectar,$consulta);

foreach ($resultado as $key => $value) {
	echo '<br>Item id'.$value['pid'].'<br>'.$value['date'].'<br>'.
	$value['title'].'<br>'.$value['body'].'<br>'.
	'Está publicado? '.$value['published'].'<br>';
}

