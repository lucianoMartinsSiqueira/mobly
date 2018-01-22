-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Jan-2018 às 13:54
-- Versão do servidor: 5.7.9
-- ...
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `cliente_id`, `produto_id`, `quantidade`, `status`, `data_registro`) VALUES
(1, 6, 4, 1, 1, '2018-01-21 16:44:32'),
(2, 6, 2, 1, 1, '2018-01-21 16:44:38'),
(3, 6, 3, 1, 1, '2018-01-21 17:00:44');

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

--
-- Extraindo dados da tabela `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('b90bd36e7299cc545024f34e3799b7fecd837c0d', '::1', 1516486630, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438363334333b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('f3a3fa834aef7273050aa9916c7bafc01be3236e', '::1', 1516485806, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438353538323b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('2a4b2f4d54baa942cca0c5cb89199a541b38db01', '::1', 1516485256, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438353039313b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('48997c954b66fc469bd05db39550eec717a98686', '::1', 1516485053, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438343738363b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('f30b65082b75c8e58a9ce532e1444b6ad2baa83d', '::1', 1516484732, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438343437303b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('d89dafe861efc592924f5fc45c349b6dafdf444f', '::1', 1516484414, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438343135363b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('0aa1000a19fdd6f6ce5233dd1348e3929fbb4303', '::1', 1516484044, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438333739373b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('4130e494e5ee1a4af019741d579108de2ddcb674', '::1', 1516483570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438333337353b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('7dfa06c8b4b8916530bd5fbaac98418f94576d26', '::1', 1516483342, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438333035323b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('41583a1c6d436bed7b180e9d388de3298e992bb0', '::1', 1516482912, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438323732363b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('6b577751af8c745c76feaf65d517eb31582e9d9e', '::1', 1516481731, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438313635383b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('99a4fe18010662dcbbd6efbcb57f9cc2909ce94a', '::1', 1516479774, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437393737303b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('17357c3300dd935b8262e2f03a2d7c44c3cea107', '::1', 1516479607, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437393432313b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('bd6c5e2b06ba8d62986af5ece2862d2ee4029e02', '::1', 1516479054, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437393035343b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('868d044a11f5ad54485a2b0a7f0a06ed264ced88', '::1', 1516478923, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437383637373b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('e795a0e958e9a29279f8bd26b862346a3a13f73b', '::1', 1516478666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437383337323b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('17aa7173a09ec8792f50aec67c8ad5626e7f179c', '::1', 1516478300, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437383031373b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('487695ecd52d1cee0e3e0152bfa5c2e93a5ed94b', '::1', 1516477663, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437373438313b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('cfbc7cac63ce512de466d5cf9179f025043b3a7c', '::1', 1516477338, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437373038313b),
('a3b3a551ddef2cfcad567524ff0bccee6bc48767', '::1', 1516476576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363437363537363b),
('5c7edb02537fb2787c93d7c37f3ea6508cb265c6', '::1', 1516398407, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339383337353b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('27fd477c30c399d9311e8d75284841d43923a686', '::1', 1516396892, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339363730313b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('5efc7473727c180efad513f1f99af090b33e056b', '::1', 1516396691, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339363339323b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('9347a1cbf272711bbbcd65a266391bbd8584b8fb', '::1', 1516396195, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339353839373b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('70653fc23977ed7c83a54ec3c4255f711ddaa89e', '::1', 1516395594, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339353539343b),
('51f27f3a7cd63dc737fa5915b9b542ac95b38945', '::1', 1516395378, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339353234383b),
('80a54b92f38a7d4c2be6a523d3972ecfaf12046e', '::1', 1516391965, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339313834323b),
('7c5919f5c64f7d4e9b85f627f53cc54af223ac2d', '::1', 1516391805, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339313531393b),
('c9a1b7bff90af4ec7e68c3ac166aef283c3b2736', '::1', 1516391350, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339313138383b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('799f1921f02918c4b593d26e7b503cfc942eed15', '::1', 1516391175, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339303837373b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('c9c69ee9fd541914f5d787d16cec7e562dfa0dfd', '::1', 1516390781, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339303533363b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('f1fdd1b5ede38e937a0b48bfd7c3ca6607ecde9b', '::1', 1516390471, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363339303137383b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('f588d2454481fc36dc28784559eeba4f3ffbed6b', '::1', 1516389916, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363338393834313b),
('1773bf505e6325980cde0670f6284610ac0832a8', '::1', 1516382100, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363338313837363b),
('34eb58d1b8223fd279d9cafc1655f878c1a928e1', '::1', 1516382272, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363338323138323b),
('5b6411e31e12efbb3ce74a37bd68daf8fb1787ef', '::1', 1516384313, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363338343039383b),
('df68527e2d13daea0892f680ce975aacc2e7a5c7', '::1', 1516384506, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363338343432383b),
('5dd5cc531b36dddf757c5cf2051c6b8785512223', '::1', 1516385059, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363338343832333b7375636573737c733a31393a22436164617374726f205265616c697a61646f21223b),
('daf13393703a266aa33823b3fa83322923d3dd42', '::1', 1516388350, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363338383037353b7375636573737c733a31393a22436164617374726f205265616c697a61646f21223b),
('547c3e2aa763696e082d3d3bfb2124ff1917036c', '::1', 1516388535, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363338383430383b7375636573737c733a31393a22436164617374726f205265616c697a61646f21223b),
('cb45f8388230d0c3d233cf88ee58d17b75e99171', '::1', 1516389043, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363338383736333b7375636573737c733a33313a22436164617374726f205265616c697a61646f20636f6d205375636573736f21223b),
('2fe34d899c96fe19f63b1deb11433ac6fb09a0e6', '::1', 1516487017, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363438363734333b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('21a0b957644afdf87778570b3c7f594dd8dba92f', '::1', 1516553039, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535323831363b),
('f8474ea7a0b6eb29c6325515143a961b6b31a0aa', '::1', 1516553455, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535333230303b),
('012d2f76dc54b94d50e29bb3a11d8807422527c3', '::1', 1516553618, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535333530373b),
('c32bcb44ec73c9206da209bbfe7f35f356ed35c1', '::1', 1516554112, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535333834353b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('ce2acc0d7f0c47f4c8200a23f8e98c9a1c716555', '::1', 1516554437, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535343135313b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b6174656e74696f6e7c733a38313a224ec3a36f20666f6920706f7373c3ad76656c207265616c697a6172206f20636164617374726f2c20766572696669717565206f732070726f626c656d61732061626169786f3a203c62722f3e3c62722f3e223b),
('024139e977d4a26200bb4d4c18654e6c5e049e05', '::1', 1516554622, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535343436353b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b6174656e74696f6e7c733a38313a224ec3a36f20666f6920706f7373c3ad76656c207265616c697a6172206f20636164617374726f2c20766572696669717565206f732070726f626c656d61732061626169786f3a203c62722f3e3c62722f3e223b),
('01c7d8d2e722dc9460fc7fb57f5dba384f6d78ba', '::1', 1516554981, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535343831303b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('c6470a521ee6081327307e824ec07df246254eb1', '::1', 1516556667, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535363631373b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('021522ff501ae911ce46c490104ae1f048be5fae', '::1', 1516557537, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535373234323b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('3dac4eed90808a2ec1afd8bed8b534406291d320', '::1', 1516557617, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535373539303b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('23caf7cb9c82991284c85123e0c78912c1b5d33b', '::1', 1516558189, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535373930323b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('8e8e7f5264b4f3f388d6ea265f4f964059ba2df7', '::1', 1516558424, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535383230393b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('c7706444ce017d08419e8da729d3041f22f86a3b', '::1', 1516558775, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535383533333b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('65c21ed33afd5aa9423c3b6c9f0290a650a1a5e3', '::1', 1516559238, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535393231313b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('5bf014b8eeab56671bbd0e203d488e4a615f0003', '::1', 1516559761, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535393535393b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('fae8950e9182a4a9aeabff591ac944ca3b9cf547', '::1', 1516560283, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363535393938353b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('b853d651362d17a3811e9f179060874e00ac2494', '::1', 1516560389, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363536303238373b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('ddf43db9a9f58f17ef88dd0f8e2e2ef4f67a69ff', '::1', 1516560895, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363536303539353b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('9ec82b490d237e6ca69dc5dcf984853a2ab84575', '::1', 1516561237, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363536303933373b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('8a06efcadff9c9253b5f66f1429d8b58e048d5d3', '::1', 1516561297, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363536313234303b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b),
('a4803cc876a3676c7629ad170b248f01215d2e90', '::1', 1516561758, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363536313539353b636c69656e74655f69647c733a313a2236223b636c69656e74655f6e6f6d657c733a373a224c756369616e6f223b);

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `cpf`, `rg`, `sexo`, `email`, `senha`, `status`, `data_registro`, `ultima_modificacao`) VALUES
(6, 'Luciano', '097.431.836-12', '123124', 'M', 'lucianocomputacao@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2018-01-19 17:10:43', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `cliente_id`, `logradouro`, `numero`, `bairro`, `cidade`, `uf`, `cep`, `complemento`, `data_registro`, `ultima_modificacao`) VALUES
(2, 6, 'Manoel José de Almeida', '91', 'Colinas Park', 'Alfenas', 'MG', '37130-000', 'nada', '2018-01-21 09:23:26', NULL),
(3, 6, 'João Paulino Damasceno', '789', 'Centro', 'Alfenas', 'MG', '37130-001', 'nada nada', '2018-01-17 06:18:20', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `log_cliente`
--

INSERT INTO `log_cliente` (`id`, `cliente_id`, `operacao`, `plataforma`, `ip`, `data_registro`) VALUES
(3, 6, 'Novo Cadastro', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 17:10:43'),
(4, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 17:32:15'),
(5, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 17:32:29'),
(6, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 17:32:46'),
(7, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 17:32:57'),
(8, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 17:35:43'),
(9, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 17:36:25'),
(10, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 17:37:04'),
(11, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 17:38:48'),
(12, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 17:39:39'),
(13, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 17:55:31'),
(14, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 19:07:29'),
(15, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 19:07:46'),
(16, 3, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-19 19:46:47'),
(17, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 17:47:36'),
(18, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 17:53:55'),
(19, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 17:54:17'),
(20, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 17:56:35'),
(21, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 17:56:56'),
(22, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 17:57:06'),
(23, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 17:57:32'),
(24, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 17:58:08'),
(25, 1, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 18:22:53'),
(26, 4, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 20:19:15'),
(27, 5, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 20:21:11'),
(28, 1, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 20:21:16'),
(29, 1, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 20:21:18'),
(30, 1, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 20:21:21'),
(31, 6, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 20:22:58'),
(32, 1, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-20 20:23:11'),
(33, 7, 'Novo Cadastro', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 14:52:09'),
(34, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 15:01:50'),
(35, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 15:02:39'),
(36, 8, 'Novo Cadastro', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 15:13:55'),
(37, 9, 'Novo Cadastro', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 15:14:04'),
(38, 7, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:09:28'),
(39, 1, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:26:57'),
(40, 2, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:27:07'),
(41, 3, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:27:18'),
(42, 5, 'Registrar Pedido', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:34:48'),
(43, 6, 'Registrar Pedido', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:35:17'),
(44, 1, 'Registrar Pedido', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:36:01'),
(45, 1, 'Registrar Pedido', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:39:49'),
(46, 3, 'Registrar Pedido', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:42:37'),
(47, 1, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:44:32'),
(48, 2, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:44:38'),
(49, 1, 'Registrar Pedido', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 16:44:47'),
(50, 3, 'Carrinho: Adicionar Produto', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 17:00:44'),
(51, 2, 'Registrar Pedido', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 17:00:50'),
(52, 6, 'login', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0', '::1', '2018-01-21 17:09:13');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id`, `cliente_id`, `endereco_id`, `valor`, `situacao`, `data_registro`) VALUES
(1, 6, 2, '495.91', 0, '2018-01-21 16:44:47'),
(2, 6, 3, '495.91', 0, '2018-01-21 17:00:50');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido_produto`
--

INSERT INTO `pedido_produto` (`id`, `pedido_id`, `produto_id`, `data_registro`) VALUES
(1, 1, 4, '2018-01-21 16:44:47'),
(2, 1, 2, '2018-01-21 16:44:47'),
(3, 2, 3, '2018-01-21 17:00:50');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `imagem`, `preco`, `visualizacao`, `status`, `registrado_por`, `data_registro`, `modificado_por`, `data_modificacao`) VALUES
(1, 'Sofá 3 Lugares Retrátil e Reclinável Eureka Suede Capuccino', 'Imagine que delícia poder se esticar quando chegar a sua casa depois de um dia de trabalho! O Sofá Eureka garante todo o conforto necessário para que você possa descansar. Reclinável e retrátil, ele é tudo o que você precisa. Sua sala ficará aconchegante e muito bonita. Fabricado com materiais de ótima qualidade e revestido em suede, tecido de toque suave e delicado, este móvel fará toda a diferença no ambiente. Perfeito, né?', '0001.jpg', '999.00', 0, 1, 1, '2018-01-17 17:21:24', 1, '2018-01-17 17:21:24'),
(2, 'Sofá de Canto 5 Lugares Direito Cartagena Suede Cinza', 'Com estilo luxuoso e atual, o Sofá Cartagena é o item que faltava para compor sua sala e deixá-la ainda mais bonita. Com 5 lugares, ele acomoda perfeitamente os amigos ou a família para uma deliciosa sessão de cinema. Seu revestimento em suede amassado proporciona um toque suave e macio. A cor cinza transmite tranquilidade e deixa o ambiente com visual clean. É exatamente o que estava procurando, não é?', '0004.jpg', '1299.00', 0, 1, 1, '2018-01-17 10:27:27', NULL, NULL),
(3, 'Sofá de Canto 6 Lugares com Chaise Astor Suede Marrom', 'Deixe seu lar mais confortável e receptivo com a ajuda do Sofá de Canto com Chaise Astor. Perfeito para complementar a sua casa e deixá-la sempre pronta para receber a visita de familiares, amigos e convidados.', '0007.jpg', '1199.00', 0, 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(4, 'Sofá 3 Lugares Larissa Suede Marrom', '3 lugares para acomodar a todos e ainda garantir aquele toque especial ao cômodo, já que seu revestimento é em suede, tecido macio e suave ao toque.', '0010.jpg', '899.00', 0, 1, 1, '2018-01-17 06:18:20', NULL, NULL),
(5, 'Sofá 3 Lugares Living Base de Madeira com Chaise Suede Vermelho', 'Este maravilhoso Sofá Living, além de ser incrivelmente belo, irá compor a decoração de sua casa com todo o aconchego que deseja! Com chaise, a peça vai deixar os seus momentos de relaxamento ainda mais agradáveis e confortáveis. O móvel possui a base em madeira e é estruturado em madeira eucalipto de reflorestamento, o que garante ao produto muita resistência e durabilidade. O enchimento de seu assento é feito com espuma D28 e D26 revestida com manta acrílica, o que fará com você queira passar o máximo de seu tempo livre aproveitando o aconchego e conforto deste móvel. Seu revestimento em suéde na cor vermelha garantirá a elegância e a sofisticação para a sua sala! Aproveite!', '0013.jpg', '2391.00', 0, 1, 1, '2018-01-17 06:18:20', NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto_categoria`
--

INSERT INTO `produto_categoria` (`id`, `produto_id`, `categoria_id`, `registrado_por`, `data_registro`) VALUES
(1, 1, 1, 1, '2018-01-17 10:27:27'),
(2, 1, 2, 1, '2017-12-27 07:21:24'),
(3, 2, 1, 1, '2018-01-17 06:18:20'),
(4, 3, 1, 1, '2018-01-17 06:18:20'),
(5, 4, 1, 1, '2018-01-17 06:18:20'),
(6, 5, 1, 1, '2018-01-17 06:18:20');

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

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
(15, 5, '0015.jpg', 1, '2018-01-17 06:18:20');

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
