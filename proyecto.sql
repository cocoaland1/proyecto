-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2017 a las 14:27:18
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arbol`
--

CREATE TABLE IF NOT EXISTS `arbol` (
  `IdArbol` mediumint(9) NOT NULL,
  `AlturaArbol` tinyint(4) NOT NULL,
  `FechaSiembra` date NOT NULL,
  `MsnmArbol` smallint(6) NOT NULL,
  `IdSueloArbol` tinyint(4) NOT NULL,
  `IdVariedadArbol` tinyint(4) NOT NULL,
  `UbicacionArbol` point NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `arbol`
--

INSERT INTO `arbol` (`IdArbol`, `AlturaArbol`, `FechaSiembra`, `MsnmArbol`, `IdSueloArbol`, `IdVariedadArbol`, `UbicacionArbol`) VALUES
(1, 14, '2017-03-11', 1234, 2, 2, '\0\0\0\0\0\0\0\0\0\0\0\0\0@\0\0\0\0\0\0�?'),
(2, 15, '2017-04-13', 2345, 4, 3, '\0\0\0\0\0\0\0q=\nףp@�G�z@'),
(4, 14, '2017-03-11', 1234, 5, 2, '\0\0\0\0\0\0\0\0\0\0\0\0\0@\0\0\0\0\0\0H@'),
(5, 25, '2017-02-08', 415, 3, 3, '\0\0\0\0\0\0\0\0\0\0\0\0\0@\0\0\0\0\0\0@'),
(7, 10, '2017-01-01', 229, 1, 1, '\0\0\0\0\0\0\0\0\0\0\0\0\0@\0\0\0\0\0\0\0@');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ataques`
--

