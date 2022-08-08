DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (`id_cliente` INT NOT NULL AUTO_INCREMENT , 
                                        `nombre_cliente` VARCHAR(128) NOT NULL , 
                                        `email` VARCHAR(128) NOT NULL , 
                                        PRIMARY KEY (`id_cliente`));

DROP TABLE IF EXISTS `pociones`;

CREATE TABLE `pociones` (`id_pocion` INT NOT NULL AUTO_INCREMENT , 
                        `nombre_pocion` VARCHAR(128) NOT NULL , 
                        PRIMARY KEY (`id_pocion`));

DROP TABLE IF EXISTS `ventas`;                       

CREATE TABLE `ventas` (`id_cliente` INT NOT NULL , 
                      `id_pocion` INT NOT NULL , 
                      `cantidad` INT NOT NULL , 
                      `fecha` DATETIME NOT NULL , 
                      PRIMARY KEY (`id_cliente`, `id_pocion`));

ALTER TABLE `ventas` ADD CONSTRAINT `fk_cliente_venta` FOREIGN KEY (`id_cliente`) REFERENCES `clientes`(`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE; 

ALTER TABLE `ventas` ADD CONSTRAINT `fk_pocion_venta` FOREIGN KEY (`id_pocion`) REFERENCES `pociones`(`id_pocion`) ON DELETE CASCADE ON UPDATE CASCADE;

DROP TABLE IF EXISTS `ingredientes`;  

CREATE TABLE `api_pociones`.`ingredientes` (`id_ingrediente` INT NOT NULL AUTO_INCREMENT , 
                                            `nombre_ingrediente` VARCHAR(128) NOT NULL , 
                                            `precio_unidad` DECIMAL(10,2) NOT NULL , 
                                            PRIMARY KEY (`id_ingrediente`));

DROP TABLE IF EXISTS `pociones_ingredientes`;

CREATE TABLE `api_pociones`.`pociones_ingredientes` (`id_pocion` INT NOT NULL , 
                                                    `id_ingrediente` INT NOT NULL , 
                                                    `cantidad` DECIMAL(10,2) NOT NULL , 
                                                    PRIMARY KEY (`id_pocion`, `id_ingrediente`));

ALTER TABLE `pociones_ingredientes` ADD CONSTRAINT `fk_id_pocion` FOREIGN KEY (`id_pocion`) REFERENCES `pociones`(`id_pocion`) ON DELETE CASCADE ON UPDATE CASCADE; 
ALTER TABLE `pociones_ingredientes` ADD CONSTRAINT `fk_id_ingrediente` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingredientes`(`id_ingrediente`) ON DELETE CASCADE ON UPDATE CASCADE;


