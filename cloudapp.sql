-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.4.249.2:3306
-- Tiempo de generación: 20-11-2016 a las 01:48:14
-- Versión del servidor: 5.5.50
-- Versión de PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cloudapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aerolineas`
--

CREATE TABLE IF NOT EXISTS `aerolineas` (
  `id_aerolinea` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_aerolinea` varchar(60) NOT NULL,
  `abreviatura` varchar(20) NOT NULL,
  PRIMARY KEY (`id_aerolinea`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `aerolineas`
--

INSERT INTO `aerolineas` (`id_aerolinea`, `nombre_aerolinea`, `abreviatura`) VALUES
(1, 'gjhgjh', 'EJM'),
(2, 'ALGuNA COSA', 'ALGMC'),
(3, 'ALGuNA COSA', 'asas'),
(4, 'ALGuNA COSA', 'asasa'),
(5, 'asas', 'aasas'),
(6, 'asas', 'asasas'),
(7, 'jkgjhghjghjg', 'ghjgjh');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aeropuertos`
--

CREATE TABLE IF NOT EXISTS `aeropuertos` (
  `id_aeropuerto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_aeropuerto` varchar(100) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `zona_horaria` varchar(20) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  PRIMARY KEY (`id_aeropuerto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `aeropuertos`
--

INSERT INTO `aeropuertos` (`id_aeropuerto`, `nombre_aeropuerto`, `ciudad`, `pais`, `zona_horaria`, `codigo_postal`) VALUES
(1, 'hgjgjhghj', 'gjhjgjhg', 'hjgjhgjh', 'hgjhgjhg', '878');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviones`
--

CREATE TABLE IF NOT EXISTS `aviones` (
  `id_avion` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(50) NOT NULL,
  `fabricacion` varchar(4) NOT NULL,
  PRIMARY KEY (`id_avion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE IF NOT EXISTS `reservas` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_vuelo` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `asiento` varchar(10) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `fk_reserva_vuelo_idx` (`id_vuelo`),
  KEY `fk_reserva_usuario_idx` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `Token` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Token` (`Token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `Token`) VALUES
(7, 'e32Cred_vQ8:APA91bHCTqZCS7ZhwsfKFnKmdGPR6MlAKKS3AMKKclA4rHsS0rQcRrYKoSESpki1cQ5ptJw8juZniAAO-wOyFWQFfc2FhLC80eiAWcG7QCqR465ZOrtNP4qvjXbmo_tkC42az3wt6mOC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(75) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasena`, `nombre`) VALUES
(1, 'shackox', 'sebas123', 'Sebastian'),
(2, 'dani', 'dani', 'Daniela lopez'),
(3, 'manzza', 'sebas123', 'shackox'),
(4, 'sebas', 'sebas', 'sebas'),
(5, 'bll', 'bll', 'bll'),
(6, 'enspdf', 'enspdf', 'enspdf'),
(7, 'amh', '1234', 'andres@outlook.com'),
(8, 'sandra', 'sandra', 'sandra milena higuita'),
(9, 'cosa', 'cosa', 'cosa'),
(10, 'diego', 'diego', 'diego'),
(11, 'cristian', 'cristian', 'cristian'),
(12, 'laura', 'laura', 'laura'),
(13, 'shackox', 'shackox', 'shackox'),
(14, 'push', 'push', 'push'),
(15, 'notificacion', 'push', 'notificacion'),
(16, 'manzza', 'blloonny', 'shackox'),
(17, 'laura', 'laura', 'laura'),
(18, 'diego', '040513233132', 'Diego Vanegas'),
(19, 'ejemplo', 'emeplo', 'ejemplo'),
(20, 'algo', 'algo', 'algo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE IF NOT EXISTS `vuelos` (
  `id_vuelo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_vuelo` varchar(45) NOT NULL,
  `id_aerolinea` int(11) NOT NULL,
  `id_avion` int(11) NOT NULL,
  `id_origen` int(11) NOT NULL,
  `id_destino` int(11) NOT NULL,
  `partida` date NOT NULL,
  `llegada` date NOT NULL,
  `asientos` varchar(45) NOT NULL,
  `valor` float NOT NULL,
  PRIMARY KEY (`id_vuelo`),
  KEY `fk_vuelos_aerolinea_idx` (`id_aerolinea`),
  KEY `fk_vuelos_avion_idx` (`id_avion`),
  KEY `fk_vuelos_aeropuerto_origen_idx` (`id_origen`),
  KEY `fk_vuelos_aeropuerto_destino_idx` (`id_destino`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reserva_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reserva_vuelo` FOREIGN KEY (`id_vuelo`) REFERENCES `vuelos` (`id_vuelo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD CONSTRAINT `fk_vuelos_aerolinea` FOREIGN KEY (`id_aerolinea`) REFERENCES `aerolineas` (`id_aerolinea`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vuelos_aeropuerto_destino` FOREIGN KEY (`id_destino`) REFERENCES `aeropuertos` (`id_aeropuerto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vuelos_aeropuerto_origen` FOREIGN KEY (`id_origen`) REFERENCES `aeropuertos` (`id_aeropuerto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vuelos_avion` FOREIGN KEY (`id_avion`) REFERENCES `aviones` (`id_avion`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
