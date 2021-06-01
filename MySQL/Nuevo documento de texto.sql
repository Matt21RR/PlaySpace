-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2021 a las 15:02:36
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
-- Base de datos: `bd_pruebas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_anotaciones`
--

create database pruebasbd;
use pruebasbd;

CREATE TABLE `tb_anotaciones` (
  `id_nota` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha_registro` date NOT NULL,
  `id_cita_medica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_anotaciones`
--

INSERT INTO `tb_anotaciones` (`id_nota`, `descripcion`, `fecha_registro`, `id_cita_medica`) VALUES
(1, 'El paciente no se presentó a la cita médica.', '2021-04-23', 1),
(2, 'El paciente requiere cirugía.', '2021-04-14', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_citas_medicas`
--

CREATE TABLE `tb_citas_medicas` (
  `id_cita_medica` int(11) NOT NULL,
  `fecha_cita` datetime NOT NULL,
  `documento` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_citas_medicas`
--

INSERT INTO `tb_citas_medicas` (`id_cita_medica`, `fecha_cita`, `documento`) VALUES
(1, '2021-04-22 14:04:04', '45436'),
(2, '2021-04-23 14:52:39', '222222');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_personas`
--

CREATE TABLE `tb_personas` (
  `documento` varchar(15) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_personas`
--

INSERT INTO `tb_personas` (`documento`, `nombre`) VALUES
('', ''),
('124352', 'Pepito Perez'),
('222222', 'Marcos Sanchez'),
('45436', 'Maria Martinez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_anotaciones`
--
ALTER TABLE `tb_anotaciones`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indices de la tabla `tb_citas_medicas`
--
ALTER TABLE `tb_citas_medicas`
  ADD PRIMARY KEY (`id_cita_medica`);

--
-- Indices de la tabla `tb_personas`
--
ALTER TABLE `tb_personas`
  ADD PRIMARY KEY (`documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_anotaciones`
--
ALTER TABLE `tb_anotaciones`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_citas_medicas`
--
ALTER TABLE `tb_citas_medicas`
  MODIFY `id_cita_medica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

INSERT INTO tb_anotaciones values (null, 'Cirugía', NOW(), 1);
INSERT INTO tb_anotaciones values (null, 'Cirugía', NOW(), 2);

SELECT COUNT(*) AS 'Cantidad filas' FROM tb_anotaciones;

DESCRIBE tb_anotaciones;

select *
from tb_anotaciones;

SELECT COUNT(*) as 'Conteo', descripcion, sum(valor) as 'SUMA'
FROM tb_anotaciones
WHERE fecha_registro = date(NOW())
GROUP BY descripcion; 

SELECT COUNT(*) as 'Conteo', descripcion, sum(valor) as 'SUMA'
FROM tb_anotaciones
GROUP BY descripcion; 

ALTER TABLE tb_anotaciones 
ADD valor 
double null AFTER descripcion;

update tb_anotaciones
set valor = 50
where fecha_registro <> DATE(NOW());

update tb_anotaciones
set valor = 100
where fecha_registro = DATE(NOW());

SELECT t1.documento,nombre, sum(valor) as suma, count(nombre) as 'Cantidad citas'
FROM tb_personas t1, tb_citas_medicas t2, tb_anotaciones t3
WHERE t1.documento = t2.documento
AND t2.id_cita_medica = t3.id_cita_medica
GROUP BY t1.nombre;

CREATE VIEW Vista_ejercicio 
AS
SELECT t1.documento,nombre, sum(valor) as suma, count(nombre) as 'Cantidad citas'
FROM tb_personas t1, tb_citas_medicas t2, tb_anotaciones t3
WHERE t1.documento = t2.documento
AND t2.id_cita_medica = t3.id_cita_medica
GROUP BY t1.nombre;

SELECT * FROM Vista_ejercicio;

SELECT upper(replace('el perro es verde','gato','cat'));
select upper(replace(nombre,"a","1")) from tb_personas;

select left(nombre, instr(nombre, ' ')) as Nombre , right(nombre,( length(nombre) - instr(nombre, ' '))) as Apellido  from tb_personas;
select length(nombre) from tb_personas;

select length(trim('   camilo   '));

select 
	case 
		when length(nombre) >0 
		then 'Nosta vacia, UwU'
		else 'Ta vacia, UnU'
	end,
    nombre
from tb_personas;

DELIMITER //

CREATE FUNCTION algotext( a varchar(50), b varchar(50)) RETURNS text
BEGIN
	RETURN concat(a," <b>",b,"</b>");
END //
DELIMITER ;
DROP FUNCTION algotext;
#----------------------------------------------------------------------------
DELIMITER //

CREATE FUNCTION algo( a int, b int) RETURNS int
BEGIN
	RETURN (a+b);
END //
DELIMITER ;
#----------------------------------------------------------------------------

SELECT algo('Miguel Angel', 'Traslaviña Rodriguez');

DROP FUNCTION algo;

DELIMITER //

CREATE FUNCTION algo( doc varchar(50), nuevo_nombre varchar(50)) RETURNS int
BEGIN
	UPDATE tb_personas SET nombre = nuevo_nombre WHERE documento = doc;
	RETURN 0;
END //
DELIMITER ;
#----------------------------------------------------------------------------

SELECT algo('124352','Pepipo Rojas');
SELECT algo();

DELIMITER //

CREATE FUNCTION algo( ) RETURNS int
BEGIN
	SELECT COUNT(*) INTO @conteo FROM tb_personas;
	RETURN @conteo;
END //
DELIMITER ;
#----------------------------------------------------------------------------



CREATE table tb_tmp
(
	doc varchar(50) not null,
    primary key( doc )
);

INSERT INTO tb_tmp ( doc )
SELECT documento FROM tb_personas;

select * from tb_tmp;


SELECT * FROM tb_personas ORDER BY fecha_registro DESC;
SELECT t1.documento, COUNT(t2.id_cita_medica) AS CITAS FROM tb_personas t1, tb_citas_medicas t2 WHERE t1.documento = t2.documento GROUP BY t1.documento ORDER BY CITAS DESC;

#----------------------------------------------------------------------------
DELIMITER //
CREATE PROCEDURE sp_algo (a double, b double)
	BEGIN
    select a+b into @suma;
    IF @suma > 0 THEN
		SELECT "NO VACIO";
	ELSE
		SELECT "VACIO";
	END IF;
    END
//
DELIMITER ;
#----------------------------------------------------------------------------
drop procedure sp_algo;
call sp_algo(1.5,0.2);

