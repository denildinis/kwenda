-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Jan-2026 às 09:23
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
-- Banco de dados: `kwenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agencias`
--

CREATE TABLE `agencias` (
  `id` int(11) NOT NULL,
  `banco_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `agencias`
--

INSERT INTO `agencias` (`id`, `banco_id`, `nome`, `endereco_id`, `created_at`) VALUES
(1, 38, 'ff', 1, '2026-01-05 00:49:42'),
(2, 38, 'w', 2, '2026-01-05 00:52:38'),
(3, 38, 'w', 3, '2026-01-05 00:53:29'),
(4, 38, 'hj', 4, '2026-01-05 18:33:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `banco_id` int(11) NOT NULL,
  `agencia_id` int(11) NOT NULL,
  `servico_id` int(11) NOT NULL,
  `data_agendamento` date NOT NULL,
  `senha` varchar(10) NOT NULL,
  `status` enum('pendente','atendido','cancelado') DEFAULT 'pendente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `cliente_id`, `banco_id`, `agencia_id`, `servico_id`, `data_agendamento`, `senha`, `status`, `created_at`) VALUES
(1, 1, 38, 1, 1, '2026-01-07', '0431F0', 'pendente', '2026-01-06 01:02:40'),
(2, 2, 38, 1, 8, '2026-01-07', 'F7B92D', 'pendente', '2026-01-06 07:34:55'),
(3, 3, 38, 1, 1, '2026-01-07', '49600E', 'pendente', '2026-01-06 07:38:44'),
(4, 4, 38, 4, 8, '2026-01-07', 'A939F5', 'pendente', '2026-01-06 07:46:34'),
(5, 5, 38, 1, 1, '2026-01-07', 'BAE0E0', 'pendente', '2026-01-06 07:55:07'),
(6, 6, 38, 4, 8, '2026-01-07', 'EE11B3', 'pendente', '2026-01-06 07:59:10'),
(7, 7, 38, 1, 8, '2026-01-07', '24AE32', 'pendente', '2026-01-06 08:29:38'),
(8, 8, 38, 1, 8, '2026-01-07', 'BE2D66', 'pendente', '2026-01-06 08:44:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bancos`
--

CREATE TABLE `bancos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sigla` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT 'default-bank.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `bancos`
--

INSERT INTO `bancos` (`id`, `nome`, `sigla`, `email`, `logo`, `created_at`) VALUES
(38, 'Banco Angolano de Investimentos S.A.', 'BAI', 'contacto@bai.co.ao', '69597e59f0e62.png', '2026-01-03 20:38:49'),
(40, 'azaaaaa', 'aaaaaaa', 'aaaaaa@dd.yee', 'placeholder.png', '2026-01-06 10:06:59'),
(41, 'sssss', 'ssss', 'aauuua@cahhau.a', 'placeholder.png', '2026-01-06 10:21:26'),
(42, 'addrr', 'efghaugva', 'auvadda@gsyu.co', 'placeholder.png', '2026-01-06 10:21:58'),
(43, 'aefr3', 'aqqqqw', 'augadfauhai@cgaiia.apa', 'placeholder.png', '2026-01-06 10:22:30'),
(44, 'sol', 'sajjaa', 'sol@aaaa.d', 'placeholder.png', '2026-01-09 08:20:00'),
(45, 'wtwrtwt7w', 'w888ttw', 'wugwyuy@iid.c', 'placeholder.png', '2026-01-09 08:20:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `created_at`) VALUES
(1, 'eee', '2026-01-06 01:02:40'),
(2, 'assss', '2026-01-06 07:34:55'),
(3, 'fghj', '2026-01-06 07:38:44'),
(4, 'ggggggggg', '2026-01-06 07:46:34'),
(5, 'sdad', '2026-01-06 07:55:07'),
(6, 'adss', '2026-01-06 07:59:10'),
(7, 'ddddddddr', '2026-01-06 08:29:38'),
(8, 'oi', '2026-01-06 08:44:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `provincia`, `municipio`, `bairro`, `rua`) VALUES
(1, 'Bengo', 'eee', 'fff', 'eee'),
(2, 'Bengo', 'w', 'www', 'wwwww'),
(3, 'Bié', 'w', 'w', 'wwqw'),
(4, 'Bié', 'l', 'rd', 'aggg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `banco_id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id`, `banco_id`, `codigo`, `nome`) VALUES
(1, 38, 'a', 'aaaaa'),
(2, 38, 'w', 'wwwwww'),
(3, 38, 'ww', 'wwww'),
(4, 38, 'www', 'ww'),
(5, 38, 'q', 'qq'),
(6, 38, 'qqqq', 'qqqqq'),
(7, 38, 'w3', 'w'),
(8, 38, '22', '222'),
(9, 38, 'wwwwwwwww3333', 'wwww444'),
(10, 38, 'fg', 'kkavcs'),
(11, 38, 'vvvv', 'zxiiiiiiic'),
(12, 38, 'rerr', 'f');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `role` enum('admin','banco') NOT NULL,
  `banco_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `role`, `banco_id`, `created_at`) VALUES
(27, 'contacto@bai.co.ao', '$2y$10$ZxUBAsUQvrCSkDnyIl94h.9A98RFGR5TL6Heoa5DrpwR6eMXWwN1O', 'banco', 38, '2026-01-03 20:38:50'),
(28, 'admin@co.ao', '$2y$10$Af.QnBDuw0fQsoJ8i5QAueQ3F3mnIkZM9h/a7337ax.Vd.5eFd1Q6', 'admin', NULL, '2026-01-04 21:00:51'),
(32, 'aaaaaa@dd.yee', '$2y$10$rh/b8O7c5PXIM1u0omt4ueBfQjh08C.uRxA0lmIAvHHHSk6NK2vXu', 'banco', 40, '2026-01-06 10:06:59'),
(33, 'aauuua@cahhau.a', '$2y$10$3sFaELpjXTYpfKJ3luEHy.TuK37JDVRsaAxUQpA1Pqflz28F/rGfO', 'banco', 41, '2026-01-06 10:21:27'),
(34, 'auvadda@gsyu.co', '$2y$10$ymgFWlr3ZLexd1qYIZ.88ePfVJqBSCl0T.oUH1LelyS0KtH7RlHnu', 'banco', 42, '2026-01-06 10:21:58'),
(35, 'augadfauhai@cgaiia.apa', '$2y$10$cqfiH61LcZdpn7ylKfdavuoIj/W3sjklGZbNsSUU8baB5IJUr1ccS', 'banco', 43, '2026-01-06 10:22:30'),
(36, 'sol@aaaa.d', '$2y$10$lTDc3N9N6nwDLgLMw67Qeuli.MEErGMt/GlCNQiUmWVV1aDYFlAYu', 'banco', 44, '2026-01-09 08:20:00'),
(37, 'wugwyuy@iid.c', '$2y$10$EFtK/3bHNKKnOV3dMpxy5u8U.sDM5vIjGr86ji4ElIOoiLyuwrvmm', 'banco', 45, '2026-01-09 08:20:38');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agencias`
--
ALTER TABLE `agencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_id` (`banco_id`),
  ADD KEY `endereco_id` (`endereco_id`);

--
-- Índices para tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `banco_id` (`banco_id`),
  ADD KEY `agencia_id` (`agencia_id`),
  ADD KEY `servico_id` (`servico_id`);

--
-- Índices para tabela `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sigla` (`sigla`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_codigo` (`codigo`),
  ADD KEY `banco_id` (`banco_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuario_banco` (`banco_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agencias`
--
ALTER TABLE `agencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agencias`
--
ALTER TABLE `agencias`
  ADD CONSTRAINT `agencias_ibfk_1` FOREIGN KEY (`banco_id`) REFERENCES `bancos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agencias_ibfk_2` FOREIGN KEY (`endereco_id`) REFERENCES `enderecos` (`id`);

--
-- Limitadores para a tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `agendamentos_ibfk_2` FOREIGN KEY (`banco_id`) REFERENCES `bancos` (`id`),
  ADD CONSTRAINT `agendamentos_ibfk_3` FOREIGN KEY (`agencia_id`) REFERENCES `agencias` (`id`),
  ADD CONSTRAINT `agendamentos_ibfk_4` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`);

--
-- Limitadores para a tabela `servicos`
--
ALTER TABLE `servicos`
  ADD CONSTRAINT `servicos_ibfk_1` FOREIGN KEY (`banco_id`) REFERENCES `bancos` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_banco` FOREIGN KEY (`banco_id`) REFERENCES `bancos` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
