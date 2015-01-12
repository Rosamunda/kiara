<div style="margin-top:3%;"></div><?php

/** 
 * Este archivo muestra cada item (post) individualmente considerado.
 */

include 'header.php';

?>
    <div class="row">
      <div class="large-9 columns">
<?php
	//obtenemos el ID de la URL
	$postId = $_GET['postId'];
	//pasamos el id como parámetro de nuestra función get_post().
	//get_post() devuelve un array con el post, que metemos en $post
	$post = get_post($postId);
	//metemos cada item en una variable para imprimirla en pantalla
	$pid=$post['pid'];
	$date=$post['date'];
	$title=$post['title'];
	$body=$post['body'];
	$published=$post['published'];

	//mostramos el post con formato
	?>
		<h1><?php echo $title; ?><small><?php echo ' '.$date; ?></small></h1>
		<p><?php echo $body; ?></p>
		<span class="label label-info">Id <?php echo $pid; ?></span>
		<br>
			<?php 
				if ($published == 1) {
					echo '<small>Estado: Publicado</small>';
				} else {
					echo '<small>Estado: Borrador</small>';
					   }
			?>
