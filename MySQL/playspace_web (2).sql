-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2021 a las 17:38:05
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `playspace_web`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSQUEDA_EVENTO` (`usuario_lat` DOUBLE, `usuario_lon` DOUBLE, `dist` INT)  BEGIN
        SELECT
			ID_EVENTO,
			UBICACION_LAT,
			UBICACION_LON,
			HAVERSINE(	usuario_lat,
						usuario_lon,
						UBICACION_LAT,
						UBICACION_LON) AS 'DISTANCIA' 
		FROM 
			EVENTOS 
		HAVING 
			DISTANCIA <= dist;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSQUEDA_TIENDA` (`usuario_lat` DOUBLE, `usuario_lon` DOUBLE, `dist` INT)  BEGIN
        SELECT
			ID_TIENDA,
			UBICACION_LAT,
			UBICACION_LON,
			HAVERSINE(	usuario_lat,
						usuario_lon,
						UBICACION_LAT,
						UBICACION_LON) AS 'DISTANCIA' 
		FROM 
			TIENDAS 
		HAVING 
			DISTANCIA <= dist;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DIFF_FECHAS` (`a` DATETIME)  BEGIN
    select date_sub(a,INTERVAL 7 DAY ) into @diferencia;
    IF @diferencia > now() THEN
		SELECT "NO ADVERTIR";
	ELSE
		SELECT "ADVERTIR";
	END IF;
    END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `CANTIDAD_PEDIDOS_VALIDACION` () RETURNS INT(11) BEGIN
	SELECT COUNT(*) INTO @cantPedidos FROM USUARIOS WHERE CLAVE_VERIFICACION <> '';
    RETURN @cantPedidos;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `CANTIDAD_USUARIOS` () RETURNS INT(11) BEGIN
	SELECT COUNT(*) INTO @cantUsuarios FROM USUARIOS;
    RETURN @cantUsuarios;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `HAVERSINE` (`USUARIO_LAT` DOUBLE, `USUARIO_LON` DOUBLE, `UBICACION_LAT` DOUBLE, `UBICACION_LON` DOUBLE) RETURNS DOUBLE BEGIN
		SET @USU_LAT = USUARIO_LAT;
        SET @USU_LON = USUARIO_LON;
    
		SET @UBI_LAT = RADIANS(UBICACION_LAT);
        SET @UBI_LON = RADIANS(UBICACION_LON);
        
        SET @LAT_DIF = @UBI_LAT - @USU_LAT;
        SET @LON_DIF = @UBI_LON - @USU_LON;
        
        SET @ANGULO = 2*ASIN(SQRT(POW(SIN(@LAT_DIF /2), 2) + COS(@USU_LAT) * COS(@UBI_LAT) * POW(SIN(@LON_DIF/2),2)));
        RETURN @ANGULO*6371000;
	END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `ID_CHAT` varchar(45) NOT NULL,
  `ID_SOLICITANTE` int(11) NOT NULL,
  `ID_OBJETIVO` int(11) NOT NULL,
  `AMISTAD` tinyint(1) DEFAULT NULL,
  `KEY_ENCRIPTACION_SOLICITANTE` text DEFAULT NULL,
  `KEY_ENCRIPTACION_OBJETIVO` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`ID_CHAT`, `ID_SOLICITANTE`, `ID_OBJETIVO`, `AMISTAD`, `KEY_ENCRIPTACION_SOLICITANTE`, `KEY_ENCRIPTACION_OBJETIVO`) VALUES
('1_4', 1, 4, 0, NULL, NULL),
('1_6', 1, 6, 1, '000 011025f19c557a314a746441242396fd', '399800TL327eZ2ducc0bBdC115fG01qIpFwwl/coAWBmoHQmQD/JASDh0MyJoZ/+FtTumZgZOgslYrr0+9wI9a'),
('2_5', 2, 5, 1, '95009d5885bb088bea909b62a6b1bd36', 'f6d51c6e1eff55854257acbe49b15162'),
('2_6', 2, 6, 1, 'aaa a6c4a03c1f161834f34276d7cda6dca4', 'aaa a6c4a03c1f161834f34276d7cda6dca4'),
('3_6', 3, 6, 1, '444 48b1d3e1bd4626aec96f965d080e8a9c', '444 48b1d3e1bd4626aec96f965d080e8a9c'),
('4_6', 4, 6, 1, 'ddd d9a5c6de8ef31870c7c18465dba3f208', 'ddd d9a5c6de8ef31870c7c18465dba3f208');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_amigos`
--

