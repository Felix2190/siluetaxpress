ALTER TABLE `cita` ADD `fechaRegistroCita` DATE NOT NULL ; 

CREATE TABLE IF NOT EXISTS `estatuscita` (
  `estatusCita` varchar(30) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`estatusCita`),
  UNIQUE KEY `estatusCita` (`estatusCita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `estatuscita` (`estatusCita`, `descripcion`) VALUES ('nueva', 'Nueva'), ('realizada', 'Realizada'), ('cancelada_usuario', 'Cancelada por el usuario'), ('cancelada_encargado', 'Cancelada por el encargado'), ('curso', 'En curso');

ALTER TABLE `cita` CHANGE `estatus` `estatus` VARCHAR(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL; 
ALTER TABLE `cita` ADD INDEX(`estatus`);
ALTER TABLE `cita` ADD FOREIGN KEY (`estatus`) REFERENCES `estatuscita`(`estatusCita`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

ALTER TABLE `cita` ADD `enviarRecordatorio2` TINYINT NOT NULL DEFAULT '1' ; 
ALTER TABLE `cita` ADD `idUsuarioCancela` INT NOT NULL DEFAULT '0', ADD INDEX (`idUsuarioCancela`) ; 