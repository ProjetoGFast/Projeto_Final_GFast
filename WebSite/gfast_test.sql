-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06-Jan-2022 às 01:36
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
-- Banco de dados: `gfast_test`
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
('admin', '1', NULL),
('cliente', '5', 1641312302);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_idguitarras` int(11) NOT NULL,
  `car_iduser` int(11) NOT NULL,
  `car_idsaldo` int(11) NOT NULL,
  PRIMARY KEY (`car_id`),
  KEY `guitarras_carrinho_fk` (`car_iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
  `enc_nome` varchar(20) NOT NULL,
  `enc_morada` varchar(40) NOT NULL,
  `enc_estado` tinyint(4) NOT NULL,
  `enc_iduser` int(11) NOT NULL,
  `enc_idvenda` int(11) NOT NULL,
  PRIMARY KEY (`enc_id`),
  KEY `encomendas_vendas_fk` (`enc_idvenda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `guitarras`
--

INSERT INTO `guitarras` (`gui_id`, `gui_nome`, `gui_idsubcategoria`, `gui_idmarca`, `gui_idreferencia`, `gui_descricao`, `gui_preco`, `gui_iva`, `gui_fotopath`, `gui_qrcodepath`, `gui_inativo`) VALUES
(1, 'GuitarraTestes', 12, 13, 'G001', 'Guitarra Para Testes', 567, 23, 'foto.png', 'qrcode.png', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

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
(20, 'Hellweg', 0),
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `us_nome`, `us_apelido`, `us_cidade`, `us_telemovel`, `us_contribuinte`, `us_pontos`, `us_inativo`) VALUES
(1, 'UserTeste', 'tUu1qHcde0diwUol3xeI-18MuHkkprQI', '$2y$13$nJ1WDlBaGcbCdbNC5.5l4.sgy.OMEKCqtDQOdQ2OWpgiKRWYyzzne', 'RkD_Jw0_8HEedzLk7MM-ZKEFfYR7VbMr_1392559490', 'sfriesen@jenkins.info', 10, 1392559490, 1392559490, NULL, 'Tester', 'Gfast', 'Leiria', 987789987, 567765567, 23, 0);

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
  ADD CONSTRAINT `guitarras_carrinho_fk` FOREIGN KEY (`car_iduser`) REFERENCES `guitarras` (`gui_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_carrinho_fk` FOREIGN KEY (`car_iduser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `concertos`
--
ALTER TABLE `concertos`
  ADD CONSTRAINT `concertos_tipoconcerto_fk` FOREIGN KEY (`con_idtipoconcerto`) REFERENCES `tipoconcertos` (`tip_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `encomendas`
--
ALTER TABLE `encomendas`
  ADD CONSTRAINT `encomendas_vendas_fk` FOREIGN KEY (`enc_idvenda`) REFERENCES `vendas` (`ven_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `enderecos_user_fk` FOREIGN KEY (`end_iduser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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

--
-- Limitadores para a tabela `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_lojas_fk` FOREIGN KEY (`ven_idloja`) REFERENCES `lojas` (`loj_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `vendas_guitarras`
--
ALTER TABLE `vendas_guitarras`
  ADD CONSTRAINT `vendas_guitarras_fk` FOREIGN KEY (`idguitarra`) REFERENCES `guitarras` (`gui_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `vendas_guitarrastwo_fk` FOREIGN KEY (`idvenda`) REFERENCES `vendas` (`ven_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
