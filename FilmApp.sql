-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-12-2017 a las 21:23:01
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `FilmApp`
--
CREATE DATABASE IF NOT EXISTS `FilmApp` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `FilmApp`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `films`
--

CREATE TABLE `films` (
  `id` int(11) NOT NULL,
  `name` tinytext CHARACTER SET latin1 NOT NULL,
  `date` date NOT NULL,
  `cover` text CHARACTER SET latin1 NOT NULL,
  `category` tinytext CHARACTER SET latin1 NOT NULL,
  `rating` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `films`
--

INSERT INTO `films` (`id`, `name`, `date`, `cover`, `category`, `rating`, `created_at`, `updated_at`) VALUES
(0, 'Los Vengadores', '2012-04-27', 'https://images.sftcdn.net/images/t_optimized,f_auto/p/93d7c950-9b29-11e6-92eb-00163ec9f5fa/750227238/marvels-the-avengers-wallpaper-logo.jpg', 'Accion, Fantástica', 92, '0000-00-00 00:00:00', '2017-12-12 17:38:44'),
(1, 'Los Vengadores: la era de ultrón', '2015-05-01', 'https://i.ytimg.com/vi/xi_6Y9jhRxo/maxresdefault.jpg', 'Acción, Fantástica, Ciencia ficción', 81, '2017-12-14 20:36:50', '2017-12-15 03:01:53'),
(4, 'Et sit odio provident atque quia.', '1904-09-08', 'https://lorempixel.com/1920/1080/?62376', 'Musical', 53, '2017-12-15 02:33:16', '2017-12-15 02:33:16'),
(5, 'Excepturi eligendi sit sit ut commodi alias.', '1907-08-28', 'https://lorempixel.com/1920/1080/?73548', 'Policiaca', 11, '2017-12-15 02:33:16', '2017-12-15 02:33:16'),
(7, 'Eaque iusto odit et saepe qui.', '1910-09-03', 'https://lorempixel.com/1920/1080/?64298', 'Terror', 35, '2017-12-15 02:33:25', '2017-12-15 02:33:25'),
(8, 'Aut aut iste id illum tenetur in quam.', '1904-08-10', 'https://lorempixel.com/1920/1080/?96157', 'Acción', 37, '2017-12-15 02:33:44', '2017-12-15 02:33:44'),
(9, 'Non consequatur nisi fuga rem nihil.', '1901-04-20', 'https://lorempixel.com/1920/1080/?49567', 'Fantástica', 30, '2017-12-15 02:34:16', '2017-12-15 02:34:16'),
(10, 'Totam ad molestiae iste aut dolor minus vel.', '1900-02-24', 'https://lorempixel.com/1920/1080/?41617', 'Erótica', 39, '2017-12-15 02:34:17', '2017-12-15 02:34:17'),
(11, 'Earum a architecto numquam nobis illo et.', '2014-06-11', 'https://lorempixel.com/1920/1080/?75065', 'Aventuras', 8, '2017-12-15 02:34:17', '2017-12-15 02:34:17'),
(12, 'Et dolores sequi quo neque.', '2012-12-21', 'https://lorempixel.com/1920/1080/?56740', 'Policiaca', 17, '2017-12-15 02:34:18', '2017-12-15 02:34:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET latin1 NOT NULL,
  `password` text CHARACTER SET latin1 NOT NULL,
  `email` text CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Manolo', '$2y$10$1cYNQkEAFQdtfWDfzb8z4O5uiajNgeICKza1l9QUXl4nkATP/aX8O', 'manolo@manolo.monolo', '2017-12-09 18:41:42', '2017-12-09 18:41:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
