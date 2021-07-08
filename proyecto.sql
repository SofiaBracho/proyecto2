-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2021 a las 23:42:17
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(2000) NOT NULL,
  `seccion` int(11) NOT NULL,
  `materia` int(11) NOT NULL,
  `profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `titulo`, `descripcion`, `seccion`, `materia`, `profesor`) VALUES
(8, 'Ecucaciones diferenciales', 'para el 13', 2, 1, 38),
(9, 'Adjetivos en inglés', 'Hacer lista de 50 adjetivos', 1, 2, 39),
(10, 'asdfa', 'asdfasdf', 1, 2, 39),
(11, 'asdf', 'asf', 1, 2, 39),
(12, 'asdf', 'asf', 1, 2, 39),
(13, 'asdf', 'asdf', 1, 2, 39),
(14, 'asdfasdf', 'asd', 1, 2, 39),
(15, 'Hacer el proyecto', 'Lo quiero para yaaaaa!', 1, 2, 39),
(16, 'Hola', 'Mundo', 1, 2, 39),
(17, 'Hola', 'Mundo', 1, 2, 39),
(18, 'Hola mundo', 'heeeey', 1, 2, 39),
(19, 'asdfasd', 'asdf', 1, 2, 39),
(20, 'asdfas', 'asdf', 1, 2, 39),
(21, 'fasf', 'asd', 1, 2, 39),
(22, 'asdf', 'asdf', 1, 2, 39),
(23, 'asdf', 'asdf', 1, 2, 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `nombre_estudiante` varchar(100) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `ci` int(10) NOT NULL,
  `seccion` int(11) NOT NULL,
  `telefono` int(13) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `nombre_estudiante`, `correo`, `ci`, `seccion`, `telefono`, `password`) VALUES
(27, 'Abrahan Bracho', 'abrahan-_-bracho@hotmail.com', 27998947, 1, 2147483647, '$2y$12$KhaIYQloYq0x4OJ9ZV.LVO9mWV.nKfCdnT9MwApYqtByaGmDatnGG'),
(29, 'asdfads', 'asdf@a', 3215, 2, 4235, '$2y$12$sX1acod0vu/AfNT3jI5F2e5BTAYVLZY7IZJ2zzVFqtWGktHk22IJm'),
(30, 'Sofia Bracho', 'sofia_bracho1@hotmail.com', 28122440, 1, 2147483647, '$2y$12$JC5re84POvaNNGAuC0VXnOSjWB6lqB1cWk0I6EGnW.Fl7VNmm8Ktu'),
(32, 'Abrahan', 'a@a', 27998948, 2, 1, '$2y$12$XrwqHpYcCSe5utPln990pu/GkQy7Br6xd3XEW9Ii4GHkKFXCGhJDy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `pnf` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre`, `pnf`) VALUES
(1, 'Matematica', 'PNFI'),
(2, 'Ingles', 'PNFI'),
(3, 'Bases de datos', 'PNFI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id` int(11) NOT NULL,
  `nombre_profesor` varchar(100) NOT NULL,
  `secciones` varchar(1000) NOT NULL,
  `ci` int(10) NOT NULL,
  `telefono` int(13) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `materias` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `nombre_profesor`, `secciones`, `ci`, `telefono`, `correo`, `password`, `materias`) VALUES
(37, 'sofia', '[2,1]', 28122440, 123412, 'sofia@sofia', '$2y$12$QFMWmq0MNLJ.ojAJUHpw2.xzBq.1UO6qrs0E1CbMDE5YIMybTaGoG', '[1,2,3]'),
(38, '1', '[2]', 1, 1, '1@q', '$2y$12$oTbni/xutc9Q0tPQUWoxQ.WwYtqmfr6vs722e8b4OWmDMzEdPVR7C', '[1]'),
(39, 'Milagros Morales', '[1]', 5802947, 2147483647, 'milagrosmorales58@hotmail.com', '$2y$12$Q6HzrUkibQLupzbGYorgxesvIC4j0RxRmpD32NVI96Iqmka64F5Om', '[2]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `pnf` varchar(10) NOT NULL,
  `trayecto` int(1) NOT NULL,
  `materias` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id`, `nombre`, `pnf`, `trayecto`, `materias`) VALUES
(1, '3201', 'PNFI', 2, '[\'matemáticas\', \'proyecto\', \'programacion\']'),
(2, '3101', 'PNFI', 1, '[\'matematicas\',\'ingles\']');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seccion` (`seccion`),
  ADD KEY `materia` (`materia`),
  ADD KEY `profesor` (`profesor`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ci` (`ci`),
  ADD KEY `seccion` (`seccion`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ci` (`ci`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`seccion`) REFERENCES `secciones` (`id`),
  ADD CONSTRAINT `actividades_ibfk_2` FOREIGN KEY (`materia`) REFERENCES `materias` (`id`),
  ADD CONSTRAINT `actividades_ibfk_3` FOREIGN KEY (`profesor`) REFERENCES `profesores` (`id`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`seccion`) REFERENCES `secciones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
