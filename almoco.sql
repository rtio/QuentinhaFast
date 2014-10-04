-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Ago-2014 às 15:48
-- Versão do servidor: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `almoco`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `almoco`
--

CREATE TABLE IF NOT EXISTS `almoco` (
  `id_almoco` int(11) NOT NULL AUTO_INCREMENT,
  `sabor` varchar(255) NOT NULL,
  `isDoDia` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_almoco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `almoco`
--

INSERT INTO `almoco` (`id_almoco`, `sabor`, `isDoDia`) VALUES
(9, 'Almôndegas', 1),
(10, 'Carne Moída com Batatas', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_do_dia`
--

CREATE TABLE IF NOT EXISTS `pedido_do_dia` (
  `id_pedido_do_dia` int(11) NOT NULL AUTO_INCREMENT,
  `fk_pessoa_id` int(11) NOT NULL,
  `fk_almoco_id` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id_pedido_do_dia`,`fk_pessoa_id`,`fk_almoco_id`),
  KEY `fk_almoco_id_idx` (`fk_almoco_id`),
  KEY `fk_pessoa_id_idx` (`fk_pessoa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `pedido_do_dia`
--

INSERT INTO `pedido_do_dia` (`id_pedido_do_dia`, `fk_pessoa_id`, `fk_almoco_id`, `data`) VALUES
(11, 9, 9, '2014-08-22'),
(13, 10, 9, '2014-08-22'),
(14, 10, 10, '2014-08-22'),
(15, 9, 9, '2014-08-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `id_pessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pessoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `nome`) VALUES
(9, 'Rafael'),
(10, 'Dannyel');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pedido_do_dia`
--
ALTER TABLE `pedido_do_dia`
  ADD CONSTRAINT `fk_almoco_id` FOREIGN KEY (`fk_almoco_id`) REFERENCES `almoco` (`id_almoco`),
  ADD CONSTRAINT `fk_pessoa_id` FOREIGN KEY (`fk_pessoa_id`) REFERENCES `pessoa` (`id_pessoa`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
