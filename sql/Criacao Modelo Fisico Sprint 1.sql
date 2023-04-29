-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/04/2023 às 17:15
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdwheymarket`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `email` varchar(140) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administrador`
--

INSERT INTO `administrador` (`id`, `email`, `senha`) VALUES
(1, 'admin@admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_tipo`
--

CREATE TABLE `cadastro_tipo` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro_tipo`
--

INSERT INTO `cadastro_tipo` (`ID`, `Nome`) VALUES
(1, 'Lojista'),
(2, 'Consumidor'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_produto`
--

CREATE TABLE `categoria_produto` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria_produto`
--

INSERT INTO `categoria_produto` (`ID`, `Nome`) VALUES
(1, 'Termogênicos'),
(2, 'Aminoácidos'),
(3, 'Acessórios');

-- --------------------------------------------------------

--
-- Estrutura para tabela `consumidor`
--

CREATE TABLE `consumidor` (
  `id` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `CPF` varchar(20) NOT NULL,
  `senha` char(32) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `consumidor`
--

INSERT INTO `consumidor` (`id`, `Nome`, `CPF`, `senha`, `email`) VALUES
(1, 'usuario teste', '00397898965', '81dc9bdb52d04dc20036dbd8313ed055', 'novo@usuario.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lojista`
--

CREATE TABLE `lojista` (
  `ID` int(11) NOT NULL,
  `CNPJ` char(14) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `senha` char(32) DEFAULT NULL,
  `fk_Cadastro_Tipo_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lojista`
--

INSERT INTO `lojista` (`ID`, `CNPJ`, `email`, `Nome`, `senha`, `fk_Cadastro_Tipo_ID`) VALUES
(1, '15625548000147', 'fernando@gmail.com', 'Fernando Souza', 'aa1bf4646de67fd9086cf6c79007026c', 1),
(2, '85425548000102', 'flavia@gmail.com', 'Flavia lopes', 'aa1bf4646de67fd9086cf6c79007026c', 1),
(3, '65487458000165', 'maria@gmail.com', 'Maria oliveira', 'aa1bf4646de67fd9086cf6c79007026c', 1),
(4, '15632236000178', 'pedro@gmail.com', 'Pedro alcantara', 'aa1bf4646de67fd9086cf6c79007026c', 1),
(5, '8915753000157', 'julio@gmail.com', 'Julio lins', 'aa1bf4646de67fd9086cf6c79007026c', 1),
(10, '12345678901234', 'eduardo@moura.com', 'Loja CSGO', 'aa1bf4646de67fd9086cf6c79007026c', 1),
(19, '12345634523414', 'nova@loja.com', 'Loja teste', '81dc9bdb52d04dc20036dbd8313ed055', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `SKU` char(5) NOT NULL,
  `fk_Lojista_ID` int(11) NOT NULL,
  `fk_Categoria_Produto_ID` int(11) DEFAULT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Preco` float DEFAULT NULL,
  `Quantidade` int(11) DEFAULT NULL,
  `Peso` float DEFAULT NULL,
  `Foto` blob DEFAULT NULL,
  `Descricao` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`SKU`, `fk_Lojista_ID`, `fk_Categoria_Produto_ID`, `Nome`, `Preco`, `Quantidade`, `Peso`, `Foto`, `Descricao`) VALUES
('25fa', 1, 2, 'Creatina', 150, 85, 500, NULL, NULL),
('38fd', 2, 2, 'Glutamina', 75, 50, 250, NULL, NULL),
('df10', 3, 1, 'Cafeína em Pó', 50, 100, 80, NULL, NULL),
('e23f', 4, 3, 'Coqueteleira', 70, 150, NULL, NULL, NULL),
('85d63', 5, 3, 'Strep', 30, 200, NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cadastro_tipo`
--
ALTER TABLE `cadastro_tipo`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `categoria_produto`
--
ALTER TABLE `categoria_produto`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `consumidor`
--
ALTER TABLE `consumidor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lojista`
--
ALTER TABLE `lojista`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CNPJ` (`CNPJ`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_Lojista_2` (`fk_Cadastro_Tipo_ID`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`fk_Lojista_ID`,`SKU`),
  ADD KEY `FK_Produto_2` (`fk_Categoria_Produto_ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cadastro_tipo`
--
ALTER TABLE `cadastro_tipo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `categoria_produto`
--
ALTER TABLE `categoria_produto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `consumidor`
--
ALTER TABLE `consumidor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `lojista`
--
ALTER TABLE `lojista`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `lojista`
--
ALTER TABLE `lojista`
  ADD CONSTRAINT `FK_Lojista_2` FOREIGN KEY (`fk_Cadastro_Tipo_ID`) REFERENCES `cadastro_tipo` (`ID`) ON DELETE CASCADE;

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `FK_Produto_2` FOREIGN KEY (`fk_Categoria_Produto_ID`) REFERENCES `categoria_produto` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Produto_3` FOREIGN KEY (`fk_Lojista_ID`) REFERENCES `lojista` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
