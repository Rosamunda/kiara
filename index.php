
<?php include 'header.php'; ?>

<div class="panel clearfix">

<h1><b><span style="color:#AA6104;font-size:180%;">Kiara App</span></b></h1>
<h3>Sencilla aplicación para postear mensajes en la web</h3>
<br><br>

<a href="#" data-reveal-id="myModal" class="panel right" style="margin-right:14%;margin-top:-8%;"><b>Nuevo Mensaje</b></a>
<div id="myModal" class="reveal-modal" data-reveal>
<?php include 'nuevoPost.php'; ?>
</div>

    <div class="row">
      <div class="large-9 columns">
		<?php include 'listado.php'; ?>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
		<?php include 'footer.php'; ?>
      </div>
    </div>
</div>