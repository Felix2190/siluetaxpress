ALTER TABLE hojaclinica ADD estatura FLOAT NOT NULL AFTER peso_ideal;

ALTER TABLE `hojaseguimiento` DROP `estatura`;

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `estatus` enum('activo','suspendido') NOT NULL DEFAULT 'activo',
  `idUsuario` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);


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

ALTER TABLE `seguimiento_producto` ADD FOREIGN KEY (`idProducto`) REFERENCES `productos`(`idProducto`) ON DELETE RESTRICT ON UPDATE RESTRICT;  ALTER TABLE `seguimiento_producto` ADD FOREIGN KEY (`idUsuario`) REFERENCES `usuario`(`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

--INSERT INTO `seguimiento_sintomas` (`idSeguimientoSintoma`, `estrenimiento`, `cansancio`, `sueno`, `mareo`, `nausea`, `bocaSeca`) VALUES (NULL, 'sinrespuesta', 'sinrespuesta', 'sinrespuesta', 'sinrespuesta', 'sinrespuesta', 'sinrespuesta');

--update hojaseguimiento set idSintomas=1;

--ALTER TABLE `hojaseguimiento` ADD  FOREIGN KEY (`idSintomas`) REFERENCES `seguimiento_sintomas`(`idSeguimientoSintoma`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `hojaseguimiento` ADD `bocaSeca` BOOLEAN NOT NULL DEFAULT FALSE AFTER `grasa`, ADD `estrenimiento` BOOLEAN NOT NULL DEFAULT FALSE AFTER `bocaSeca`, ADD `cansancio` BOOLEAN NOT NULL DEFAULT FALSE AFTER `estrenimiento`, ADD `sueno` BOOLEAN NOT NULL DEFAULT FALSE AFTER `cansancio`, ADD `mareo` BOOLEAN NOT NULL DEFAULT FALSE AFTER `sueno`, ADD `nausea` BOOLEAN NOT NULL DEFAULT FALSE AFTER `mareo`; 

ALTER TABLE `productos` ADD `estatus` ENUM('activo','suspendido') NOT NULL DEFAULT 'activo' AFTER `descripcion`; 

ALTER TABLE `hojaseguimiento` ADD `fc` FLOAT NOT NULL DEFAULT '0' AFTER `grasa`, ADD `pa` FLOAT NOT NULL DEFAULT '0' AFTER `fc`; 

ALTER TABLE `seguimiento_producto` ADD `estatus` ENUM('activo','baja') NOT NULL DEFAULT 'activo' AFTER `idUsuario`; 

ALTER TABLE `hojaseguimiento` ADD `fechaSeguimiento` DATETIME NOT NULL DEFAULT '1900-01-01 00:00:00' AFTER `fechaRegistro`; 
