ALTER TABLE `promociones_ruleta` ADD `idSucursal` INT NOT NULL AFTER `idFranquicia`, ADD INDEX (`idSucursal`); 
UPDATE `promociones_ruleta` SET `idSucursal` = 2 WHERE idFranquicia=2;
UPDATE `promociones_ruleta` SET `idSucursal` = 3 WHERE idFranquicia=1;
ALTER TABLE `promociones_ruleta` ADD FOREIGN KEY (`idSucursal`) REFERENCES `sucursal`(`idSucursal`) ON DELETE RESTRICT ON UPDATE RESTRICT; 
INSERT INTO `claves` (`idClave`, `referencia`, `usuario`, `clave`, `idSucursal`) VALUES (NULL, 'oportunidades', '', '5', '0'); INSERT INTO `claves` (`idClave`, `referencia`, `usuario`, `clave`, `idSucursal`) VALUES (NULL, 'oportunidades', '', '5', '0'); 
