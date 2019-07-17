CREATE DATABASE events_admin;

USE events_admin;

CREATE TABLE users(
	id int auto_increment,
	name varchar(60) not null,
	email varchar(255) not null,
	password varchar(64) not null,
	role enum('administrator','operator'),
	create_at timestamp not null default current_timestamp,
	update_at timestamp null,
	primary key (id)
)engine = InnoDB;


CREATE TABLE envents(
	id int auto_increment,
	user_id int not null,
	title varchar(255) not null,
	description text not null,
	cover varchar(100) null,
	envent_date timestamp,
	status enum('pending','executed'),
	created_ad timestamp not null default current_timestamp,
	updated_at timestamp null,
	primary key (id),
	foreign key (user_id) references users(id)
)engine = InnoDB;