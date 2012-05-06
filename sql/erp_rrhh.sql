-- phpMyAdmin SQL Dump
-- version 2.11.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-05-2012 a las 01:41:37
-- Versión del servidor: 5.0.67
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `erp_rrhh`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` char(6) NOT NULL,
  `nombre` varchar(50) default NULL,
  `descripcion` varchar(100) default NULL,
  `numMaxEmp` int(5) default NULL,
  `activo` bit(1) default NULL,
  `salarioBase` int(5) unsigned default NULL,
  PRIMARY KEY  (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Esta tabla contendrá información relativa a las distintas ca';

--
-- Volcar la base de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `numMaxEmp`, `activo`, `salarioBase`) VALUES
('CAT001', 'Directivo', NULL, 10, '1', 3000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `idDepartamento` char(6) NOT NULL,
  `nombre` varchar(50) default NULL,
  `descripicion` varchar(100) default NULL,
  `numMaxEmp` int(5) unsigned default NULL,
  `activo` bit(1) default NULL,
  PRIMARY KEY  (`idDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Esta tabla contendrá información relativa a los distintos de';

--
-- Volcar la base de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombre`, `descripicion`, `numMaxEmp`, `activo`) VALUES
('DEP001', 'Ventas', NULL, 100, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `idEmpleado` int(7) unsigned NOT NULL auto_increment,
  `nombre` varchar(100) default NULL,
  `apellidos` varchar(200) default NULL,
  `fechaNac` date default NULL,
  `NIF` char(12) NOT NULL,
  `numSegSoc` char(12) default NULL,
  `numHijos` int(3) default NULL,
  `numTelfFijo` varchar(12) default NULL,
  `numTelfMovil` varchar(12) default NULL,
  `email` varchar(200) default NULL,
  `direccion` varchar(200) default NULL,
  `ciudad` varchar(50) default NULL,
  `codPostal` char(5) default NULL,
  `provincia` varchar(50) default NULL,
  `comunidadAutonoma` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `eliminado` bit(1) default '\0',
  PRIMARY KEY  (`idEmpleado`),
  UNIQUE KEY `NIF_UNIQUE` (`NIF`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Almacenara los datos básicos de cada uno de los empleados.' AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombre`, `apellidos`, `fechaNac`, `NIF`, `numSegSoc`, `numHijos`, `numTelfFijo`, `numTelfMovil`, `email`, `direccion`, `ciudad`, `codPostal`, `provincia`, `comunidadAutonoma`, `pais`, `eliminado`) VALUES
(1, 'Jesús', ' Rodríguez Pérez', '1989-09-06', '50615352b', '0550550550', 0, '+34957666666', '+34652404428', 'jesu@gmail.com', 'Plaza Antequera', 'Lucena', '14900', 'Cordoba', 'Andalucia', 'España', '0'),
(2, 'Root', 'root', '2012-05-05', 'root', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(3, 'Francisco', 'Adamuz', '2012-05-01', '1234', '20', 20, '20', '20', 'adamuz@ElMejor.es', 'calle sin casas', 'Adamuz', '14900', 'Cordoba', 'Andalucia', 'España', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interno`
--

CREATE TABLE IF NOT EXISTS `interno` (
  `idEmpleado` int(7) unsigned NOT NULL,
  `fechaInicio` date default NULL,
  `fechaFin` date default NULL,
  `reincorporacion` bit(1) default NULL,
  `departamento` char(6) default NULL,
  `categoria` char(6) default NULL,
  PRIMARY KEY  (`idEmpleado`),
  KEY `interno_categoria_idcategoria` (`categoria`),
  KEY `interno_departamento_idDepartamento` (`departamento`),
  KEY `empleado_idEmpleado` (`idEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Contendrá información complementaria a la básica de cada uno';

--
-- Volcar la base de datos para la tabla `interno`
--

INSERT INTO `interno` (`idEmpleado`, `fechaInicio`, `fechaFin`, `reincorporacion`, `departamento`, `categoria`) VALUES
(1, '2012-05-01', '2012-05-04', '0', 'DEP001', 'CAT001'),
(3, '2012-05-01', '2012-05-02', '0', 'DEP001', 'CAT001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `idlogin` int(7) unsigned NOT NULL,
  `password` varchar(200) default NULL,
  `errores` int(11) unsigned default '0',
  `estado` bit(1) default NULL,
  PRIMARY KEY  (`idlogin`),
  KEY `idLogin_idEmpleado` (`idlogin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `login`
--

INSERT INTO `login` (`idlogin`, `password`, `errores`, `estado`) VALUES
(1, 'pasa', 2, '0'),
(2, 'pasa', 1, '0');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `interno`
--
ALTER TABLE `interno`
  ADD CONSTRAINT `interno_categoria_idcategoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interno_departamento_idDepartamento` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interno_empleado_idEmpleado` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `idLogin_idEmpleado` FOREIGN KEY (`idlogin`) REFERENCES `empleado` (`idEmpleado`) ON DELETE CASCADE ON UPDATE CASCADE;
