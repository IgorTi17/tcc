CREATE DATABASE `4system`;

use `4system`;

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
(16, 'Lucas', 'Rua do Lucas, 30', 'Próxima ao mcdonalds', 'lucas@gmail.com', '99999-9999', '321.321.123-12', '2021-07-22'),
(17, 'Lucas', 'Rua do Lucas, 30', 'Próxima ao mcdonalds', 'lucas@gmail.com', '99999-9999', '321.321.123-12', '2021-05-22');



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
(19, 'Jorge Reis dos Santos', '', '526.894.567-59', 'Rua do Ana, 4321', 'Bloco 9', '95497-6521', 'ana@gmail.com');



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
(1, 'Dipirona', '5,00', 10, '', '', 'n', 'gota'),
(2, 'Dipirona 2', '5,00', 10, '', '', 'n', 'gota');


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

ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`idMedicamento`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `fornecedor`
  MODIFY `idFornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `medicamentos`
  MODIFY `idMedicamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
