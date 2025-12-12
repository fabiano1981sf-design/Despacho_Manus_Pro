-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 12-Dez-2025 às 13:32
-- Versão do servidor: 5.7.24
-- versão do PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gerencia_atv2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ativos_ti`
--

CREATE TABLE `ativos_ti` (
  `id` int(11) NOT NULL,
  `nome_ativo` varchar(255) NOT NULL,
  `tipo` enum('Hardware','Software','Rede','Outro') NOT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `status` enum('Em Uso','Em Estoque','Manutenção','Desativado') NOT NULL DEFAULT 'Em Uso',
  `data_aquisicao` date DEFAULT NULL,
  `valor_compra` decimal(10,2) DEFAULT NULL,
  `observacoes` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome_razao` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `cnpj_cpf` varchar(20) NOT NULL,
  `tipo` enum('Pessoa Física','Pessoa Jurídica') NOT NULL DEFAULT 'Pessoa Física'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cofre_senhas`
--

CREATE TABLE `cofre_senhas` (
  `id` int(11) NOT NULL,
  `nome_credencial` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha_criptografada` text NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `observacoes` text,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `chave` varchar(100) NOT NULL,
  `valor` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_a_pagar`
--

CREATE TABLE `contas_a_pagar` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_vencimento` date NOT NULL,
  `status` enum('Pendente','Pago','Atrasado') NOT NULL DEFAULT 'Pendente',
  `plano_contas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_a_receber`
--

CREATE TABLE `contas_a_receber` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_vencimento` date NOT NULL,
  `status` enum('Pendente','Recebido','Atrasado') NOT NULL DEFAULT 'Pendente',
  `plano_contas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `despachos`
--

