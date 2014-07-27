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

**login.php**
Gestiona el acceso del usuario. Contiene el form de login con la consulta a la base de datos. Se usan las siguientes funciones:
mysqli_query()
mysqli_num_rows()
isset()
header()
mysqli_close()

**conectar.php**
Gestiona la conexión a la base de datos. Todos los documentos que piden cosas a la base, deben incluír este documento. Usa las funciones:
mysqli_connect()
mysqli_set_charset()

**listado.php**
Muestra la lista de mensajes (posts) [...]

**nuevoPost.php**
Gestiona la generación de un nuevo mensaje. [...]