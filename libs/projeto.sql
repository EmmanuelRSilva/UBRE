-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` varchar(30) COLLATE utf8_bin NOT NULL,
  `longitude` varchar(30) COLLATE utf8_bin NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comentario` varchar(255) COLLATE utf8_bin NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id`, `latitude`, `longitude`, `id_usuario`, `comentario`, `data`) VALUES
(22, '-8.031984771', '-34.9011284', 3, 'teste', '2014-11-26 03:08:20'),
(23, '-8.031984771', '-34.9011284', 3, 'Deixo recado aqui', '2014-11-26 03:14:50'),
(24, '-8.079219384', '-34.89969453', 3, 'asddasfdsa', '2014-11-26 03:37:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `senha` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(3, 'Emmanuel', 'contato.emmanuel@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Emmanuel', 'contato.emmanuel@gmail.com', '202cb962ac59075b964b07152d234b70'),
(6, 'Emmanuel', 'contato.emmanuel@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(7, 'Emmanuel', 'contato.emmanuel@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(8, 'Emmanuel', 'contato.emmanuel@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
