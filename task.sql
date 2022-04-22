-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2022 a las 19:09:05
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*==================================================================*/
/*-----En la base de datos se maneja 'job' en vez de 'task' debido a un error en el idioma-----*/

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jobs`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE `sp_delete_old_job` (IN `pFecha` DATE)  begin
	DELETE FROM job WHERE EstadoJob = 2 AND FechaLimite = pFecha;
end$$

CREATE PROCEDURE `SP_Horario_Clase` (IN `pDia` VARCHAR(50))  begin
	Select NombreClase, EnlaceClase, EnlacePortafolio from Clase inner join horario on pDia = IDClasePK;
end$$

CREATE PROCEDURE `sp_insert_historial` (IN `pTablaA` VARCHAR(50), IN `pAccion` VARCHAR(150), IN `pEquipo` VARCHAR(100), IN `pNombreE` VARCHAR(100), IN `pID` INTEGER)  begin
	insert into historial_sql values (null, now(), pTablaA, pAccion, pEquipo, pNombreE, pID);
end$$

CREATE PROCEDURE `sp_select_job` (IN `pEstado` TINYINT, IN `pId` INTEGER)  begin
	SELECT * FROM job WHERE EstadoJob = pEstado AND IDUsuarioFK = pId order by FechaLimite asc;
end$$

CREATE PROCEDURE `sp_select_job_asc` (IN `pEstado` TINYINT, IN `pId` INTEGER)  begin
	SELECT * FROM job WHERE EstadoJob = pEstado AND IDUsuarioFK = pId order by FechaLimite asc;
end$$

CREATE PROCEDURE `sp_select_job_desc` (IN `pEstado` TINYINT, IN `pId` INTEGER)  begin
	SELECT * FROM job WHERE EstadoJob = pEstado AND IDUsuarioFK = pId order by FechaLimite desc;
end$$

CREATE PROCEDURE `sp_select_job_eliminado_asc` (IN `pId` INTEGER)  begin
	SELECT * FROM job_eliminado WHERE IDUsuarioFK = pId order by fechaEliminacion asc;
end$$

CREATE PROCEDURE `sp_select_usuario_login` (IN `pUsuario` VARCHAR(50))  begin
	SELECT * FROM Usuario WHERE BINARY CorreoUsuario = pUsuario;
end$$

CREATE PROCEDURE `sp_update_estado_job` (IN `pEstado` TINYINT, IN `pIDJob` INTEGER, IN `pIdUser` INTEGER)  begin
	UPDATE job
    SET EstadoJob = pEstado,
    FechaCreacion = now()
	WHERE IDUsuarioFK = pIdUser AND IDJobPK = pIDJob;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `IDClasePK` int(11) NOT NULL,
  `NombreClase` varchar(100) NOT NULL,
  `EnlaceClase` varchar(300) DEFAULT NULL,
  `EnlacePortafolio` varchar(300) DEFAULT NULL,
  `HoraInicio` time DEFAULT NULL,
  `HoraFin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_sql`
--

CREATE TABLE `historial_sql` (
  `IDHistorialPK` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `TablaAfectada` varchar(50) NOT NULL,
  `Accion` varchar(150) NOT NULL,
  `Equipo` varchar(100) NOT NULL,
  `NombreUserEquipo` varchar(100) NOT NULL,
  `IdUsuarioFk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `IDHorarioPK` int(11) NOT NULL,
  `LunesFK` int(11) DEFAULT NULL,
  `MartesFK` int(11) DEFAULT NULL,
  `MiercolesFK` int(11) DEFAULT NULL,
  `JuevesFK` int(11) DEFAULT NULL,
  `ViernesFK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job`
--

