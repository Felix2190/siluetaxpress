INSERT INTO `estatuscita` (`estatusCita`, `descripcion`) VALUES ('no_realizada', 'El paciente no se presentó');
ALTER TABLE `cita` ADD `fechaVerificaAsistencia` DATETIME NULL DEFAULT NULL AFTER `idUsuarioCancela`, ADD `verificaAsistencia` BOOLEAN NOT NULL DEFAULT FALSE AFTER `fechaVerificaAsistencia`; 
UPDATE cita set fechaVerificaAsistencia=DATE_SUB(fechaFin,INTERVAL 10 MINUTE);

DELIMITER $$

CREATE TRIGGER actualizaFechaVerificar AFTER UPDATE ON cita
FOR EACH ROW
BEGIN
	SET @fechaVerificaAsistencia=DATE_SUB(NEW.fechaFin, INTERVAL 10 MINUTE);
	UPDATE cita set fechaVerificaAsistencia=@fechaVerificaAsistencia where idCita=NEW.idCita;
	
	
END $$
