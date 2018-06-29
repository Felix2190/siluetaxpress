
ALTER TABLE `hojaclinica` ADD `completitud` DOUBLE NOT NULL DEFAULT '0' ; 

ALTER TABLE `paciente` CHANGE `telefonoCasa` `telefonoCasa` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL; 

ALTER TABLE `hojaclinica` CHANGE `cirugia` `cirugia` ENUM('Si','No','sinrespuesta') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'sinrespuesta', CHANGE `estrenimiento` `estrenimiento` ENUM('Si','No','sinrespuesta') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'sinrespuesta', CHANGE `menstruacion` `menstruacion` ENUM('Regular','Irregular','Menopausa','No','sinrespuesta') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'sinrespuesta', CHANGE `alergia` `alergia` ENUM('Si','No','sinrespuesta') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'sinrespuesta', CHANGE `cafe` `cafe` ENUM('Si','No','sinrespuesta') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'sinrespuesta', CHANGE `fuma` `fuma` ENUM('Si','No','sinrespuesta') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'sinrespuesta', CHANGE `beber` `beber` ENUM('Si','No','sinrespuesta') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'sinrespuesta', CHANGE `ansiedad` `ansiedad` ENUM('Si','No','sinrespuesta') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'sinrespuesta', CHANGE `actividadFisica` `actividadFisica` ENUM('Si','No','sinrespuesta') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'sinrespuesta';

ALTER TABLE `hojaclinica` ADD `tiempoSimbolo` ENUM('hrs','min') NOT NULL DEFAULT 'hrs' AFTER `tiempo`; 

ALTER TABLE `cita` CHANGE `estatus` `estatus` ENUM('nueva','cancelada','realizada') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL; 

