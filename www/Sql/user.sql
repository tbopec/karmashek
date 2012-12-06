drop database karmashek;
create database karmashek;
use karmashek;

create table users (
	guid varchar(36) not null,
	login varchar(36) not null,
	password varchar(36) not null,
	Family varchar(36),
	Name varchar(36),
	primary key(guid)
);

create table sessions (
	guid varchar(36) not null,
	userId varchar(36),
	lastLogIn datetime,
	primary key(guid)
);

create table links (
	guid varchar(36) not null,
	owner varchar(36),
	parent varchar(36),
	`date` datetime,
	`name` text,
	`info` text,
	`preview` varchar(36),
	`isfolder` smallint(1),
	`childCount` int default 0,
	primary key(guid)
);

create table previews (
	guid varchar(36) not null,
	`data` blob,
	primary key(guid)
);