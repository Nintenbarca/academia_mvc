-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-06-2018 a las 12:04:36
-- Versión del servidor: 5.5.59-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `academia`
--
CREATE DATABASE IF NOT EXISTS `academia` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `academia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `is_parent_category` tinyint(4) NOT NULL DEFAULT '0',
  `is_leaf_category` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `categoria_id`, `is_parent_category`, `is_leaf_category`) VALUES
(1, 'Primaria', NULL, 1, 0),
(2, 'ESO', NULL, 0, 0),
(3, 'Bachiller', NULL, 0, 0),
(4, '1º', 2, 1, 0),
(5, '2º', 2, 1, 0),
(6, '3º', 2, 1, 0),
(7, '4º', 2, 1, 0),
(8, '1º', 3, 1, 0),
(9, '2º', 3, 1, 0),
(10, 'Lengua', 1, 0, 1),
(11, 'Lengua', 4, 0, 1),
(12, 'Lengua', 5, 0, 1),
(13, 'Lengua', 6, 0, 1),
(14, 'Lengua', 7, 0, 1),
(15, 'Lengua', 8, 0, 1),
(16, 'Lengua', 9, 0, 1),
(17, 'Matematicas', 1, 0, 1),
(18, 'Matematicas', 4, 0, 1),
(19, 'Matematicas', 5, 0, 1),
(20, 'Matematicas', 6, 0, 1),
(21, 'Matematicas', 7, 0, 1),
(22, 'Matematicas', 8, 0, 1),
(23, 'Matematicas', 9, 0, 1),
(24, 'Fisica', 8, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE IF NOT EXISTS `examenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria` (`categoria`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`id`, `fecha`, `categoria`, `user_id`) VALUES
(4, 1525737600, 20, 3),
(5, 873676800, 13, 3),
(6, 1541894400, 24, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `resumen` varchar(100) NOT NULL,
  `contenido` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `titulo`, `resumen`, `contenido`, `user_id`, `categoria_id`) VALUES
(5, 'bbvxbvc', 'bvccvvb', 'bcbvcbvvb123', 3, 12),
(6, 'asxdfsghfm', 'argesnd', 'weragthsf', 3, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE IF NOT EXISTS `preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enunciado` varchar(200) NOT NULL,
  `solucion` text NOT NULL,
  `nota_maxima` int(11) NOT NULL,
  `examen_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `examen_id` (`examen_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `enunciado`, `solucion`, `nota_maxima`, `examen_id`) VALUES
(1, '2 + 2 =', '4', 10, 4),
(2, '2 x 3 =', '6', 5, 4),
(5, 'dfggff', 'gdffffdfgrewrewr12', 0, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `is_profesor` tinyint(4) NOT NULL DEFAULT '0',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `pass`, `is_profesor`, `is_admin`) VALUES
(3, 'Fabio', 'Espin', 'nintenbarca-fabio@gmx.es', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1),
(6, 'Carlos', 'Abrisqueta', 'dwes@iescierva.net', 'e10adc3949ba59abbe56e057f20f883e', 0, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD CONSTRAINT `examenes_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examenes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`examen_id`) REFERENCES `examenes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
