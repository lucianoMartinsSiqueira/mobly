-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Jan-2018 às 23:44
-- Versão do servidor: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newshop`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `caracteristica`
--

DROP TABLE IF EXISTS `caracteristica`;
CREATE TABLE IF NOT EXISTS `caracteristica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0: inativo / 1: ativo',
  `registrado_por` int(11) NOT NULL,
  `data_registro` datetime NOT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0: carrinho / 1: pedido / 2: cancelado',
  `data_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `produto_id` (`produto_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0: inativo / 1: ativo',
  `registrado_por` int(11) NOT NULL,
  `data_registro` datetime NOT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nome` (`nome`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `status`, `registrado_por`, `data_registro`, `modificado_por`, `data_modificacao`) VALUES
(1, 'Sofá', 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(2, 'Poltronas', 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(3, 'Camas', 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(4, 'Mesas', 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(5, 'Guarda-Roupas', 1, 1, '2018-01-17 06:18:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `sexo` enum('M','F') NOT NULL COMMENT 'M / F',
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0: inativo | 1: ativo',
  `data_registro` datetime NOT NULL,
  `ultima_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nome` (`nome`),
  KEY `cpf` (`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `logradouro` varchar(50) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `data_registro` datetime NOT NULL,
  `ultima_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_admin`
--

DROP TABLE IF EXISTS `log_admin`;
CREATE TABLE IF NOT EXISTS `log_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `referencia_id` int(11) NOT NULL COMMENT 'ID do registro modificado',
  `tabela` varchar(30) NOT NULL,
  `operacao` varchar(30) NOT NULL,
  `query` text NOT NULL,
  `ip` varchar(20) NOT NULL,
  `data_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_cliente`
--

DROP TABLE IF EXISTS `log_cliente`;
CREATE TABLE IF NOT EXISTS `log_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `operacao` varchar(30) NOT NULL,
  `plataforma` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `data_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `endereco_id` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `situacao` int(11) NOT NULL COMMENT '0: aberto / 1: concluido / 2: cancelado',
  `data_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_produto`
--

DROP TABLE IF EXISTS `pedido_produto`;
CREATE TABLE IF NOT EXISTS `pedido_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `data_registro` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

