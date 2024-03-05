-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2024 a las 15:33:14
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `finedugt_formeci`
--
CREATE DATABASE IF NOT EXISTS `finedugt_formeci` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `finedugt_formeci`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_campus`
--

CREATE TABLE `tbl_campus` (
  `id_campus` int(11) NOT NULL,
  `des_campus` varchar(100) NOT NULL,
  `ind_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_campus`
--

INSERT INTO `tbl_campus` (`id_campus`, `des_campus`, `ind_estado`) VALUES
(1, 'Central', 1),
(2, 'Escuintla', 1),
(3, 'Huehuetenango', 1),
(4, 'Jocotenango', 1),
(5, 'Jutiapa', 1),
(6, 'Mazatenango', 1),
(7, 'Naranjo', 1),
(8, 'Portales', 1),
(9, 'Puerto Barrios', 1),
(10, 'Quetzaltenango', 1),
(11, 'Santa Lucía Cotzumalguapa', 1),
(12, 'Villa Nueva', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_eci_data`
--

CREATE TABLE `tbl_eci_data` (
  `id_alumno` int(11) NOT NULL,
  `des_nombre` varchar(300) NOT NULL,
  `des_cell` varchar(15) NOT NULL,
  `des_email` varchar(300) NOT NULL,
  `des_campus` varchar(50) NOT NULL,
  `des_jornada` varchar(50) NOT NULL,
  `des_modalidad` varchar(50) NOT NULL,
  `dt_fecha_envio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ind_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_eci_data`
--

INSERT INTO `tbl_eci_data` (`id_alumno`, `des_nombre`, `des_cell`, `des_email`, `des_campus`, `des_jornada`, `des_modalidad`, `dt_fecha_envio`, `ind_estado`) VALUES
(1, 'Jaime Noel López Daniel', '3473-4672', 'noellopez1409@gmail.com', '1', '1', '1', '2024-03-05 14:30:57', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_campus`
--
ALTER TABLE `tbl_campus`
  ADD PRIMARY KEY (`id_campus`);

--
-- Indices de la tabla `tbl_eci_data`
--
ALTER TABLE `tbl_eci_data`
  ADD PRIMARY KEY (`id_alumno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_campus`
--
ALTER TABLE `tbl_campus`
  MODIFY `id_campus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_eci_data`
--
ALTER TABLE `tbl_eci_data`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
