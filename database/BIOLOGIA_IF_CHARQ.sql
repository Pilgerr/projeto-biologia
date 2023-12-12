CREATE DATABASE  IF NOT EXISTS `BIOLOGIA_IF_CHARQ`;
USE `BIOLOGIA_IF_CHARQ`;

DROP TABLE IF EXISTS `USUARIOS`;
CREATE TABLE `USUARIOS` (
                         `ID` int(11) NOT NULL AUTO_INCREMENT,
                         `EMAIL` varchar(45) NOT NULL,
                         `NOME` varchar(45) NOT NULL,
                         `TELEFONE` char(19) NULL,
                         `SENHA` varchar(255) NOT NULL,
                         `CPF` char(14) NOT NULL,
                         `ADM` varchar(5) NOT NULL,
                         `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
                         `UPDATED_AT` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                         PRIMARY KEY (`ID`),
                         UNIQUE KEY `EMAIL_UNIQUE` (`EMAIL`),
                         UNIQUE KEY `CPF_UNIQUE` (`CPF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `addresses`;
-- CREATE TABLE `addresses` (
--                              `id` int(11) NOT NULL AUTO_INCREMENT,
--                              `street` varchar(45) NOT NULL,
--                              `number` int(11) NOT NULL,
--                              `complement` varchar(45) NOT NULL,
--                              `city` varchar(45) NOT NULL,
--                              `state` char(2) NOT NULL,
--                              `zipCode` varchar(45) NOT NULL,
--                              `idUser` int(11) NOT NULL,
--                              `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
--                              `udated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
--                              PRIMARY KEY SERES_VIVOS(`id`),
--                              KEY `fk_addresses_users_idx` (`idUser`),
--                              CONSTRAINT `fk_addresses_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `SERES_VIVOS`;
CREATE TABLE `SERES_VIVOS` (
                            `ID` int(11) NOT NULL AUTO_INCREMENT,
                            `IMAGEM` varchar(255) NULL,
                            `NOME_POPULAR` varchar(255) NOT NULL,
                            `NOME_CIENTIFICO` varchar(255) NOT NULL,
                            `DESCRICAO_ESPECIE` varchar(255) NULL,
                            `REINO` char(1) NOT NULL,
                            `TERRITORIO` varchar(255) NOT NULL,
                            `OBSERVACOES` text NULL,
                            `REGISTRO_LOCALIZACAO` text NULL,
                            `REGISTRO_COLECAO_IF_SUL` text NULL,
                            `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
                            `UPDATED_AT` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                            PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;