ALTER TABLE `sucursal` ADD `enviarSMS` BOOLEAN NOT NULL DEFAULT FALSE AFTER `idFranquicia`, ADD `enviarRecordatorio` BOOLEAN NOT NULL DEFAULT FALSE AFTER `enviarSMS`; 
ALTER TABLE `sucursal` CHANGE `enviarRecordatorio` `enviarRecordatorio` ENUM('Si','No') NOT NULL DEFAULT 'No'; 
ALTER TABLE `sucursal` CHANGE enviarSMS enviarSMS ENUM('Si','No') NOT NULL DEFAULT 'No'; 