CREATE TABLE `job` (
  `IDJobPK` int(11) NOT NULL,
  `TituloJob` varchar(100) NOT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `FechaCreacion` date NOT NULL,
  `FechaLimite` date DEFAULT NULL,
  `EstadoJob` tinyint(4) NOT NULL DEFAULT 1,
  `IDUsuarioFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Disparadores `job`
--
DELIMITER $$
CREATE TRIGGER `before_delete_job` BEFORE DELETE ON `job` FOR EACH ROW begin
	insert into job_eliminado values (null, now(), old.TituloJob, old.Descripcion, old.FechaCreacion, old.FechaLimite, old.EstadoJob, old.IDUsuarioFK);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_eliminado`
--

CREATE TABLE `job_eliminado` (
  `IDJobEPK` int(11) NOT NULL,
  `fechaEliminacion` datetime NOT NULL,
  `TituloJob` varchar(100) NOT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `fechaCreacion` date NOT NULL,
  `FechaLimite` date DEFAULT NULL,
  `EstadoJob` tinyint(4) NOT NULL DEFAULT 1,
  `IDUsuarioFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IDUsuarioPK` int(11) NOT NULL,
  `NombreUsuario` varchar(70) NOT NULL,
  `CorreoUsuario` varchar(100) NOT NULL,
  `PasswordU` varchar(260) NOT NULL,
  `Rol` tinyint(4) NOT NULL DEFAULT 2,
  `EstadoUsuario` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDUsuarioPK`, `NombreUsuario`, `CorreoUsuario`, `PasswordU`, `Rol`, `EstadoUsuario`) VALUES
(1, 'Administrador', 'admin@admin.com', '$2y$10$3LioBl3o0Cc8zXVgSRP6yOArhw7QRa36oyILxgD63csCstgDBD7Mq', 2, 1);


--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`IDClasePK`);

--
-- Indices de la tabla `historial_sql`
--
ALTER TABLE `historial_sql`
  ADD PRIMARY KEY (`IDHistorialPK`),
  ADD KEY `hizo` (`IdUsuarioFk`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`IDHorarioPK`),
  ADD KEY `Clases_Horario` (`LunesFK`),
  ADD KEY `Clases_Horario_Martes` (`MartesFK`),
  ADD KEY `Clases_Horario_Miercoles` (`MiercolesFK`),
  ADD KEY `Clases_Horario_Jueves` (`JuevesFK`),
  ADD KEY `Clases_Horario_Viernes` (`ViernesFK`);

--
-- Indices de la tabla `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`IDJobPK`),
  ADD KEY `tiene_una` (`IDUsuarioFK`);

--
-- Indices de la tabla `job_eliminado`
--
ALTER TABLE `job_eliminado`
  ADD PRIMARY KEY (`IDJobEPK`),
  ADD KEY `elimino` (`IDUsuarioFK`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDUsuarioPK`),
  ADD UNIQUE KEY `CorreoUsuario` (`CorreoUsuario`);


--
-- Filtros para la tabla `historial_sql`
--
ALTER TABLE `historial_sql`
  ADD CONSTRAINT `hizo` FOREIGN KEY (`IdUsuarioFk`) REFERENCES `usuario` (`IDUsuarioPK`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `Clases_Horario_Lunes` FOREIGN KEY (`LunesFK`) REFERENCES `clase` (`IDClasePK`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Clases_Horario_Jueves` FOREIGN KEY (`JuevesFK`) REFERENCES `clase` (`IDClasePK`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Clases_Horario_Martes` FOREIGN KEY (`MartesFK`) REFERENCES `clase` (`IDClasePK`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Clases_Horario_Miercoles` FOREIGN KEY (`MiercolesFK`) REFERENCES `clase` (`IDClasePK`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Clases_Horario_Viernes` FOREIGN KEY (`ViernesFK`) REFERENCES `clase` (`IDClasePK`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `tiene_una` FOREIGN KEY (`IDUsuarioFK`) REFERENCES `usuario` (`IDUsuarioPK`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `job_eliminado`
--
ALTER TABLE `job_eliminado`
  ADD CONSTRAINT `elimino` FOREIGN KEY (`IDUsuarioFK`) REFERENCES `usuario` (`IDUsuarioPK`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