CREATE TABLE `chat_amigos` (
  `ID_CHAT` varchar(45) NOT NULL,
  `MENSAJE` text NOT NULL,
  `FECHA_MENSAJE` datetime DEFAULT NULL,
  `ID_REMITENTE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_evento`
--

CREATE TABLE `chat_evento` (
  `ID_EVENTO` int(11) NOT NULL,
  `MENSAJE` text NOT NULL,
  `FECHA_MENSAJE` datetime DEFAULT NULL,
  `ID_REMITENTE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_tienda`
--

CREATE TABLE `chat_tienda` (
  `ID_TIENDA` int(11) NOT NULL,
  `ID_REMITENTE` int(11) NOT NULL,
  `MENSAJE` text NOT NULL,
  `FECHA_MENSAJE` datetime NOT NULL,
  `MENSAJE_RESPUESTA` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `ID_USUARIO` int(11) NOT NULL,
  `ID_EVENTO` int(11) NOT NULL,
  `TAMANO_EVENTO` int(11) DEFAULT NULL,
  `CANTIDAD_PARTICIPANTES` int(11) NOT NULL,
  `TIPO_EVENTO` int(11) NOT NULL,
  `DESCRIPCION` text DEFAULT NULL,
  `UBICACION_LAT` double NOT NULL,
  `UBICACION_LON` double NOT NULL,
  `FECHA_INICIO` datetime NOT NULL,
  `FECHA_FIN` datetime NOT NULL,
  `CALIFICACION_EVENTO` double DEFAULT 5,
  `CANTIDAD_CALIFICACIONES` int(11) DEFAULT 0,
  `EVENTO_FALSO` int(11) DEFAULT 0,
  `CHAT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`ID_USUARIO`, `ID_EVENTO`, `TAMANO_EVENTO`, `CANTIDAD_PARTICIPANTES`, `TIPO_EVENTO`, `DESCRIPCION`, `UBICACION_LAT`, `UBICACION_LON`, `FECHA_INICIO`, `FECHA_FIN`, `CALIFICACION_EVENTO`, `CANTIDAD_CALIFICACIONES`, `EVENTO_FALSO`, `CHAT`) VALUES
(4, 41, 2, 6, 5, 'vb', 2.572685535034676, -72.6479, '2021-07-02 07:47:00', '2021-06-02 10:47:00', 5, 0, 0, 0),
(6, 61, 1, 8, 14, 'Vamoh a jugar beisbol o que coma??', 2.5650345643723425, -72.63908950262453, '2021-07-07 00:39:00', '2021-07-07 15:39:00', 5, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `info_amigos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `info_amigos` (
`ID_CHAT` varchar(45)
,`ID_USUARIO` int(11)
,`ID_AMIGO` int(11)
,`NOMBRE_AMIGO` varchar(45)
,`ID_FOTO_PERFIL` tinyint(4)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `info_basica_usuario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `info_basica_usuario` (
`ID_USUARIO` int(11)
,`NOMBRE_USUARIO` varchar(45)
,`ID_FOTO_PERFIL` tinyint(4)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `info_participantes_evento`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `info_participantes_evento` (
`ID_EVENTO` int(11)
,`ID_PARTICIPANTE` int(11)
,`ID_FOTO_PERFIL` tinyint(4)
,`NOMBRE_USUARIO` varchar(45)
,`ADMINISTRADOR` int(1)
,`CALIFICACION_USUARIO` double
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `info_solicitudes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `info_solicitudes` (
`ID_USUARIO_SOLICITANTE` int(11)
,`ID_USUARIO_AMIGO_1` int(11)
,`ID_USUARIO_AMIGO_2` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `info_solicitudes_rechazadas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `info_solicitudes_rechazadas` (
`ID_USUARIO_SOLICITANTE` int(11)
,`ID_USUARIO_AMIGO_1` int(11)
,`ID_USUARIO_AMIGO_2` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_eventos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_eventos` (
`ID_EVENTO` int(11)
,`TIPO_EVENTO` int(11)
,`CANTIDAD_INSCRITOS` bigint(21)
,`CANTIDAD_PARTICIPANTES` int(11)
,`FECHA_INICIO` datetime
,`TAMANO_EVENTO` int(11)
,`ID_CREADOR` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lista_tiendas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lista_tiendas` (
`ID_TIENDA` int(11)
,`NOMBRE_TIENDA` text
,`FIN_PUBLICACION` datetime
,`TIPO_PRODUCTOS` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papelera_de_reciclaje`
--

CREATE TABLE `papelera_de_reciclaje` (
  `MENSAJE` text DEFAULT NULL,
  `FECHA_MENSAJE` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `papelera_de_reciclaje`
--

INSERT INTO `papelera_de_reciclaje` (`MENSAJE`, `FECHA_MENSAJE`) VALUES
('Cuenta Creada', '2021-06-12 19:24:23'),
('Tienda Creada', '2021-07-01 17:11:45'),
('Tienda Creada', '2021-07-01 20:29:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes_evento`
--

CREATE TABLE `participantes_evento` (
  `ID_EVENTO` int(11) NOT NULL,
  `ID_PARTICIPANTE` int(11) NOT NULL,
  `MALOS_COMPORTAMIENTOS` int(11) DEFAULT 0,
  `ASISTIO` int(11) DEFAULT 0,
  `CALIFICACION_EVENTO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `participantes_evento`
--

INSERT INTO `participantes_evento` (`ID_EVENTO`, `ID_PARTICIPANTE`, `MALOS_COMPORTAMIENTOS`, `ASISTIO`, `CALIFICACION_EVENTO`) VALUES
(61, 6, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes_expulsados`
--

CREATE TABLE `participantes_expulsados` (
  `ID_EVENTO` int(11) NOT NULL,
  `ID_EXPULSADO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_TIENDA` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `NOMBRE_PRODUCTO` text NOT NULL,
  `PRECIO_PRODUCTO` double NOT NULL,
  `FOTO_PRODUCTO` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportantes_evento`
--

CREATE TABLE `reportantes_evento` (
  `ID_EVENTO` int(11) NOT NULL,
  `ID_REPORTANTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `ID_USUARIO` int(11) NOT NULL,
  `TIPO_REPORTE` int(11) NOT NULL,
  `FECHA_REPORTE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`ID_USUARIO`, `TIPO_REPORTE`, `FECHA_REPORTE`) VALUES
(2, 4, '2021-06-12 18:24:38'),
(2, 1, '2018-08-02 12:33:11'),
(2, 1, '2021-05-24 12:33:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE `tiendas` (
  `ID_USUARIO` int(11) NOT NULL,
  `ID_TIENDA` int(11) NOT NULL,
  `NOMBRE_TIENDA` text NOT NULL,
  `UBICACION_LAT` double NOT NULL,
  `UBICACION_LON` double NOT NULL,
  `DESCRIPCION` text DEFAULT NULL,
  `TELEFONO` bigint(20) DEFAULT NULL,
  `CORREO` varchar(30) DEFAULT NULL,
  `DIRECCION` text DEFAULT NULL,
  `FIN_PUBLICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`ID_USUARIO`, `ID_TIENDA`, `NOMBRE_TIENDA`, `UBICACION_LAT`, `UBICACION_LON`, `DESCRIPCION`, `TELEFONO`, `CORREO`, `DIRECCION`, `FIN_PUBLICACION`) VALUES
(3, 31, 'Melasuda', 2.542685535034676, -72.6779, 'Descripcion que describe kosas', 3144085417, 'portal2matr@gmail.com', 'Ninguna', '2022-07-06 20:24:36');

--
-- Disparadores `tiendas`
--
DELIMITER $$
CREATE TRIGGER `CREADO_TIENDA` AFTER INSERT ON `tiendas` FOR EACH ROW INSERT INTO PAPELERA_DE_RECICLAJE (MENSAJE) VALUES ('Tienda Creada')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos`
--

CREATE TABLE `tipo_productos` (
  `ID_TIENDA` int(11) NOT NULL,
  `TIPO_PRODUCTOS` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_productos`
--

INSERT INTO `tipo_productos` (`ID_TIENDA`, `TIPO_PRODUCTOS`) VALUES
(31, '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOMBRE_USUARIO` varchar(45) NOT NULL,
  `ID_FOTO_PERFIL` tinyint(4) NOT NULL,
  `CONTRASENA` varchar(60) NOT NULL,
  `CORREO` varchar(60) NOT NULL,
  `PARTICIPACIONES` int(11) DEFAULT NULL,
  `INASISTENCIAS` int(11) DEFAULT NULL,
  `EVENTOS_REALIZADOS` int(11) DEFAULT NULL,
  `FECHA_CAMBIO_NOMBRE` datetime DEFAULT NULL,
  `CLAVE_VERIFICACION` varchar(12) DEFAULT NULL,
  `FECHA_CLAVE_VERIFICACION` datetime DEFAULT NULL,
  `CALIFICACION_USUARIO` double NOT NULL DEFAULT 5,
  `CALIFICACION_EVENTOS` double DEFAULT NULL,
  `FECHA_REPORTE_EVENTO` datetime DEFAULT NULL,
  `TIENDA_PRUEBA` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `NOMBRE_USUARIO`, `ID_FOTO_PERFIL`, `CONTRASENA`, `CORREO`, `PARTICIPACIONES`, `INASISTENCIAS`, `EVENTOS_REALIZADOS`, `FECHA_CAMBIO_NOMBRE`, `CLAVE_VERIFICACION`, `FECHA_CLAVE_VERIFICACION`, `CALIFICACION_USUARIO`, `CALIFICACION_EVENTOS`, `FECHA_REPORTE_EVENTO`, `TIENDA_PRUEBA`) VALUES
(1, 'DonHardCore', 4, 'elbiernez', 'flipas@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 1),
(2, 'Elquereparte', 1, 'lasostias', 'sinconsagrar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 1),
(3, 'JhoyMorenoMar', 8, '1a45109660b1b1d11403a3a2022446815de25d06684a530316', 'js.marroko313@outlook.com', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 1),
(4, 'FelizJuevez', 10, 'YelCuerpoYa', 'nilosabe@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 1),
(5, 'DeltaForce', 7, '25CountingStars25', 'dontforget@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 1),
(6, '2021Matt21RR', 1, 'd697e90d7188b816938854f2ad941cc98d3380eefcef878ce6', 'portal2matr@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 0);

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `BORRADO_CUENTA` AFTER DELETE ON `usuarios` FOR EACH ROW INSERT INTO PAPELERA_DE_RECICLAJE (MENSAJE) VALUES ('Cuenta Borrada')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `CREADO_CUENTA` AFTER INSERT ON `usuarios` FOR EACH ROW INSERT INTO PAPELERA_DE_RECICLAJE (MENSAJE) VALUES ('Cuenta Creada')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura para la vista `info_amigos`
--
DROP TABLE IF EXISTS `info_amigos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `info_amigos`  AS SELECT `t1`.`ID_CHAT` AS `ID_CHAT`, CASE WHEN `t1`.`ID_SOLICITANTE` = `t2`.`ID_USUARIO` THEN `t1`.`ID_SOLICITANTE` ELSE `t1`.`ID_OBJETIVO` END AS `ID_USUARIO`, CASE WHEN `t1`.`ID_SOLICITANTE` = `t2`.`ID_USUARIO` THEN `t1`.`ID_OBJETIVO` ELSE `t1`.`ID_SOLICITANTE` END AS `ID_AMIGO`, (select `usuarios`.`NOMBRE_USUARIO` from `usuarios` where `usuarios`.`ID_USUARIO` = case when `t1`.`ID_SOLICITANTE` = `t2`.`ID_USUARIO` then `t1`.`ID_OBJETIVO` else `t1`.`ID_SOLICITANTE` end) AS `NOMBRE_AMIGO`, (select `usuarios`.`ID_FOTO_PERFIL` from `usuarios` where `usuarios`.`ID_USUARIO` = case when `t1`.`ID_SOLICITANTE` = `t2`.`ID_USUARIO` then `t1`.`ID_OBJETIVO` else `t1`.`ID_SOLICITANTE` end) AS `ID_FOTO_PERFIL` FROM (`amigos` `t1` join `usuarios` `t2`) WHERE (`t2`.`ID_USUARIO` = `t1`.`ID_SOLICITANTE` OR `t2`.`ID_USUARIO` = `t1`.`ID_OBJETIVO`) AND `t1`.`AMISTAD` = 1 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `info_basica_usuario`
--
DROP TABLE IF EXISTS `info_basica_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `info_basica_usuario`  AS SELECT `usuarios`.`ID_USUARIO` AS `ID_USUARIO`, `usuarios`.`NOMBRE_USUARIO` AS `NOMBRE_USUARIO`, `usuarios`.`ID_FOTO_PERFIL` AS `ID_FOTO_PERFIL` FROM `usuarios` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `info_participantes_evento`
--
DROP TABLE IF EXISTS `info_participantes_evento`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `info_participantes_evento`  AS SELECT `t3`.`ID_EVENTO` AS `ID_EVENTO`, `t3`.`ID_PARTICIPANTE` AS `ID_PARTICIPANTE`, `t1`.`ID_FOTO_PERFIL` AS `ID_FOTO_PERFIL`, `t1`.`NOMBRE_USUARIO` AS `NOMBRE_USUARIO`, CASE WHEN `t3`.`ID_EVENTO` = `t2`.`ID_EVENTO` AND `t3`.`ID_PARTICIPANTE` = `t2`.`ID_USUARIO` THEN 1 ELSE 0 END AS `ADMINISTRADOR`, `t1`.`CALIFICACION_USUARIO` AS `CALIFICACION_USUARIO` FROM ((`usuarios` `t1` join `eventos` `t2`) join `participantes_evento` `t3`) WHERE `t3`.`ID_PARTICIPANTE` = `t1`.`ID_USUARIO` AND `t3`.`ID_EVENTO` = `t2`.`ID_EVENTO` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `info_solicitudes`
--
DROP TABLE IF EXISTS `info_solicitudes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `info_solicitudes`  AS SELECT `t1`.`ID_SOLICITANTE` AS `ID_USUARIO_SOLICITANTE`, CASE WHEN `t1`.`ID_SOLICITANTE` = `t2`.`ID_USUARIO` THEN `t1`.`ID_SOLICITANTE` ELSE `t1`.`ID_OBJETIVO` END AS `ID_USUARIO_AMIGO_1`, CASE WHEN `t1`.`ID_SOLICITANTE` = `t2`.`ID_USUARIO` THEN `t1`.`ID_OBJETIVO` ELSE `t1`.`ID_SOLICITANTE` END AS `ID_USUARIO_AMIGO_2` FROM (`amigos` `t1` join `usuarios` `t2`) WHERE (`t2`.`ID_USUARIO` = `t1`.`ID_SOLICITANTE` OR `t2`.`ID_USUARIO` = `t1`.`ID_OBJETIVO`) AND `t1`.`AMISTAD` = 0 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `info_solicitudes_rechazadas`
--
DROP TABLE IF EXISTS `info_solicitudes_rechazadas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `info_solicitudes_rechazadas`  AS SELECT `t1`.`ID_SOLICITANTE` AS `ID_USUARIO_SOLICITANTE`, CASE WHEN `t1`.`ID_SOLICITANTE` = `t2`.`ID_USUARIO` THEN `t1`.`ID_SOLICITANTE` ELSE `t1`.`ID_OBJETIVO` END AS `ID_USUARIO_AMIGO_1`, CASE WHEN `t1`.`ID_SOLICITANTE` = `t2`.`ID_USUARIO` THEN `t1`.`ID_OBJETIVO` ELSE `t1`.`ID_SOLICITANTE` END AS `ID_USUARIO_AMIGO_2` FROM (`amigos` `t1` join `usuarios` `t2`) WHERE (`t2`.`ID_USUARIO` = `t1`.`ID_SOLICITANTE` OR `t2`.`ID_USUARIO` = `t1`.`ID_OBJETIVO`) AND `t1`.`AMISTAD` = -1 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_eventos`
--
DROP TABLE IF EXISTS `lista_eventos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_eventos`  AS SELECT `t1`.`ID_EVENTO` AS `ID_EVENTO`, `t1`.`TIPO_EVENTO` AS `TIPO_EVENTO`, count(`t2`.`ID_PARTICIPANTE`) AS `CANTIDAD_INSCRITOS`, `t1`.`CANTIDAD_PARTICIPANTES` AS `CANTIDAD_PARTICIPANTES`, `t1`.`FECHA_INICIO` AS `FECHA_INICIO`, `t1`.`TAMANO_EVENTO` AS `TAMANO_EVENTO`, `t1`.`ID_USUARIO` AS `ID_CREADOR` FROM (`eventos` `t1` join `participantes_evento` `t2`) WHERE `t1`.`ID_EVENTO` = `t2`.`ID_EVENTO` GROUP BY `t1`.`ID_EVENTO` ORDER BY `t1`.`FECHA_INICIO` ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `lista_tiendas`
--
DROP TABLE IF EXISTS `lista_tiendas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lista_tiendas`  AS SELECT `t1`.`ID_TIENDA` AS `ID_TIENDA`, `t1`.`NOMBRE_TIENDA` AS `NOMBRE_TIENDA`, `t1`.`FIN_PUBLICACION` AS `FIN_PUBLICACION`, `t2`.`TIPO_PRODUCTOS` AS `TIPO_PRODUCTOS` FROM (`tiendas` `t1` join `tipo_productos` `t2`) WHERE `t1`.`ID_TIENDA` = `t2`.`ID_TIENDA` ORDER BY `t1`.`FIN_PUBLICACION` DESC ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`ID_CHAT`),
  ADD KEY `ID_SOLICITANTE` (`ID_SOLICITANTE`),
  ADD KEY `ID_OBJETIVO` (`ID_OBJETIVO`);

--
-- Indices de la tabla `chat_amigos`
--
ALTER TABLE `chat_amigos`
  ADD KEY `ID_CHAT` (`ID_CHAT`);

--
-- Indices de la tabla `chat_evento`
--
ALTER TABLE `chat_evento`
  ADD KEY `ID_EVENTO` (`ID_EVENTO`);

--
-- Indices de la tabla `chat_tienda`
--
ALTER TABLE `chat_tienda`
  ADD KEY `ID_TIENDA` (`ID_TIENDA`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`ID_EVENTO`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `participantes_evento`
--
ALTER TABLE `participantes_evento`
  ADD KEY `ID_EVENTO` (`ID_EVENTO`),
  ADD KEY `ID_PARTICIPANTE` (`ID_PARTICIPANTE`);

--
-- Indices de la tabla `participantes_expulsados`
--
ALTER TABLE `participantes_expulsados`
  ADD KEY `ID_EVENTO` (`ID_EVENTO`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD KEY `ID_TIENDA` (`ID_TIENDA`);

--
-- Indices de la tabla `reportantes_evento`
--
ALTER TABLE `reportantes_evento`
  ADD KEY `ID_EVENTO` (`ID_EVENTO`),
  ADD KEY `ID_REPORTANTE` (`ID_REPORTANTE`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`ID_TIENDA`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  ADD KEY `ID_TIENDA` (`ID_TIENDA`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `amigos_ibfk_1` FOREIGN KEY (`ID_SOLICITANTE`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `amigos_ibfk_2` FOREIGN KEY (`ID_OBJETIVO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `chat_amigos`
--
ALTER TABLE `chat_amigos`
  ADD CONSTRAINT `chat_amigos_ibfk_1` FOREIGN KEY (`ID_CHAT`) REFERENCES `amigos` (`ID_CHAT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `chat_evento`
--
ALTER TABLE `chat_evento`
  ADD CONSTRAINT `chat_evento_ibfk_1` FOREIGN KEY (`ID_EVENTO`) REFERENCES `eventos` (`ID_EVENTO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `chat_tienda`
--
ALTER TABLE `chat_tienda`
  ADD CONSTRAINT `chat_tienda_ibfk_1` FOREIGN KEY (`ID_TIENDA`) REFERENCES `tiendas` (`ID_TIENDA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `participantes_evento`
--
ALTER TABLE `participantes_evento`
  ADD CONSTRAINT `participantes_evento_ibfk_1` FOREIGN KEY (`ID_EVENTO`) REFERENCES `eventos` (`ID_EVENTO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participantes_evento_ibfk_2` FOREIGN KEY (`ID_PARTICIPANTE`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `participantes_expulsados`
--
ALTER TABLE `participantes_expulsados`
  ADD CONSTRAINT `participantes_expulsados_ibfk_1` FOREIGN KEY (`ID_EVENTO`) REFERENCES `eventos` (`ID_EVENTO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`ID_TIENDA`) REFERENCES `tiendas` (`ID_TIENDA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reportantes_evento`
--
ALTER TABLE `reportantes_evento`
  ADD CONSTRAINT `reportantes_evento_ibfk_1` FOREIGN KEY (`ID_EVENTO`) REFERENCES `eventos` (`ID_EVENTO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reportantes_evento_ibfk_2` FOREIGN KEY (`ID_REPORTANTE`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD CONSTRAINT `tiendas_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  ADD CONSTRAINT `tipo_productos_ibfk_1` FOREIGN KEY (`ID_TIENDA`) REFERENCES `tiendas` (`ID_TIENDA`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
