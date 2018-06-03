CREATE TABLE IF NOT EXISTS `cabina` (
  `idCabina` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `tipo` enum('consultorio','cabina') NOT NULL DEFAULT 'consultorio',
  `idSucursal` int(11) NOT NULL,
  PRIMARY KEY (`idCabina`),
  KEY `idSucursal` (`idSucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

ALTER TABLE `cabina`
  ADD CONSTRAINT `cabina_ibfk_1` FOREIGN KEY (`idSucursal`) REFERENCES `sucursal` (`idSucursal`);

  INSERT INTO `cabina` (`idCabina`, `nombre`, `tipo`, `idSucursal`) VALUES
(1, 'Consultorio 1', 'consultorio', 2),
(2, 'Cabina 1', 'cabina', 2),
(3, 'Cabina 2', 'cabina', 2),
(4, 'Cabina 3', 'cabina', 2),
(5, 'Cabina 4', 'cabina', 2),
(6, 'Consultorio 1', 'consultorio', 4),
(7, 'Cabina 1', 'cabina', 4),
(8, 'Cabina 2', 'cabina', 4),
(9, 'Cabina 3', 'cabina', 4),
(10, 'Consultorio 1', 'consultorio', 3),
(11, 'Cabina 1', 'cabina', 3),
(12, 'Cabina 2', 'cabina', 3);

ALTER TABLE `cita` ADD `idCabina` INT NOT NULL AFTER `idSucursal`, ADD INDEX (`idCabina`) ; 

ALTER TABLE `cita` ADD FOREIGN KEY (`idCabina`) REFERENCES `cabina`(`idCabina`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `consulta` ADD `consultorio` ENUM('consultorio','cabina') NOT NULL DEFAULT 'cabina' AFTER `tipoConsulta`; 

UPDATE `consulta` SET `consultorio` = 'consultorio' WHERE `consulta`.`idConsulta` = 1; 
