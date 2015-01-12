<?php session_start(); ?>

<!DOCTYPE html lang="en" >
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->

<head>
  <meta charset="utf-8">
  <!-- If you delete this meta tag World War Z will become a reality -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kiara App</title>



  <!-- If you are using the gem version, you need this only -->
  <link rel="stylesheet" href="stylesheets/app.css">

  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/foundation/js/foundation.min.js"></script>

</head>
<body>

<?php
	include 'funciones.php';
	//incluímos el encabezado con los campos para loguearse
	if (empty($_SESSION['usuario'])) include 'login.php';
	else {
?>

<div class="fixed">
	<nav class="top-bar" data-topbar role="navigation">
	  <ul class="title-area">
	    <li class="name">
	      <h1><a href="#">Estás logueado como <b><?php echo $_SESSION['usuario']; ?></b></a></h1>
	    </li>
	  </ul>

	  <section class="top-bar-section">
	    <!-- Right Nav Section -->
	    <ul class="right">
	      <li class="active"><a href="/<?php echo obtenerCarpeta(); ?>">inicio</a></li>
	      <li class="active"><a href="adminPosts.php">administrar mensajes</a></li>
	      <li class="active"><a href="config.php">configuraciones</a></li>
	      <li class="active"><a href="salir.php">salir</a></li>
	    </ul>
	  </section>
	</nav>
</div>

<?php
	}

	