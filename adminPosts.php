<?php session_start();

/*
* Esta es el área de administración, a la cual sólo tiene acceso el admin.
* Aquí está la lista completa de posts, incluyendo los borradores.
* Incluímos el encabezado html, y la conexión a la base.
* Luego hacemos la consulta, donde pedimos que nos traiga todos los resultados.
* Al terminar de mostrar, cerramos la conexión.
* TO-DO: paginar resultados o mostrarlos con jquery
* cada resultado es metido en una lista, formateada como tabla html.
* Finalmente agregamos al final de cada elemento el link a la edición del post.
* Para identificar al post que editaremos, le adosamos al link el id de cada uno.
* Como los datos se adosan al link, trabajaremos con $_GET en lugar de $_POST
*/

include 'header.php';

include 'conectar.php';

$consulta="  SELECT pid, date, title, published 
			 FROM post 
			 ";

$resultado=mysqli_query($conectar,$consulta);

echo '<table><th>ID</th><th>FECHA</th><th>TÍTULO</th><th>ESTADO</th>';

foreach ($resultado as $key => $value) {
	$publicado= $value['published'];
	if ($publicado == '1') {
		$value['published'] = '<b><i>Publicado</i></b>';
	} else {$value['published'] = 'Borrador';}


	echo '<tr>';
	echo '<td>'.$value['pid'].'</td><td>'.$value['date'].'</td><td>'.
	$value['title'].'</td><td>'.$value['published'].'</td><td><a href="?editar='.$value['pid'].'">editar</a></td>';
	echo '</tr>';
}
echo '</table>';

mysqli_close($conectar);

// EDICIÓN DE LOS POSTS (TO-DO: Hacerlo en Jquery)
if (empty($_GET['editar'])) {} else {
include 'conectar.php';

$editar= " SELECT pid, date, title, body, published FROM post 
		   WHERE pid='".$_GET['editar']."'
		 ";

$resultado=mysqli_query($conectar,$editar);

/*
* Una vez obtenidos los resultamos, los metemos en un array asociativo.
* Generamos variables para cada elemento, y las pegamos en un formulario que 
* le servirá al usuario para alterar el contenido del post
*/

$post=mysqli_fetch_assoc($resultado);

$pid=$post['pid'];
$date=$post['date'];
$title=$post['title'];
$body=$post['body'];
$published=$post['published'];


?>
<br><br>
<form name='modificador' method='POST' action=''>
	<?php 
	echo 'Estás modificando el post N*: '.$pid;
	echo '<br>';
	echo 'Publicado el '.$date;
	echo '<br>';
	if ($post['published']=='1') {
		$checked = 'checked';
	}
	?>
	<input type="text" name="title" value="<?php echo $title; ?>" /><br>
	<textarea name="body"><?php echo $body; ?></textarea><br>
	Publicar? <input name="published" type="checkbox" <?php echo $checked; ?> /><br>
	<input type="submit" value="Modificar ahora" name="submit"><br>
</form>

<?php
mysqli_close($conectar);
}


if($_SERVER['REQUEST_METHOD']=='POST') {

	include 'conectar.php';
		/* antes de consultar la base vamos a determinar si el post
		* está o no publicado.
		* Usar 	if ($_POST['published']==true) no anda. 
		*/
		if (isset($_POST['published'])) {
			$_POST['published'] = 1;
		} else { $_POST['published'] = 0; }

	$modificaciones= " UPDATE post
					   SET 	title='".$_POST['title']."',
					   		body='".$_POST['body']."',
					   		published='".$_POST['published']."'
					   WHERE pid='".$_GET['editar']."'

		 			 ";
	$resultado=mysqli_query($conectar,$modificaciones);

	mysqli_close($conectar);

	header('Location: adminPosts.php');

}
