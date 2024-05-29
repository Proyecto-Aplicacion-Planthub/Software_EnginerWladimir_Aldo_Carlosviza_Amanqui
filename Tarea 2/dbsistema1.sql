-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2024 a las 06:09:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbsistema1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `idcalificacion` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `calificación` decimal(50,0) DEFAULT NULL,
  `comentario` varchar(256) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`idcalificacion`, `idcategoria`, `calificación`, `comentario`, `imagen`, `condicion`) VALUES
(1, 5, 555559, 'los mejores celulares koreanos9', '1656866627.png', 1),
(3, 6, 55555543333343, 'los mejores celulares koreanos', '1656867124.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chocolate`
--

CREATE TABLE `chocolate` (
  `idchocolate` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `marca` varchar(256) DEFAULT NULL,
  `porcentaje_cacao` decimal(5,0) NOT NULL,
  `Origen` varchar(40) NOT NULL,
  `Ingredientes` varchar(50) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `chocolate`
--

INSERT INTO `chocolate` (`idchocolate`, `nombre`, `marca`, `porcentaje_cacao`, `Origen`, `Ingredientes`, `condicion`) VALUES
(1, 'zapatos', 'los mejores zapatos', 0, '', '', 1),
(2, 'carteras', 'las mejores carteras', 0, '', '', 0),
(5, 'celulares', 'los mejores celulares', 0, '', '', 1),
(6, 'laptos', 'los mejores laptops', 0, '', '', 1),
(13, 'billeteras', 'las mejores billeteras', 0, '', '', 1),
(14, 'zapatos mujeres', 'los mejores zapatos para mujeres', 0, '', '', 0),
(15, 'cucharas', 'las mejores cucharas', 0, '', '', 0),
(16, 'frutas', 'las mejores frutas', 0, '', '', 0),
(17, 'ew', 'q', 0, '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'chocolates'),
(2, 'compras'),
(3, 'almacen'),
(4, 'estadisticas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `email`, `rol`, `login`, `clave`, `imagen`, `condicion`) VALUES
(2, 'ale', 'alex@gmail.com', 'ingeniero', '23045137777', '49dc52e6bf2abe5ef6e2bb5b0f1ee2d765b922ae6cc8b95d39dc06c21c848f8c', '1657253170.jpg', 1),
(3, 'dede', 'cedd@gmail.com', 'doctor', '', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1716223230.png', 0),
(4, 'a', 'ceddwladimir@gmail.com', 'experto', '123456', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1716326997.png', 1),
(8, 'wa', 'fa@gmail.com', 'experto', '1234567', '49dc52e6bf2abe5ef6e2bb5b0f1ee2d765b922ae6cc8b95d39dc06c21c848f8c', '1716326158.png', 1),
(11, 'o', 'ooo@gmail.com', 'experto', '12345678', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '1716327544.png', 1),
(12, 'g', 'g@gmail.com', 'experto', '123456789', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '', 1),
(13, 'l', 'a@gmail.com', 'experto', '12345', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '1716867784.png', 0),
(15, 'ho', 'torresalexanderi@hotma', 'experto', '456789', '472bbe83616e93d3c09a79103ae47d8f71e3d35a966d6e8b22f743218d04171d', '1716926745.png', 1),
(16, 'dd', 'ddwladimir@gmail.com', 'experto', '3456789', 'b27dfc00528b59c53de1183a1910ee7dd9d0847247b995fbfd0e843669205638', '1716927775.png', 1),
(17, 'k', 'k@gmail.com', 'experto', '1234567890', 'c775e7b757ede630cd0aa1113bd102661ab38829ca52a6422ab782862f268646', '1716928021.png', 1),
(18, 'g', 'mir@gmail.com', 'experto', '6789', '499bc7df9d8873c1c38e6898177c343b2a34d2eb43178a9eb4efcb993366c8cd', '', 1),
(19, 'x', 'wd@gmail.com', 'experto', '25', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(66, 3, 1),
(69, 4, 2),
(70, 8, 2),
(71, 2, 4),
(72, 18, 1),
(73, 19, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`idcalificacion`),
  ADD KEY `fk_articulo_categoria_idx` (`idcategoria`);

--
-- Indices de la tabla `chocolate`
--
ALTER TABLE `chocolate`
  ADD PRIMARY KEY (`idchocolate`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fk_usuario_permiso_permiso_idx` (`idpermiso`),
  ADD KEY `fk_usuario_permiso_usuario_idx` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `idcalificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `chocolate`
--
ALTER TABLE `chocolate`
  MODIFY `idchocolate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `fk_articulo_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `chocolate` (`idchocolate`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_permiso` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_permiso_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
