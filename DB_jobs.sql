-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2022 a las 19:39:54
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_old_job` (IN `pFecha` DATE)  begin
	DELETE FROM job WHERE EstadoJob = 2 AND FechaLimite = pFecha;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Horario_Clase` (IN `pDia` VARCHAR(50))  begin
	Select NombreClase, EnlaceClase, EnlacePortafolio from Clase inner join horario on pDia = IDClasePK;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_historial` (IN `pTablaA` VARCHAR(50), IN `pAccion` VARCHAR(150), IN `pEquipo` VARCHAR(100), IN `pNombreE` VARCHAR(100), IN `pID` INTEGER)  begin
	insert into historial_sql values (null, now(), pTablaA, pAccion, pEquipo, pNombreE, pID);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_select_job` (IN `pEstado` TINYINT, IN `pId` INTEGER)  begin
	SELECT * FROM job WHERE EstadoJob = pEstado AND IDUsuarioFK = pId order by FechaLimite asc;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_select_job_asc` (IN `pEstado` TINYINT, IN `pId` INTEGER)  begin
	SELECT * FROM job WHERE EstadoJob = pEstado AND IDUsuarioFK = pId order by FechaLimite asc;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_select_job_desc` (IN `pEstado` TINYINT, IN `pId` INTEGER)  begin
	SELECT * FROM job WHERE EstadoJob = pEstado AND IDUsuarioFK = pId order by FechaLimite desc;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_select_job_eliminado_asc` (IN `pId` INTEGER)  begin
	SELECT * FROM job_eliminado WHERE IDUsuarioFK = pId order by fechaEliminacion asc;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_select_usuario_login` (IN `pUsuario` VARCHAR(50))  begin
	SELECT * FROM Usuario WHERE BINARY CorreoUsuario = pUsuario;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_estado_job` (IN `pEstado` TINYINT, IN `pIDJob` INTEGER, IN `pIdUser` INTEGER)  begin
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

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`IDClasePK`, `NombreClase`, `EnlaceClase`, `EnlacePortafolio`, `HoraInicio`, `HoraFin`) VALUES
(1, 'Protección ambiental', 'https://meet.google.com/dmu-yjkb-vwx?hs=224', NULL, '07:00:00', '12:20:00'),
(2, 'Comunicación', 'https://meet.google.com/ctw-hcos-ckw?hs=224', 'https://drive.google.com/drive/u/1/folders/1HKSORR-N4cSeU1esBOiMMJsYIJwD6eUb', '13:00:00', '16:00:00'),
(3, 'Diseño orientado a objetos - JAVA', 'https://meet.google.com/nad-htgy-ghb?hs=224', NULL, '07:00:00', '12:20:00'),
(4, 'Calidad de desarrollo de software', 'https://meet.google.com/wqj-sisj-ccm?hs=224', NULL, '13:00:00', '14:30:00'),
(5, 'Diseño UX', NULL, 'https://drive.google.com/drive/folders/1TD0O80ASR1Hq21R0hZHfZaB7z3ukp3mt', '14:30:00', '16:00:00'),
(6, 'Bases de datos', 'https://meet.google.com/meet/eax-ctau-zdh', 'https://drive.google.com/drive/folders/1wUWSU7ybmpb0zg2jqHuq1ryGI2AgTHSs?usp=sharing ', '07:00:00', '12:20:00'),
(7, 'Cultura fisica', 'https://meet.google.com/jic-jpmz-ivt', 'https://drive.google.com/drive/u/1/folders/1PR5-vjKHEaorJiwuDyaw4UINGYGYkR1_', '13:00:00', '16:00:00'),
(8, 'Ingles', 'https://meet.google.com/aaj-stww-vog', 'https://drive.google.com/drive/u/1/folders/1Him_Oq37mS4k7mb5bklqXFKPd8flSKEi', '13:00:00', '16:00:00'),
(9, 'Arquitectura orientada a objetos', 'https://meet.google.com/paa-fqys-vmt', 'https://drive.google.com/drive/folders/1eTO_tQGf5w9Q_hd36-hJJNbCJp8GxANR?usp=sharing', '07:00:00', '12:20:00'),
(10, 'Seguimiento proyecto', 'https://meet.google.com/qjx-vdub-pxp', NULL, '13:00:00', '18:00:00');

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

--
-- Volcado de datos para la tabla `historial_sql`
--

INSERT INTO `historial_sql` (`IDHistorialPK`, `Fecha`, `TablaAfectada`, `Accion`, `Equipo`, `NombreUserEquipo`, `IdUsuarioFk`) VALUES
(1, '2022-02-28 11:19:08', 'Job', 'Insertar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(2, '2022-02-28 11:19:44', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(3, '2022-02-28 11:19:52', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(4, '2022-02-28 11:20:07', 'Job', 'Actualizar el estado de una tarea (tarea terminada)', 'DESKTOP-B5I23TV', 'Camargo', 1),
(5, '2022-02-28 11:20:24', 'Job', 'Actualizar el estado de una tarea (tarea terminada)', 'DESKTOP-B5I23TV', 'Camargo', 1),
(6, '2022-02-28 11:20:39', 'Job', 'Insertar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(7, '2022-02-28 11:20:39', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(8, '2022-02-28 11:21:57', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(9, '2022-02-28 11:22:00', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(10, '2022-02-28 11:22:09', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(11, '2022-02-28 11:22:59', 'Job', 'Insertar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(12, '2022-02-28 11:22:59', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(13, '2022-02-28 12:16:46', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(14, '2022-02-28 12:17:05', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(15, '2022-02-28 12:17:34', 'Job', 'Insertar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(16, '2022-02-28 12:17:34', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(17, '2022-02-28 12:17:53', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(18, '2022-02-28 12:17:56', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(19, '2022-02-28 12:19:28', 'Job', 'Insertar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(20, '2022-02-28 12:19:28', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(21, '2022-02-28 12:19:36', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(22, '2022-02-28 12:19:39', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(23, '2022-02-28 12:26:40', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(24, '2022-02-28 12:26:40', 'Job', 'Insertar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(25, '2022-02-28 13:16:48', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(26, '2022-02-28 13:16:48', 'Job', 'Insertar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(27, '2022-02-28 13:17:06', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(28, '2022-02-28 13:17:10', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(29, '2022-02-28 13:17:13', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(30, '2022-02-28 13:17:19', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(31, '2022-02-28 13:17:19', 'Job', 'Insertar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(32, '2022-02-28 13:17:47', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(33, '2022-02-28 13:18:12', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(34, '2022-02-28 13:18:14', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(35, '2022-02-28 13:18:18', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(36, '2022-02-28 13:18:23', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(37, '2022-02-28 13:18:24', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(38, '2022-02-28 13:18:31', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(39, '2022-02-28 13:18:37', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(40, '2022-02-28 13:19:40', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(41, '2022-02-28 13:19:54', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(42, '2022-02-28 13:19:58', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(43, '2022-02-28 13:20:01', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(44, '2022-02-28 13:20:04', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(45, '2022-02-28 13:20:07', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(46, '2022-02-28 13:20:11', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(47, '2022-02-28 13:20:18', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(48, '2022-02-28 13:20:49', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(49, '2022-02-28 13:21:00', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(50, '2022-02-28 13:21:09', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(51, '2022-02-28 13:22:56', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(52, '2022-02-28 13:23:56', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(53, '2022-02-28 13:24:13', 'Job', 'Eliminar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1),
(54, '2022-02-28 13:39:00', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(55, '2022-02-28 13:39:32', 'Job_eliminados', 'Eliminar tarea de la tabla eliminados', 'DESKTOP-B5I23TV', 'Camargo', 1),
(56, '2022-02-28 13:39:32', 'Job', 'Insertar una tarea', 'DESKTOP-B5I23TV', 'Camargo', 1);

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

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`IDHorarioPK`, `LunesFK`, `MartesFK`, `MiercolesFK`, `JuevesFK`, `ViernesFK`) VALUES
(1, 1, 3, 6, 3, 9),
(2, 2, 4, 7, 8, 10),
(3, NULL, 5, NULL, NULL, NULL);

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
-- Volcado de datos para la tabla `job`
--

INSERT INTO `job` (`IDJobPK`, `TituloJob`, `Descripcion`, `FechaCreacion`, `FechaLimite`, `EstadoJob`, `IDUsuarioFK`) VALUES
(2, 'Terminar Proyecto votaciones', 'Culminar proyecto votaciones', '2022-02-27', '2022-02-22', 2, 1),
(3, 'Actividad #2 (DB)', 'Realizar la segunda actividad de base de datos (MER)', '2022-02-22', '2022-02-22', 2, 1),
(4, 'Taller #1 - Calidad de software', 'Realizar el punto dos del taller, Infografía Aseguramiento de la calidad de software', '2022-02-22', '2022-02-21', 2, 1),
(5, 'Taller #2 - Cultura fisica', 'Hacer la actividad #1 sobre los tipos de cuerpos', '2022-02-22', '2022-02-22', 2, 1),
(6, 'Presentación sobre el taller 3.3', 'Desarrollar el punto 3.3 de la guia', '2022-02-22', '2022-02-24', 2, 1),
(7, 'Dividir con sumas - Java', 'Hacer el proceso para dividir haciendo sumas', '2022-02-27', '2022-02-21', 2, 1),
(8, 'Escoger el objetivo del proyecto', 'Elegir el tema del proyecto, a que empresa va dirigida y realizar una presentación exponiendo sobre el proyecto seleccionado.', '2022-02-22', '2022-02-24', 2, 1),
(10, 'Video compatibilidad - calidad de SW', 'Realizar el video del punto 3 de calidad de software, sobre calidad la de productos', '2022-02-22', '2022-02-28', 2, 1),
(11, 'Biomímesis - Diseño UX', 'Realizar una exposición sobre el taller biomímesis', '2022-02-22', '2022-02-28', 2, 1),
(15, 'Crear las tablas del supermercado - BD', 'Realizar las tablas en Excel del modelo, entidad, relación del supermercado. Completando los campos que se necesitan.', '2022-02-28', '2022-03-01', 1, 1),
(25, 'Trabajo English', 'Hacer la grabación de el taller 1 de inglés en el enlace:\r\nhttps://voicespice.com/VoiceTag/TagQuestion.aspx?tag=Computerparts97&amp;created=yes\r\nY subir el taller workshop 1', '2022-02-22', '2022-02-27', 2, 1),
(26, 'Computer brands - Workshop 2', 'Realizar el ejercicio de comparación de computadores juego (sapo)', '2022-02-22', '2022-02-27', 2, 1),
(27, 'Ejercicios - cultura física', 'Realizar los ejercicios del taller 2 de cultura física, y consignar los resultados en el documento.', '2022-02-26', '2022-03-01', 1, 1),
(28, 'Necesidades de la comunidad - SENOVA', 'Mirar que necesidades hay en mi entorno, tener una idea de como solucionar esa necesidad con un SW.', '2022-02-27', '2022-03-02', 1, 1),
(39, 'Escoger el objetivo del proyecto', 'Que proyecto se realizará', '2022-02-27', '2022-02-28', 1, 7),
(40, 'Escoger el objetivo del proyecto 2', 'Que proyecto se realizará', '2022-02-27', '2022-03-01', 2, 7),
(43, 'Almacenar historial', 'Buscar la forma de guardar todos los movimientos que se hagan en la plataforma, guardar el id, el usuario, la fecha y la instrucción que ejecutó.\r\nCreo que puede funcionar con triggers.', '2022-02-27', '2022-03-06', 1, 2),
(44, 'Prueba', 'Hola esto es una prueba para el historial, actualización.', '2022-02-28', '2022-03-02', 1, 6),
(45, 'Completar la matriz - Protección ambiental', 'Realizar la matriz en Excel sobre el desarrollo de un software para la web, con java o con javaScript.', '2022-02-28', '2022-03-06', 1, 1),
(59, 'Prueba', 'Hola esto es una prueba para el historial', '2022-02-28', '2022-03-02', 1, 6),
(95, 'Prueba desde phpMyAdmin', 'Esta es una prueba de inserción y eliminacion desde phpMyAdmin', '2022-02-28', '2022-02-28', 1, 1);

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

--
-- Volcado de datos para la tabla `job_eliminado`
--

INSERT INTO `job_eliminado` (`IDJobEPK`, `fechaEliminacion`, `TituloJob`, `Descripcion`, `fechaCreacion`, `FechaLimite`, `EstadoJob`, `IDUsuarioFK`) VALUES
(8, '2022-02-27 00:00:00', 'Prueba 1', 'Prueba #1 desde admin', '2022-02-27', '2022-02-28', 1, 2),
(11, '2022-02-27 00:00:00', 'Prueba 2', 'Prueba #2 desde admin', '2022-02-27', '2022-03-01', 1, 2),
(12, '2022-02-27 00:00:00', 'Prueba 3', 'Prueba #3 desde admin', '2022-02-27', '2022-03-02', 2, 2),
(13, '2022-02-28 09:40:51', 'Prueba', 'Hola esto es una prueba para el historial', '2022-02-28', '2022-03-02', 1, 6),
(26, '2022-02-28 11:19:44', 'Trigger', 'Triggerrrrrr', '2022-02-28', '2022-03-02', 1, 1),
(35, '2022-02-28 12:19:36', 'Prueba desde phpMyAdmin', 'Esta es una prueba de inserción y eliminacion desde phpMyAdmin', '2022-02-28', '2022-02-28', 1, 1),
(37, '2022-02-28 12:27:52', 'Prueba', 'Hola esto es una prueba para el historial', '2022-02-28', '2022-03-02', 1, 6),
(38, '2022-02-28 12:27:56', 'Prueba', 'Hola esto es una prueba para el historial', '2022-02-28', '2022-03-02', 1, 6),
(39, '2022-02-28 12:27:59', 'Prueba', 'Hola esto es una prueba para el historial', '2022-02-28', '2022-03-02', 1, 6),
(40, '2022-02-28 12:28:02', 'Prueba', 'Hola esto es una prueba para el historial', '2022-02-28', '2022-03-02', 1, 6),
(41, '2022-02-28 12:28:03', 'Prueba', 'Hola esto es una prueba para el historial', '2022-02-28', '2022-03-02', 1, 6),
(42, '2022-02-28 12:28:05', 'Prueba', 'Hola esto es una prueba para el historial', '2022-02-28', '2022-03-02', 1, 6),
(43, '2022-02-28 12:28:08', 'Prueba', 'Hola esto es una prueba para el historial', '2022-02-28', '2022-03-02', 1, 6),
(44, '2022-02-28 12:28:10', 'Prueba', 'Hola esto es una prueba para el historial', '2022-02-28', '2022-03-02', 1, 6),
(45, '2022-02-28 12:28:12', 'Prueba', 'Hola esto es una prueba para el historial 2', '2022-02-28', '2022-03-02', 1, 6),
(46, '2022-02-28 12:28:14', 'Prueba', 'Hola esto es una prueba para el historial', '2022-02-28', '2022-03-02', 1, 6),
(51, '2022-02-28 13:19:54', 'Prueba actualizada', 'Prueba de no repetición de registros', '2022-02-28', '2022-03-30', 1, 1),
(52, '2022-02-28 13:19:58', 'Prueba', 'Prueaaaa', '2022-02-28', '2015-01-01', 1, 1),
(53, '2022-02-28 13:20:01', 'Prueba desde phpMyAdmin', 'Esta es una prueba de inserción y eliminacion desde phpMyAdmin', '2022-02-28', '2022-02-28', 1, 1),
(54, '2022-02-28 13:20:04', 'Prueba desde phpMyAdmin', 'Esta es una prueba de inserción y eliminacion desde phpMyAdmin', '2022-02-28', '2022-02-28', 1, 1),
(56, '2022-02-28 13:20:11', 'Prueba desde phpMyAdmin', 'Esta es una prueba de inserción y eliminacion desde phpMyAdmin', '2022-02-28', '2022-02-28', 1, 1),
(57, '2022-02-28 13:20:18', 'Trigger', 'Triggerrrrrr', '2022-02-28', '2022-03-02', 1, 1),
(58, '2022-02-28 13:20:49', 'Prueba actualizada', 'Prueba de no repetición de registros', '2022-02-28', '2022-03-30', 1, 1),
(60, '2022-02-28 13:22:56', 'Prueba actualizada', 'Prueba de no repetición de registros', '2022-02-28', '2022-03-30', 1, 1),
(61, '2022-02-28 13:24:13', 'Prueba', 'Prueaaaa', '2022-02-28', '2015-01-01', 1, 1);

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
(1, 'Jhon Camargo', 'JhonCamargo21', '$2y$10$3LioBl3o0Cc8zXVgSRP6yOArhw7QRa36oyILxgD63csCstgDBD7Mq', 1, 1),
(2, 'Alexander Cadena', 'AdminCamargo', '$2y$10$3LioBl3o0Cc8zXVgSRP6yOArhw7QRa36oyILxgD63csCstgDBD7Mq', 1, 1),
(3, 'Tyrone González', 'canserbero@gmail.com', '$2y$11$ZdmtqTL2rIm8IUolbNAKV.TTV3HjOhW7cWjK/xY/RADhvVVTfAdmm', 2, 1),
(4, 'John Doe', 'john@doe.com', '$2y$11$wNuzPpdZ0f1mpS6Oi3o4ZuOM/lPbkgSDoWGlnTE2V53pF2gMQJdJ6', 2, 1),
(5, 'Admin', 'admin@admin.com', '$2y$11$GBs4jjTsWXoa8KgRO4uGs.Z4NuNGoAkJKsCX.o3GrSu7cmKYFvZaq', 2, 1),
(6, 'Prueba', 'prueba@prueba.com', '$2y$11$iBCAx/idowGundBKVcOxmeAtBCRDIA67ba3q8bzGSjv0pa66WUdfS', 2, 1),
(7, 'Amparo Cadena', 'ampi1974f@hotmail.com', '$2y$11$G0BhK7FAg6yVPJv7.RoaZe.k6BALl1yt1ITNURGlMJmmwKU2dANdC', 2, 1);

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `IDClasePK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `historial_sql`
--
ALTER TABLE `historial_sql`
  MODIFY `IDHistorialPK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `IDHorarioPK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `job`
--
ALTER TABLE `job`
  MODIFY `IDJobPK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `job_eliminado`
--
ALTER TABLE `job_eliminado`
  MODIFY `IDJobEPK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDUsuarioPK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial_sql`
--
ALTER TABLE `historial_sql`
  ADD CONSTRAINT `hizo` FOREIGN KEY (`IdUsuarioFk`) REFERENCES `usuario` (`IDUsuarioPK`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `Clases_Horario` FOREIGN KEY (`LunesFK`) REFERENCES `clase` (`IDClasePK`) ON UPDATE CASCADE,
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
