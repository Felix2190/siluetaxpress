ALTER TABLE hojaclinica ADD estatura FLOAT NOT NULL AFTER peso_ideal;

ALTER TABLE `hojaseguimiento` DROP `estatura`;

CREATE TABLE IF NOT EXISTS `seguimiento_sintomas` (
  `idSeguimientoSintoma` int(11) NOT NULL AUTO_INCREMENT,
  `estrenimiento` enum('Si','No','sinrespuesta') NOT NULL DEFAULT 'sinrespuesta',
  `cansancio` enum('Si','No','sinrespuesta') NOT NULL DEFAULT 'sinrespuesta',
  `sueno` enum('Si','No','sinrespuesta') NOT NULL DEFAULT 'sinrespuesta',
  `mareo` enum('Si','No','sinrespuesta') NOT NULL DEFAULT 'sinrespuesta',
  `nausea` enum('Si','No','sinrespuesta') NOT NULL DEFAULT 'sinrespuesta',
  `bocaSeca` enum('Si','No','sinrespuesta') NOT NULL DEFAULT 'sinrespuesta',
  PRIMARY KEY (`idSeguimientoSintoma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `hojaseguimiento` CHANGE `sintomas` `otrosSintomas` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL; 

ALTER TABLE `hojaseguimiento` ADD `pierna` FLOAT NOT NULL DEFAULT '0' AFTER `cadera`, ADD `musculo` FLOAT NOT NULL DEFAULT '0' AFTER `pierna`, ADD `grasa` FLOAT NOT NULL DEFAULT '0' AFTER `musculo`, ADD `idSintomas` INT NOT NULL AFTER `grasa`; 


DROP TABLE IF EXISTS `seguimiento_producto`;
CREATE TABLE IF NOT EXISTS `seguimiento_producto` (
  `idSeguimientoProducto` int(11) NOT NULL AUTO_INCREMENT,
  `idSeguimiento` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idSeguimientoProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `productos` ADD `idUsuario` INT NOT NULL AFTER `descripcion`, ADD `fechaRegistro` DATETIME NOT NULL AFTER `idUsuario`; 

ALTER TABLE `productos` ADD FOREIGN KEY (`idUsuario`) REFERENCES `usuario`(`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `seguimiento_producto` ADD FOREIGN KEY (`idProducto`) REFERENCES `productos`(`idProducto`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `seguimiento_producto` ADD FOREIGN KEY (`idSeguimiento`) REFERENCES `seguimiento_sintomas`(`idSeguimientoSintoma`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `seguimiento_producto` ADD FOREIGN KEY (`idUsuario`) REFERENCES `usuario`(`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

INSERT INTO `seguimiento_sintomas` (`idSeguimientoSintoma`, `estrenimiento`, `cansancio`, `sueno`, `mareo`, `nausea`, `bocaSeca`) VALUES (NULL, 'sinrespuesta', 'sinrespuesta', 'sinrespuesta', 'sinrespuesta', 'sinrespuesta', 'sinrespuesta');

update hojaseguimiento set idSintomas=1;

ALTER TABLE `hojaseguimiento` ADD  FOREIGN KEY (`idSintomas`) REFERENCES `seguimiento_sintomas`(`idSeguimientoSintoma`) ON DELETE RESTRICT ON UPDATE RESTRICT;

