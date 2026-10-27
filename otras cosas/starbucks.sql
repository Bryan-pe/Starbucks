create table bebidas(
	id integer primary key autoincrement, 
	nom text not null, 
	size_id integer, 
	crema text not null, 
	leche text not null, 
	frapp text not null, 
	kcal real not null, 
	precio_n real not null, 
	precio_v real, 
	img text not null, 
	tipo_id integer,
	
	foreign key (size_id) references size(id),
	foreign key (tipo_id) references tipo(id)
);

create table usuarios(
	id integer primary key autoincrement,
	nom text not null,
	ap text not null,
	gmail text not null unique,
	pass text not null
);

create table carrito(
	id integer primary key autoincrement,
	usuario integer,
	fecha datetime default current_timestamp,
	estado text,
	
	foreign key (usuario) references usuarios(id)
);

create table carrito_det(
	id_carrito_det integer primary key autoincrement,
	carrito integer,
	bebida integer,
	cant integer not null,
	
	foreign key (carrito) references carrito(id),
	foreign key (bebida) references bebidas(id)
);

create table compra(
	id integer primary key autoincrement,
	usuario integer,
	total real not null,
	fecha datetime default current_timestamp,
	
	foreign key (usuario) references usuarios(id)
);

create table compra_det(
	id integer primary key autoincrement,
	compra integer,
	bebida integer,
	cant integer not null,
	precio real not null,
	
	foreign key (compra) references compra(id),
	foreign key (bebida) references bebidas(id)
);

create table size(
	id integer primary key autoincrement,
	size text not null
);

create table tipo(
	id integer primary key autoincrement,
	tipo text not null
);

select usuario,bebida,cant FROM carrito join carrito_det on carrito.id = carrito_det.carrito join bebidas on carrito_det.bebida = bebidas.id

select size,nom from bebidas join size on bebidas.size_id = size.id

SELECT * FROM carrito_det join bebidas ON carrito_det.bebida = bebidas.id JOIN size ON bebidas.size_id = size.id

SELECT * FROM carrito_det join bebidas ON carrito_det.bebida = bebidas.id JOIN size ON bebidas.size_id = size.id JOIN carrito on carrito_det.carrito = carrito.id WHERE estado = 'abierto'

SELECT * FROM carrito_det cd JOIN bebidas b ON cd.bebida = b.id JOIN size s ON b.size_id = s.id JOIN carrito c on cd.carrito = c.id WHERE estado = 'abierto'

SELECT sum(cant) from carrito_det where carrito = 22

SELECT sum(cant) FROM carrito_det cd JOIN carrito c on cd.carrito = c.id WHERE estado = 'abierto' AND usuario = 1