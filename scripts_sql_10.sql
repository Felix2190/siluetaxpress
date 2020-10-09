INSERT INTO `estatuscita` (`estatusCita`, `descripcion`) VALUES ('no_realizada', 'El paciente no se presentó');
ALTER TABLE `cita` ADD `fechaVerificaAsistencia` DATETIME NULL DEFAULT NULL AFTER `idUsuarioCancela`, ADD `verificaAsistencia` BOOLEAN NOT NULL DEFAULT FALSE AFTER `fechaVerificaAsistencia`; 
UPDATE cita set fechaVerificaAsistencia=DATE_SUB(fechaFin,INTERVAL 10 MINUTE);
