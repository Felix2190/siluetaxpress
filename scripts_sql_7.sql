ALTER TABLE `cita` ADD `fechaEnvioSMS` DATETIME NULL AFTER `fechaRegistroCita`, ADD `enviarRecordatorio1` BOOLEAN NOT NULL DEFAULT FALSE AFTER `fechaEnvioSMS`; 

ALTER TABLE `hojaclinica` ADD `peso_habitual` DOUBLE NOT NULL DEFAULT '0' AFTER `actividadCena`, ADD `peso_ideal` DOUBLE NOT NULL DEFAULT '0' AFTER `peso_habitual`, ADD `observaciones` TEXT NOT NULL AFTER `peso_ideal`; 
