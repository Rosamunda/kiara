kiara
=====

This is just a test.

Objetivo
========
Creación de un CMS básico en PHP, sin usar objetos y usando PHPdocumentor para documentar todo lo hecho.

Funcionalidad
-------------
Weblog para un sólo usuario, donde el admin se loguea y puede generar textos.
Cada texto es de un único autor -el admin- y consta de una fecha de creación, un título y un contenido o cuerpo.
Estos textos se publican o se mantienen como borrador (en un estado "no publicado").
El admin puede editarlos para modificarlos o para cambiarles su estado.
Los visitantes del sitio pueden acceder a todos los contenidos publicados.

Archivos requeridos
-------------------
*index.php*
Muestra el listado de textos publicados por fecha, los cuales se muestran en orden decreciente.
Permite el login del admin.

*nuevo.php*
Acceso al admin para que cargue nuevos textos.

*lista.php*
Muestra una lista de todos los textos publicados, indicando su estado.

*logout.php*
Funcionalidad para desloguearse
