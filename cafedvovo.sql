-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Mar-2025 às 21:51
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cafedvovo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `despacho`
--

CREATE TABLE `despacho` (
  `despacho_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `venda_id` int(11) NOT NULL,
  `nome_empresa` varchar(50) DEFAULT NULL,
  `prazo` varchar(50) DEFAULT NULL,
  `data_entrega` varchar(50) DEFAULT NULL,
  `valor` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `despacho`
--

INSERT INTO `despacho` (`despacho_id`, `cliente_id`, `venda_id`, `nome_empresa`, `prazo`, `data_entrega`, `valor`) VALUES
(2, 109, 11, 'SEDEX', '5', '2025-03-25', 21.53),
(3, 136, 12, 'Mini Envios', '10', '2025-03-30', 13.7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `iddespesa` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` decimal(14,2) NOT NULL,
  `data` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`iddespesa`, `categoria`, `descricao`, `valor`, `data`) VALUES
(11, 'wfwrjngukhi', '55', '-67.00', '2025-03-12 19:19:08'),
(14, 'poiuyf', 'car', '-50.00', '2025-03-05 23:59:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesa_categoria`
--

CREATE TABLE `despesa_categoria` (
  `idcategoria` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `despesa_categoria`
--

INSERT INTO `despesa_categoria` (`idcategoria`, `tipo`, `nome`) VALUES
(6, 'fixo', 'Fábio'),
(7, 'variavel', 'FUNK');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `endereco_id` int(11) NOT NULL,
  `pais` varchar(45) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `rua` varchar(45) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `complemento` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `pessoa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`endereco_id`, `pais`, `cep`, `estado`, `cidade`, `bairro`, `rua`, `numero`, `complemento`, `tipo`, `pessoa_id`) VALUES
(87, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '3232', 'de 1412 ao fim - lado par', '', 99),
(88, 'aaaa', 'aaaa', 'aaaa', 'aaaa', 'aaaaa', 'aaaaa', 'aaaa', 'aaaa', '', 100),
(90, ' 007', ' 007', ' 007', ' 007', ' 007', ' 007', ' 007', '008', '', 102),
(91, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '222222', 'de 1412 ao fim - lado par', '', 103),
(92, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '23232', 'de 1412 ao fim - lado par', '', 104),
(93, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '2222', 'de 1412 ao fim - lado par', '', 105),
(94, 'Pessoa juriiii', 'Pessoa juriiii', 'Pessoa juriiii', 'Pessoa juriiii', 'Pessoa juriiii', 'Pessoa juriiii', 'Pessoa juriiii', 'Pessoa juriiii', '', 106),
(95, 'fornecedore', 'fornecedore', 'fornecedore', 'fornecedore', 'Horto', 'Avenida Silviano Brandão', '34234', 'de 1412 ao fim - lado par', '', 107),
(97, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', 'dsfsdfsdf', 'de 1412 ao fim - lado par', '', 109),
(98, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', 'erer', 'de 1412 ao fim - lado par', '', 110),
(99, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '34234324', 'de 1412 ao fim - lado par', '', 111),
(100, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', 'rewrwer', 'de 1412 ao fim - lado par', '', 112),
(101, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '3242343', 'de 1412 ao fim - lado par', '', 113),
(102, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '333', 'de 1412 ao fim - lado par', '', 114),
(103, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '34324234', 'de 1412 ao fim - lado par', '', 115),
(104, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '43534534', 'de 1412 ao fim - lado par', '', 116),
(105, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '34234', 'de 1412 ao fim - lado par', '', 117),
(106, 'Brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '234234234', 'de 1412 ao fim - lado par', '', 118),
(107, 'brasil', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '23423432', 'de 1412 ao fim - lado par', '', 119),
(108, 'Brasil', '36402148', 'MG', 'Conselheiro Lafaiete', 'Gigante', 'Rua Trindade Áurea de Almeida', '334', 'almeida', '', 120),
(109, '4324', '31015015', 'MG', 'Belo Horizonte', 'Horto', 'Avenida Silviano Brandão', '31', 'de 1412 ao fim - lado par', '', 121),
(110, 'Brasil', '234324', '34234', '234234', '234234', '234234', '234234', '23423423', '', 124),
(111, 'Brasil', '234324', '34234', '234234', '234234', '234234', '234234', '23423423', '', 125),
(112, 'Brasil', '234234', '324234', '324234', '234234', '234234', '24234', '234234', '', 126),
(113, 'Brasil', '234234', '324234', '324234', '234234', '234234', '24234', '234234', '', 127),
(114, 'Brasil', '234234', '324234', '324234', '234234', '234234', '24234', '234234', '', 128),
(115, 'Brasil', '234234', '324234', '324234', '234234', '234234', '24234', '234234', '', 129),
(116, 'Brasil', '234234', '324234', '324234', '234234', '234234', '24234', '234234', '', 130),
(117, 'Brasil', '234234', '234234', '234234', '32423', '324234', '234234', '234234', '', 131),
(119, 'Brasil', '24234', '234234', '234234', '423423', '423423', '423423', '423423', '', 133),
(120, 'Brasil', '32423423', '423423', '423423', '4234234', '4324234', '422324', '4234234', '', 134),
(121, 'Brasil', '234324', '234234', '234234', '423423', '324234', '234234324', '234234', '', 135),
(122, 'Brasil', '23434', '423432', '234', '324', '23432', '4234', '234234', '', 136),
(123, 'Brasil', '23423432', '324234', '4324234', '4234234', '4234234', '4234234', '4324234', '', 137);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entradas`
--

CREATE TABLE `entradas` (
  `identrada` int(11) NOT NULL,
  `valor` decimal(14,2) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `data` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `entradas`
--

INSERT INTO `entradas` (`identrada`, `valor`, `descricao`, `data`) VALUES
(32, '99.00', '4678', '2025-03-13 01:29:36'),
(39, '1234567890.24', 'tr', '2025-03-14 21:26:18'),
(41, '456.00', 'w', '2025-03-14 21:26:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregas`
--

CREATE TABLE `entregas` (
  `id_entrega` int(11) NOT NULL,
  `id_venda` varchar(255) NOT NULL,
  `data_venda` datetime DEFAULT NULL,
  `data_entrega` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `fornecedor_id` int(11) NOT NULL,
  `nome_empresa` varchar(100) NOT NULL,
  `documento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`fornecedor_id`, `nome_empresa`, `documento`) VALUES
(107, 'fornecedore', ''),
(134, '324234', '4324234'),
(136, '234234', '32423');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `funcionario_id` int(11) NOT NULL,
  `cargo` varchar(45) NOT NULL,
  `salario` float NOT NULL,
  `matricula` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`funcionario_id`, `cargo`, `salario`, `matricula`) VALUES
(102, ' 007', 7, ' 007'),
(103, '222222car', 22222, '0101103'),
(116, '432423', 4234230, '0101116'),
(120, 'cargo', 40000, '1111120'),
(135, '42342342', 432423000, '4324234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `insumo`
--

CREATE TABLE `insumo` (
  `insumo_id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `unidade_medida` varchar(45) NOT NULL,
  `custo_unitario` float NOT NULL,
  `custo_total` float NOT NULL,
  `estoque_atual` int(11) NOT NULL,
  `data_validade` varchar(35) NOT NULL,
  `data_cadastro` varchar(45) NOT NULL,
  `estoque_minimo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `insumo`
--

INSERT INTO `insumo` (`insumo_id`, `nome`, `unidade_medida`, `custo_unitario`, `custo_total`, `estoque_atual`, `data_validade`, `data_cadastro`, `estoque_minimo`) VALUES
(1, 'Café em Grãos', 'g', 0.05, 0, -328518, '2025-12-31', '2024-01-01', 0),
(2, 'Água', 'ml', 0.001, 0, 10000, '2025-12-31', '2024-01-01', 0),
(3, 'Leite', 'ml', 0.02, 0, 1995, '2025-12-31', '2024-01-01', 0),
(4, 'Chocolate em Pó', 'g', 0.1, 0, 1490, '2025-12-31', '2024-01-01', 0),
(5, 'Açúcar', 'g', 0.01, 0, 3000, '2025-12-31', '2024-01-01', 0),
(6, 'Canela em Pó', 'g', 0.05, 0, 478, '2025-12-31', '2024-01-01', 0),
(7, 'Baunilha', 'ml', 0.2, 0, 300, '2025-12-31', '2024-01-01', 0),
(8, 'Chantilly', 'ml', 0.15, 0, 500, '2025-12-31', '2024-01-01', 0),
(9, 'Nutella', 'g', 0.3, 0, 400, '2025-12-31', '2024-01-01', 0),
(10, 'Gengibre em Pó', 'g', 0.05, 0, 200, '2025-12-31', '2024-01-01', 0),
(11, 'Côco Ralado', 'g', 0.1, 0, 500, '2025-12-31', '2024-01-01', 0),
(12, 'Frutas Vermelhas', 'g', 0.2, 0, 600, '2025-12-31', '2024-01-01', 0),
(13, 'Cacau em Pó', 'g', 0.15, 0, 500, '2025-12-31', '2024-01-01', 0),
(14, 'Amêndoas', 'g', 0.2, 0, 300, '2025-12-31', '2024-01-01', 0),
(15, 'Limão', 'g', 0.1, 0, 200, '2025-12-31', '2024-01-01', 0),
(16, 'Frutas da Estação', 'g', 0.25, 0, 300, '2025-12-31', '2024-01-01', 0),
(17, 'Licor', 'ml', 0.5, 0, 988, '2025-12-31', '2024-01-01', 0),
(18, 'Cachaça', 'ml', 0.5, 0, 1000, '2025-12-31', '2024-01-01', 0),
(19, 'Mel', 'g', 0.1, 0, 500, '2025-12-31', '2024-01-01', 0),
(20, 'Ervas', 'g', 0.05, 0, 300, '2025-12-31', '2024-01-01', 0),
(21, 'Sementes de Cardamomo', 'g', 0.1, 0, 200, '2025-12-31', '2024-01-01', 0),
(22, 'Frutas Secas', 'g', 0.15, 0, 300, '2025-12-31', '2024-01-01', 0),
(23, 'Embalagem para Café', 'un', 0.05, 0, 1000, '2025-12-31', '2024-01-01', 0),
(24, 'Embalagem para Espresso', 'un', 0.15, 0, 800, '2025-12-31', '2024-01-01', 0),
(25, 'Sache de Açúcar', 'un', 0.01, 0, 1000, '2025-12-31', '2024-01-17', 0),
(26, 'Sache de Sal', 'un', 0.01, 0, 500, '2025-12-31', '2024-01-18', 0),
(27, 'Iogurte', 'ml', 0.2, 0, 400, '2025-12-31', '2024-01-01', 0),
(28, 'Cereais', 'g', 0.1, 0, 500, '2025-12-31', '2024-01-01', 0),
(29, 'Açúcar Mascavo', 'g', 0.02, 0, 300, '2025-12-31', '2024-01-01', 0),
(30, 'Granola', 'g', 0.1, 0, 400, '2025-12-31', '2024-01-01', 0),
(31, 'Cachaça de Café', 'ml', 0.5, 0, 1000, '2025-12-31', '2024-01-01', 0),
(32, 'Sementes de Girassol', 'g', 0.05, 0, 300, '2025-12-31', '2024-01-01', 0),
(33, 'Pasta de Amendoim', 'g', 0.3, 0, 400, '2025-12-31', '2024-01-01', 0),
(96, '', 'g', 0, 0, 0, '', '2024-10-31', 0),
(97, 'insumo 1', 'g', 1, 100, 100, '1111-11-11', '2024-10-31', 0),
(98, 'dfsdfdsf', 'g', 10034.8, 343422000, 34223, '', '2024-10-31', 0),
(99, 'avelá top', 'g', 1, 2000, 2000, '2024-11-22', '2024-11-01', 0),
(100, 'yyyy', 'g', 0.5, 10, 18, '2025-10-12', '2025-02-21', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_venda`
--

CREATE TABLE `itens_venda` (
  `item_venda_id` int(11) NOT NULL,
  `venda_id` int(11) DEFAULT NULL,
  `produto` varchar(100) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `preco_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itens_venda`
--

INSERT INTO `itens_venda` (`item_venda_id`, `venda_id`, `produto`, `quantidade`, `preco_unitario`, `subtotal`) VALUES
(17, 11, '71', 6, '1.12', '6.72'),
(18, 11, '17', 3, '18.00', '54.00'),
(19, 12, '71', 4, '1.12', '4.48'),
(20, 12, '1', 4, '15.00', '60.00'),
(21, 12, '31', 2, '18.00', '36.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `pessoa_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `data_nascimento` varchar(45) DEFAULT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`pessoa_id`, `nome`, `email`, `data_nascimento`, `data_cadastro`) VALUES
(98, 'dsfdsfsd', '324234@gmai.com', '0000-00-00', '2024-10-23'),
(99, 'dsfdsfsd', '324234@gmai.com', '0000-00-00', '2024-10-23'),
(100, 'aaaa', 'aaaa@gmai.com', 'aaaaa', '2024-10-23'),
(102, 'funcionario 007', 'funcionario@gmail.com', ' 007', '2024-10-23'),
(103, 'funcionario', 'funcionario@gmail.com', '0000-00-00', '2024-10-23'),
(104, 'numero 104', '104@gmail.com', '0000-00-00', '2024-10-23'),
(105, 'clienteestrangeiro', 'clienteestrangeiro@fdfd.com', '0000-00-00', '2024-10-23'),
(106, 'Pessoa juriiii', 'Pessoa@juriii.com', 'Pessoa juriiii', '2024-10-23'),
(107, 'fornecedore', 'dsfsd@dfdf.cpm', 'fornecedore', '2024-10-23'),
(109, '32423423', '432423@gmail.com', '43/24/2342', '2024-10-23'),
(110, 'fer', 'rewrw@gmail.com', '42/34/2342', '2024-10-23'),
(111, 'yyyyy', 'yyyy@gmail.com', '42/34/2342', '2024-10-23'),
(112, 'dsfsdf', 'fsdf@gmail.com', '42/34/2342', '2024-10-23'),
(113, 'asdas', 'dsadsa@gmail.com', '42/34/2342', '2024-10-23'),
(114, 'aaaaaa', 'dsfsd@gsdffgsd.com', '42/34/2342', '2024-10-23'),
(115, 'bbbbbb', 'fdsfsd@gma.com', '43/24/2424', '2024-10-23'),
(116, 'funcionário', 'fffff@gff.com', '43/24/2342', '2024-10-23'),
(117, 'dsfdsf', 'fdsfds@fgdfdf.conm', '43/24/2342', '2024-10-23'),
(118, 'sdfdsf', 'fddsfsd@gmail.com', '43/24/2342', '2024-10-23'),
(119, 'dsfdsf', 'fdsfds@gmail.com', '43/24/2342', '2024-10-23'),
(120, 'Fabrício dos santos', 'fabrídio@funcionário.com', '11/11/1111', '2024-10-23'),
(121, 'erer', 'rewrwer3@fgdgf.com', '43/24/2342', '2024-10-24'),
(122, 'sdfdsf', 'fdsfds@fdfdf', 'fsdfds', '2024-10-24'),
(123, 'sdfdsf', 'fdsfds@fdfdf', 'fsdfds', '2024-10-24'),
(124, 'ewrewr', 'rwer@fdfd', '324234', '2024-10-24'),
(125, 'ewrewr', 'rwer@fdfd', '324234', '2024-10-24'),
(126, 'aaaa', 'aaa@aaa', '13123', '2024-10-24'),
(127, 'aaaa', 'aaa@aaa', '13123', '2024-10-24'),
(128, 'aaaa', 'aaa@aaa', '13123', '2024-10-24'),
(129, 'aaaa', 'aaa@aaa', '13123', '2024-10-24'),
(130, 'aaaa', 'aaa@aaa', '13123', '2024-10-24'),
(131, 'aaaaaaaaaaaaa', 'aaaaaaaa@fdfdf.com', '234234', '2024-10-24'),
(133, 'pessoa juridica', 'asdasd@fdfd', '32424', '2024-10-24'),
(134, 'fornecedor', 'dsfds@fdfd.com', '4324', '2024-10-24'),
(135, 'funcionario', '324234@fdfd.com', '432423423', '2024-10-24'),
(136, 'alan fornecedor', 'alan@gmail.com', '234324', '2024-10-25'),
(137, 'Fábio', 'fabio@gmail.com', '423423', '2024-10-25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `produto_id` int(11) NOT NULL,
  `imagem` longblob NOT NULL,
  `tipo_imagem` varchar(255) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `peso` float NOT NULL,
  `custo` float NOT NULL,
  `margem_lucro` float NOT NULL,
  `preco_venda` float NOT NULL,
  `estoque_atual` int(11) NOT NULL,
  `estoque_minimo` int(11) NOT NULL,
  `data_validade` varchar(45) NOT NULL,
  `data_cadastro` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`produto_id`, `imagem`, `tipo_imagem`, `nome`, `categoria`, `descricao`, `tipo`, `peso`, `custo`, `margem_lucro`, `preco_venda`, `estoque_atual`, `estoque_minimo`, `data_validade`, `data_cadastro`) VALUES
(1, '', '', 'Café Arábica', 'Café', 'Café 100% Arábica de alta qualidade.', 'capsula', 250, 0, 0.5, 15, 100, 20, '0', '2024-01-01'),
(3, '', '', 'Café Espresso', 'Café', 'Mistura de grãos Arábica e Robusta para espresso.', 'pacote', 250, 12, 0.6, 18, 80, 15, '2025-12-31', '2024-01-03'),
(4, '', '', 'Café Gourmet', 'Café', 'Café especial com notas de chocolate.', 'pacote', 250, 15, 0.75, 25, 50, 10, '2025-12-31', '2024-01-04'),
(5, '', '', 'Café Mocha', 'Café', 'Café com sabor de chocolate e especiarias.', 'pacote', 250, 14, 0.7, 22, 70, 12, '2025-12-31', '2024-01-05'),
(6, '', '', 'Café Orgânico', 'Café', 'Café produzido de forma sustentável e orgânica.', 'pacote', 250, 13, 0.65, 20, 90, 15, '2025-12-31', '2024-01-06'),
(7, '', '', 'Café Descafeinado', 'Café', 'Café descafeinado, perfeito para sensíveis à cafeína.', 'pacote', 250, 11, 0.55, 17, 60, 10, '2025-12-31', '2024-01-07'),
(8, '', '', 'Café com Baunilha', 'Café', 'Café aromatizado com essência de baunilha.', 'pacote', 250, 12, 0.6, 18, 75, 15, '2025-12-31', '2024-01-08'),
(9, '', '', 'Café com Canela', 'Café', 'Café aromatizado com canela.', 'pacote', 250, 12, 0.6, 18, 80, 15, '2025-12-31', '2024-01-09'),
(10, '', '', 'Café Intenso', 'Café', 'Mistura de grãos intensos para paladares exigentes.', 'pacote', 250, 14, 0.7, 21, 70, 12, '2025-12-31', '2024-01-10'),
(11, '', '', 'Café da Manhã', 'Café', 'Café suave ideal para o café da manhã.', 'pacote', 250, 9, 0.45, 13, 100, 20, '2025-12-31', '2024-01-11'),
(12, '', '', 'Café Frances', 'Café', 'Café com sabor forte e corpo robusto.', 'pacote', 250, 10, 0.5, 15, 80, 15, '2025-12-31', '2024-01-12'),
(13, '', '', 'Café Italiano', 'Café', 'Café com notas de caramelo e chocolate.', 'pacote', 250, 13, 0.65, 20, 60, 10, '2025-12-31', '2024-01-13'),
(14, '', '', 'Café do Brasil', 'Café', 'Café de origem brasileira com sabor adocicado.', 'pacote', 250, 11, 0.55, 17, 70, 12, '2025-12-31', '2024-01-14'),
(15, '', '', 'Café do México', 'Café', 'Café com notas frutadas e acidez leve.', 'pacote', 250, 12, 0.6, 18, 50, 10, '2025-12-31', '2024-01-15'),
(16, '', '', 'Café Etíope', 'Café', 'Café com sabor floral e notas cítricas.', 'pacote', 250, 14, 0.7, 22, 40, 8, '2025-12-31', '2024-01-16'),
(17, '', '', 'Café Colombiano', 'Café', 'Café suave com notas de caramelo.', 'pacote', 250, 12, 0.6, 18, 70, 12, '2025-12-31', '2024-01-17'),
(18, '', '', 'Café Puro', 'Café', 'Café 100% puro, sem misturas.', 'pacote', 250, 15, 0.75, 25, 50, 10, '2025-12-31', '2024-01-18'),
(19, '', '', 'Café Torrado', 'Café', 'Café torrado no ponto perfeito.', 'pacote', 250, 10, 0.5, 15, 90, 20, '2025-12-31', '2024-01-19'),
(20, '', '', 'Café em Grãos', 'Café', 'Café em grãos, ideal para moer na hora.', 'pacote', 250, 11, 0.55, 17, 100, 20, '2025-12-31', '2024-01-20'),
(21, '', '', 'Café de Cápsula', 'Café', 'Cápsulas de café compatíveis com máquinas.', 'kit', 10, 30, 1.5, 45, 120, 25, '2025-12-31', '2024-01-21'),
(22, '', '', 'Café Instantâneo', 'Café', 'Café instantâneo prático para preparar.', 'pacote', 100, 8, 0.4, 12, 200, 50, '2025-12-31', '2024-01-22'),
(23, '', '', 'Café com Chocolate', 'Café', 'Café aromatizado com chocolate.', 'pacote', 250, 14, 0.7, 22, 60, 10, '2025-12-31', '2024-01-23'),
(24, '', '', 'Café com Leite', 'Café', 'Café pronto para beber, com leite.', 'pacote', 200, 10, 0.5, 15, 80, 15, '2025-12-31', '2024-01-24'),
(25, '', '', 'Café em Saquinho', 'Café', 'Café em saquinhos individuais.', 'pacote', 200, 7, 0.35, 10, 150, 30, '2025-12-31', '2024-01-25'),
(26, '', '', 'Café Filtrado', 'Café', 'Café coado com sabor suave.', 'pacote', 250, 9, 0.45, 13, 100, 20, '2025-12-31', '2024-01-26'),
(27, '', '', 'Café para Prensa Francesa', 'Café', 'Café moído ideal para prensa francesa.', 'pacote', 250, 11, 0.55, 17, 90, 15, '2025-12-31', '2024-01-27'),
(28, '', '', 'Café Turco', 'Café', 'Café moído finamente, ideal para preparar café turco.', 'pacote', 250, 12, 0.6, 18, 70, 12, '2025-12-31', '2024-01-28'),
(29, '', '', 'Café com Cardamomo', 'Café', 'Café aromatizado com cardamomo.', 'pacote', 250, 12, 0.6, 18, 65, 10, '2025-12-31', '2024-01-29'),
(30, '', '', 'Café com Gengibre', 'Café', 'Café aromatizado com gengibre.', 'pacote', 250, 12, 0.6, 18, 50, 10, '2025-12-31', '2024-01-30'),
(31, '', '', 'Café com Cravo', 'Café', 'Café aromatizado com cravo.', 'pacote', 250, 12, 0.6, 18, 40, 8, '2025-12-31', '2024-01-31'),
(32, '', '', 'Café com Noz-Moscada', 'Café', 'Café aromatizado com noz-moscada.', 'pacote', 250, 12, 0.6, 18, 35, 7, '2025-12-31', '2024-02-01'),
(33, '', '', 'Café com Licor', 'Café', 'Café aromatizado com licor.', 'pacote', 250, 15, 0.75, 25, 30, 5, '2025-12-31', '2024-02-02'),
(34, '', '', 'Café Premium', 'Café', 'Mistura de grãos premium para paladares exigentes.', 'pacote', 250, 18, 0.9, 28, 25, 5, '2025-12-31', '2024-02-03'),
(35, '', '', 'Café do Dia', 'Café', 'Café especial do dia.', 'pacote', 250, 12, 0.6, 18, 40, 8, '2025-12-31', '2024-02-04'),
(36, '', '', 'Café Blend', 'Café', 'Mistura de grãos Arábica e Robusta.', 'pacote', 250, 10, 0.5, 15, 90, 20, '2025-12-31', '2024-02-05'),
(37, '', '', 'Café de Especialidade', 'Café', 'Café de especialidade com notas florais.', 'pacote', 250, 20, 1, 30, 20, 4, '2025-12-31', '2024-02-06'),
(38, '', '', 'Café Moído', 'Café', 'Café moído na hora.', 'pacote', 250, 11, 0.55, 17, 70, 12, '2025-12-31', '2024-02-07'),
(39, '', '', 'Café com Avelã', 'Café', 'Café aromatizado com avelã.', 'pacote', 250, 13, 0.65, 20, 65, 10, '2025-12-31', '2024-02-08'),
(40, '', '', 'Café com Frutas Vermelhas', 'Café', 'Café com notas de frutas vermelhas.', 'pacote', 250, 14, 0.7, 22, 50, 10, '2025-12-31', '2024-02-09'),
(41, '', '', 'Café Frio', 'Café', 'Café gelado pronto para beber.', 'pacote', 200, 10, 0.5, 15, 80, 15, '2025-12-31', '2024-02-10'),
(42, '', '', 'Café com Leite Condensado', 'Café', 'Café com leite condensado.', 'pacote', 200, 12, 0.6, 18, 60, 10, '2025-12-31', '2024-02-11'),
(43, '', '', 'Café Gelado com Chocolate', 'Café', 'Café gelado com chocolate.', 'pacote', 200, 14, 0.7, 22, 40, 8, '2025-12-31', '2024-02-12'),
(44, '', '', 'Café com Iogurte', 'Café', 'Café com iogurte e especiarias.', 'pacote', 200, 13, 0.65, 20, 50, 10, '2025-12-31', '2024-02-13'),
(45, '', '', 'Café com Leite de Coco', 'Café', 'Café com leite de coco.', 'pacote', 200, 12, 0.6, 18, 60, 10, '2025-12-31', '2024-02-14'),
(46, '', '', 'Café com Creme', 'Café', 'Café cremoso ideal para sobremesas.', 'pacote', 200, 15, 0.75, 25, 30, 5, '2025-12-31', '2024-02-15'),
(47, '', '', 'Café em Lata', 'Café', 'Café em lata pronto para beber.', 'pacote', 300, 12, 0.6, 18, 50, 10, '2025-12-31', '2024-02-16'),
(48, '', '', 'Café Energético', 'Café', 'Café com cafeína extra.', 'pacote', 250, 13, 0.65, 20, 45, 9, '2025-12-31', '2024-02-17'),
(49, '', '', 'Café para Bule', 'Café', 'Café ideal para preparo em bule.', 'pacote', 250, 11, 0.55, 17, 90, 20, '2025-12-31', '2024-02-18'),
(50, '', '', 'Café de Pressão', 'Café', 'Café preparado na máquina de pressão.', 'pacote', 250, 10, 0.5, 15, 80, 15, '2025-12-31', '2024-02-19'),
(51, '', '', 'Café da Tarde', 'Café', 'Café suave ideal para a tarde.', 'pacote', 250, 9, 0.45, 13, 100, 20, '2025-12-31', '2024-02-20'),
(52, '', '', 'Café com Fava Tonka', 'Café', 'Café aromatizado com fava tonka.', 'pacote', 250, 15, 0.75, 25, 25, 5, '2025-12-31', '2024-02-21'),
(53, '', '', 'Café com Menta', 'Café', 'Café aromatizado com menta.', 'pacote', 250, 12, 0.6, 18, 60, 10, '2025-12-31', '2024-02-22'),
(54, '', '', 'Café com Caramelo', 'Café', 'Café aromatizado com caramelo.', 'pacote', 250, 13, 0.65, 20, 50, 10, '2025-12-31', '2024-02-23'),
(55, '', '', 'Café com Maracujá', 'Café', 'Café com sabor de maracujá.', 'pacote', 250, 14, 0.7, 22, 40, 8, '2025-12-31', '2024-02-24'),
(56, '', '', 'Café de Baga', 'Café', 'Café com notas de baga.', 'pacote', 250, 15, 0.75, 25, 30, 5, '2025-12-31', '2024-02-25'),
(57, '', '', 'Café com Pimenta', 'Café', 'Café aromatizado com pimenta.', 'pacote', 250, 12, 0.6, 18, 50, 10, '2025-12-31', '2024-02-26'),
(58, '', '', 'Café com Limão', 'Café', 'Café aromatizado com limão.', 'pacote', 250, 12, 0.6, 18, 40, 8, '2025-12-31', '2024-02-27'),
(59, '', '', 'Café com Lavanda', 'Café', 'Café aromatizado com lavanda.', 'pacote', 250, 15, 0.75, 25, 25, 5, '2025-12-31', '2024-02-28'),
(60, '', '', 'Café de Bananada', 'Café', 'Café com notas de bananada.', 'pacote', 250, 14, 0.7, 22, 30, 5, '2025-12-31', '2024-03-01'),
(61, '', '', 'Café com Mel', 'Café', 'Café adoçado com mel.', 'pacote', 250, 13, 0.65, 20, 40, 8, '2025-12-31', '2024-03-02'),
(62, '', '', 'Café de Açaí', 'Café', 'Café com notas de açaí.', 'pacote', 250, 15, 0.75, 25, 25, 5, '2025-12-31', '2024-03-03'),
(63, '', '', 'Café com Coco', 'Café', 'Café aromatizado com coco.', 'pacote', 250, 14, 0.7, 22, 30, 5, '2025-12-31', '2024-03-04'),
(64, '', '', 'Café de Cupuaçu', 'Café', 'Café com notas de cupuaçu.', 'pacote', 250, 15, 0.75, 25, 20, 4, '2025-12-31', '2024-03-05'),
(65, '', '', 'Café com Pêssego', 'Café', 'Café aromatizado com pêssego.', 'pacote', 250, 14, 0.7, 22, 25, 5, '2025-12-31', '2024-03-06'),
(66, '', '', 'Café com Morango', 'Café', 'Café aromatizado com morango.', 'pacote', 250, 14, 0.7, 22, 30, 5, '2025-12-31', '2024-03-07'),
(67, '', '', 'Café com Amêndoa', 'Café', 'Café aromatizado com amêndoa.', 'pacote', 250, 13, 0.65, 20, 40, 8, '2025-12-31', '2024-03-08'),
(68, '', '', 'Café com Cachaça', 'Café', 'Café aromatizado com cachaça.', 'pacote', 250, 15, 0.75, 25, 20, 4, '2025-12-31', '2024-03-09'),
(69, '', '', 'Café com Alecrim', 'Café', 'Café aromatizado com alecrim.', 'pacote', 250, 12, 0.6, 18, 50, 10, '2025-12-31', '2024-03-10'),
(70, '', '', 'Café com Erva Doce', 'Café', 'Café aromatizado com erva doce.', 'pacote', 250, 12, 0.6, 18, 40, 8, '2025-12-31', '2024-03-11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_insumo`
--

CREATE TABLE `produto_insumo` (
  `produto_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `qntd_insumo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto_insumo`
--

INSERT INTO `produto_insumo` (`produto_id`, `insumo_id`, `qntd_insumo`) VALUES
(1, 1, 150),
(1, 3, 5),
(1, 4, 10),
(3, 1, 200),
(3, 3, 10),
(3, 4, 15),
(3, 6, 5),
(4, 1, 200),
(4, 3, 5),
(4, 4, 10),
(4, 7, 20),
(5, 1, 150),
(5, 3, 10),
(5, 4, 10),
(5, 5, 10),
(6, 1, 150),
(6, 3, 5),
(6, 7, 30),
(7, 1, 150),
(7, 3, 5),
(7, 5, 10),
(7, 6, 5),
(8, 1, 200),
(8, 3, 5),
(8, 7, 15),
(8, 12, 5),
(9, 1, 150),
(9, 3, 5),
(9, 4, 10),
(9, 8, 3),
(10, 1, 200),
(10, 3, 10),
(10, 7, 30),
(10, 9, 5),
(11, 1, 200),
(11, 3, 5),
(11, 18, 10),
(12, 1, 200),
(12, 3, 5),
(12, 8, 5),
(13, 1, 200),
(13, 3, 5),
(13, 9, 5),
(14, 1, 150),
(14, 3, 5),
(14, 9, 10),
(14, 23, 5),
(15, 1, 200),
(15, 3, 5),
(15, 22, 3),
(16, 1, 200),
(16, 3, 5),
(16, 24, 5),
(17, 1, 200),
(17, 3, 5),
(17, 21, 5),
(18, 1, 150),
(18, 3, 5),
(18, 12, 5),
(19, 1, 200),
(19, 3, 5),
(19, 25, 5),
(20, 1, 150),
(20, 3, 5),
(20, 30, 5),
(21, 1, 200),
(21, 3, 5),
(21, 26, 5),
(22, 1, 200),
(22, 3, 5),
(22, 10, 5),
(23, 1, 200),
(23, 3, 5),
(23, 32, 5),
(24, 1, 200),
(24, 3, 5),
(24, 13, 5),
(25, 1, 200),
(25, 3, 5),
(25, 7, 10),
(26, 1, 200),
(26, 3, 5),
(26, 31, 5),
(27, 1, 200),
(27, 3, 5),
(27, 7, 10),
(28, 1, 150),
(28, 3, 5),
(29, 1, 200),
(29, 3, 5),
(29, 20, 5),
(30, 1, 200),
(30, 3, 5),
(30, 19, 5),
(31, 1, 150),
(31, 3, 5),
(32, 1, 200),
(32, 3, 5),
(33, 1, 150),
(33, 3, 5),
(34, 1, 200),
(34, 3, 5),
(34, 13, 5),
(35, 1, 150),
(35, 3, 5),
(35, 21, 5),
(36, 1, 200),
(36, 3, 5),
(36, 22, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_fisica`
--

CREATE TABLE `p_fisica` (
  `pfisica_id` int(11) NOT NULL,
  `cpf_rg` varchar(45) DEFAULT NULL,
  `passaporte` varchar(45) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `nacionalidade` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `p_fisica`
--

INSERT INTO `p_fisica` (`pfisica_id`, `cpf_rg`, `passaporte`, `descricao`, `nacionalidade`) VALUES
(100, 'aaaaaa', 'aaaaa', NULL, 'aaaaa'),
(104, '222222222', '', NULL, 'brasileiro'),
(105, NULL, 'passaporte', NULL, 'estrangeiro'),
(109, '3423423423', NULL, NULL, 'brasileiro'),
(111, '23234234', '', NULL, 'brasileiro'),
(112, '32423423', NULL, NULL, 'brasileiro'),
(113, '324234324', NULL, NULL, 'brasileiro'),
(114, '34324324 ', NULL, NULL, 'brasileiro'),
(115, '4324234234', NULL, NULL, 'brasileiro'),
(117, '324324324', NULL, NULL, 'brasileiro'),
(118, '32432432', NULL, NULL, 'brasileiro'),
(119, '32423423', NULL, NULL, 'brasileiro'),
(121, '234234324', NULL, NULL, 'brasileiro'),
(124, '23423', NULL, NULL, 'brasileiro'),
(125, '', NULL, NULL, 'brasileiro'),
(126, '', NULL, NULL, 'brasileiro'),
(127, '', NULL, NULL, 'brasileiro'),
(128, NULL, 'passaporte 34234234', NULL, 'brasileiro'),
(129, 'cpf 08089898', NULL, NULL, 'brasileiro'),
(130, 'cpf 08089898', NULL, NULL, 'brasileiro'),
(131, NULL, '234234', NULL, 'estrangeiro'),
(137, '432423423', NULL, NULL, 'brasileiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_juridica`
--

CREATE TABLE `p_juridica` (
  `pjuridica_id` int(11) NOT NULL,
  `cnpj` varchar(45) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `p_juridica`
--

INSERT INTO `p_juridica` (`pjuridica_id`, `cnpj`, `descricao`) VALUES
(106, 'Pessoa juriiii', ''),
(110, '34324', '4324234'),
(133, '432423', '4234234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

CREATE TABLE `telefone` (
  `telefone_id` int(11) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `pessoa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `telefone`
--

INSERT INTO `telefone` (`telefone_id`, `telefone`, `tipo`, `pessoa_id`) VALUES
(79, '(32) 42342-3432', 'Principal', 99),
(80, 'aaaa', 'Principal', 100),
(82, ' 007', 'Principal', 102),
(83, '(22) 22222-2222', 'Principal', 103),
(84, '(11) 11111-1111', 'Principal', 104),
(85, '(11) 21212-1212', 'Principal', 105),
(86, 'Pessoa juriiii', 'Principal', 106),
(87, 'fornecedore', 'Principal', 107),
(89, '(34) 23423-4324', 'Principal', 109),
(90, '(43) 24234-2342', 'Principal', 110),
(91, '(32) 42342-3423', 'Principal', 111),
(92, '(23) 42342-3423', 'Principal', 112),
(93, '(32) 34234-2342', 'Principal', 113),
(94, '(42) 34432-4234', 'Principal', 114),
(95, '(34) 32432-4324', 'Principal', 115),
(96, '(34) 23423-4234', 'Principal', 116),
(97, '(34) 23423-3423', 'Principal', 117),
(98, '(32) 42342-3423', 'Principal', 118),
(99, '(23) 42342-3423', 'Principal', 119),
(100, '(23) 23232-3232', 'Principal', 120),
(101, '(32) 42342-3424', 'Principal', 121),
(102, '324234', 'principal', 124),
(103, '324234', 'principal', 125),
(104, '123123', 'principal', 126),
(105, '123123', 'principal', 127),
(106, '123123', 'principal', 128),
(107, '123123', 'principal', 129),
(108, '123123', 'principal', 130),
(109, '4234234', 'principal', 131),
(111, '23423', 'principal', 133),
(112, '324234', 'principal', 134),
(113, '3423423', 'principal', 135),
(114, '234324', 'principal', 136),
(115, '432423', 'principal', 137);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `venda_id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `data_venda` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`venda_id`, `cliente_id`, `total`, `data_venda`) VALUES
(11, 109, '60.72', '2025-03-20 15:25:31'),
(12, 136, '100.48', '2025-03-20 15:27:31');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `despacho`
--
ALTER TABLE `despacho`
  ADD PRIMARY KEY (`despacho_id`),
  ADD KEY `venda_id` (`venda_id`);

--
-- Índices para tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`iddespesa`);

--
-- Índices para tabela `despesa_categoria`
--
ALTER TABLE `despesa_categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`endereco_id`),
  ADD KEY `pessoa_id` (`pessoa_id`);

--
-- Índices para tabela `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`identrada`);

--
-- Índices para tabela `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id_entrega`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`fornecedor_id`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`funcionario_id`);

--
-- Índices para tabela `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`insumo_id`);

--
-- Índices para tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD PRIMARY KEY (`item_venda_id`),
  ADD KEY `venda_id` (`venda_id`);

--
-- Índices para tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`pessoa_id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`produto_id`);

--
-- Índices para tabela `produto_insumo`
--
ALTER TABLE `produto_insumo`
  ADD PRIMARY KEY (`produto_id`,`insumo_id`),
  ADD KEY `insumo_id` (`insumo_id`);

--
-- Índices para tabela `p_fisica`
--
ALTER TABLE `p_fisica`
  ADD PRIMARY KEY (`pfisica_id`);

--
-- Índices para tabela `p_juridica`
--
ALTER TABLE `p_juridica`
  ADD PRIMARY KEY (`pjuridica_id`);

--
-- Índices para tabela `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`telefone_id`),
  ADD KEY `id_pessoa` (`pessoa_id`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`venda_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `despacho`
--
ALTER TABLE `despacho`
  MODIFY `despacho_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `iddespesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `despesa_categoria`
--
ALTER TABLE `despesa_categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `endereco_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de tabela `entradas`
--
ALTER TABLE `entradas`
  MODIFY `identrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id_entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `insumo`
--
ALTER TABLE `insumo`
  MODIFY `insumo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  MODIFY `item_venda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `pessoa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de tabela `telefone`
--
ALTER TABLE `telefone`
  MODIFY `telefone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `venda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `despacho`
--
ALTER TABLE `despacho`
  ADD CONSTRAINT `despacho_ibfk_1` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`venda_id`);

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`pessoa_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD CONSTRAINT `fornecedor_ibfk_1` FOREIGN KEY (`fornecedor_id`) REFERENCES `pessoa` (`pessoa_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `cadastro_id` FOREIGN KEY (`funcionario_id`) REFERENCES `pessoa` (`pessoa_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD CONSTRAINT `itens_venda_ibfk_1` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`venda_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `produto_insumo`
--
ALTER TABLE `produto_insumo`
  ADD CONSTRAINT `produto_insumo_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `produto_insumo_ibfk_2` FOREIGN KEY (`insumo_id`) REFERENCES `insumo` (`insumo_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `p_fisica`
--
ALTER TABLE `p_fisica`
  ADD CONSTRAINT `p_fisica_ibfk_1` FOREIGN KEY (`pfisica_id`) REFERENCES `pessoa` (`pessoa_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `p_juridica`
--
ALTER TABLE `p_juridica`
  ADD CONSTRAINT `p_juridica_ibfk_1` FOREIGN KEY (`pjuridica_id`) REFERENCES `pessoa` (`pessoa_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`pessoa_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
