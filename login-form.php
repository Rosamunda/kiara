<form name="loguearse" action="" method="POST">
Usuario: <input type="text" name="usuario" value= "<?php echo $_COOKIE['usuario']; ?>"/> 
Clave: <input type="text" name="clave" value= "<?php echo $_COOKIE['clave']; ?>"/>
<input type="checkbox" name="recordarme"> Recordar datos
<input type="submit" name="submit" value="Entrar!">
<br>
</form>