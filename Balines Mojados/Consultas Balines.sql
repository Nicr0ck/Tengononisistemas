-- Agregar Sucursales
INSERT INTO Sucursales (Nombre, Direccion, telefono)
VALUES ('Sucursal Central', 'Av. Principal 123', '1234567890');
INSERT INTO Sucursales (Nombre, Direccion, telefono)
VALUES ('Sucursal Loma Hermosa', 'Av. Eva Perón 9998', '54 11 34343-5786');
-- Agregar canchas
INSERT INTO Canchas (Nombre, ID_Sucursal)
VALUES ('Cancha 1', 1);
-- Agregar turnos turnos
INSERT INTO Turnos (ID_Cancha, hora_inicio, hora_fin, fecha)
VALUES (1, '10:00:00', '11:00:00', '2024-09-10');

-- Crear una reserva
INSERT INTO Reservas (ID_turno, Num_Jugadores, Balas_Adicionales, Total)
VALUES (1, 5, 100, 250.00);

-- Actualizar estado del turno a 'Reservado'
UPDATE Turnos SET estado = 'Reservado' WHERE ID = 1;
-- Comprar Equipamiento
INSERT INTO Equipamiento (nombre_equipamiento, precio, descripcion)
VALUES ('Chaleco Protector', 50.00, 'Chaleco de protección para jugadores');
-- Reserva de Equipamiento
INSERT INTO ReservaEquipamiento (ID_reserva, ID_equipamiento, Cantidad, Precio_Total)
VALUES (1, 1, 5, 250.00);
-- Facturas
INSERT INTO Facturas (ID_Reserva, Total_Factura)
VALUES (1, 500.00);
