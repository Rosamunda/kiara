<form name="loguearse" action="" method="POST">
Usuario: <input type="text" name="usuario" /> 
Clave: <input type="text" name="clave" />
<input type="submit" name="submit" value="Entrar!">
<br>
</form>

<?php
/* CONSULTA A BASE DE DATOS PARA LOGUEAR AL USUARIO 
*
* Cómo es el proceso:
* 1. Solamente iniciamos la conexión en caso que el usuario haya clickeado el botón
* 2. Metemos el proceso de conexión en la variable $conexion
* Formato del proceso de conexión: mysqli_connect('host','usuario','pass','base')
* @see http://php.net/manual/en/function.mysqli-connect.php mysqli_connect()
* 3. Una vez dentro, hacemos la consulta propiamente dicha, metiéndola en la variable
* $consulta.
* El resultado de la consulta es una array asociativa. Ese resultado lo meto en una variable.
* Formato: $resultado=mysqli_query($conexion,$consulta);
* @see http://php.net/manual/en/mysqli.query.php mysqli_query()
* 4. Luego cierro la conexión, ya que mysql ya me contestó lo que le pregunté
* 5. En otras circunstancias habría que tomar otro camino, pero como en este caso existirá sólo 
* un resultado, ya que el admin será uno sólo, iniciaio la sesión del susuario en caso que el 
* sistema haya encontrado un resultado, ya que significará que los datos son correctos.
* @see http://php.net/manual/en/mysqli-result.num-rows.php mysqli_num_rows()
*/

if($_SERVER['REQUEST_METHOD']=='POST'){

    //incluímos la conexión a base. Usar la variable $conectar
    include 'conectar.php';

    /*generamos las variables con los datos del usuario.
    * así como están son INSEGURAS.
    * TO-DO: 
    * mysqi_real_escape_string()? http://php.net/manual/en/function.mysql-real-escape-string.php
    * o mysqli_prepare() http://php.net/mysqli.prepare
    * @see http://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php SQL Injection
    */
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $consulta="  SELECT * FROM usuario 
            	 WHERE username='$usuario'
                 AND pass='$clave'
              ";

    $resultado=mysqli_query($conectar,$consulta);

    $rows = mysqli_num_rows($resultado);
    if ($rows) {

    	/* 
		* ASIGNACIÓN DE LA VARIABLE DE SESIÓN AL USUARIO Y SETEARLE LOS COOKIES
		* 
		* Primeramente iniciamos la sesión con session_start() y todo lo haremos a 
        * partir de eso
		* @see http://php.net/manual/en/function.session-start.php session_start()
		* Luego asignamos el nombre del usuario a la variable de sesión.
		* Si tildamos la casilla "recordar" -es decir, es true- entonces guardamos el 
        * user/pass en la cookie. Caso contrario eliminamos la existencia de 
        * cualquier cookie.
		* time() funciona con segundos, por lo que le decimos que guarde la cookie por 
        * 30 días: 24*60*60 es un día * 30 días
    	*/
        /*
    	$_SESSION['usuario']=$_POST['usuario'];

        if ($_POST['recordarme']) {
            setcookie ("usuario",$usuario, time()+24*60*60*30);
            setcookie ("clave",$clave, time()+24*60*60*30);
            } else {
                setcookie("usuario","");
                setcookie("clave","");
                }
        */ 

    /*
    * Si la sesión existe, es decir está seteada según nos informa isset(), 
    * entonces le damos acceso al usuario y lo saludamos
    */
    if (isset($_SESSION['usuario'])) {
        header('Location: index.php');
    } else {
        echo "Oops! Falló la generación de la sesión.";
      }


    mysqli_close($conectar);

    } else { echo 'Nope, intenta nuevamente.';}

}