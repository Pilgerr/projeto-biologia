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

DROP TABLE IF EXISTS `SERES_VIVOS`;
CREATE TABLE `SERES_VIVOS` (
                            `ID` int(11) NOT NULL AUTO_INCREMENT,
                            `IMAGEM` varchar(255) NULL,
                            `NOME_POPULAR` varchar(255) NOT NULL,
                            `NOME_CIENTIFICO` varchar(255) NOT NULL,
                            `DESCRICAO_ESPECIE` varchar(255) NULL,
                            `REINO` varchar(255) NOT NULL,
                            `TERRITORIO` varchar(255) NOT NULL,
                            `OBSERVACOES` text NULL,
                            `REGISTRO_LOCALIZACAO` text NULL,
                            `REGISTRO_COLECAO_IF_SUL` text NULL,
                            `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
                            `UPDATED_AT` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                            PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO SERES_VIVOS (IMAGEM, NOME_POPULAR, NOME_CIENTIFICO, DESCRICAO_ESPECIE, REINO, TERRITORIO, OBSERVACOES, REGISTRO_LOCALIZACAO, REGISTRO_COLECAO_IF_SUL) VALUES 
('https://i.im.ge/2023/12/13/EEy0rX.agaricus-bisporus.jpg', 'Cogumelo Comestível', 'Agaricus bisporus', 'Espécie de cogumelo comestível', 'fungi', 'Floresta', 'Encontrado em troncos em decomposição', 'Latitude: xx.xxxxx, Longitude: yy.yyyyy', 'Registro 12345'),
('https://i.im.ge/2023/12/13/EEyhV9.grande-felino.png', 'Leão', 'Panthera leo', 'Grande felino', 'animal', 'Savana', 'Predador de topo', 'Latitude: zz.zzzzz, Longitude: ww.wwwww', 'Registro 67890'),
('https://i.im.ge/2023/12/13/EEyU6K.rosa-spp.jpg', 'Rosa', 'Rosa spp.', 'Planta ornamental', 'vegetal', 'Jardim', 'Flores utilizadas em arranjos', 'Latitude: aa.aaaaa, Longitude: bb.bbbbb', 'Registro 54321'),
('https://i.im.ge/2023/12/13/EEyLSF.amoeba-proteus.jpg', 'Amiba', 'Amoeba proteus', 'Protozoário unicelular', 'protista', 'Ambiente aquático', 'Movimento por pseudópodes', 'Latitude: cc.ccccc, Longitude: dd.ddddd', 'Registro 13579'),
('https://i.im.ge/2023/12/13/EEyDv6.escherichia-coli.jpg', 'Bactéria E. coli', 'Escherichia coli', 'Bactéria comumente encontrada no intestino', 'monera', 'Trato digestivo', 'Importante para a digestão', 'Não aplicável', 'Registro 24680');
