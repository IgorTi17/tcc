CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `complemento` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `dataRegistro` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cliente` (`idCliente`, `nome`, `endereco`, `complemento`, `email`, `telefone`, `cpf`, `dataRegistro`) VALUES
(1, 'Lucas', 'Rua do Lucas, 30', 'Próxima ao mcdonalds', 'lucas@gmail.com', '99999-9999', '321.321.123-12', '2021-03-22'),
(3, 'Igor', 'Rua do Igor, 30', 'Próxima ao mcdonalds', 'igor@gmail.com', '99999-9999', '321.321.123-12', '2021-04-04'),
(4, 'Luiz', 'Rua do Luiz, 30', 'Próxima ao mcdonalds', 'luiz@gmail.com', '99999-9999', '321.321.123-12', '2021-03-22'),
(5, 'Guilherme', 'Rua do Guilherme, 30', 'Próxima ao mcdonalds', 'guilherme@gmail.com', '99999-9999', '321.321.123-12', '2021-09-23'),
(6, 'Julia', 'Rua da Julia, 30', 'Próxima ao mcdonalds', 'guilherme@gmail.com', '99999-9999', '321.321.123-12', '2021-08-15'),
(7, 'Alana', 'Rua da Alana, 30', 'Próxima ao mcdonalds', 'guilherme@gmail.com', '99999-9999', '321.321.123-12', '2021-07-09'),
(8, 'Eliana', 'Rua da Eliana, 30', 'Próxima ao mcdonalds', 'eliana@gmail.com', '99999-9999', '321.321.123-12', '2021-06-09'),
(9, 'João', 'Rua do João, 30', 'Próxima ao mcdonalds', 'guilherme@gmail.com', '99999-9999', '321.321.123-12', '2021-05-05'),
(10, 'Larissa', 'Rua da Larissa, 30', 'Próxima ao mcdonalds', 'guilherme@gmail.com', '99999-9999', '321.321.123-12', '2021-04-03'),
(11, 'Lucas', 'Rua do Lucas, 30', 'Próxima ao mcdonalds', 'lucas@gmail.com', '99999-9999', '321.321.123-12', '2021-05-22'),
(12, 'Lucas', 'Rua do Lucas, 30', 'Próxima ao mcdonalds', 'lucas@gmail.com', '99999-9999', '321.321.123-12', '2021-06-22'),
(13, 'Lucas', 'Rua do Lucas, 30', 'Próxima ao mcdonalds', 'lucas@gmail.com', '99999-9999', '321.321.123-12', '2021-05-22'),
(14, 'Lucas', 'Rua do Lucas, 30', 'Próxima ao mcdonalds', 'lucas@gmail.com', '99999-9999', '321.321.123-12', '2021-09-22'),
(15, 'Lucas', 'Rua do Lucas, 30', 'Próxima ao mcdonalds', 'lucas@gmail.com', '99999-9999', '321.321.123-12', '2021-06-22'),
(16, 'Lucas', 'Rua do Lucas, 30', 'Próxima ao mcdonalds', 'lucas@gmail.com', '99999-9999', '321.321.123-12', '2021-07-22');

-- --------------------------------------------------------

CREATE TABLE `fornecedor` (
  `idFornecedor` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `cpfCnpj` varchar(20) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `complemento` varchar(200) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `fornecedor` (`idFornecedor`, `nome`, `razao_social`, `cpfCnpj`, `endereco`, `complemento`, `telefone`, `email`) VALUES
(1, '', 'Kabum Ltda', '14.787.947/0001-07', 'Rua da Kabum, 10', 'bloco 20', '95555-6666', 'contato@kabum.com'),
(2, '', 'Cocacola Ltda', '74.369.416/0001-18', 'Rua da Cocacola, 20', 'Bloco 30', '92222-1111', 'contato@cocacola.com'),
(4, '', 'Nike Ltda', '28.562.224/0001-68', 'Rua da nike, 80', 'bloco 90', '97777-6666', 'contato@nike.com'),
(7, 'Lucia Reis dos Santos', '', '526.894.567-59', 'Rua do Ana, 4321', 'Bloco 9', '95497-6521', 'ana@gmail.com'),
(18, 'Ana Lucia Reis dos Santos', '', '526.894.567-59', 'Rua do Ana, 4321', 'Bloco 9', '95497-6521', 'ana@gmail.com'),
(19, 'Jorge Reis dos Santos', '', '526.894.567-59', 'Rua do Ana, 4321', 'Bloco 9', '95497-6521', 'jorge@gmail.com');

-- --------------------------------------------------------

CREATE TABLE `history_solicitacao` (
  `idHistory` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idFornecedor` int(11) NOT NULL,
  `dataAtual` int(11) NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `history_solicitacao` (`idHistory`, `idUsuario`, `idFornecedor`, `dataAtual`, `msg`) VALUES