CREATE TABLE IF NOT EXISTS `ataques` (
  `IdAtaques` mediumint(9) NOT NULL,
  `FechaAtaques` date NOT NULL,
  `PorcentajeInfestacion` tinyint(4) NOT NULL,
  `IdEnfermedadAtaque` tinyint(4) NOT NULL,
  `IdArbolAtaque` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ataques`
--

INSERT INTO `ataques` (`IdAtaques`, `FechaAtaques`, `PorcentajeInfestacion`, `IdEnfermedadAtaque`, `IdArbolAtaque`) VALUES
(1, '2017-06-18', 4, 3, 1),
(2, '2017-08-12', 3, 2, 1),
(4, '0000-00-00', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE IF NOT EXISTS `auditoria` (
  `IdAuditoria` int(11) NOT NULL,
  `FechaAuditoria` date NOT NULL,
  `DescripcionAuditoria` varchar(90) NOT NULL,
  `IdUsuarioAuditoria` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`IdAuditoria`, `FechaAuditoria`, `DescripcionAuditoria`, `IdUsuarioAuditoria`) VALUES
(1, '2017-02-06', 'dar aconocer las ventajas y desventajas.', 1),
(2, '2017-06-06', 'llevar el control de cada una de ellas.', 2),
(3, '2017-06-06', 'sapo galviz', 1),
(4, '2017-06-06', 'jlbhigñiug', 2),
(5, '2017-06-06', ',noug9ug´9ogpñjvkv ñk', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `IdCliente` mediumint(9) NOT NULL,
  `NombreCliente` varchar(70) NOT NULL,
  `CelularCliente` varchar(70) NOT NULL,
  `DireccionCliente` varchar(70) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`IdCliente`, `NombreCliente`, `CelularCliente`, `DireccionCliente`) VALUES
(1, 'Juan Gomez', '3218261074', 'call 5 #9-5'),
(2, 'Maria Prada', '3149652530', 'call 9 #2-9'),
(3, 'Pablo Sandobal', '3194702804', 'call 9 #9-0'),
(4, 'Samanta Johnson', '3169402835', 'call 6 #4-7'),
(5, 'Nicoll Parkson', '3228763029', 'call 3 #7-4'),
(7, 'Nicoll Parkson', '546546', 'call 3 #7-4'),
(10, 'Nicoll Parkson', '5646511', 'call 3 #7-4NN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

CREATE TABLE IF NOT EXISTS `enfermedad` (
  `IdEnfermedad` tinyint(4) NOT NULL,
  `DescripcionEnfermedad` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `enfermedad`
--

INSERT INTO `enfermedad` (`IdEnfermedad`, `DescripcionEnfermedad`) VALUES
(1, 'La Moniliasis'),
(2, ' La mazorca negra'),
(3, 'Mal del machete'),
(4, 'Antracnosis'),
(5, ' Las bubas'),
(6, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fertilizacion`
--

CREATE TABLE IF NOT EXISTS `fertilizacion` (
  `IdFertilizacion` mediumint(9) NOT NULL,
  `FechaFertilizacion` date NOT NULL,
  `CantidadFertilizante` tinyint(4) NOT NULL,
  `IdFertilizanteFertilizacion` tinyint(4) NOT NULL,
  `IdArbolFertilizacion` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fertilizacion`
--

INSERT INTO `fertilizacion` (`IdFertilizacion`, `FechaFertilizacion`, `CantidadFertilizante`, `IdFertilizanteFertilizacion`, `IdArbolFertilizacion`) VALUES
(1, '2016-04-03', 12, 1, 2),
(2, '2016-09-06', 15, 2, 1),
(3, '2017-02-07', 15, 1, 2),
(4, '0000-00-00', 0, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fertilizante`
--

CREATE TABLE IF NOT EXISTS `fertilizante` (
  `IdFertilizante` tinyint(4) NOT NULL,
  `DescripcionFertilizante` varchar(70) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fertilizante`
--

INSERT INTO `fertilizante` (`IdFertilizante`, `DescripcionFertilizante`) VALUES
(1, ' cal dolomita'),
(2, ' roca fosfórica'),
(4, ' compost'),
(5, 'bocachi'),
(7, 'bocachi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `floracion`
--

CREATE TABLE IF NOT EXISTS `floracion` (
  `IdFloracion` mediumint(9) NOT NULL,
  `CantidadFloresFruto` tinyint(4) NOT NULL,
  `FechaFloracion` date NOT NULL,
  `IdArbolFloracion` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `floracion`
--

INSERT INTO `floracion` (`IdFloracion`, `CantidadFloresFruto`, `FechaFloracion`, `IdArbolFloracion`) VALUES
(1, 16, '2016-09-18', 2),
(2, 19, '2016-09-06', 2),
(3, 0, '0000-00-00', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `podas`
--

CREATE TABLE IF NOT EXISTS `podas` (
  `IdPoda` mediumint(9) NOT NULL,
  `FechaPoda` date NOT NULL,
  `IdTiposPoda` tinyint(4) NOT NULL,
  `IdArbolPoda` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `podas`
--

INSERT INTO `podas` (`IdPoda`, `FechaPoda`, `IdTiposPoda`, `IdArbolPoda`) VALUES
(1, '2016-08-02', 5, 1),
(2, '2016-02-01', 6, 2),
(9, '2017-02-09', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE IF NOT EXISTS `produccion` (
  `IdProduccion` mediumint(9) NOT NULL,
  `FechaProduccion` date NOT NULL,
  `KilosPepaProduccion` tinyint(4) NOT NULL,
  `LitrosBabaProduccion` tinyint(4) NOT NULL,
  `KilosCascaraProduccion` tinyint(4) NOT NULL,
  `IdArbolProduccion` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `produccion`
--

INSERT INTO `produccion` (`IdProduccion`, `FechaProduccion`, `KilosPepaProduccion`, `LitrosBabaProduccion`, `KilosCascaraProduccion`, `IdArbolProduccion`) VALUES
(1, '2017-01-03', 100, 25, 60, 2),
(2, '2017-01-06', 120, 30, 45, 2),
(3, '0000-00-00', 0, 0, 0, 1),
(4, '0000-00-00', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `IdRol` tinyint(4) NOT NULL,
  `NombreRol` varchar(20) NOT NULL,
  `ArbolRol` varchar(4) NOT NULL,
  `VariedadRol` varchar(4) NOT NULL,
  `SueloRol` varchar(4) NOT NULL,
  `EnfermedadRol` varchar(4) NOT NULL,
  `ProduccionRol` varchar(4) NOT NULL,
  `AtaqueRol` varchar(4) NOT NULL,
  `ClienteRol` varchar(4) NOT NULL,
  `VentasRol` varchar(4) NOT NULL,
  `TratamientoRol` varchar(4) NOT NULL,
  `PodasRol` varchar(4) NOT NULL,
  `TipoPodaRol` varchar(4) NOT NULL,
  `FloracionRol` varchar(4) NOT NULL,
  `FertilizantesRol` varchar(4) NOT NULL,
  `FertilizacionRol` varchar(4) NOT NULL,
  `UsuariosRol` varchar(4) NOT NULL,
  `AuditoriaRol` varchar(4) NOT NULL,
  `RolRol` varchar(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`IdRol`, `NombreRol`, `ArbolRol`, `VariedadRol`, `SueloRol`, `EnfermedadRol`, `ProduccionRol`, `AtaqueRol`, `ClienteRol`, `VentasRol`, `TratamientoRol`, `PodasRol`, `TipoPodaRol`, `FloracionRol`, `FertilizantesRol`, `FertilizacionRol`, `UsuariosRol`, `AuditoriaRol`, `RolRol`) VALUES
(1, 'Administrador', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'ru'),
(2, 'Clientes', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD'),
(4, 'Proveedores', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'cd', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'CRUD', 'ur');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suelo`
--

CREATE TABLE IF NOT EXISTS `suelo` (
  `IdSuelo` tinyint(4) NOT NULL,
  `DescripcionSuelo` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `suelo`
--

INSERT INTO `suelo` (`IdSuelo`, `DescripcionSuelo`) VALUES
(1, 'Suelos arenosos'),
(2, 'Suelos calizos'),
(3, 'Suelos humíferos'),
(4, 'Suelos arcillosos'),
(5, 'Suelos pedregosos'),
(6, 'Suelos mixtos'),
(7, 'Suelos pedregososJJH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipospodas`
--

CREATE TABLE IF NOT EXISTS `tipospodas` (
  `IdTiposPoda` tinyint(4) NOT NULL,
  `DescripcionTipoPoda` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipospodas`
--

INSERT INTO `tipospodas` (`IdTiposPoda`, `DescripcionTipoPoda`) VALUES
(1, 'Poda de formación'),
(2, 'Pinzamientos'),
(3, 'Poda de saneamiento'),
(4, 'Poda de fructificación'),
(5, 'Poda tras la floración'),
(6, 'Poda de rejuvenecimiento'),
(7, 'Poda de floración'),
(8, 'JJHJHHJ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE IF NOT EXISTS `tratamiento` (
  `IdTratamiento` mediumint(9) NOT NULL,
  `FechaTratamiento` date NOT NULL,
  `DescripcionTratamiento` varchar(80) NOT NULL,
  `IdAtaqueTratamiento` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tratamiento`
--

INSERT INTO `tratamiento` (`IdTratamiento`, `FechaTratamiento`, `DescripcionTratamiento`, `IdAtaqueTratamiento`) VALUES
(1, '2016-11-16', 'se le hace tratamiento para que asi no hayan interupciones', 1),
(2, '2017-12-11', 'abonar ', 2),
(3, '0000-00-00', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `IdUsuario` tinyint(4) NOT NULL,
  `NombreUsuario` varchar(60) NOT NULL,
  `EmailUsuario` varchar(60) NOT NULL,
  `ClaveUsuario` varchar(64) NOT NULL,
  `FechaRegistroUsuario` date NOT NULL,
  `FechaUltimaClaveUsuario` date NOT NULL,
  `IdRolUsuario` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `NombreUsuario`, `EmailUsuario`, `ClaveUsuario`, `FechaRegistroUsuario`, `FechaUltimaClaveUsuario`, `IdRolUsuario`) VALUES
(1, 'ingrith', 'ingrith@hotmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2016-03-02', '2017-04-05', 1),
(2, 'jhonatan', 'jhonatan@hotmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2016-02-01', '2016-09-08', 4),
(8, 'david', 'david@hotmail.com', '06f67fd63dd76fa88393c7c2b35416a5778f7ea1b9165bc20b7d09be65adb8af', '2017-02-06', '2017-03-29', 4),
(11, 'davinson', 'davinson@hotmail.com', '728a8ecdf50e3dabdd6e4a470e5ae2bbf51270b9f83efb341758781172f98b25', '2017-01-30', '2017-03-02', 1),
(12, 'alejandro', 'alejandro@hotmail.com', '6a3479dc46a8230a8ba2742356a653b561fff3126ef761c3e1bc73c5c8689c64', '2017-03-28', '2017-03-28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variedad`
--

CREATE TABLE IF NOT EXISTS `variedad` (
  `IdVariedad` tinyint(4) NOT NULL,
  `DescripcionVariedad` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `variedad`
--

INSERT INTO `variedad` (`IdVariedad`, `DescripcionVariedad`) VALUES
(1, 'cacao criollo'),
(2, 'cacao forastero'),
(3, 'cacao trinitario'),
(4, 'JHH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `IdVentas` mediumint(9) NOT NULL,
  `NumeroFactura` mediumint(9) NOT NULL,
  `KilosVenta` smallint(6) NOT NULL,
  `FechaVenta` date NOT NULL,
  `IdClientesVenta` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`IdVentas`, `NumeroFactura`, `KilosVenta`, `FechaVenta`, `IdClientesVenta`) VALUES
(1, 0, 200, '2017-09-20', 2),
(2, 3, 250, '2017-09-23', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arbol`
--
ALTER TABLE `arbol`
  ADD PRIMARY KEY (`IdArbol`), ADD KEY `IdSueloArbol` (`IdSueloArbol`), ADD KEY `IdVariedadArbol` (`IdVariedadArbol`);

--
-- Indices de la tabla `ataques`
--
ALTER TABLE `ataques`
  ADD PRIMARY KEY (`IdAtaques`), ADD KEY `IdEnfermedadAtaque` (`IdEnfermedadAtaque`), ADD KEY `IdArbolAtaque` (`IdArbolAtaque`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`IdAuditoria`), ADD KEY `IdUsuarioAuditoria` (`IdUsuarioAuditoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`IdCliente`);

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`IdEnfermedad`);

--
-- Indices de la tabla `fertilizacion`
--
ALTER TABLE `fertilizacion`
  ADD PRIMARY KEY (`IdFertilizacion`), ADD KEY `IdFertilizanteFertilizacion` (`IdFertilizanteFertilizacion`), ADD KEY `IdArbolFertilizacion` (`IdArbolFertilizacion`);

--
-- Indices de la tabla `fertilizante`
--
ALTER TABLE `fertilizante`
  ADD PRIMARY KEY (`IdFertilizante`);

--
-- Indices de la tabla `floracion`
--
ALTER TABLE `floracion`
  ADD PRIMARY KEY (`IdFloracion`), ADD KEY `IdArbolFloracion` (`IdArbolFloracion`);

--
-- Indices de la tabla `podas`
--
ALTER TABLE `podas`
  ADD PRIMARY KEY (`IdPoda`), ADD KEY `IdTiposPoda` (`IdTiposPoda`), ADD KEY `IdArbolPoda` (`IdArbolPoda`);

--
-- Indices de la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD PRIMARY KEY (`IdProduccion`), ADD KEY `IdArbolProduccion` (`IdArbolProduccion`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IdRol`), ADD KEY `IdRol` (`IdRol`);

--
-- Indices de la tabla `suelo`
--
ALTER TABLE `suelo`
  ADD PRIMARY KEY (`IdSuelo`);

--
-- Indices de la tabla `tipospodas`
--
ALTER TABLE `tipospodas`
  ADD PRIMARY KEY (`IdTiposPoda`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`IdTratamiento`), ADD KEY `IdAtaqueTratamiento` (`IdAtaqueTratamiento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`), ADD KEY `IdRolUsuario` (`IdRolUsuario`);

--
-- Indices de la tabla `variedad`
--
ALTER TABLE `variedad`
  ADD PRIMARY KEY (`IdVariedad`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`IdVentas`), ADD KEY `IdClientesVenta` (`IdClientesVenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arbol`
--
ALTER TABLE `arbol`
  MODIFY `IdArbol` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `ataques`
--
ALTER TABLE `ataques`
  MODIFY `IdAtaques` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `IdAuditoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `IdCliente` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  MODIFY `IdEnfermedad` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `fertilizacion`
--
ALTER TABLE `fertilizacion`
  MODIFY `IdFertilizacion` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `fertilizante`
--
ALTER TABLE `fertilizante`
  MODIFY `IdFertilizante` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `floracion`
--
ALTER TABLE `floracion`
  MODIFY `IdFloracion` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `podas`
--
ALTER TABLE `podas`
  MODIFY `IdPoda` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `IdProduccion` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `IdRol` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `suelo`
--
ALTER TABLE `suelo`
  MODIFY `IdSuelo` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tipospodas`
--
ALTER TABLE `tipospodas`
  MODIFY `IdTiposPoda` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  MODIFY `IdTratamiento` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `variedad`
--
ALTER TABLE `variedad`
  MODIFY `IdVariedad` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `IdVentas` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `arbol`
--
ALTER TABLE `arbol`
ADD CONSTRAINT `fksueloarbol` FOREIGN KEY (`IdSueloArbol`) REFERENCES `suelo` (`IdSuelo`),
ADD CONSTRAINT `fkvariedadarbol` FOREIGN KEY (`IdVariedadArbol`) REFERENCES `variedad` (`IdVariedad`);

--
-- Filtros para la tabla `ataques`
--
ALTER TABLE `ataques`
ADD CONSTRAINT `fkarbolataque` FOREIGN KEY (`IdArbolAtaque`) REFERENCES `arbol` (`IdArbol`),
ADD CONSTRAINT `fkenfermedadataque` FOREIGN KEY (`IdEnfermedadAtaque`) REFERENCES `enfermedad` (`IdEnfermedad`);

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
ADD CONSTRAINT `fkusuarioauditoria` FOREIGN KEY (`IdUsuarioAuditoria`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `fertilizacion`
--
ALTER TABLE `fertilizacion`
ADD CONSTRAINT `fkarbolfertiizacion` FOREIGN KEY (`IdArbolFertilizacion`) REFERENCES `arbol` (`IdArbol`),
ADD CONSTRAINT `fkfertilizantefertilizacion` FOREIGN KEY (`IdFertilizanteFertilizacion`) REFERENCES `fertilizante` (`IdFertilizante`);

--
-- Filtros para la tabla `floracion`
--
ALTER TABLE `floracion`
ADD CONSTRAINT `fkarbolfloracion` FOREIGN KEY (`IdArbolFloracion`) REFERENCES `arbol` (`IdArbol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `podas`
--
ALTER TABLE `podas`
ADD CONSTRAINT `fkarbolpoda` FOREIGN KEY (`IdArbolPoda`) REFERENCES `arbol` (`IdArbol`),
ADD CONSTRAINT `fktipospoda` FOREIGN KEY (`IdTiposPoda`) REFERENCES `tipospodas` (`IdTiposPoda`);

--
-- Filtros para la tabla `produccion`
--
ALTER TABLE `produccion`
ADD CONSTRAINT `fkarbolproduccion` FOREIGN KEY (`IdArbolProduccion`) REFERENCES `arbol` (`IdArbol`);

--
-- Filtros para la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
ADD CONSTRAINT `fkataquetratamiento` FOREIGN KEY (`IdAtaqueTratamiento`) REFERENCES `ataques` (`IdAtaques`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fkrolusuario` FOREIGN KEY (`IdRolUsuario`) REFERENCES `rol` (`IdRol`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
ADD CONSTRAINT `fkclientesventa` FOREIGN KEY (`IdClientesVenta`) REFERENCES `cliente` (`IdCliente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
