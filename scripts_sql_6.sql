ALTER TABLE `paciente` ADD `llenado` ENUM('Completo','Minimo') NOT NULL DEFAULT 'Completo' , ADD `estatus` ENUM('activo','suspendido') NOT NULL DEFAULT 'activo' ; 
