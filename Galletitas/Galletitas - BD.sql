create database Galletitas;
use Galletitas;
-- La tabla clientes necesita: nombre/s, apellido/s, numero
create table Clientes(
ID int auto_increment primary key,
Nombre varchar(50),
Apellido varchar(50),
Telefono varchar(20),
Localidad varchar(50),
Direccion varchar(50)
);
-- Pedidos necesita: cantidad de pallets, ID_Clientes, fecha en la que se realizo
create table Pedidos(
ID int auto_increment primary key,
Cantidad_Pallets int(3),
Fecha DATE,
ID_Cliente int,
foreign key (ID_Cliente) references Clientes(ID)
);
-- EstadoGalletitas necesita: referenciar a pedidos, indicar su estado, fecha y hora de cuando se chequeo, etapa de produccion donde se chequeo
create table Galletitas(
ID int auto_increment primary key,
ID_Pedido int,
Estado varchar(50),
Hora_Chequeo DATETIME,
Etapa_Chequeo varchar(50),
foreign key (ID_Pedido) references Pedidos(ID)
);
-- Esta tabla tendra un nuevo elemento cuando en "Galletitas" salga el estado Rotas/Dañadas, para guardar cuando se rompieron las galletitas.
create table Roturas(
ID int auto_increment primary key,
ID_Galletitas int,
Hora_Rotura DATETIME,
Etapa_Rotura varchar(50),
foreign key (ID_Galletitas) references Galletitas(ID)
);
-- Aca se iria actualizando la localizacion y hora en la que se actualizo por ultima vez esta misma.
create table Camiones(
ID int auto_increment primary key,
Localizacion varchar(50),
Hora DATETIME
);
-- Entregas necesita: referenciar el pedido, el estado de las galletitas, hora de salida, hora de entrega, opinion del cliente(tendria 3 tipos de estados: 1-10, Comentario, Devuelto o no)
create table Entregas(
ID int auto_increment primary key,
ID_Pedido int,
ID_Galletitas int,
ID_Camion int,
Hora_Salida DATETIME,
Hora_Entrega DATETIME,
Comentarios_Cliente varchar(150),
Devolucion bool,
foreign key (ID_Pedido) references Pedidos(ID),
foreign key (ID_Galletitas) references Galletitas(ID),
foreign key (ID_Camion) references Camiones(ID)
);