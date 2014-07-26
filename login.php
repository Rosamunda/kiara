<form name="loguearse" action="" method="POST">
Usuario: <input type="text" name="usuario"> 
Clave: <input type="text" name="clave">
<input name="recordar" type="checkbox" value="1" <?php if ($_COOKIE['recordar'] == 1) echo "checked";?>/> recordar datos
<input type="submit" name="submit" value="Entrar!">
<br>
</form>

<?php
//variables para el login
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$recordar = $_POST['recordar'];

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
	$conexion=mysqli_connect('localhost','kiaraAdmin','123456','kiara')
	OR die('Upa! Algo salió mal y no se pudo conectar a la base de datos para loguearte. Error '.mysqli_connect_errno());

    $consulta='  SELECT * FROM usuario 
    	WHERE usuario="'.$usuario.'" 
        AND clave="'.$clave.'"
        ';

    $resultado=mysqli_query($conexion,$consulta);

    mysqli_close($conexion);

    //if(mysqli_num_rows($resultado)==1){
    	/* 
		* ASIGNACIÓN DE LA VARIABLE DE SESIÓN AL USUARIO Y SETEARLE LOS COOKIES
		* 
		* Primeramente iniciamos la sesión con session_start() y todo lo haremos a partir de eso
		* @see http://php.net/manual/en/function.session-start.php session_start()
		* Luego asignamos el nombre del usuario a la variable de sesión.
		* Si tildamos la casilla "recordar" -es decir, es true- entonces guardamos el user/pass
		* en la cookie. Caso contrario eliminamos la existencia de cualquier cookie.
		* time() funciona con segundos, por lo que le decimos que guarde la cookie por 30 días:
		* 24*60*60 es un día * 30 días
    	*/
    	session_start();

    	$_SESSION['usuario']=$usuarioLogueado;
    	
    	if ($recordar) {
    		setcookie ("usuario",$usuarioLogueado, time()+24*60*60*30);
            setcookie ("clave",$clave, time()+24*60*60*30);
    	} else {
    		setcookie("usuario","");
            setcookie("clave","");
    	}
    /*
	* Si la sesión existe, es decir está seteada según nos informa isset(), entonces le damos
	* acceso al usuario y lo saludamos
    */
    if (isset($usuarioLogueado)) {
    	echo 'Hola '.$usuarioLogueado. ' Session Id: '.session_id();
    } else echo 'Nada';    	
    //}
}
