
DROP TABLE IF EXISTS `cita_control_whatsapp`;
CREATE TABLE IF NOT EXISTS `cita_control_whatsapp` (
  `idControl` int NOT NULL AUTO_INCREMENT,
  `idCita` int NOT NULL,
  `idPlantilla` int NOT NULL,
  `estatus` enum('Pendiente','Confirmada','Cancelada') NOT NULL DEFAULT 'Pendiente',
  `fechaEnvio` datetime NOT NULL,
  `fechaRespuesta` datetime DEFAULT NULL,
  `idUsuario` int NOT NULL,
  PRIMARY KEY (`idControl`),
  KEY `idCita` (`idCita`),
  KEY `idPlantilla` (`idPlantilla`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `plantilla_whatsapp`;
CREATE TABLE IF NOT EXISTS `plantilla_whatsapp` (
  `idPlantilla` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `activa` tinyint(1) NOT NULL,
  `idUsuario` int NOT NULL,
  `fecha_registro` int NOT NULL,
  PRIMARY KEY (`idPlantilla`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `cita_control_whatsapp`
  ADD CONSTRAINT `cita_control_whatsapp_ibfk_1` FOREIGN KEY (`idCita`) REFERENCES `cita` (`idCita`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cita_control_whatsapp_ibfk_2` FOREIGN KEY (`idPlantilla`) REFERENCES `plantilla_whatsapp` (`idPlantilla`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cita_control_whatsapp_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `plantilla_whatsapp`
  ADD CONSTRAINT `plantilla_whatsapp_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `franquicia` ADD `identificadorMeta` TEXT NOT NULL AFTER `idUsuario`; 

ALTER TABLE `cita_control_whatsapp` ADD `numeroCelular` CHAR(12) NOT NULL AFTER `idPlantilla`; 

ALTER TABLE `cita_control_whatsapp` ADD `errorMeta` TEXT NOT NULL AFTER `fechaRespuesta`; 

ALTER TABLE `sucursal` ADD `enviarWhatsapp` TINYINT NOT NULL DEFAULT '0' AFTER `enviarSMS`; 

ALTER TABLE `cita_control_whatsapp` CHANGE `estatus` `estatus` ENUM('Pendiente','Confirmada','Cancelada','Error') NOT NULL DEFAULT 'Pendiente'; 

ALTER TABLE `plantilla_whatsapp` CHANGE `fecha_registro` `fecha_registro` DATE NOT NULL; 