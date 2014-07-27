/*
* Creamos la base de datos que usará el sistema.
* Por una parte está la información del usuario administrador
* Y por la otra la información de los textos a cargar.
* 
* Dado que el sistema solamente contempla un usuario admin, no es preciso conectar 
* ambas bases de datos.
* El sistema parte de la base que el usuario con privilegios para trabajar con la base 
* desde la aplicación se llama kiaraAdmin. El admin hay que crearlo antes.
* Usando phpmyadmin podemos generar un nuevo usuario desde el apartado "users" el link "add user"
* Sólo necesitamos generarle al usuario el nombre y una clave. Los privilegios los generamos 
* desde aquí.
* Por le momento hay que agregar al admin del sitio manualmente en la tabla usuarios. 
* TO-DO: Hacerlo desde una pantalla e configuración inicial que corra database.sql.
*/

CREATE DATABASE if not exists kiara
 	DEFAULT CHARACTER SET utf8
  	DEFAULT COLLATE utf8_general_ci;

USE kiara;

GRANT SELECT, INSERT, UPDATE
on kiara.*
to kiaraAdmin;

create table if not exists usuario (
	uid int unsigned not null auto_increment primary key,
	username char(20) not null,
	pass char(20) not null,
	name char(200) not null,
	email char(200) not null
) DEFAULT CHARACTER SET utf8;

create table if not exists post ( 
	pid int unsigned not null auto_increment primary key,
	date datetime not null,
	title char(200) not null,
	body text not null,
	published int not null DEFAULT '0'
) DEFAULT CHARACTER SET utf8;
