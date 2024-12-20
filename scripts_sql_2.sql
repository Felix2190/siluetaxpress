ALTER TABLE `paciente` ADD `edad` INT(2) NOT NULL AFTER `telefonoCel`, ADD `sexo` ENUM('Masculino','Femenino') NOT NULL AFTER `edad`, ADD `fechaNacimiento` DATE NOT NULL AFTER `sexo`, ADD `ocupacion` INT NOT NULL AFTER `fechaNacimiento`; 

ALTER TABLE `paciente` CHANGE `ocupacion` `ocupacion` VARCHAR(50) NOT NULL; 

ALTER TABLE `hojaclinica` DROP `edad`; 

ALTER TABLE `hojaclinica`  ADD `cirugia` ENUM('Si','No') NOT NULL DEFAULT 'No' ,  ADD `cirugias` TEXT NOT NULL ,  ADD `enfermedades` TEXT NULL ,  ADD `estrenimiento` ENUM('Si','No') NOT NULL DEFAULT 'No' ,  ADD `estrenimientoFrecuencia` ENUM('0','1','2','3') NOT NULL DEFAULT '0' ,  ADD `menstruacion` ENUM('Regular','Irregular','Menopausa','No') NOT NULL DEFAULT 'No' ,  ADD `alergia` ENUM('Si','No') NOT NULL ,  ADD `alimento` VARCHAR(100) NOT NULL ,  ADD `hrsDormir` INT(2) NOT NULL ,  ADD `hrsComer` INT(2) NOT NULL ,  ADD `cafe` ENUM('Si','No') NOT NULL DEFAULT 'No' ,  ADD `cafeFrecuencia` ENUM('0','1','2','3') NOT NULL DEFAULT '0' ,  ADD `fuma` ENUM('Si','No') NOT NULL DEFAULT 'No' ,  ADD `fumaFrecuencia` ENUM('0','1','2','3') NOT NULL DEFAULT '0' ,  ADD `beber` ENUM('Si','No') NOT NULL DEFAULT 'No' ,  ADD `beberFrecuencia` ENUM('0','1','2','3') NOT NULL DEFAULT '0' ,  ADD `desagradables` TEXT NOT NULL ,  ADD `ansiedad` ENUM('Si','No') NOT NULL DEFAULT 'No';

ALTER TABLE `hojaclinica` CHANGE `alergia` `alergia` ENUM('Si','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'No'; 

ALTER TABLE `hojaclinica`  ADD `actividadFisica` ENUM('Si','No') NOT NULL DEFAULT 'No' ,  ADD `actividad` VARCHAR(100) NOT NULL ,  ADD `tiempo` INT(2) NOT NULL DEFAULT '0' ,  ADD `actividadFisicaFrecuencia` ENUM('0','1','2','3') NOT NULL DEFAULT '0' ,  ADD `motivacion` INT(2) NOT NULL ,  ADD `horarioLevantarse` VARCHAR(10) NOT NULL ,  ADD `horarioAcostarse` VARCHAR(10) NOT NULL ,  ADD `horarioActividad` VARCHAR(10) NOT NULL ,  ADD `desayuno` ENUM('Si','No') NOT NULL DEFAULT 'No' ,  ADD `horarioDesayuno` VARCHAR(10) NOT NULL ,  ADD `actividadDesayuno` TEXT NOT NULL ,  ADD `colacion` ENUM('Si','No') NOT NULL DEFAULT 'No' ,  ADD `horarioColacion` VARCHAR(10) NOT NULL ,  ADD `actividadColacion` TEXT NOT NULL ,  ADD `comida` ENUM('Si','No') NOT NULL DEFAULT 'No'  ,  ADD `horarioComida` VARCHAR(10) NOT NULL ,  ADD `actividadComida` TEXT NOT NULL ,  ADD `colacion2` ENUM('Si','No') NOT NULL DEFAULT 'No' ,  ADD `horarioColacion2` VARCHAR(10) NOT NULL ,  ADD `actividadColacion2` TEXT NOT NULL;

ALTER TABLE `hojaclinica` ADD `cena` ENUM('Si','No') NOT NULL DEFAULT 'No' , ADD `horarioCena` VARCHAR(10) NOT NULL , ADD `actividadCena` TEXT NOT NULL ; 

ALTER TABLE `hojaclinica` ADD `completitud` DOUBLE NOT NULL DEFAULT '0' ; 

ALTER TABLE `paciente` CHANGE `telefonoCasa` `telefonoCasa` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL; 