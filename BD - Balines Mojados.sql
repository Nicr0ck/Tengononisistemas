create database BalinesMojados;
use BalinesMojados;
create table Sucursales(
ID INT PRIMARY KEY AUTO_INCREMENT,
Nombre varchar(100),
Direccion varchar(100),
telefono varchar(16)
);

CREATE TABLE Canchas (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    ID_Sucursal int(3),
	FOREIGN KEY (ID_sucursal) REFERENCES Sucursales(ID)
);
CREATE TABLE Turnos (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ID_Cancha INT,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    fecha DATE NOT NULL,
    estado ENUM('Disponible', 'Reservado') DEFAULT 'Disponible',
    FOREIGN KEY (ID_Cancha) REFERENCES Canchas(ID)
);
Create table Clientes(
	ID INT PRIMARY KEY AUTO_INCREMENT,
	Nombre varchar(100),
    Empresa boolean,
    telefono varchar(20),
    Email varchar(50)
);
CREATE TABLE Reservas (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ID_Turno INT,
    ID_Cliente INT,
    Fecha_Reserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Num_Jugadores INT NOT NULL,
    Balas_Adicionales INT DEFAULT 0,
    Total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (ID_Turno) REFERENCES Turnos(ID),
    FOREIGN KEY (ID_Cliente) REFERENCES Clientes(ID)
);
CREATE TABLE Equipamiento (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nombre_equipamiento VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    descripcion VARCHAR(255)
);
CREATE TABLE ReservaEquipamiento (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ID_reserva INT,
    ID_equipamiento INT,
    Cantidad INT NOT NULL,
    Precio_Total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (ID_reserva) REFERENCES Reservas(ID),
    FOREIGN KEY (ID_equipamiento) REFERENCES Equipamiento(ID)
);
CREATE TABLE Usuarios (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(255) NOT NULL,
    Rol ENUM('Empleado', 'Administrador') DEFAULT 'Empleado',
    ID_Sucursal INT,
	FOREIGN KEY (ID_sucursal) REFERENCES Sucursales(ID)
);
CREATE TABLE Facturas (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ID_Reserva INT,
    Total_Factura DECIMAL(10, 2) NOT NULL,
    Fecha_Factura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ID_reserva) REFERENCES Reservas(ID)
);
