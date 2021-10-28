-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Out-2021 às 14:24
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crud-container`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `container`
--

CREATE TABLE `container` (
  `id_container` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `numero_container` varchar(255) NOT NULL,
  `tipo` int(2) NOT NULL,
  `status` char(5) NOT NULL,
  `categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `container`
--

INSERT INTO `container` (`id_container`, `cliente`, `numero_container`, `tipo`, `status`, `categoria`) VALUES
(26, 'Usina Nuclear', 'GHNH5205252', 20, 'Cheio', 'Importação'),
(27, 'Usina Nuclear', 'FGDS4324201', 20, 'Cheio', 'Exportação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacao`
--

CREATE TABLE `movimentacao` (
  `id_movimentacao` int(11) NOT NULL,
  `tipo_movimentacao` varchar(255) NOT NULL,
  `data_inicio` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `data_fim` date NOT NULL,
  `hora_fim` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `container`
--
ALTER TABLE `container`
  ADD PRIMARY KEY (`id_container`);

--
-- Índices para tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`id_movimentacao`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `container`
--
ALTER TABLE `container`
  MODIFY `id_container` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `id_movimentacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
