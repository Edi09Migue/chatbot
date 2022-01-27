-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-01-2022 a las 06:58:05
-- Versión del servidor: 10.3.28-MariaDB
-- Versión de PHP: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chatbot`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `respuesta` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`id`, `pregunta`, `respuesta`) VALUES
(1, 'Hola ', 'Hola, un gusto en saludarte. ¿cómo te ayudo? '),
(2, 'Buenos Días', 'Hola, un gusto en saludarte. ¿cómo te ayudo? '),
(3, 'Buenas Noches', 'Hola, un gusto en saludarte. ¿cómo te ayudo? '),
(4, 'Buenas Tardes', 'Hola, un gusto en saludarte. ¿cómo te ayudo? '),
(5, '¿Cómo estás?', 'Ha sido un buen día, y dime ¿en qué te ayudo?'),
(6, '¿Qué haces?', 'Resuelvo tus dudas, hazme una pregunta'),
(7, '¿Qué estás haciendo?', 'Resuelvo tus dudas, hazme una pregunta'),
(8, '¿Qué más?', 'Resuelvo tus dudas, hazme una pregunta'),
(9, '¿Quién eres?', 'Hola Soy un bot. Dime, ¿qué puedo hacer por ti?'),
(10, '¿Qué eres?', 'Hola Soy un bot. Dime, ¿qué puedo hacer por ti?'),
(11, '¿En qué mes estamos?', 'Enero'),
(12, '¿Qué mes es?', 'Enero'),
(13, '¿Quién te creó?', 'Fui desarrollado por Estefy y Sara.'),
(14, '¿Cuál es tu creador?', 'Fui desarrollado por Estefy y Sara.'),
(15, 'Me gustas', 'No te puedo corresponder'),
(16, 'Te quiero', 'No te puedo corresponder'),
(17, '¿Quieres ser mi amigo?', 'Claro ya somos amigos'),
(18, 'Seamos amigos', 'Claro ya somos amigos'),
(19, 'Cualquier otra pregunta', 'No puedo responder a tu pregunta. Inténtalo otra vez'),
(22, 'Temperatura', '15 °C'),
(23, 'Humedad', '70 %');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