(1, 2, 4, 1636424122, 'Solicitação de quatro tênises.'),
(2, 2, 4, 1636424147, 'tênises.'),
(3, 2, 4, 1636424170, 'solicitação tênises.'),
(4, 2, 4, 1636424205, 'solicitação cadeiras.'),
(5, 2, 4, 1636424225, 'Solicitação tênis.'),
(6, 2, 4, 1636424237, 'Tênis.');

-- --------------------------------------------------------

CREATE TABLE `itens_pedido` (
  `idItensPedido` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `medicamento` varchar(255) NOT NULL,
  `quantMedicamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `itens_pedido` (`idItensPedido`, `idPedido`, `medicamento`, `quantMedicamento`) VALUES
(1, 2, '3', 4),
(2, 2, '1', 3),
(3, 3, '1', 1);

-- --------------------------------------------------------

CREATE TABLE `medicamentos` (
  `idMedicamento` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `bula` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `receita` text NOT NULL,
  `caracteristicas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `medicamentos` (`idMedicamento`, `nome`, `preco`, `quantidade`, `bula`, `imagem`, `receita`, `caracteristicas`) VALUES
(2, 'Amoxilina', '4.00', 9, '1636572436_75120976.pdf', '1636572436_28851830.jpg', 'n', 'gota'),
(3, 'Torsilax', '5.50', 8, '1636572684_70608555.pdf', '1636572684_67336276.jpg', 'n', 'gota'),
(4, 'Dipirona', '3.00', 27, '1636497927_35760071.pdf', '1636497927_14881004.jpg', '3.00', 'carac nada...');

-- --------------------------------------------------------

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `dataAtual` int(11) NOT NULL,
  `total` varchar(11) NOT NULL,
  `formaDePagamento` varchar(11) NOT NULL,
  `troco` varchar(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pedidos` (`idPedido`, `idCliente`, `dataAtual`, `total`, `formaDePagamento`, `troco`, `status`) VALUES
(2, 5, 1636380683, '10.30', 'Dinheiro', '15.00', 'separando'),
(3, 1, 1636385543, '10.30', 'Cartão', '', 'concluido'),
(4, 6, 1636389803, '10.30', 'Cartão', '', 'cancelado'),
(5, 7, 1636392383, '10.30', 'Dinheiro', '', 'entrega');

-- --------------------------------------------------------

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `acesso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `usuario` (`id_usuario`, `usuario`, `senha`, `acesso`) VALUES
(1, 'igor', 'igor123', 'atendente'),
(2, 'lucas', 'lucas123', 'adm'),
(3, 'luiz', 'luiz123', 'estoquista');

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`idFornecedor`);

ALTER TABLE `history_solicitacao`
  ADD PRIMARY KEY (`idHistory`);

ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`idItensPedido`);

ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`idMedicamento`);

ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `fornecedor`
  MODIFY `idFornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `history_solicitacao`
  MODIFY `idHistory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `itens_pedido`
  MODIFY `idItensPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `medicamentos`
  MODIFY `idMedicamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
