-- Unas inserciones de prueba hechas por chat gpt
INSERT INTO Clientes (Nombre, Apellido, Telefono, Localidad, Direccion) VALUES
('Juan', 'Pérez', '123456789', 'Ciudad A', 'Calle Falsa 123'),
('María', 'García', '987654321', 'Ciudad B', 'Avenida Siempreviva 742'),
('Pedro', 'Lopez', '456123789', 'Ciudad C', 'Calle de los Pinos 456');

INSERT INTO Camioneros (Nombre, DNI) VALUES
('Carlos', '20345678'),
('Luis', '31456789'),
('Jorge', '42567890');
INSERT INTO Camiones (Localizacion, Hora, ID_Camionero) VALUES
('Ciudad A', '2024-10-01 12:00:00', 1),
('Ciudad B', '2024-10-02 14:30:00', 2),
('Ciudad C', '2024-10-03 15:45:00', 3);
