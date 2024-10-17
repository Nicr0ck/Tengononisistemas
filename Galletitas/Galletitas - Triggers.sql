DELIMITER //
CREATE TRIGGER DetectarRotura_I
AFTER INSERT ON galletitas
FOR EACH ROW
BEGIN
	IF NEW.Estado LIKE "Rotas" THEN
		IF (SELECT COUNT(*) FROM roturas WHERE ID_Galletitas = NEW.ID) = 0 THEN
			INSERT INTO roturas (ID_Galletitas, Hora_Rotura, Etapa_Rotura)
			VALUES (NEW.ID, NOW(), NEW.Etapa_Chequeo);
		END IF;
	END IF;
END //

DELIMITER //
CREATE TRIGGER DetectarRotura_A
AFTER UPDATE ON galletitas
FOR EACH ROW
BEGIN
	IF NEW.Estado LIKE "Rotas" THEN
		IF (SELECT COUNT(*) FROM roturas WHERE ID_Galletitas = NEW.ID) = 0 THEN
			INSERT INTO roturas (ID_Galletitas, Hora_Rotura, Etapa_Rotura)
			VALUES (NEW.ID, NOW(), NEW.Etapa_Chequeo);
		END IF;
	END IF;
END //

DELIMITER //
CREATE TRIGGER CrearGalles
AFTER INSERT ON pedidos
FOR EACH ROW
BEGIN
	INSERT INTO galletitas(ID_PEDIDO, Estado, Hora_Chequeo, Etapa_Chequeo) VALUES
    (NEW.ID,"Sin revisar",NOW(),"Empaquetado");
END //

DELIMITER //
CREATE TRIGGER CrearEntrega
AFTER UPDATE ON galletitas
FOR EACH ROW
BEGIN
	IF NEW.Etapa_Chequeo LIKE "Carga de Pallets" THEN
		INSERT INTO entregas (ID_Pedido,ID_Galletitas, Hora_Salida)
		VALUES (NEW.ID_Pedido,NEW.ID, NOW());
	END IF;
END //

DELIMITER //
CREATE TRIGGER Destino
AFTER UPDATE ON camiones
FOR EACH ROW
BEGIN
	IF NEW.Localizacion LIKE "Destino" THEN
		update entregas set Hora_Entrega = NOW() where ID_Camion=NEW.ID;
        END IF;
END //
