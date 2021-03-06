<?php 
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

if (empty($_SESSION['usuario'])) { echo 'No puedes acceder a esta página sin estar logueado';}
else {

	// Hacemos la consulta para mostrar la lista de posts
	include 'conectar.php';

	$consulta="  SELECT pid, date, title, published 
				 FROM post 
				 ";

	$resultado=mysqli_query($conectar,$consulta);
?>


<div class="panel clearfix">
      <div class="large-8 columns left">
<?php
		echo '<br><br><h1>Administrar los Mensajes</h1> <a href="#" data-reveal-id="myModal" class="panel right" style="margin-right:14%;margin-top:-8%;"><b>Nuevo Mensaje</b></a> <br><table><th>ID</th><th>FECHA</th><th>TÍTULO</th><th>ESTADO</th>';
		foreach ($resultado as $key => $value) {
			$publicado= $value['published'];
			if ($publicado == '1') {
				$value['published'] = '<b><i>Publicado</i></b>';
			} else {$value['published'] = 'Borrador';}


			echo '<tr>';
			echo '<td>'.$value['pid'].'</td><td>'.$value['date'].'</td><td>'.
			$value['title'].'</td><td>'.$value['published'].'</td><td><a href="?editar='.$value['pid'].'">editar</a> | <a href="?borrar='.$value['pid'].'">borrar</a></td>';
			echo '</tr>';
		}
		echo '</table>';
?>
      </div>

<div id="myModal" class="reveal-modal" data-reveal>
<?php include 'nuevoPost.php'; ?>
</div>

<?php

	mysqli_close($conectar);

	// Hacemos otra consulta para encontrar el post específico que queremos editar
	// Tomamos el dato que nos entrega el link "editar"

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
<ul class="side-nav">
    <div class="large-4 columns right">
		<form name='modificador' method='POST' action=''>
			<?php 
			echo 'Estás modificando el post <b>'.$pid.'</b>';
			echo ' de fecha <b>'.$date.'</b>';
			echo '<br>';
			if ($post['published']=='1') {
				$checked = 'checked';
			}
			?>
			<label>Título</label> <input type="text" name="title" value="<?php echo $title; ?>" /><br>
			<label>Mensaje</label>
			<textarea name="body"><?php echo $body; ?></textarea><br>
			<div class="panel callout radius right"> <b>Publicar?</b> <input name="published" type="checkbox" <?php echo $checked; ?> /></div>
			<br><br>
			<input type="submit" class="button [radius round alert]" value="Modificar ahora" name="submit"><br>
		</form>
	</div>
</ul>
		<?php
		mysqli_close($conectar);
	}


	if($_SERVER['REQUEST_METHOD']=='POST') {

	// Hacemos otra consulta más para modificar los datos en base, 
	// según lo que tocamos en el formulario

		include 'conectar.php';
			/* antes de consultar la base vamos a determinar si el post
			* está o no publicado.
			* Usar 	if ($_POST['published']==true) no anda. 
			* @See http://stackoverflow.com/questions/9142860/inserting-checkbox-values-into-mysql-database-with-php
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
		echo '<script>window.location.replace("adminPosts.php");</script>';

	}

	// Y finalmente otra consulta más para eliminar el post que queremos borrar
	// de la base

	if (empty($_GET['borrar'])) {} else {
		include 'conectar.php';

		$borrar= " DELETE FROM post 
				   WHERE pid='".$_GET['borrar']."'
				 ";

		$borrado = mysqli_query($conectar, $borrar);
		mysqli_close($conectar);
		//no usamos location.reload(); porque se queda recargando indefinidamente
		echo '<script>window.location.replace("adminPosts.php");</script>';
	}
}

include 'footer.php';

?>
</div>