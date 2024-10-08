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