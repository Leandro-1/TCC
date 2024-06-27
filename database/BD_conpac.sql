CREATE DATABASE conpac;
USE conpac;

CREATE TABLE `usuario` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `login` varchar(80) NOT NULL,
  `senha` varchar(80) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `privilegio` varchar(80) NOT NULL,
  PRIMARY KEY (`id_user`)
) ;

CREATE TABLE `propriedade` (
  `id_propriedade` int NOT NULL AUTO_INCREMENT,
  `num_propriedade` int NOT NULL,
  `bloco_quadra` varchar(50) NOT NULL,
  PRIMARY KEY (`id_propriedade`)
) ;

CREATE TABLE `morador` (
  `cpf` int NOT NULL,
  `nome` varchar(80) NOT NULL,
  `telefone` varchar(17) NOT NULL,
  `email` varchar(80) NOT NULL,
  `id_propriedade` int NOT NULL,
  PRIMARY KEY (`cpf`),
  KEY `idx_nome` (`nome`),
  KEY `fk_propriedade` (`id_propriedade`),
  CONSTRAINT `fk_propriedade` FOREIGN KEY (`id_propriedade`) REFERENCES `propriedade` (`id_propriedade`)
) ;

CREATE TABLE `entrega` (
  `id_entrega` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(80) NOT NULL,
  `data_recebimento` date NOT NULL,
  `data_retirada` date DEFAULT NULL,
  `nome_morador` varchar(80) NOT NULL,
  `status` varchar(8) NOT NULL,
  `id_residencia` int NOT NULL,
  `remetente` varchar(200) DEFAULT NULL,
  `retirado_por` varchar(80) DEFAULT NULL,
  `recebido_por` varchar(80) DEFAULT NULL,
  `num_registro` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_entrega`),
  KEY `fk_morador_entrega` (`nome_morador`),
  KEY `fk_residencia_entrega` (`id_residencia`),
  CONSTRAINT `fk_morador_entrega` FOREIGN KEY (`nome_morador`) REFERENCES `morador` (`nome`),
  CONSTRAINT `fk_residencia_entrega` FOREIGN KEY (`id_residencia`) REFERENCES `propriedade` (`id_propriedade`)
) ;





