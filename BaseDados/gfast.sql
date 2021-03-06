-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 18-Fev-2022 às 22:32
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gfast`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1634936385),
('admin', '2', 1634936510),
('admin', '3', 1634936558),
('admin', '8', 1636407591),
('cliente', '12', 1641422018),
('cliente', '14', 1641423182),
('cliente', '15', 1641423206),
('cliente', '16', 1641423385),
('cliente', '20', 1641426924),
('cliente', '22', 1641479117),
('cliente', '6', 1636061825),
('cliente', '7', 1636145673),
('cliente', '9', 1642457693),
('funcionario', '4', 1636061741),
('gestor', '5', 1636061780);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('adicionarOwnCarrinho', 2, 'Adicionar ao Próprio Carrinho', 'isCliente', NULL, 1636219415, 1636219415),
('adicionarOwnSaldo', 2, 'Adicionar Saldo', 'isCliente', NULL, 1636219415, 1636219415),
('admin', 1, NULL, NULL, NULL, 1636219415, 1636219415),
('alterarEncomenda', 2, 'Alterar Encomendas', NULL, NULL, 1636219415, 1636219415),
('cliente', 1, NULL, NULL, NULL, 1636219415, 1636219415),
('crudCategorias', 2, 'CRUD Categorias', NULL, NULL, 1636219415, 1636219415),
('crudConcertos', 2, 'CRUD Concertos', NULL, NULL, 1636219415, 1636219415),
('crudEncomendas', 2, 'crud Encomendas', 'isCliente', NULL, 1636219415, 1636219415),
('crudLojas', 2, 'CRUD Lojas', NULL, NULL, 1636219415, 1636219415),
('crudMarcas', 2, 'CRUD Marcas', NULL, NULL, 1636219415, 1636219415),
('crudOwnAvaliacao', 2, 'CRUD à Propria Avaliação', 'isCliente', NULL, 1636219415, 1636219415),
('crudPontos', 2, 'CRUD Pontos', NULL, NULL, 1636219415, 1636219415),
('crudSubCategorias', 2, 'CRUD SubCategorias', NULL, NULL, 1636219415, 1636219415),
('crudtabelaGuitarras', 2, 'CRUD Tabela Guitarras', NULL, NULL, 1636219415, 1636219415),
('crudUsers', 2, 'CRUD Users', NULL, NULL, 1636219415, 1636219415),
('editarOwnPerfil', 2, 'Editar Próprio Perfil', 'isCliente', NULL, 1636219415, 1636219415),
('eliminarOwnCarrinho', 2, 'Eliminar Próprio Carrinho', 'isCliente', NULL, 1636219415, 1636219415),
('fazerOwnEncomenda', 2, 'Fazer Próprias Encomendas', 'isCliente', NULL, 1636219415, 1636219415),
('funcionario', 1, NULL, NULL, NULL, 1636219415, 1636219415),
('gestor', 1, NULL, NULL, NULL, 1636219415, 1636219415),
('logout', 2, 'Logout', NULL, NULL, 1636219415, 1636219415),
('verOwnCarrinho', 2, 'Ver Proprio Carrinho', 'isCliente', NULL, 1636219415, 1636219415),
('verOwnEncomenda', 2, 'Ver Próprias Encomendas', 'isCliente', NULL, 1636219415, 1636219415),
('verOwnPerfil', 2, 'Ver Perfil', 'isCliente', NULL, 1636219415, 1636219415),
('verOwnPontos', 2, 'Ver Próprios Pontos', 'isCliente', NULL, 1636219415, 1636219415),
('verOwnSaldo', 2, 'Ver Próprio Saldo', 'isCliente', NULL, 1636219415, 1636219415);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('cliente', 'adicionarOwnCarrinho'),
('cliente', 'adicionarOwnSaldo'),
('admin', 'cliente'),
('funcionario', 'cliente'),
('gestor', 'cliente'),
('gestor', 'crudCategorias'),
('gestor', 'crudConcertos'),
('funcionario', 'crudEncomendas'),
('admin', 'crudLojas'),
('gestor', 'crudMarcas'),
('cliente', 'crudOwnAvaliacao'),
('gestor', 'crudPontos'),
('gestor', 'crudSubCategorias'),
('gestor', 'crudtabelaGuitarras'),
('admin', 'crudUsers'),
('cliente', 'editarOwnPerfil'),
('cliente', 'eliminarOwnCarrinho'),
('cliente', 'fazerOwnEncomenda'),
('admin', 'funcionario'),
('gestor', 'funcionario'),
('admin', 'gestor'),
('cliente', 'logout'),
('cliente', 'verOwnCarrinho'),
('cliente', 'verOwnEncomenda'),
('cliente', 'verOwnPontos'),
('cliente', 'verOwnSaldo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isCliente', 0x4f3a32353a2266726f6e74656e645c726261635c436c69656e746552756c65223a333a7b733a343a226e616d65223b733a393a226973436c69656e7465223b733a393a22637265617465644174223b693a313633363231393431353b733a393a22757064617465644174223b693a313633363231393431353b7d, 1636219415, 1636219415);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes`
--

