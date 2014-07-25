/*
* Creamos la base de datos que usará el sistema.
* Por una parte está la información del usuario administrador
* Y por la otra la información de los textos a cargar.
* 
* Dado que el sistema solamente contempla un usuario admin, no es preciso conectar 
* ambas bases de datos.
*/

CREATE DATABASE if not exists kiara
 	DEFAULT CHARACTER SET utf8
  	DEFAULT COLLATE utf8_general_ci;

USE kiara;

create table admin (
	uid int unsigned not null auto_increment primary key,
	username char(20) not null,
	pass char(20) not null,
	name char(200) not null,
	email char(200) not null
);

create table post ( 
	pid int unsigned not null auto_increment primary key,
	date datetime not null,
	title char(200) not null,
	body text not null,
	published int not null DEFAULT '0',
);
