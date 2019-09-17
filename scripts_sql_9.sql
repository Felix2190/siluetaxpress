CREATE TABLE IF NOT EXISTS `citasparalelas` (
  `idCitaParalela` int(11) NOT NULL AUTO_INCREMENT,
  `idCita1` int(11) NOT NULL,
  `idCita2` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idSucursal` int(11) NOT NULL,
  `actualizable` tinyint(1) NOT NULL,
  `idCitaParalelaAdmin` int(11) NOT NULL,
  `estatus` enum('pendiente','resuelto') NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fechaResolucion` datetime NOT NULL,
  PRIMARY KEY (`idCitaParalela`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `citasparalelas` ADD FOREIGN KEY (`idCita1`) REFERENCES `cita`(`idCita`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `citasparalelas` ADD FOREIGN KEY (`idCita2`) REFERENCES `cita`(`idCita`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `citasparalelas` ADD FOREIGN KEY (`idUsuario`) REFERENCES `usuario`(`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `citasparalelas` ADD FOREIGN KEY (`idSucursal`) REFERENCES `sucursal`(`idSucursal`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `citasparalelas` ADD `idCitaParalelaOtroUsuario` INT NOT NULL AFTER `idCitaParalelaAdmin`; 