DROP TABLE IF EXISTS `avaliacoes`;
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `ava_id` int(11) NOT NULL AUTO_INCREMENT,
  `ava_avaliacao` varchar(45) NOT NULL,
  `ava_idguitarra` int(11) NOT NULL,
  `ava_iduser` int(11) NOT NULL,
  PRIMARY KEY (`ava_id`),
  KEY `user_avaliacoes_fk` (`ava_iduser`),
  KEY `guitarras_avaliacoes_fk` (`ava_idguitarra`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`ava_id`, `ava_avaliacao`, `ava_idguitarra`, `ava_iduser`) VALUES
(24, 'Era Mesmo esta que eu queria!!', 5, 8),
(29, 'testesss', 7, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bilhetes`
--

DROP TABLE IF EXISTS `bilhetes`;
CREATE TABLE IF NOT EXISTS `bilhetes` (
  `bil_id` int(11) NOT NULL AUTO_INCREMENT,
  `bil_nome` varchar(20) NOT NULL,
  `bil_iduser` int(11) NOT NULL,
  `bil_idconcerto` int(11) NOT NULL,
  `bil_precopontos` int(11) NOT NULL,
  PRIMARY KEY (`bil_id`),
  KEY `bilhetes_concertos_fk` (`bil_idconcerto`),
  KEY `bilhetes_users_fk` (`bil_iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enc_id` int(11) DEFAULT NULL,
  `gui_id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `inativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enc_userid_fk` (`enc_id`),
  KEY `enc_guitar_fk` (`gui_id`),
  KEY `carrinho_user_fk` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `enc_id`, `gui_id`, `iduser`, `inativo`) VALUES
