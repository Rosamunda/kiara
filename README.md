kiara
=====

El objetivo de este app es simplemente el de ejercitación de algunos conocimientos aprendidos. Se trata de una aplicación en PHP que -por el momento- no usa objetos.

El objetivo ha sido la puesta en marcha de un CMS básico en PHP.

Funcionalidad
-------------
Weblog *unipersonal*, donde el admin se loguea y puede crear textos (posts).
Cada texto es de un único autor -el admin- y consta de una fecha de creación, un título y un contenido o cuerpo.
Estos textos se publican o se mantienen como borrador (en un estado "no publicado").
El admin puede editarlos para modificarlos o para cambiarles su estado, o en su caso borrarlos.
Los visitantes del sitio pueden acceder a todos los contenidos publicados.

TO-DO
-----
Como esta aplicación es una mera ejercitación, no se tuvo en cuenta aún ningún control sobre el input del usuario, para prever una SQL Injection.

Archivos que contiene el sistema
--------------------------------

**login.php**
Gestiona el acceso del usuario. Contiene el form de login con la consulta a la base de datos. Se usan las siguientes funciones:
mysqli_query()
mysqli_num_rows()
isset()
header()
mysqli_close()
Actualmente este archivo se inserta en index.php.

**conectar.php**
Gestiona la conexión a la base de datos. Todos los documentos que piden cosas a la base, deben incluír este documento. Usa las funciones:
mysqli_connect()
mysqli_set_charset()

**listado.php**
Hace la consulta a base y muestra el listado de posts que cumplen la condición de estar publicados. 
Actualmente este archivo se inserta en index.php.

**nuevoPost.php**
Gestiona la generación de cada nuevo mensaje.
Contiene el formulario web de carga de un nuevo post al pie del listado de la home.
Usamos header() para hacer el reenvío al finalizar la operación.
Actualmente este archivo se inserta en index.php.

**adminPosts.php**
En caso de estar logueado, se muestra el listado de todos los posts -publicados o no- y un link hacia la edición de cada uno.
Usamos $_GET['...'] ya que cada link contiene el número de id de cada post, y de allí tomamos el dato para hacer las consultas a la base de datos.

**header.php**
El encabezado de las páginas.

**database.sql**
Contiene la información para generar la base de datos.

**config.php**
Archivo que contiene algunas configuraciones del sistema.
Por el momento tiene solamente:
- Carpeta del sistema: Usamos la función obtenerCarpeta()
- Cantidad de posts en inicio: usamos la función cantPosts()
El archivo guarda los nuevos datos usando la función guardarDatos()

**funciones.php**
Contiene las funciones específicas del sistema, creadas ad hoc.
Está incrustado en header.php, por lo que todas las páginas acceden a la data provista por este archivo.

**salir.php**
Gestiona el logout del usuario. Se usan las siguientes fuciones:
session_unset();
session_destroy();