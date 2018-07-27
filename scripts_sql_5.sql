ALTER TABLE `tipousuario` ADD `abrev` VARCHAR(10) NOT NULL ; 

UPDATE `tipousuario` SET `nombre` = 'Licenciada en Nutrición' WHERE `tipousuario`.`idTipoUsuario` = 2; 
UPDATE `tipousuario` SET `nombre` = 'Terapeuta' WHERE `tipousuario`.`idTipoUsuario` = 3; 
UPDATE `tipousuario` SET `abrev` = 'Admin.' WHERE `tipousuario`.`idTipoUsuario` = 1; 
UPDATE `tipousuario` SET `abrev` = 'Lic. Ntc.' WHERE `tipousuario`.`idTipoUsuario` = 2; 
UPDATE `tipousuario` SET `abrev` = 'Tpta.' WHERE `tipousuario`.`idTipoUsuario` = 3; 

ALTER TABLE `usuario`  ADD `foto` TEXT NOT NULL ;