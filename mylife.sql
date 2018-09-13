-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jul 03, 2013 as 04:09 
-- Versão do Servidor: 5.1.41
-- Versão do PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `mylife`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `financas`
--

CREATE TABLE IF NOT EXISTS `financas` (
  `id_financas` int(4) NOT NULL AUTO_INCREMENT,
  `id_financas_cat` int(4) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` float NOT NULL,
  `data` date NOT NULL,
  `lancamento` char(1) NOT NULL,
  PRIMARY KEY (`id_financas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `financas`
--

INSERT INTO `financas` (`id_financas`, `id_financas_cat`, `descricao`, `valor`, `data`, `lancamento`) VALUES
(4, 2, 'AlimentaÃ§Ã£o - Semana 01', 50, '2013-07-01', '1'),
(6, 2, 'AlmoÃ§o', 14.5, '2013-07-01', '2'),
(7, 2, 'AlmoÃ§o', 14.5, '2013-07-02', '2'),
(8, 4, 'Gasolina', 15, '2013-07-01', '2'),
(9, 2, 'Cafe da manha', 2.5, '2013-07-03', '2'),
(10, 2, 'AlmoÃ§o', 9, '2013-07-03', '2'),
(11, 2, 'Credito', 50, '2013-07-03', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `financas_cat`
--

CREATE TABLE IF NOT EXISTS `financas_cat` (
  `id_financas_cat` int(4) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) NOT NULL,
  PRIMARY KEY (`id_financas_cat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `financas_cat`
--

INSERT INTO `financas_cat` (`id_financas_cat`, `categoria`) VALUES
(1, 'Salario'),
(2, 'Alimentacao'),
(3, 'Diversos'),
(4, 'Gasolina'),
(5, 'Moto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

CREATE TABLE IF NOT EXISTS `tarefas` (
  `id_tarefas` int(4) NOT NULL AUTO_INCREMENT,
  `id_projeto` int(4) NOT NULL,
  `tarefa` varchar(300) NOT NULL,
  `data` datetime NOT NULL,
  `prazo` date NOT NULL,
  `prioridade` int(1) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id_tarefas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`id_tarefas`, `id_projeto`, `tarefa`, `data`, `prazo`, `prioridade`, `status`) VALUES
(1, 1, 'Cadatrar evento de SP, do Gilberto', '2013-07-03 15:12:00', '0000-00-00', 0, '1'),
(2, 1, 'Colocar na listagem do evento um icone para identificar POS e venda Online', '2013-07-03 15:18:47', '0000-00-00', 0, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas_notas`
--

CREATE TABLE IF NOT EXISTS `tarefas_notas` (
  `id_notas` int(4) NOT NULL AUTO_INCREMENT,
  `id_tarefas` int(4) NOT NULL,
  `nota` text NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id_notas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `tarefas_notas`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas_projeto`
--

CREATE TABLE IF NOT EXISTS `tarefas_projeto` (
  `id_projeto` int(4) NOT NULL AUTO_INCREMENT,
  `projeto` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id_projeto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tarefas_projeto`
--

INSERT INTO `tarefas_projeto` (`id_projeto`, `projeto`, `class`, `status`) VALUES
(1, 'IngressoSKY', '', '1'),
(2, 'Estudos', '', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
