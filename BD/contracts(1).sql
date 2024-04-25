-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-04-2024 a las 10:06:34
-- Versión del servidor: 8.0.36-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `contracts`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_emergencia`
--

CREATE TABLE `contacto_emergencia` (
  `id` int NOT NULL,
  `id_persona` int DEFAULT NULL COMMENT 'ID de la Persona asociada',
  `nombre` varchar(255) DEFAULT NULL COMMENT 'Nombre del contacto de emergencia',
  `telefono` varchar(20) DEFAULT NULL COMMENT 'Teléfono del contacto de emergencia',
  `activo` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado de activación del contacto (1: activo, 0: inactivo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `id` int NOT NULL,
  `id_persona` int DEFAULT NULL COMMENT 'ID de la Persona asociada',
  `empresa` varchar(255) DEFAULT NULL COMMENT 'Empresa que presta servicios',
  `cargo` varchar(100) DEFAULT NULL COMMENT 'Cargo que desempeña',
  `eps` varchar(100) DEFAULT NULL COMMENT 'EPS del contratante',
  `pension` varchar(100) DEFAULT NULL COMMENT 'Lugar donde cotiza pensión',
  `estado_hv` varchar(100) DEFAULT NULL COMMENT 'Estado del HV',
  `fecha_inicio` date DEFAULT NULL COMMENT 'Fecha de inicio del contrato',
  `tipo` varchar(100) DEFAULT NULL COMMENT 'Tipo de contrato',
  `fecha_terminacion` date DEFAULT NULL COMMENT 'Fecha de terminación del contrato',
  `vacaciones` date DEFAULT NULL COMMENT 'Próximas vacaciones',
  `activo` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado de activación del contrato (1: activo, 0: inactivo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hijo`
--

CREATE TABLE `hijo` (
  `id` int NOT NULL,
  `id_persona` int DEFAULT NULL COMMENT 'ID de la Persona asociada',
  `nombre` varchar(255) DEFAULT NULL COMMENT 'Nombre del hijo',
  `documento` varchar(20) DEFAULT NULL COMMENT 'Número de documento del hijo',
  `edad` int DEFAULT NULL COMMENT 'Edad del hijo',
  `activo` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado de activación del hijo (1: activo, 0: inactivo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int NOT NULL,
  `nombre` varchar(255) DEFAULT NULL COMMENT 'Nombres y apellidos completos de la persona',
  `sexo` varchar(10) DEFAULT NULL COMMENT 'Sexo de la persona',
  `edad` int DEFAULT NULL COMMENT 'Edad de la persona',
  `fecha_nacimiento` date DEFAULT NULL COMMENT 'Fecha de nacimiento de la persona',
  `lugar_nacimiento` varchar(255) DEFAULT NULL COMMENT 'Lugar de nacimiento de la persona',
  `cedula` varchar(20) DEFAULT NULL COMMENT 'Número de cédula de la persona',
  `fecha_expedicion_cedula` date DEFAULT NULL COMMENT 'Fecha de expedición de la cédula',
  `tipo_sangre` varchar(10) DEFAULT NULL COMMENT 'Tipo de sangre de la persona',
  `estado_civil` varchar(20) DEFAULT NULL COMMENT 'Estado civil de la persona',
  `direccion` varchar(255) DEFAULT NULL COMMENT 'Dirección de la persona',
  `barrio` varchar(100) DEFAULT NULL COMMENT 'Barrio de residencia de la persona',
  `municipio` varchar(100) DEFAULT NULL COMMENT 'Municipio de residencia de la persona',
  `estrato` int DEFAULT NULL COMMENT 'Estrato de vivienda de la persona',
  `telefono` varchar(20) DEFAULT NULL COMMENT 'Teléfono personal de contacto de la persona',
  `whatsapp` varchar(20) DEFAULT NULL COMMENT 'Número de WhatsApp de la persona',
  `escolaridad` varchar(100) DEFAULT NULL COMMENT 'Grado o nivel de escolaridad de la persona',
  `competencias` varchar(255) DEFAULT NULL COMMENT 'Título en competencias de la persona',
  `email` varchar(255) DEFAULT NULL COMMENT 'Correo electrónico activo de la persona',
  `activo` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Estado de activación de la persona (1: activo, 0: inactivo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) DEFAULT NULL COMMENT 'Nombre del usuario',
  `email` varchar(100) DEFAULT NULL COMMENT 'Correo electrónico del usuario',
  `password` varchar(255) DEFAULT NULL COMMENT 'Contraseña del usuario (hash)',
  `rol` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '1' COMMENT 'Rol del usuario',
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de registro del usuario',
  `activo` enum('1','0') NOT NULL DEFAULT '1' COMMENT 'Estado de activación del usuario (1: activo, 0: inactivo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `fecha_registro`, `activo`) VALUES
(3, 'Juan Reyes', 'juan@gmail.com', '$2y$10$ZGLy/ltxci6rHuU3zPKikujBj3PVekUWeGjhNkKeEmBbck8Mf5Zju', '1', '2024-03-07 15:51:54', '1'),
(4, 'Jesus Reyes', 'jesus@gmail.com', '$2y$10$3s.nrFFZTGg6l.0J6W2ZgeRrclRiwPmPOpdHJfhADikzTayXaIHcO', '2', '2024-04-23 21:37:11', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacto_emergencia`
--
ALTER TABLE `contacto_emergencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `hijo`
--
ALTER TABLE `hijo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacto_emergencia`
--
ALTER TABLE `contacto_emergencia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hijo`
--
ALTER TABLE `hijo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contacto_emergencia`
--
ALTER TABLE `contacto_emergencia`
  ADD CONSTRAINT `fk_contacto_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `fk_contrato_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `hijo`
--
ALTER TABLE `hijo`
  ADD CONSTRAINT `fk_hijo_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