CREATE TABLE `despachos` (
  `id` int(11) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `mercadoria_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `status` enum('Pendente','Em Trânsito','Entregue','Cancelado') NOT NULL DEFAULT 'Pendente',
  `data_saida` date DEFAULT NULL,
  `data_entrega` date DEFAULT NULL,
  `transportadora_id` int(11) DEFAULT NULL,
  `observacoes` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos_validacao`
--

CREATE TABLE `documentos_validacao` (
  `id` int(11) NOT NULL,
  `nome_documento` varchar(255) NOT NULL,
  `caminho_arquivo` varchar(255) NOT NULL,
  `tipo_entidade` varchar(50) NOT NULL,
  `entidade_id` int(11) NOT NULL,
  `data_validade` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque_movimentacao`
--

CREATE TABLE `estoque_movimentacao` (
  `id` int(11) NOT NULL,
  `mercadoria_id` int(11) NOT NULL,
  `tipo` enum('entrada','saida') NOT NULL,
  `quantidade` int(11) NOT NULL,
  `observacao` text,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mercadorias`
--

CREATE TABLE `mercadorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `quantidade_estoque` int(11) NOT NULL DEFAULT '0',
  `preco_unitario` decimal(10,2) NOT NULL DEFAULT '0.00',
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `oportunidades`
--

CREATE TABLE `oportunidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `valor_estimado` decimal(10,2) DEFAULT NULL,
  `status` enum('Aberta','Qualificação','Proposta','Fechada Ganha','Fechada Perdida') NOT NULL DEFAULT 'Aberta',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_venda`
--

CREATE TABLE `pedidos_venda` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `numero_pedido` varchar(50) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `status` enum('Pendente','Aprovado','Faturado','Cancelado') NOT NULL DEFAULT 'Pendente',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano_contas`
--

CREATE TABLE `plano_contas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `tipo` enum('Receita','Despesa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `transportadoras`
--

CREATE TABLE `transportadoras` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `role` enum('admin','gerente','vendedor','operador') NOT NULL DEFAULT 'operador',
  `foto_perfil` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `senha_hash`, `role`, `foto_perfil`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'info@kld.com.br', '$2y$10$G4bjaqpChBa0U9vH1NXIfeD3vTUf.cbWlxEvTe8WeLdpR45uZg.ti', 'admin', NULL, '2025-12-11 20:08:21', '2025-12-12 10:01:54');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ativos_ti`
--
ALTER TABLE `ativos_ti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj_cpf` (`cnpj_cpf`);

--
-- Índices para tabela `cofre_senhas`
--
ALTER TABLE `cofre_senhas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`chave`);

--
-- Índices para tabela `contas_a_pagar`
--
ALTER TABLE `contas_a_pagar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plano_contas_id` (`plano_contas_id`);

--
-- Índices para tabela `contas_a_receber`
--
ALTER TABLE `contas_a_receber`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plano_contas_id` (`plano_contas_id`);

--
-- Índices para tabela `despachos`
--
ALTER TABLE `despachos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `mercadoria_id` (`mercadoria_id`),
  ADD KEY `transportadora_id` (`transportadora_id`);

--
-- Índices para tabela `documentos_validacao`
--
ALTER TABLE `documentos_validacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estoque_movimentacao`
--
ALTER TABLE `estoque_movimentacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mercadoria_id` (`mercadoria_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `mercadorias`
--
ALTER TABLE `mercadorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices para tabela `oportunidades`
--
ALTER TABLE `oportunidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices para tabela `pedidos_venda`
--
ALTER TABLE `pedidos_venda`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_pedido` (`numero_pedido`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices para tabela `plano_contas`
--
ALTER TABLE `plano_contas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Índices para tabela `transportadoras`
--
ALTER TABLE `transportadoras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ativos_ti`
--
ALTER TABLE `ativos_ti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cofre_senhas`
--
ALTER TABLE `cofre_senhas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contas_a_pagar`
--
ALTER TABLE `contas_a_pagar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contas_a_receber`
--
ALTER TABLE `contas_a_receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `despachos`
--
ALTER TABLE `despachos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `documentos_validacao`
--
ALTER TABLE `documentos_validacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estoque_movimentacao`
--
ALTER TABLE `estoque_movimentacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mercadorias`
--
ALTER TABLE `mercadorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `oportunidades`
--
ALTER TABLE `oportunidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos_venda`
--
ALTER TABLE `pedidos_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `plano_contas`
--
ALTER TABLE `plano_contas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `transportadoras`
--
ALTER TABLE `transportadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cofre_senhas`
--
ALTER TABLE `cofre_senhas`
  ADD CONSTRAINT `fk_cofre_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `contas_a_pagar`
--
ALTER TABLE `contas_a_pagar`
  ADD CONSTRAINT `fk_contas_pagar_plano` FOREIGN KEY (`plano_contas_id`) REFERENCES `plano_contas` (`id`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `contas_a_receber`
--
ALTER TABLE `contas_a_receber`
  ADD CONSTRAINT `fk_contas_receber_plano` FOREIGN KEY (`plano_contas_id`) REFERENCES `plano_contas` (`id`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `despachos`
--
ALTER TABLE `despachos`
  ADD CONSTRAINT `fk_despacho_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_despacho_mercadoria` FOREIGN KEY (`mercadoria_id`) REFERENCES `mercadorias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_despacho_transportadora` FOREIGN KEY (`transportadora_id`) REFERENCES `transportadoras` (`id`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `estoque_movimentacao`
--
ALTER TABLE `estoque_movimentacao`
  ADD CONSTRAINT `fk_mov_mercadoria` FOREIGN KEY (`mercadoria_id`) REFERENCES `mercadorias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_mov_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `mercadorias`
--
ALTER TABLE `mercadorias`
  ADD CONSTRAINT `fk_mercadoria_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `oportunidades`
--
ALTER TABLE `oportunidades`
  ADD CONSTRAINT `fk_oportunidade_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `pedidos_venda`
--
ALTER TABLE `pedidos_venda`
  ADD CONSTRAINT `fk_pedido_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
