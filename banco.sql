-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/02/2024 às 05:20
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `assistencia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `contato` varchar(255) NOT NULL,
  `data_criado` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `senha`, `contato`, `data_criado`, `data_atualizado`) VALUES
(1, 'Maria Elziane Melo da Silva', 'maria@gmail.com', '$2y$10$jfyxoxmibbtPOjaYJOGUn.XTgEZCZ19yEHc7pAgR9ntY2Xk7pXdk6', '21974955544', '2024-02-07 02:14:44', '2024-02-07 02:16:00'),
(2, 'Maria Isabel Melo da Silva', 'mariaisabel@gmail.com', '$2y$10$5tPr7EjFiN1gZyENjgdmaOfNmZf2xWq3OIdcmX50J33YPxD3oGwL6', '21970854952', '2024-02-07 02:15:32', '2024-02-07 02:15:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes_dispositivos`
--

CREATE TABLE `clientes_dispositivos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `dispositivo` varchar(255) NOT NULL,
  `data_criado` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes_dispositivos`
--

INSERT INTO `clientes_dispositivos` (`id`, `cliente_id`, `marca`, `modelo`, `dispositivo`, `data_criado`, `data_atualizado`) VALUES
(1, 1, 'Motorola', 'G23', 'Celular', '2024-02-07 02:57:07', '2024-02-07 02:57:07');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes_orçamentos`
--

CREATE TABLE `clientes_orçamentos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `dispositivo_id` int(11) NOT NULL,
  `servico_id` int(11) NOT NULL,
  `orçamento` text NOT NULL,
  `data_criado` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes_orçamentos`
--

INSERT INTO `clientes_orçamentos` (`id`, `cliente_id`, `dispositivo_id`, `servico_id`, `orçamento`, `data_criado`, `data_atualizado`) VALUES
(1, 1, 1, 2, '150', '2024-02-07 03:04:34', '2024-02-07 03:04:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes_serviços`
--

CREATE TABLE `clientes_serviços` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `dispositivo_id` int(11) NOT NULL,
  `serviço` varchar(255) NOT NULL,
  `data_criado` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dispositivo_preço`
--

CREATE TABLE `dispositivo_preço` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_criado` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dispositivo_preço`
--

INSERT INTO `dispositivo_preço` (`id`, `nome`, `marca`, `modelo`, `tipo`, `valor`, `data_criado`, `data_atualizado`) VALUES
(1, 'G23', 'MOTOROLA', 'G23', 'Tela', 120.00, '2024-02-07 02:32:38', '2024-02-07 02:32:38');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_criado` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id`, `nome`, `descricao`, `valor`, `data_criado`, `data_atualizado`) VALUES
(1, 'Troca de Tela', 'Serviços de Troca de Tela', 100.00, '2024-02-07 02:20:06', '2024-02-07 02:20:06'),
(2, 'Troca de Bateria', 'Troca', 50.00, '2024-02-07 02:22:27', '2024-02-07 02:22:27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_criado` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_criado`, `data_atualizado`) VALUES
(1, 'Carlos André da Silva Farias', 'carlostmj2019@gmail.com', '$2y$10$BxDCYEHDeDqJQ7XiZtihkuq4nDd3S6nOwu96o5euFOdpOZucI6A4m', '2024-02-07 01:50:21', '2024-02-07 01:50:21');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `clientes_dispositivos`
--
ALTER TABLE `clientes_dispositivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_dispositivo` (`cliente_id`);

--
-- Índices de tabela `clientes_orçamentos`
--
ALTER TABLE `clientes_orçamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_orçamento` (`cliente_id`);

--
-- Índices de tabela `clientes_serviços`
--
ALTER TABLE `clientes_serviços`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_serviço` (`cliente_id`);

--
-- Índices de tabela `dispositivo_preço`
--
ALTER TABLE `dispositivo_preço`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `clientes_dispositivos`
--
ALTER TABLE `clientes_dispositivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `clientes_orçamentos`
--
ALTER TABLE `clientes_orçamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `clientes_serviços`
--
ALTER TABLE `clientes_serviços`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dispositivo_preço`
--
ALTER TABLE `dispositivo_preço`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `clientes_dispositivos`
--
ALTER TABLE `clientes_dispositivos`
  ADD CONSTRAINT `fk_cliente_dispositivo` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `clientes_orçamentos`
--
ALTER TABLE `clientes_orçamentos`
  ADD CONSTRAINT `fk_cliente_orçamento` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `clientes_serviços`
--
ALTER TABLE `clientes_serviços`
  ADD CONSTRAINT `fk_cliente_serviço` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