(28, 74, 15, 8, 1),
(29, 74, 8, 8, 1),
(30, 75, 9, 8, 1),
(31, 75, 8, 8, 1),
(32, 76, 8, 8, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoriaguitarra`
--

DROP TABLE IF EXISTS `categoriaguitarra`;
CREATE TABLE IF NOT EXISTS `categoriaguitarra` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nome` varchar(20) NOT NULL,
  `cat_inativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoriaguitarra`
--

INSERT INTO `categoriaguitarra` (`cat_id`, `cat_nome`, `cat_inativo`) VALUES
(1, 'Elétrica', 0),
(2, 'Acústica', 0),
(3, 'Classico', 0),
(4, 'Baixo', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `concertos`
--

DROP TABLE IF EXISTS `concertos`;
CREATE TABLE IF NOT EXISTS `concertos` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_nome` varchar(20) NOT NULL,
  `con_data` date NOT NULL,
  `con_descricao` varchar(255) NOT NULL,
  `con_idtipoconcerto` int(11) NOT NULL,
  `con_idpontos` int(11) NOT NULL,
  `con_inativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`con_id`),
  KEY `concertos_tipoconcerto_fk` (`con_idtipoconcerto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomendas`
--

DROP TABLE IF EXISTS `encomendas`;
CREATE TABLE IF NOT EXISTS `encomendas` (
  `enc_id` int(11) NOT NULL AUTO_INCREMENT,
  `enc_nome` varchar(20) DEFAULT NULL,
  `enc_morada` varchar(40) DEFAULT NULL,
  `enc_estado` int(11) NOT NULL,
  `enc_iduser` int(11) NOT NULL,
  PRIMARY KEY (`enc_id`),
  KEY `enc_estado_fk` (`enc_estado`),
  KEY `enc_userddd_fk` (`enc_iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `encomendas`
--

INSERT INTO `encomendas` (`enc_id`, `enc_nome`, `enc_morada`, `enc_estado`, `enc_iduser`) VALUES
(74, 'Teste', 'Rua do Teste', 3, 8),
(75, 'teste', 'teste', 1, 8),
(76, 'teste', 'teste', 1, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
CREATE TABLE IF NOT EXISTS `enderecos` (
  `end_id` int(11) NOT NULL AUTO_INCREMENT,
  `end_nome` varchar(20) NOT NULL,
  `end_iduser` int(11) NOT NULL,
  `end_tipo` tinyint(4) NOT NULL,
  `end_morada` varchar(20) NOT NULL,
  `end_cidade` varchar(20) NOT NULL,
  `end_codigopostal` varchar(8) NOT NULL,
  PRIMARY KEY (`end_id`),
  KEY `enderecos_user_fk` (`end_iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `Estado` varchar(255) NOT NULL,
  PRIMARY KEY (`est_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`est_id`, `Estado`) VALUES
(1, 'Pago'),
(2, 'Enviado'),
(3, 'Concluido');

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE IF NOT EXISTS `favoritos` (
  `fav_id` int(11) NOT NULL AUTO_INCREMENT,
  `fav_idguitarras` int(11) NOT NULL,
  `fav_iduser` int(11) NOT NULL,
  `fav_idsaldo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fav_id`),
  KEY `guitarras_carrinho_fk` (`fav_iduser`),
  KEY `carrinho_guitarra_fk` (`fav_idguitarras`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `favoritos`
--

INSERT INTO `favoritos` (`fav_id`, `fav_idguitarras`, `fav_iduser`, `fav_idsaldo`) VALUES
(84, 8, 6, NULL),
(85, 9, 6, NULL),
(101, 15, 8, NULL),
(102, 7, 8, NULL),
(103, 5, 8, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos`
--

DROP TABLE IF EXISTS `fotos`;
CREATE TABLE IF NOT EXISTS `fotos` (
  `fot_id` int(11) NOT NULL AUTO_INCREMENT,
  `fot_nome` varchar(20) NOT NULL,
  `fot_idguitarra` int(11) NOT NULL,
  `fot_idref` int(11) NOT NULL,
  `fot_tipofoto` varchar(20) NOT NULL,
  `fot_principal` varchar(20) NOT NULL,
  `fot_inativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`fot_id`),
  KEY `fotos_subcategoria_fk` (`fot_idguitarra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `guitarras`
--

DROP TABLE IF EXISTS `guitarras`;
CREATE TABLE IF NOT EXISTS `guitarras` (
  `gui_id` int(11) NOT NULL AUTO_INCREMENT,
  `gui_nome` varchar(20) NOT NULL,
  `gui_idsubcategoria` int(11) NOT NULL,
  `gui_idmarca` int(11) NOT NULL,
  `gui_idreferencia` varchar(255) NOT NULL,
  `gui_descricao` text NOT NULL,
  `gui_preco` float NOT NULL,
  `gui_iva` int(11) NOT NULL,
  `gui_fotopath` varchar(255) NOT NULL,
  `gui_qrcodepath` varchar(255) DEFAULT NULL,
  `gui_inativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`gui_id`),
  KEY `guitarra_subcategoria_fk` (`gui_idsubcategoria`),
  KEY `marca_subcategoria_fk` (`gui_idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `guitarras`
--

INSERT INTO `guitarras` (`gui_id`, `gui_nome`, `gui_idsubcategoria`, `gui_idmarca`, `gui_idreferencia`, `gui_descricao`, `gui_preco`, `gui_iva`, `gui_fotopath`, `gui_qrcodepath`, `gui_inativo`) VALUES
(5, 'SB1.7FRFM Flame Natu', 3, 1, 'GF0001', 'TESTETESTE', 123, 23, 'Epiphone SG Standard \'61 Vintage Cherry.jpg', NULL, 0),
(7, 'LTD Snakebyte SW', 9, 3, 'GF0003', 'James Hetfield Signature model\r\nBody: Mahogany\r\nSet-in neck: Mahogany\r\nFretboard: Makassar ebony\r\nNeck profile: Thin U\r\nFretboard radius: 350 mm (13.78\")\r\nScale: 629 mm (24.75\")\r\nNut width: 42 mm (1.65\")\r\n22 Extra jumbo frets\r\nPickup: 2 Active EMG JH humbuckers\r\n2 Volume controls\r\n3-Way toggle switch\r\nTonepros Locking TOM bridge and tailpiece\r\nLTD locking machine heads\r\nBlack hardware\r\nEx-factory stringing: D\'Addario XL110 (.010 - .046)\r\nColour: Snow White\r\nCase included', 1379, 23, 'ESP LTD Snakebyte SW.jpg', NULL, 0),
(8, 'LTD KH WZ', 4, 3, 'GF0004', 'Kirk Hammett (Metallica) White Zombie Signature Model\r\nBody: Alder\r\nNeck: Maple\r\nNeck attachment: Neck-thru (body)\r\nFretboard: Macassar Ebony\r\nNeck profile: Thin U\r\nFrets: 24 Extra jumbo\r\nNut width: 42 mm\r\nScale: 648 mm\r\nFretboard radius: 350 mm\r\nPickups: 2x Active EMG Bone Breaker humbuckers\r\nControls: Volume & Tone\r\n3-Way switch\r\nTremolo: Floyd Rose 1000\r\nHardware: Black\r\nMachine heads: LTD\r\nOriginal strings: D\'Addario XL120 .009 - .042\r\nColour: Black with White Zombie graphics\r\nIncludes a case\r\n', 1399, 23, 'ESP LTD KH WZ.jpg', NULL, 0),
(9, 'ESP_E_II_M_II_NT_BTB', 5, 9, 'GF0005', 'Body: Mahogany\r\nNeck: Mahogany\r\nFretboard: Indian Laurel\r\nTrapezoid fretboard inlays\r\nNeck profile: Slim taper\r\n22 Frets\r\nScale: 629 mm (24.75\")\r\nNut width 43 mm (1.693\")\r\nPickups: ProBucker-2 (neck) and ProBucker-3 (bridge) humbuckers\r\n2 x Volume and 2 x tone controls\r\nToggle switch\r\nCTS electronics\r\nLocktone ABR Tune-o-matic bridge\r\nStopable tailpiece\r\nEpiphone Deluxe Vintage 18: 1 machine heads\r\nColour: Vintage cherry', 441, 23, 'ESP_E_II_M_II_NT_BTB.jpg', NULL, 0),
(15, 'Charvel_Joe_Duplanti', 10, 13, 'G0010', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 356, 23, 'Charvel_Joe_Duplantier_Pro_Mod_SD_S2HH.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lojas`
--

DROP TABLE IF EXISTS `lojas`;
CREATE TABLE IF NOT EXISTS `lojas` (
  `loj_id` int(11) NOT NULL AUTO_INCREMENT,
  `loj_nome` varchar(20) NOT NULL,
  `loj_longitude` float NOT NULL,
  `loj_latitude` float NOT NULL,
  PRIMARY KEY (`loj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `mar_id` int(11) NOT NULL AUTO_INCREMENT,
  `mar_nome` varchar(20) NOT NULL,
  `mar_inativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`mar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`mar_id`, `mar_nome`, `mar_inativo`) VALUES
(1, 'Fender', 0),
(2, 'Yamaha', 0),
(3, 'ESP', 0),
(4, 'Charvel', 0),
(5, 'Ibanez', 0),
(6, 'Solar Guitars', 0),
(7, 'Jackson', 0),
(8, 'Dean Guitars', 0),
(9, 'Epiphone', 0),
(10, 'Danelectro', 0),
(11, 'Gibson', 0),
(12, 'D Angelico', 0),
(13, 'Alhambra', 0),
(14, 'Gewa', 0),
(15, 'Hamaril', 0),
(16, 'La Mancha', 0),
(17, 'Ortega', 0),
(18, 'Startone', 0),
(19, 'Harley Benton', 0),
(21, 'Cordoba', 0),
(22, 'Martinez', 0),
(23, 'Taylor', 0),
(24, 'Adamas', 0),
(25, 'Applause', 0),
(26, 'Ovation', 0),
(27, 'Marcuz Miller', 0),
(28, 'Sandberg', 0),
(29, 'Marleaux', 0),
(30, 'Warwick', 0),
(31, 'Schecter', 0),
(32, 'Sadowsky', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1634935888),
('m130524_201442_init', 1634935957),
('m140506_102106_rbac_init', 1634935942),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1634935942),
('m180523_151638_rbac_updates_indexes_without_prefix', 1634935942),
('m190124_110200_add_verification_token_column_to_user_table', 1634935957),
('m200409_110543_rbac_update_mssql_trigger', 1634935942),
('m211015_181754_init_rbac', 1634936059),
('m211104_144503_init_rbac', 1636219415);

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcategoriaguitarra`
--

DROP TABLE IF EXISTS `subcategoriaguitarra`;
CREATE TABLE IF NOT EXISTS `subcategoriaguitarra` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_nome` varchar(20) NOT NULL,
  `sub_idcat` int(11) NOT NULL,
  PRIMARY KEY (`sub_id`),
  KEY `sub_idcat` (`sub_idcat`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subcategoriaguitarra`
--

INSERT INTO `subcategoriaguitarra` (`sub_id`, `sub_nome`, `sub_idcat`) VALUES
(1, 'Modelo St', 1),
(2, 'teste', 2),
(3, 'Modelo T', 1),
(4, 'Modelo Signature', 1),
(5, 'Modelo SG', 1),
(6, 'Modelo LP', 1),
(7, 'Modelo Hollowbody', 1),
(8, 'Modelo Esquerdino El', 1),
(9, 'Modelo Alternativo E', 1),
(10, 'Modelo 7/8', 1),
(11, 'Modelo 1/2', 3),
(12, 'Modelo 1/4', 3),
(13, 'Modelo 1/8', 3),
(14, 'Modelo 3/4', 3),
(15, 'Modelo 7/8', 3),
(16, 'Modelo Esquerdino Cl', 3),
(17, 'Modelo Dreadnought', 2),
(18, 'Modelo Esquerdino Ac', 2),
(19, 'Modelo Folk', 2),
(20, 'Modelo Jumbo', 2),
(21, 'Modelo Roundback', 2),
(22, 'Modelo 4', 4),
(23, 'Modelo 5', 4),
(24, 'Modelo 6', 4),
(25, 'Modelo Esquerdino Bx', 4),
(26, 'Modelo Alternativo B', 4),
(27, 'Modelo Signature Bx', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoconcertos`
--

DROP TABLE IF EXISTS `tipoconcertos`;
CREATE TABLE IF NOT EXISTS `tipoconcertos` (
  `tip_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_nome` varchar(20) NOT NULL,
  `tip_inativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`tip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `us_nome` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `us_apelido` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `us_cidade` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `us_telemovel` int(9) NOT NULL,
  `us_contribuinte` int(9) NOT NULL,
  `us_pontos` int(11) NOT NULL,
  `us_inativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `us_nome`, `us_apelido`, `us_cidade`, `us_telemovel`, `us_contribuinte`, `us_pontos`, `us_inativo`) VALUES
(1, 'duarte_fpereira', 'WH-GO4zP4VwFLNH8VIkkMmjxbIz9Kz9Y', '$2y$13$aOuGfr9TeD9.cS2SYrapjOKpzpk3S.3vSivY31BrT3wMNPoV86/LW', NULL, '2190715@my.ipleiria.pt', 10, 1634936385, 1642092703, NULL, 'manel', 'Pereira', 'Leiria', 915107661, 234432598, 23, 0),
(2, 'alexlevs', 'tU4F73wMajQT1SIK39BvcDNk7kUgXdnd', '$2y$13$xWX8wIxnKw7zWJ1jyYqXD.kajrxs3WfTjqkp8MJTRN6Cs9uIrqHVi', NULL, 'alexandrelevchenko1@gmail.com', 10, 1634936510, 1634936510, NULL, 'Alexandre', 'levchenko', 'Leiria', 910000000, 1234567890, 1222, 0),
(3, 'tiago_jorge', 'W7Lklqfe8cfdHvn-WQKUu_T7D1XAhyL7', '$2y$13$lVU48YoCnAuCBfMwwitrxulchoU56wJvBcltdHqP9ucuK4Ocgrr4a', NULL, 'tiago.jorge@gmail.com', 10, 1634936558, 1634936558, NULL, 'Tiago', 'Jorge', 'Leiria', 910000000, 1234567890, 34, 0),
(4, 'func', 'fieqz5LkgSnKS91AERHE-lfKXxCjjlnn', '$2y$13$ESo1HazSZocIT1.ovh3Veu8721tnQF.l6VMghyG0k74x7LosDsSqy', NULL, 'funcionario@gfast.pt', 10, 1636061741, 1636061741, 'SmvW_LvCPt_YoU6E2ffNFwa0JtqhS896_1636061741', 'Funcionário', 'GFast', 'Leiria', 910000000, 1234567890, 0, 0),
(5, 'gestor', 'h_QigDGqddXzF96FfQ59F5_1MKzU-XsY', '$2y$13$dyX6BwJmdwFnxec1ubpQb.0q/EDiZRzsAKLwzB9X7yNZKU4KsbOxW', NULL, 'gestor@gfast.pt', 10, 1636061780, 1636061780, '0a3DDMoZuPitnE8uIDTu1UDDxKfATrzE_1636061780', 'Gestor', 'GFast', 'Leiria', 910000000, 1234567890, 0, 0),
(6, 'cliente', '4lE9GjSjUg_rk-6MYmP0ubUmlK4pjgfx', '$2y$13$WXxm6ut.KmypW5ihunwQ1e8bcGIpRos0gXowKbuHeAsnveIJmC.w.', NULL, 'cliente@gfast.pt', 10, 1636061825, 1643215574, 'AgN6mb6Chg-anGbk0ngsZaPsHVHRhNV6_1636061825', 'Cliente', 'GFast', 'Leiria', 910056456, 123456789, 0, 0),
(8, 'admin', '4tHXaQz54QJ7fe4MHqVPL8D9IZY6SQdg', '$2y$13$8VEAJeFOy.DnSCU05/LR2.ZY8iw3nUdKGUkU06K5tfUqx13b.KTka', NULL, 'teste@tefste.pt', 10, 1636407591, 1644259796, 'B7rJOEI9aMVIQH3zeQEkMUNiCjmqfWOp_1636407591', 'Admini', 'GFast', 'Leiria', 910000043, 123123123, 12, 0),
(9, 'francisco123', 'ehjMaBjsDh05MlRN6Bafp3hixQKEu8nI', '$2y$13$XMyr1.DcDBTZAVumcPof3.PlyEvuifkoi.wASbznhxhoD.k.ESBLm', NULL, 'francisco1@gmail.com', 10, 1642457693, 1642457693, 'Zspkd7p5UnQVokYHJ2D3GzQaf6_1aofw_1642457693', 'Francisco', 'ferreira', 'Leiria', 910002222, 123458888, 0, 0),
(12, 'dsadasd', 'BPMH_hCs1Gy4-Aip1Tw2bcgMQrpf9ZuW', '$2y$13$4OvADS4/2qoJSg.2VC7ylubIl1ufBKs9sPLXd2TTUYx1biIpPDEce', NULL, 'alexandrelevchenkodas1@gmail.com', 10, 1642539376, 1642539376, 'KF7sfEA6S0u6aZ1qimYwFD_9AU52gQbA_1642539376', 'Alexandre', 'Levchenko', 'Alcanena', 935473444, 275201946, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE IF NOT EXISTS `vendas` (
  `ven_id` int(11) NOT NULL AUTO_INCREMENT,
  `ven_iduser` int(11) NOT NULL,
  `ven_idloja` int(11) NOT NULL,
  `ven_idsaldo` int(11) NOT NULL,
  `ven_idproduto` int(11) NOT NULL,
  `ven_total` int(11) NOT NULL,
  `ven_estado` tinyint(4) NOT NULL,
  `ven_iva` int(11) NOT NULL,
  PRIMARY KEY (`ven_id`),
  KEY `vendas_lojas_fk` (`ven_idloja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas_guitarras`
--

DROP TABLE IF EXISTS `vendas_guitarras`;
CREATE TABLE IF NOT EXISTS `vendas_guitarras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idguitarra` int(11) NOT NULL,
  `idvenda` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vendas_guitarras_fk` (`idguitarra`),
  KEY `vendas_guitarrastwo_fk` (`idvenda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `guitarras_avaliacoes_fk` FOREIGN KEY (`ava_idguitarra`) REFERENCES `guitarras` (`gui_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_avaliacoes_fk` FOREIGN KEY (`ava_iduser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bilhetes`
--
ALTER TABLE `bilhetes`
  ADD CONSTRAINT `bilhetes_concertos_fk` FOREIGN KEY (`bil_idconcerto`) REFERENCES `concertos` (`con_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `bilhetes_users_fk` FOREIGN KEY (`bil_iduser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_user_fk` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `enc_guitar_fk` FOREIGN KEY (`gui_id`) REFERENCES `guitarras` (`gui_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `enc_userid_fk` FOREIGN KEY (`enc_id`) REFERENCES `encomendas` (`enc_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `concertos`
--
ALTER TABLE `concertos`
  ADD CONSTRAINT `concertos_tipoconcerto_fk` FOREIGN KEY (`con_idtipoconcerto`) REFERENCES `tipoconcertos` (`tip_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `encomendas`
--
ALTER TABLE `encomendas`
  ADD CONSTRAINT `enc_estado_fk` FOREIGN KEY (`enc_estado`) REFERENCES `estados` (`est_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `enc_userddd_fk` FOREIGN KEY (`enc_iduser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `enderecos_user_fk` FOREIGN KEY (`end_iduser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `carrinho_guitarra_fk` FOREIGN KEY (`fav_idguitarras`) REFERENCES `guitarras` (`gui_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_carrinho_fk` FOREIGN KEY (`fav_iduser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_subcategoria_fk` FOREIGN KEY (`fot_idguitarra`) REFERENCES `guitarras` (`gui_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `guitarras`
--
ALTER TABLE `guitarras`
  ADD CONSTRAINT `guitarra_subcategoria_fk` FOREIGN KEY (`gui_idsubcategoria`) REFERENCES `subcategoriaguitarra` (`sub_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `marca_subcategoria_fk` FOREIGN KEY (`gui_idmarca`) REFERENCES `marcas` (`mar_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `subcategoriaguitarra`
--
ALTER TABLE `subcategoriaguitarra`
  ADD CONSTRAINT `subcategoriaguitarra_ibfk_1` FOREIGN KEY (`sub_idcat`) REFERENCES `categoriaguitarra` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
