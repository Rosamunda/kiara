/*
* Creamos la base de datos que usará el sistema.
* Por una parte está la información del usuario administrador
* Y por la otra la información de los textos a cargar.
* create database if not exists kiara;
* Dado que el sistema solamente contempla un usuario admin, no es preciso conectar 
* ambas bases de datos.
*/


create table admin (
	uid int unsigned not null auto_increment primary key,
	username char(20) not null,
	pass char(20) not null,
	name char(200) not null,
	email char(200) not null
);

create table post ( 
	pid int unsigned not null auto_increment primary key,
	date date not null,
	title char(200) not null,
	body text not null,
	published int not null,
);