DROP TABLE IF EXISTS `permissao`;
CREATE TABLE IF NOT EXISTS `permissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` text,
  `status` int(11) NOT NULL COMMENT '0: inativo | 1: ativo',
  `registrado_por` int(11) NOT NULL,
  `data_registro` datetime NOT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(50) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `visualizacao` int(11) DEFAULT '0',
  `status` int(11) NOT NULL COMMENT '0: inativo / 1: ativo',
  `registrado_por` int(11) NOT NULL,
  `data_registro` datetime NOT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nome` (`nome`),
  KEY `preco` (`preco`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `imagem`, `preco`, `visualizacao`, `status`, `registrado_por`, `data_registro`, `modificado_por`, `data_modificacao`) VALUES
(1, 'Sofá 3 Lugares Retrátil e Reclinável Eureka Suede Capuccino', 'Imagine que delícia poder se esticar quando chegar a sua casa depois de um dia de trabalho! O Sofá Eureka garante todo o conforto necessário para que você possa descansar. Reclinável e retrátil, ele é tudo o que você precisa. Sua sala ficará aconchegante e muito bonita. Fabricado com materiais de ótima qualidade e revestido em suede, tecido de toque suave e delicado, este móvel fará toda a diferença no ambiente. Perfeito, né?', '0001.jpg', '999.00', 0, 1, 1, '2018-01-17 17:21:24', 1, '2018-01-17 17:21:24'),
(2, 'Sofá de Canto 5 Lugares Direito Cartagena Suede Cinza', 'Com estilo luxuoso e atual, o Sofá Cartagena é o item que faltava para compor sua sala e deixá-la ainda mais bonita. Com 5 lugares, ele acomoda perfeitamente os amigos ou a família para uma deliciosa sessão de cinema. Seu revestimento em suede amassado proporciona um toque suave e macio. A cor cinza transmite tranquilidade e deixa o ambiente com visual clean. É exatamente o que estava procurando, não é?', '0004.jpg', '1299.00', 0, 1, 1, '2018-01-17 10:27:27', NULL, NULL),
(3, 'Sofá de Canto 6 Lugares com Chaise Astor Suede Marrom', 'Deixe seu lar mais confortável e receptivo com a ajuda do Sofá de Canto com Chaise Astor. Perfeito para complementar a sua casa e deixá-la sempre pronta para receber a visita de familiares, amigos e convidados.', '0007.jpg', '1199.00', 0, 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(4, 'Sofá 3 Lugares Larissa Suede Marrom', '3 lugares para acomodar a todos e ainda garantir aquele toque especial ao cômodo, já que seu revestimento é em suede, tecido macio e suave ao toque.', '0010.jpg', '899.00', 0, 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(5, 'Sofá 3 Lugares Living Base de Madeira com Chaise Suede Vermelho', 'Este maravilhoso Sofá Living, além de ser incrivelmente belo, irá compor a decoração de sua casa com todo o aconchego que deseja! Com chaise, a peça vai deixar os seus momentos de relaxamento ainda mais agradáveis e confortáveis. O móvel possui a base em madeira e é estruturado em madeira eucalipto de reflorestamento, o que garante ao produto muita resistência e durabilidade. O enchimento de seu assento é feito com espuma D28 e D26 revestida com manta acrílica, o que fará com você queira passar o máximo de seu tempo livre aproveitando o aconchego e conforto deste móvel. Seu revestimento em suéde na cor vermelha garantirá a elegância e a sofisticação para a sua sala! Aproveite!', '0013.jpg', '2391.00', 0, 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(6, 'Cama Box de Casal Guldi Branco', 'Uma boa noite de sono proporciona mais bem-estar e melhora a qualidade de vida, não é verdade? Para que suas noites sejam mais reconfortantes, esta incrível Cama Box Guldi é uma excelente opção. O modelo no tamanho casal apresenta a estrutura em madeira de eucalipto reflorestada, que não agride a natureza e oferece maior resistência, revestido em couro sintético, material ecológicamente correto. Tudo isso para que você tenha noites de sono melhores. Demais, não é? Leva!', '16.jpg', '308.00', 0, 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(7, 'Beliche Bogart Escada Fixa Mel Acetinando', 'Essa é especial para quem gosta de poupar espaço. O Beliche Bogart com Escada Fixa acomoda duas pessoas na hora de dormir. Confeccionada com madeira pinus de qualidade, as camas são resistentes e garante segurança enquanto você repousa. Perfeito, né? Aproveite! ', '19.jpg', '636.99', 0, 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(8, 'Treliche 3 Gavetas 123 Castanho', 'Se quer um lugar seguro para dormir, que seja capaz de acomodar mais de uma pessoa, mas não ocupe muito espaço no seu dormitório, vai amar a Treliche. Bonita, ela é confeccionada com materiais resistentes e de qualidade. : ) ', '23.jpg', '1426.99', 0, 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(9, 'Cama Box de Solteiro Guldi Prata', 'Uma boa noite de sono proporciona mais bem-estar e melhora a qualidade de vida, não é verdade? Para que suas noites sejam mais reconfortantes, esta incrível Cama Box Guldi é uma excelente opção. O modelo no tamanho solteiro apresenta a estrutura em madeira de eucalipto reflorestada, que não agride a natureza e oferece maior resistência, revestido em couro sintético, material ecológicamente correto. Tudo isso para que você tenha noites de sono melhores. Demais, não é? Leva!', '26.jpg', '289.00', 0, 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(10, 'Base Box com Baú Casal 46x138x188 Preto', 'O seu quarto vive uma bagunça por falta de espaço? Então nós resolvemos o teu problema! Com esse Box com Baú Tutibox isso será solucionado de uma maneira simples e elegante. A peça de estrutura firme proporciona uma decoração sofisticada e moderna ao dormitório. A abertura conta com base basculante e uma alça na parte frontal para facilitar ao abrir e fechar. É muito espaço para você guardar o que desejar e ainda manter o ambiente chique e organizado. Curtiu? : )', '29.jpg', '739.99', 0, 1, 1, '2018-01-17 06:18:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_caracteristica`
--

