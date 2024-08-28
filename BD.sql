create database balines;
use balines;

create table Sucursales(
    idSucursal int(11) auto_increment,
    direccion varchar(255),
    primary key (idSucursal)
);

create table Promos(
    idPromo int(11) auto_increment,
    balasExtras int(11),
    tiempoExtra time,
    precio int(11),
    primary key (idPromo)
);

create table Reserva(
    idReserva int(11) auto_increment,
    idSucursal int(11),
    idPromo int(11),
    fecha date,
    horaInicio time,
    horaFinal time,
    balasExtras int(11),
    precio int(11),
    primary key (idReserva),
    foreign key (idSucursal) references Sucursales(idSucursal),
    foreign key (idPromo) references Promos(idPromo)
);