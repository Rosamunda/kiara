
<?php include 'header.php'; ?>


<a href="#" data-reveal-id="myModal" class="panel right" style="margin-right:14%;margin-top:-8%;">&#x270e; <b>Nuevo Mensaje</b></a>
<a href="archivo.php" class="panel right" style="margin-right:14%;margin-top:-2%;"><b> &#x2605; Ver Archivo &#x2605; </b></a>
<div id="myModal" class="reveal-modal" data-reveal>
<?php include 'nuevoPost.php'; ?>
</div>

    <div class="row">
      <div class="large-9 columns">
		<?php include 'listadoFront.php'; ?>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
		<?php include 'footer.php'; ?>
      </div>
    </div>
</div>