DROP TABLE IF EXISTS `produto_caracteristica`;
CREATE TABLE IF NOT EXISTS `produto_caracteristica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `caracteristica_id` int(11) NOT NULL,
  `registrado_por` int(11) NOT NULL,
  `data_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produto_id` (`produto_id`),
  KEY `caracteristica_id` (`caracteristica_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_categoria`
--

DROP TABLE IF EXISTS `produto_categoria`;
CREATE TABLE IF NOT EXISTS `produto_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `registrado_por` int(11) NOT NULL,
  `data_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produto_id` (`produto_id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto_categoria`
--

INSERT INTO `produto_categoria` (`id`, `produto_id`, `categoria_id`, `registrado_por`, `data_registro`) VALUES
(1, 1, 1, 1, '2018-01-17 10:27:27'),
(2, 1, 2, 1, '2017-12-27 07:21:24'),
(3, 2, 1, 1, '2018-01-17 06:18:20'),
(4, 3, 1, 1, '2018-01-17 06:18:20'),
(5, 4, 1, 1, '2018-01-17 06:18:20'),
(6, 5, 1, 1, '2018-01-17 06:18:20'),
(7, 6, 3, 1, '2018-01-17 06:18:20'),
(8, 7, 3, 1, '2018-01-17 06:18:20'),
(9, 8, 3, 1, '2018-01-17 06:18:20'),
(10, 9, 3, 1, '2018-01-17 06:18:20'),
(11, 10, 3, 1, '2018-01-17 06:18:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_imagem`
--

DROP TABLE IF EXISTS `produto_imagem`;
CREATE TABLE IF NOT EXISTS `produto_imagem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `imagem` varchar(50) NOT NULL,
  `registrado_por` int(11) NOT NULL,
  `data_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produto_id` (`produto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto_imagem`
--

INSERT INTO `produto_imagem` (`id`, `produto_id`, `imagem`, `registrado_por`, `data_registro`) VALUES
(1, 1, '0001.jpg', 1, '2018-01-17 06:18:20'),
(2, 1, '0002.jpg', 1, '2018-01-17 06:18:20'),
(3, 1, '0003.jpg', 1, '2018-01-17 06:18:20'),
(4, 2, '0004.jpg', 1, '2018-01-17 06:18:20'),
(5, 2, '0005.jpg', 1, '2018-01-17 06:18:20'),
(6, 2, '0006.jpg', 1, '2018-01-17 06:18:20'),
(7, 3, '0007.jpg', 1, '2018-01-17 06:18:20'),
(8, 3, '0008.jpg', 1, '2018-01-17 06:18:20'),
(9, 3, '0009.jpg', 1, '2018-01-17 06:18:20'),
(10, 4, '0010.jpg', 1, '2018-01-17 06:18:20'),
(11, 4, '0011.jpg', 1, '2018-01-17 06:18:20'),
(12, 4, '0012.jpg', 1, '2018-01-17 06:18:20'),
(13, 5, '0013.jpg', 1, '2018-01-17 06:18:20'),
(14, 5, '0014.jpg', 1, '2018-01-17 06:18:20'),
(15, 5, '0015.jpg', 1, '2018-01-17 06:18:20'),
(16, 6, '16.jpg', 1, '2018-01-17 06:18:20'),
(17, 6, '17.jpg', 1, '2018-01-17 06:18:20'),
(18, 6, '18.jpg', 1, '2018-01-17 06:18:20'),
(19, 7, '19.jpg', 1, '2018-01-17 06:18:20'),
(20, 7, '20.jpg', 1, '2018-01-17 06:18:20'),
(21, 7, '21.jpg', 1, '2018-01-17 06:18:20'),
(22, 8, '22.jpg', 1, '2018-01-17 06:18:20'),
(23, 8, '23.jpg', 1, '2018-01-17 06:18:20'),
(24, 8, '24.jpg', 1, '2018-01-17 06:18:20'),
(25, 9, '25.jpg', 1, '2018-01-17 06:18:20'),
(26, 9, '26.jpg', 1, '2018-01-17 06:18:20'),
(27, 9, '27.jpg', 1, '2018-01-17 06:18:20'),
(28, 10, '28.jpg', 1, '2018-01-17 06:18:20'),
(29, 10, '29.jpg', 1, '2018-01-17 06:18:20'),
(30, 10, '30.jpg', 1, '2018-01-17 06:18:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permissao_id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `sessao` varchar(50) DEFAULT NULL,
  `ultimo_acesso` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `registrado_por` int(11) NOT NULL COMMENT '0: inativo / 1 : ativo',
  `data_registro` datetime NOT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `premissao_id` (`permissao_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
