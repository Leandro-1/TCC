-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 25-Out-2024 às 17:37
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `conpac`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrega`
--

CREATE TABLE `entrega` (
  `id_entrega` int(11) NOT NULL,
  `tipo` enum('carta','e-commerce','sedex') NOT NULL,
  `data_recebimento` datetime NOT NULL,
  `data_retirada` datetime DEFAULT NULL,
  `nome_destinatario` varchar(80) NOT NULL,
  `status` enum('a retirar','entregue') NOT NULL DEFAULT 'a retirar',
  `id_residencia` int(11) NOT NULL,
  `remetente` varchar(200) DEFAULT NULL,
  `retirado_por` varchar(80) DEFAULT NULL,
  `recebido_por` varchar(80) DEFAULT NULL,
  `num_registro` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `entrega`
--

INSERT INTO `entrega` (`id_entrega`, `tipo`, `data_recebimento`, `data_retirada`, `nome_destinatario`, `status`, `id_residencia`, `remetente`, `retirado_por`, `recebido_por`, `num_registro`) VALUES
(179, 'e-commerce', '2024-10-24 09:38:44', '2024-10-24 14:39:49', 'Jessie', 'entregue', 1, '', 'Joao', 'Jessie Neire', ''),
(180, 'e-commerce', '2024-10-24 09:39:55', NULL, 'lucca', 'a retirar', 1, '', NULL, 'Jessie Neire', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `morador`
--

CREATE TABLE `morador` (
  `cpf` bigint(20) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `telefone` varchar(17) NOT NULL,
  `email` varchar(80) NOT NULL,
  `id_propriedade` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `morador`
--

INSERT INTO `morador` (`cpf`, `nome`, `telefone`, `email`, `id_propriedade`, `id_usuario`) VALUES
(11111111111, 'Jessie Neire da Silva Santos', '11930772985', 'jessie.neire@gmail.com', 1, 29);

--
-- Acionadores `morador`
--
DELIMITER $$
CREATE TRIGGER `excluir_login_morador` AFTER DELETE ON `morador` FOR EACH ROW begin
delete from usuario where login = old.email;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `propriedade`
--

CREATE TABLE `propriedade` (
  `id_propriedade` int(11) NOT NULL,
  `num_propriedade` int(11) NOT NULL,
  `bloco_quadra` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `propriedade`
--

INSERT INTO `propriedade` (`id_propriedade`, `num_propriedade`, `bloco_quadra`) VALUES
(1, 125, 'A'),
(2, 254, 'B');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL,
  `login` varchar(80) NOT NULL,
  `senha` varchar(80) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `privilegio` enum('administrador','operador','morador') DEFAULT NULL,
  `primeiro_acesso` tinyint(1) DEFAULT 1,
  `token` varchar(255) DEFAULT NULL,
  `expirar_token` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_user`, `login`, `senha`, `nome`, `privilegio`, `primeiro_acesso`, `token`, `expirar_token`) VALUES
(7, 'jessie@j', '1', 'Jessie Neire', 'administrador', 0, NULL, NULL),
(8, 'jessie@f', '123', 'Flavio Santos', 'operador', 1, NULL, NULL),
(29, 'jessie.neire@gmail.com', '123', 'Jessie Neire da Silva Santos', 'morador', 1, '64a5a9', '2024-10-24 16:13:49');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`id_entrega`),
  ADD KEY `fk_residencia_entrega` (`id_residencia`);

--
-- Índices para tabela `morador`
--
ALTER TABLE `morador`
  ADD PRIMARY KEY (`cpf`),
  ADD UNIQUE KEY `UK_email` (`email`),
  ADD UNIQUE KEY `UK_tel_propriedade` (`telefone`,`id_propriedade`),
  ADD KEY `fk_propriedade` (`id_propriedade`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- Índices para tabela `propriedade`
--
ALTER TABLE `propriedade`
  ADD PRIMARY KEY (`id_propriedade`),
  ADD UNIQUE KEY `UK_num_apart_bloco` (`num_propriedade`,`bloco_quadra`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `UK_login` (`login`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `entrega`
--
ALTER TABLE `entrega`
  MODIFY `id_entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT de tabela `propriedade`
--
ALTER TABLE `propriedade`
  MODIFY `id_propriedade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `entrega`
--
ALTER TABLE `entrega`
  ADD CONSTRAINT `fk_residencia_entrega` FOREIGN KEY (`id_residencia`) REFERENCES `propriedade` (`id_propriedade`);

--
-- Limitadores para a tabela `morador`
--
ALTER TABLE `morador`
  ADD CONSTRAINT `fk_propriedade` FOREIGN KEY (`id_propriedade`) REFERENCES `propriedade` (`id_propriedade`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
