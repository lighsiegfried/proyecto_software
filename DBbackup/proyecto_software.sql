-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2024 a las 21:50:54
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_software`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id` int(253) NOT NULL,
  `nombre_actividad` varchar(30) DEFAULT NULL,
  `descripcion` text,
  `punteo` decimal(10,0) DEFAULT NULL,
  `id_etapa` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id`, `nombre_actividad`, `descripcion`, `punteo`, `id_etapa`, `id_usuario`) VALUES
(1, 'recapp', 'ya fue', '11', 7, NULL),
(2, 'recap2', 'hoy la pagaron', '15', 8, NULL),
(3, 'book1', 'venganzaaa', '5', 7, NULL),
(4, 'actividad1', 'user1', '5', 9, 1),
(5, 'actividad prueba2', 'descripcion', '5', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad2`
--

CREATE TABLE `actividad2` (
  `id` int(253) NOT NULL,
  `nota_actividad` decimal(10,0) DEFAULT NULL,
  `id_estudiantes` int(11) DEFAULT NULL,
  `id_actividad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `id` int(253) NOT NULL,
  `grado` varchar(25) DEFAULT NULL,
  `seccion` char(2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id`, `grado`, `seccion`, `fecha`, `id_usuario`) VALUES
(1, 'kinder', 'A', '2024-04-26', NULL),
(2, 'Kinder', 'B', '2024-04-26', NULL),
(5, 'primero primaria', 'A', '2024-05-03', 1),
(6, 'segundo primaria', 'A', '2024-05-03', 1),
(7, 'tercero primaria', 'A', '2024-05-03', 1),
(8, 'perito contador 4to', 'A', '2024-05-03', 2),
(9, 'perito contador 5to', 'A', '2024-05-03', 2),
(10, 'perito contador 6to', 'B', '2024-05-03', 2),
(11, 'primero basico', 'A', '2024-05-05', 1),
(12, 'segundo basico', 'A', '2024-05-06', 1),
(13, 'tercero basico', 'A', '2024-05-06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id` int(253) NOT NULL,
  `clave` smallint(6) DEFAULT NULL,
  `total_nota` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_clase` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id`, `clave`, `total_nota`, `id_persona`, `id_clase`, `id_usuario`) VALUES
