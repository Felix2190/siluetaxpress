ALTER TABLE `cita` ADD `fechaEnvioSMS` DATETIME NULL AFTER `fechaRegistroCita`, ADD `enviarRecordatorio1` BOOLEAN NOT NULL DEFAULT FALSE AFTER `fechaEnvioSMS`; 

ALTER TABLE `hojaclinica` ADD `peso_habitual` DOUBLE NOT NULL DEFAULT '0' AFTER `actividadCena`, ADD `peso_ideal` DOUBLE NOT NULL DEFAULT '0' AFTER `peso_habitual`, ADD `observaciones` TEXT NOT NULL AFTER `peso_ideal`; 

CREATE TABLE IF NOT EXISTS `hojaseguimiento` (
  `idHojaSeguimiento` int(11) NOT NULL AUTO_INCREMENT,
  `idPaciente` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idSucursal` int(11) NOT NULL,
  `pesoKg` float NOT NULL DEFAULT '0',
  `estatura` float NOT NULL DEFAULT '0',
  `IMC` double NOT NULL DEFAULT '0',
  `pecho` float NOT NULL DEFAULT '0',
  `talla` float NOT NULL DEFAULT '0',
  `cintura` float NOT NULL DEFAULT '0',
  `abdomen` float NOT NULL DEFAULT '0',
  `cadera` float NOT NULL DEFAULT '0',
  `sintomas` text NOT NULL,
  `dieta` text NOT NULL,
  `tratamiento` text NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idHojaSeguimiento`),
  KEY `idPaciente` (`idPaciente`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idSucursal` (`idSucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `hojaseguimiento` ADD FOREIGN KEY (`idPaciente`) REFERENCES `paciente`(`idPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `hojaseguimiento` ADD FOREIGN KEY (`idSucursal`) REFERENCES `sucursal`(`idSucursal`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `hojaseguimiento` ADD FOREIGN KEY (`idUsuario`) REFERENCES `usuario`(`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `usuario` ADD `idFranquicia` INT NOT NULL AFTER `envioPassword`; 
UPDATE `usuario` SET `idFranquicia` = '1' ;

DROP TABLE IF EXISTS `franquicia`;
CREATE TABLE IF NOT EXISTS `franquicia` (
  `idFranquicia` int(11) NOT NULL AUTO_INCREMENT,
  `franquicia` varchar(50) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idFranquicia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;


INSERT INTO `franquicia` (`idFranquicia`, `franquicia`, `idUsuario`, `fechaRegistro`) VALUES
(1, 'Acapulco', 1, '2019-07-17 13:32:33');

ALTER TABLE `usuario` ADD INDEX(`idFranquicia`); 
ALTER TABLE `usuario` ADD FOREIGN KEY (`idFranquicia`) REFERENCES `franquicia`(`idFranquicia`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `sucursal` ADD `idFranquicia` INT NOT NULL AFTER `numTelefono`, ADD INDEX (`idFranquicia`); 

UPDATE sucursal SET `idFranquicia` = '1' ;

ALTER TABLE `sucursal` ADD FOREIGN KEY (`idFranquicia`) REFERENCES `franquicia`(`idFranquicia`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `hojaclinica` ADD `antecedentes` TEXT NOT NULL AFTER `peso_ideal`, ADD `tratamientos` TEXT NOT NULL AFTER `antecedentes`; 
