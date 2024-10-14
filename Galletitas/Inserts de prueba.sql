-- Unas inserciones de prueba hechas por chat gpt
INSERT INTO Clientes (Nombre, Apellido, Telefono, Localidad, Direccion) VALUES
('Juan', 'Pérez', '123456789', 'Ciudad A', 'Calle Falsa 123'),
('María', 'García', '987654321', 'Ciudad B', 'Avenida Siempreviva 742'),
('Pedro', 'Lopez', '456123789', 'Ciudad C', 'Calle de los Pinos 456');
INSERT INTO Pedidos (Cantidad_Pallets, Fecha, ID_Cliente) VALUES
(10, '2024-10-01', 1),
(15, '2024-10-02', 2),
(20, '2024-10-03', 3);
INSERT INTO Galletitas (ID_Pedido, Estado, Hora_Chequeo, Etapa_Chequeo) VALUES
(1, 'En Buen Estado', '2024-10-01 08:00:00', 'Empaquetado'),
(2, 'Dañadas', '2024-10-02 09:30:00', 'Almacenamiento'),
(3, 'En Buen Estado', '2024-10-03 10:45:00', 'Carga en Camión');
INSERT INTO Roturas (ID_Galletitas, Hora_Rotura, Etapa_Rotura) VALUES
(2, '2024-10-02 10:00:00', 'Almacenamiento');
INSERT INTO Camioneros (Nombre, DNI) VALUES
('Carlos', '20345678'),
('Luis', '31456789'),
('Jorge', '42567890');
INSERT INTO Camiones (Localizacion, Hora, ID_Camionero) VALUES
('Ciudad A', '2024-10-01 12:00:00', 1),
('Ciudad B', '2024-10-02 14:30:00', 2),
('Ciudad C', '2024-10-03 15:45:00', 3);
INSERT INTO Entregas (ID_Pedido, ID_Galletitas, ID_Camion, Hora_Salida, Hora_Entrega, Comentarios_Cliente, Devolucion) VALUES
(1, 1, 1, '2024-10-01 08:30:00', '2024-10-01 13:00:00', 'Todo en orden', false),
(2, 2, 2, '2024-10-02 09:45:00', '2024-10-02 15:30:00', 'Algunas dañadas', true),
(3, 3, 3, '2024-10-03 10:50:00', '2024-10-03 16:00:00', 'Entrega exitosa', false);