(1, 1, NULL, 10, 2, NULL),
(3, 2, NULL, 8, 2, NULL),
(4, 1, NULL, 11, 7, 1),
(5, 2, NULL, 12, 7, 1),
(6, 1, NULL, 13, 8, 2),
(7, 2, NULL, 14, 8, 2),
(8, 1, NULL, 15, 9, 2),
(9, 1, NULL, 16, 10, 2),
(10, 1, NULL, 20, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etapa`
--

CREATE TABLE `etapa` (
  `id` int(253) NOT NULL,
  `nombre_etapa` varchar(25) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `etapa`
--

INSERT INTO `etapa` (`id`, `nombre_etapa`, `id_usuario`) VALUES
(7, 'bimestre 1', NULL),
(8, 'bimestre 2', NULL),
(9, 'etapa user 1', 1),
(10, 'segundo semestre', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `id` int(253) NOT NULL,
  `nombre_examen` varchar(25) DEFAULT NULL,
  `descripcion` text,
  `total_examen` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen2`
--

CREATE TABLE `examen2` (
  `id` int(253) NOT NULL,
  `nota_examen` decimal(10,0) DEFAULT NULL,
  `id_estudiante` int(11) DEFAULT NULL,
  `id_examen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(253) NOT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `id_personas` int(11) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `usuario`, `id_rol`, `id_personas`, `pass`) VALUES
(1, 'Wilson', 1, 1, '1'),
(2, 'Pepito', 2, 2, '1'),
(3, 'Mario', 2, 3, '1'),
(4, 'Push', 3, 4, '1'),
(7, 'viajero', 2, 5, '1'),
(8, 'goku', 3, 6, '1'),
(9, 'elpapu', 2, 7, '1'),
(10, 'elmeromero', 1, 8, '1'),
(12, 'gohan', 3, 10, '1'),
(13, 'sdf', 2, 17, '1'),
(14, 'dos', 2, 18, '1'),
(15, 'alum', 3, 19, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(253) NOT NULL,
  `tipo_modelo` varchar(25) DEFAULT NULL,
  `comentario` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(253) NOT NULL,
  `agregar` tinyint(1) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  `modificar` tinyint(1) DEFAULT NULL,
  `reportes` tinyint(1) DEFAULT NULL,
  `vistas` tinyint(1) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(253) NOT NULL,
  `codigo_personal` int(11) DEFAULT NULL,
  `nombres` varchar(30) DEFAULT NULL,
  `apellidos` varchar(30) DEFAULT NULL,
  `direccion` varchar(35) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `id_puesto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `codigo_personal`, `nombres`, `apellidos`, `direccion`, `correo`, `celular`, `id_puesto`) VALUES
(1, 1025, 'Wilson Antonio', 'Vasquez Grijalva', 'Guatemala', 'wvasquezg1@miumg.edu.gt', '44775039', 1),
(2, 1, 'Pepito', 'Lopez', 'Antigua', 'xlive123x@gmail.com', '11223344', 4),
(3, 100, 'Mario', 'Bros', 'Boca del monte', 'nintendo@gmail.com', '44332211', 4),
(4, 754, 'Anastacio', 'Push', 'Amatitlan', 'correo@colegio.com', '00552244', 6),
(5, NULL, 'linux ze', 'Op', NULL, 'linux@gmail.com', NULL, 4),
(6, NULL, 'pancho', 'panchito', NULL, 'panchon@gmail.com', NULL, 6),
(7, NULL, 'elchavo', 'elchavin', NULL, 'elchavon@gmail.com', NULL, 4),
(8, NULL, 'danonino', 'danonine', NULL, 'dano@gmail.com', NULL, 4),
(10, NULL, 'papu', 'mamu', NULL, 'papu@gmail.com', NULL, 6),
(11, NULL, 'wil', 'wils', NULL, 'f@gmail.com', NULL, 6),
(12, NULL, 'prueba', 'pruebas', NULL, 'f@gmail.com', NULL, 6),
(13, NULL, 'alumno de Pepito', 'Prueba2', NULL, 'profepepito@gmail.com', NULL, 6),
(14, NULL, 'alumno de Pepito 2', 'prueba4', NULL, 'correoyoquese@gmail.com', NULL, 6),
(15, NULL, 'alumno de pepito 3', 'ya se', NULL, 'ya_gane@gmail.con', NULL, 6),
(16, NULL, 'prueba de fallo', 'prueba1', NULL, 'yase@gmail.com', NULL, 6),
(17, NULL, 'fs', 'fs', NULL, 'f', NULL, 4),
(18, NULL, 'dos', 'dos', NULL, 'dos', NULL, 4),
(19, NULL, 'hola', 'ds', NULL, 'f', NULL, 6),
(20, NULL, 'alumnoprueba', 'dos', NULL, 'tres', NULL, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `id` int(253) NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`id`, `descripcion`) VALUES
(1, 'Gestor del Sistema'),
(2, 'Director'),
(3, 'Subdirector'),
(4, 'Profesor'),
(5, 'Presidente de clase'),
(6, 'Alumno'),
(7, 'Padres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(253) NOT NULL,
  `nombre` varchar(15) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Admin', 'Administrador del sistema'),
(2, 'Profesor', 'Gestiona Seccion,alumnos,actividades,notas'),
(3, 'Consultor', 'Visualiza consultas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_etapa` (`id_etapa`);

--
-- Indices de la tabla `actividad2`
--
ALTER TABLE `actividad2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estudiantes` (`id_estudiantes`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_clase` (`id_clase`);

--
-- Indices de la tabla `etapa`
--
ALTER TABLE `etapa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examen2`
--
ALTER TABLE `examen2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `id_examen` (`id_examen`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_personas` (`id_personas`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_modulo` (`id_modulo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_puesto` (`id_puesto`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `actividad2`
--
ALTER TABLE `actividad2`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `etapa`
--
ALTER TABLE `etapa`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `examen2`
--
ALTER TABLE `examen2`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(253) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`id_etapa`) REFERENCES `etapa` (`id`);

--
-- Filtros para la tabla `actividad2`
--
ALTER TABLE `actividad2`
  ADD CONSTRAINT `actividad2_ibfk_1` FOREIGN KEY (`id_estudiantes`) REFERENCES `estudiante` (`id`),
  ADD CONSTRAINT `actividad2_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id`);

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `estudiante_ibfk_2` FOREIGN KEY (`id_clase`) REFERENCES `clase` (`id`);

--
-- Filtros para la tabla `examen2`
--
ALTER TABLE `examen2`
  ADD CONSTRAINT `examen2_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiante` (`id`),
  ADD CONSTRAINT `examen2_ibfk_2` FOREIGN KEY (`id_examen`) REFERENCES `examen` (`id`);

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`id_personas`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`),
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `login` (`id`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`id_puesto`) REFERENCES `puesto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
