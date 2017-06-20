-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2017 a las 12:42:09
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sigpi`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE  PROCEDURE `actualizarEmpleado` (IN `_nombreCompleto` VARCHAR(50) CHARSET utf8, IN `_documento` VARCHAR(50) CHARSET utf8, IN `_telefonoFijo` VARCHAR(50) CHARSET utf8, IN `_telefonoCelular` VARCHAR(50) CHARSET utf8, IN `_correoElectronico` VARCHAR(50) CHARSET utf8, IN `_direccion` VARCHAR(50) CHARSET utf8, IN `_idRol` INT, IN `_idUsuario` INT, IN `_idEmpleado` INT)  BEGIN
UPDATE Usuario SET nombreUsuario = _correoElectronico WHERE idUsuario = _idUsuario;

    UPDATE Empleado SET nombreCompleto = _nombreCompleto, documento = _documento, telefonoFijo = _telefonoFijo, 
    telefonoCelular = _telefonoCelular, correoElectronico = _correoElectronico, direccion = _direccion, Rol_idRol = _idRol
    WHERE idEmpleado = _idEmpleado;
END$$

CREATE  PROCEDURE `actualizarProveedor` (IN `_nombre` VARCHAR(50) CHARSET utf8, IN `_asesor` VARCHAR(50) CHARSET utf8, IN `_telefono` VARCHAR(50) CHARSET utf8, IN `_correoElectronico` VARCHAR(50) CHARSET utf8, IN `_direccion` VARCHAR(50) CHARSET utf8, IN `_idProveedor` INT)  BEGIN
    UPDATE Proveedor SET nombre = _nombre, asesor = _asesor, telefono = _telefono,
     correoElectronico = _correoElectronico, direccion =_direccion WHERE idProveedor = _idProveedor;
END$$

CREATE  PROCEDURE `actualizarProyecto` (IN `_nombre` VARCHAR(50) CHARSET utf8, IN `_inicio` DATE, IN `_fin` DATE, IN `_avance` VARCHAR(50) CHARSET utf8, IN `_Cliente` INT, IN `_estado` INT, IN `_idProyecto` INT)  BEGIN
    UPDATE Proyecto SET nombre = _nombre, fechaInicio = _inicio, fechaEntrega = _fin,
     porcentajeAvance = _avance, Cliente_idCliente =_Cliente, EstadoProyecto_idEstadoProyecto = _estado WHERE idProyecto = _idProyecto;
END$$

CREATE  PROCEDURE `buscarCorreo` (IN `_email` VARCHAR(50) CHARSET utf8)  BEGIN
    SELECT count(*) AS Usuario
    FROM Usuario
    where nombreUsuario = _email AND visibilidad = 1;
END$$

CREATE  PROCEDURE `buscarUsuario` (IN `_idEmpleado` VARCHAR(50) CHARSET utf8)  BEGIN
    select contrasena, nombreUsuario
    from Empleado inner join Usuario on Empleado.Usuario_idUsuario = Usuario.idUsuario 
    where idEmpleado = _idEmpleado AND Usuario.visibilidad = 1;
END$$

CREATE  PROCEDURE `cambiarContrasena` (IN `_email` VARCHAR(50) CHARSET utf8, IN `_pass` VARCHAR(255) CHARSET utf8)  BEGIN
    UPDATE Usuario
    SET contrasena = _pass
    where nombreUsuario = _email AND visibilidad = 1;
END$$

CREATE  PROCEDURE `consultarIdRol` (IN `_nombre` VARCHAR(45) CHARSET utf8)  SELECT idRol FROM Rol WHERE nombre = _nombre$$

CREATE  PROCEDURE `conteoEquipo` (`_idProyecto` INT)  BEGIN 
    SELECT COUNT(*) AS numero FROM EquipoTrabajo
    WHERE Proyecto_idProyecto = _idProyecto;
END$$

CREATE  PROCEDURE `conteoOrdenes` (`_idProyecto` INT)  BEGIN 
    SELECT COUNT(*) AS numero FROM Orden
    WHERE Plano_idPlano = (SELECT idPlano FROM Plano WHERE Proyecto_idProyecto = _idProyecto);
END$$

CREATE  PROCEDURE `conteoReporteDevolucionMaterial` (`_idMaterial` INT)  BEGIN 
    SELECT COUNT(*) AS numero FROM Tramite
    WHERE Material_idMaterial = _idMaterial AND tipo = 'Devolucion';
END$$

CREATE  PROCEDURE `conteoReporteEntradaMaterial` (`_idMaterial` INT)  BEGIN 
    SELECT COUNT(*) AS numero FROM Tramite
    WHERE Material_idMaterial = _idMaterial AND tipo = 'Entrada';
END$$

CREATE  PROCEDURE `conteoReporteSalidaMaterial` (`_idMaterial` INT)  BEGIN 
    SELECT COUNT(*) AS numero FROM Tramite
    WHERE Material_idMaterial = _idMaterial AND tipo = 'Salida';
END$$

CREATE  PROCEDURE `eliminarDirectorio` (IN `_idMaterial` INT, IN `_idProveedor` INT)  BEGIN
    DELETE FROM DirectorioProveedor 
    WHERE (Material_idMaterial = _idMaterial) AND ( Proveedor_idProveedor = _idProveedor);
END$$

CREATE  PROCEDURE `eliminarEquipo` (`_idEmpleado` INT, `_idProyecto` INT)  BEGIN
    DELETE FROM EquipoTrabajo  
    WHERE (Empleado_idEmpleado = _idEmpleado) AND ( Proyecto_idProyecto = _idProyecto);
END$$

CREATE  PROCEDURE `eliminarInforme` (`_idArchivo` INT)  BEGIN
    UPDATE Informe SET visibilidad = 0 WHERE idArchivo = _idArchivo;
END$$

CREATE  PROCEDURE `inhabilitarEmpleado` (`_idEmpleado` INT)  BEGIN
UPDATE Usuario SET visibilidad = 0 WHERE idUsuario = (SELECT Usuario_idUsuario FROM Empleado WHERE idEmpleado = _idEmpleado);

    UPDATE Empleado SET visibilidad = 0 WHERE idEmpleado = _idEmpleado;
END$$

CREATE  PROCEDURE `inhabilitarPlano` (`_idArchivo` INT)  BEGIN
    UPDATE Plano SET visibilidad = 0 WHERE idPlano = (SELECT Plano_idPlano FROM ArchivoPlano WHERE idArchivo = _idArchivo);
    UPDATE Orden SET visibilidad = 0 WHERE Plano_idPlano = (SELECT Plano_idPlano FROM ArchivoPlano WHERE idArchivo = _idArchivo);
    UPDATE ArchivoPlano SET visibilidad = 0 WHERE  idArchivo = _idArchivo;
END$$

CREATE  PROCEDURE `inhabilitarProveedor` (`_idProveedor` INT)  BEGIN
    UPDATE Proveedor SET visibilidad = 0 WHERE idProveedor = _idProveedor;
    DELETE FROM DirectorioProveedor WHERE Proveedor_idProveedor = _idProveedor;
END$$

CREATE  PROCEDURE `inhabilitarProyecto` (`_idProyecto` INT)  BEGIN
    UPDATE Proyecto SET visibilidad = 0 WHERE idProyecto = _idProyecto;  
    UPDATE Plano SET visibilidad = 0 WHERE Proyecto_idProyecto = _idProyecto;  
    UPDATE ArchivoPlano SET visibilidad = 0 WHERE Plano_idPlano = (SELECT idPlano FROM Plano WHERE Proyecto_idProyecto = _idProyecto);  
    UPDATE Orden SET visibilidad = 0 WHERE Plano_idPlano = (SELECT idPlano FROM Plano WHERE Proyecto_idProyecto = _idProyecto);    
    UPDATE EquipoTrabajo SET visibilidad = 0 WHERE Proyecto_idProyecto = _idProyecto; 
END$$

CREATE  PROCEDURE `login` (IN `_email` VARCHAR(50) CHARSET utf8)  BEGIN
    select idEmpleado, nombreCompleto, Rol_idRol, nombre as Rol, contrasena
    from Empleado inner join Usuario on Empleado.Usuario_idUsuario = Usuario.idUsuario 
    inner join Rol on Empleado.Rol_idRol = Rol.idRol 
    where nombreUsuario = _email AND Usuario.visibilidad = 1;
END$$

CREATE  PROCEDURE `nuevoDirectorio` (`_idMaterial` INT, `_idProveedor` INT)  BEGIN
    insert into DirectorioProveedor (Material_idMaterial, Proveedor_idProveedor, visibilidad)
    values (_idMaterial, _idProveedor, 1);
END$$

CREATE  PROCEDURE `nuevoEquipo` (`_idEmpleado` INT, `_idProyecto` INT)  BEGIN
    insert into EquipoTrabajo (Empleado_idEmpleado, Proyecto_idProyecto, visibilidad)
    values (_idEmpleado, _idProyecto, 1);
END$$

CREATE  PROCEDURE `registrarEmpleado` (IN `_nombreCompleto` VARCHAR(50) CHARSET utf8, IN `_contrasena` VARCHAR(255) CHARSET utf8, IN `_documento` VARCHAR(50) CHARSET utf8, IN `_telefonoFijo` VARCHAR(50) CHARSET utf8, IN `_telefonoCelular` VARCHAR(50) CHARSET utf8, IN `_correoElectronico` VARCHAR(50) CHARSET utf8, IN `_direccion` VARCHAR(50) CHARSET utf8, IN `_idRol` INT)  BEGIN
INSERT INTO Usuario(nombreUsuario, contrasena, visibilidad) VALUES( _correoElectronico, _contrasena, 1);

    INSERT INTO Empleado (nombreCompleto, documento, telefonoFijo, 
     telefonoCelular, correoElectronico, direccion, Rol_idRol,Usuario_idUsuario, 
     visibilidad) 
    VALUES(_nombreCompleto, _documento, _telefonoFijo, _telefonoCelular, _correoElectronico,
     _direccion, _idRol, (SELECT idUsuario FROM Usuario WHERE nombreUsuario = _correoElectronico AND visibilidad = 1), 1);
END$$

CREATE  PROCEDURE `registrarInforme` (IN `_nombre` VARCHAR(45) CHARSET utf8, IN `_tipoArchivo` VARCHAR(100) CHARSET utf8, IN `_tamano` VARCHAR(45) CHARSET utf8, IN `_ruta` VARCHAR(100) CHARSET utf8, IN `_idEmpleado` INT, IN `_idProyecto` INT)  BEGIN
    INSERT INTO Informe (nombre, tipoArchivo, tamano, ruta, Empleado_idEmpleado, Proyecto_idProyecto, visibilidad)
    VALUES (_nombre, _tipoArchivo, _tamano, _ruta, _idEmpleado, _idProyecto, 1); 
END$$

CREATE  PROCEDURE `registrarPlano` (`_nombre` VARCHAR(45), `_tipoArchivo` VARCHAR(100), `_tamano` VARCHAR(45), `_ruta` VARCHAR(100), `_idEmpleado` INT, `_idProyecto` INT)  BEGIN
    INSERT INTO Plano (Proyecto_idProyecto, descripcion, visibilidad)
    VALUES (_idProyecto, _nombre, 1);

    INSERT INTO ArchivoPlano (tipoArchivo, tamano, ruta, Empleado_idEmpleado, Plano_idPlano, visibilidad)
    VALUES (_tipoArchivo, _tamano, _ruta, _idEmpleado, (SELECT idPlano FROM Plano WHERE descripcion = _nombre AND Proyecto_idProyecto = _idProyecto),1);
END$$

CREATE  PROCEDURE `registrarProveedor` (IN `_nombre` VARCHAR(50) CHARSET utf8, IN `_asesor` VARCHAR(50) CHARSET utf8, IN `_telefono` VARCHAR(50) CHARSET utf8, IN `_correoElectronico` VARCHAR(50) CHARSET utf8, IN `_direccion` VARCHAR(50) CHARSET utf8)  BEGIN
    INSERT INTO Proveedor (nombre, asesor, telefono, correoElectronico, direccion, visibilidad) 
    VALUES(_nombre, _asesor, _telefono, _correoElectronico, _direccion, 1);
END$$

CREATE  PROCEDURE `registrarProyecto` (`_nombre` VARCHAR(50), `_inicio` DATE, `_fin` DATE, `_avance` VARCHAR(50), `_Cliente` INT, `_estado` INT, `_idEmpleado` INT)  BEGIN
    INSERT INTO Proyecto (nombre,fechaInicio,fechaEntrega,porcentajeAvance,Cliente_idCliente,EstadoProyecto_idEstadoProyecto,visibilidad)
    VALUES(_nombre, _inicio, _fin, _avance, _Cliente, _estado, 1);
    INSERT INTO EquipoTrabajo (Empleado_idEmpleado, Proyecto_idProyecto,visibilidad)
    VALUES(_idEmpleado, (SELECT idProyecto FROM Proyecto 
        WHERE nombre = _nombre AND fechaInicio = _inicio AND Cliente_idCliente = _Cliente AND fechaEntrega = _fin) ,1);
END$$

CREATE  PROCEDURE `reporteConsultaMaterial` (`_idMaterial` INT)  BEGIN 
    SELECT referencia, especificaciones, unidadMedida, cantidadDisponible
    FROM Material
    WHERE idMaterial = _idMaterial;
END$$

CREATE  PROCEDURE `reporteDevolucionMaterial` (`_idMaterial` INT)  BEGIN
    SELECT t.fecha, t.cantidadAsignada, e.nombreCompleto
    FROM Tramite AS t INNER JOIN Empleado AS e ON t.Empleado_idEmpleado = e.idEmpleado
    WHERE t.Material_idMaterial = _idMaterial AND t.tipo = 'Entrada';
END$$

CREATE  PROCEDURE `reporteDevolucionMaterialProyecto` (`_idMaterial` INT)  BEGIN 
    SELECT t.fecha, t.cantidadAsignada, e.nombreCompleto, pl.descripcion AS Plano, pr.nombre AS Proyecto
    FROM Tramite AS t INNER JOIN Empleado AS e ON t.Empleado_idEmpleado = e.idEmpleado
    INNER JOIN Orden AS o ON o.idOrden = (SELECT idOrden FROM Orden 
        WHERE t.cantidadAsignada = (cantidadRequerida - cantidadConsumida) AND Material_idMaterial = _idMaterial)
    INNER JOIN Plano AS pl ON o.Plano_idPlano = pl.idPlano
    INNER JOIN Proyecto AS pr ON pl.Proyecto_idProyecto = pr.idProyecto
    WHERE t.Material_idMaterial = _idMaterial AND t.tipo = 'Devolucion';
END$$

CREATE  PROCEDURE `reporteEntradaMaterial` (`_idMaterial` INT)  BEGIN
    SELECT t.fecha, t.cantidadAsignada, e.nombreCompleto
    FROM Tramite AS t INNER JOIN Empleado AS e ON t.Empleado_idEmpleado = e.idEmpleado
    WHERE t.Material_idMaterial = _idMaterial AND t.tipo = 'Entrada';
END$$

CREATE  PROCEDURE `reporteEquipoProyecto` (`_idProyecto` INT)  BEGIN 
    SELECT em.nombreCompleto, ro.nombre
    FROM Proyecto AS pr INNER JOIN EquipoTrabajo AS eq ON eq.Proyecto_idProyecto = pr.idProyecto
    INNER JOIN Empleado AS em ON em.idEmpleado = eq.Empleado_idEmpleado
    INNER JOIN Rol AS ro ON ro.idRol = em.Rol_idRol
    WHERE pr.idProyecto = _idProyecto AND eq.visibilidad = 1;
END$$

CREATE  PROCEDURE `reporteEstadoProyecto` (`_idProyecto` INT)  BEGIN 
    SELECT pr.nombre, pr.fechaInicio, pr.fechaEntrega, pr.porcentajeAvance, ep.nombre AS estado, cl.nombre AS Cliente
    FROM EstadoProyecto AS ep INNER JOIN Proyecto AS pr ON ep.idEstadoProyecto = pr.EstadoProyecto_idEstadoProyecto
    INNER JOIN Cliente AS cl ON cl.idCliente = pr.Cliente_idCliente

    WHERE pr.idProyecto = _idProyecto;
END$$

CREATE  PROCEDURE `reportePlanosProyecto` (`_idProyecto` INT)  BEGIN 
    SELECT pl.descripcion, od.estado, ma.referencia, ma.especificaciones, od.cantidadRequerida, od.cantidadConsumida
    FROM Proyecto AS pr INNER JOIN Plano AS pl ON pl.Proyecto_idProyecto = pr.idProyecto
    INNER JOIN Orden AS od ON od.Plano_idPlano = pl.idPlano
    INNER JOIN Material AS ma ON od.Material_idMaterial = ma.idMaterial
    WHERE pr.idProyecto = _idProyecto AND od.visibilidad = 1;
END$$

CREATE  PROCEDURE `reporteSalidaMaterial` (`_idMaterial` INT)  BEGIN 
    SELECT t.fecha, t.cantidadAsignada, e.nombreCompleto, pl.descripcion AS Plano, pr.nombre AS Proyecto
    FROM Tramite AS t INNER JOIN Empleado AS e ON t.Empleado_idEmpleado = e.idEmpleado
    INNER JOIN OrdenTramitada AS ot ON ot.Tramite_idTramite = t.idTramite
    INNER JOIN Orden AS o ON o.idOrden = ot.Orden_idOrden
    INNER JOIN Plano AS pl ON o.Plano_idPlano = pl.idPlano
    INNER JOIN Proyecto AS pr ON pl.Proyecto_idProyecto = pr.idProyecto
    WHERE t.Material_idMaterial = _idMaterial AND t.tipo = 'Salida';
END$$

CREATE  PROCEDURE `´conteoReporteEntradaMaterial´` (`´_idMaterial´` INT)  BEGIN 
    SELECT COUNT(*) FROM Tramite
    WHERE Material_idMaterial = _idMaterial AND tipo = 'Entrada';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `alertaOrden`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `alertaOrden` (
`nombre` varchar(45)
,`fechaEntrega` date
,`cantidadRequerida` double
,`estado` tinyint(1)
,`descripcion` varchar(45)
,`referencia` varchar(45)
,`cantidadDisponible` double
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ArchivoPlano`
--

CREATE TABLE `ArchivoPlano` (
  `idArchivo` int(11) NOT NULL COMMENT 'Codigo identificador unico del Plano',
  `tipoArchivo` varchar(100) NOT NULL COMMENT 'Tipo de archivo (pdf)',
  `tamano` varchar(45) NOT NULL COMMENT 'Tama?o del archivo en KB',
  `ruta` varchar(100) NOT NULL COMMENT 'Ruta que da acceso al archivo',
  `Empleado_idEmpleado` int(11) NOT NULL COMMENT 'Codigo que relaciona al archivo con el Empleado que lo agrego',
  `Plano_idPlano` int(11) NOT NULL COMMENT 'Codigo que relaciona al archivo con la entidad Plano',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cliente`
--

CREATE TABLE `Cliente` (
  `idCliente` int(11) NOT NULL COMMENT 'Codigo identificador unico para Cliente',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del Cliente',
  `telefonoFijo` varchar(45) DEFAULT NULL COMMENT 'Telefono fijo del Cliente',
  `telefonoCelular` varchar(45) DEFAULT NULL COMMENT 'Telefono celular del Cliente',
  `correoElectronico` varchar(45) DEFAULT NULL COMMENT 'Correo electronico del Cliente',
  `nit` varchar(45) NOT NULL COMMENT 'Codigo NIT del Cliente',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DirectorioProveedor`
--

CREATE TABLE `DirectorioProveedor` (
  `Material_idMaterial` int(11) NOT NULL COMMENT 'Codigo que relaciona al directorio con el Material',
  `Proveedor_idProveedor` int(11) NOT NULL COMMENT 'Codigo que relaciona al directorio con el Proveedor',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Empleado`
--

CREATE TABLE `Empleado` (
  `idEmpleado` int(11) NOT NULL COMMENT 'Codigo identificador unico para Empleado',
  `nombreCompleto` varchar(45) NOT NULL COMMENT 'Nombres y apellidos del Empleado',
  `documento` varchar(45) NOT NULL COMMENT 'Numero de documento del Empleado',
  `telefonoFijo` varchar(45) DEFAULT NULL COMMENT 'Telefono fijo del Empleado',
  `telefonoCelular` varchar(45) DEFAULT NULL COMMENT 'Telefono celular del Empleado',
  `correoElectronico` varchar(45) NOT NULL COMMENT 'Correo electronico del Empleado',
  `direccion` varchar(45) NOT NULL COMMENT 'Direccion del lugar de residencia del Empleado',
  `Rol_idRol` int(11) NOT NULL COMMENT 'Codigo que relaciona al Empleado con un Rol',
  `Usuario_idUsuario` int(11) NOT NULL COMMENT 'Codigo que relaciona al Empleado con un Usuario',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Empleado`
--

INSERT INTO `Empleado` (`idEmpleado`, `nombreCompleto`, `documento`, `telefonoFijo`, `telefonoCelular`, `correoElectronico`, `direccion`, `Rol_idRol`, `Usuario_idUsuario`, `visibilidad`) VALUES
(1, 'Gerente', '1234', '42342', '98121', 'gerente@gmail.com', 'calle 3', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EquipoTrabajo`
--

CREATE TABLE `EquipoTrabajo` (
  `Empleado_idEmpleado` int(11) NOT NULL COMMENT 'Codigo que relaciona al Empleado con un equipo de trabajo',
  `Proyecto_idProyecto` int(11) NOT NULL COMMENT 'Codigo que relaciona al Proyecto con un equipo de trabajo',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EstadoProyecto`
--

CREATE TABLE `EstadoProyecto` (
  `idEstadoProyecto` int(11) NOT NULL COMMENT 'Codigo identificador unico para estado de Proyecto',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del estado de Proyecto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `EstadoProyecto`
--

INSERT INTO `EstadoProyecto` (`idEstadoProyecto`, `nombre`) VALUES
(1, 'diseno'),
(2, 'compra de Materiales'),
(3, 'produccion'),
(4, 'ensamblaje'),
(5, 'pruebas'),
(6, 'puesta en marcha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Informe`
--

CREATE TABLE `Informe` (
  `idArchivo` int(11) NOT NULL COMMENT 'Codigo unico identificador del archivo',
  `nombre` varchar(45) NOT NULL COMMENT 'nombre del archivo',
  `tipoArchivo` varchar(100) NOT NULL COMMENT 'Tipo de archivo (pdf)',
  `tamano` varchar(45) NOT NULL COMMENT 'Tama? del archivo en KB',
  `ruta` varchar(100) NOT NULL COMMENT 'Ruta que da acceso al archivo',
  `Empleado_idEmpleado` int(11) NOT NULL COMMENT 'Codigo que relaciona al archivo con el Empleado que lo agrego',
  `Proyecto_idProyecto` int(11) NOT NULL COMMENT 'Codigo que relaciona al archivo con el Proyecto al que pertenece',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Material`
--

CREATE TABLE `Material` (
  `idMaterial` int(11) NOT NULL COMMENT 'Codigo identificador unico para Material',
  `referencia` varchar(45) NOT NULL COMMENT 'Referencia con la que el Material es reconocido dentro de la empresa',
  `especificaciones` varchar(45) NOT NULL COMMENT 'Dimensiones y otros detalles del Material',
  `unidadMedida` varchar(45) NOT NULL COMMENT 'Cadena de caracteres que indica la unidad de medida del Material',
  `cantidadDisponible` double NOT NULL COMMENT 'Cantidad disponible de Material en el almacen',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Orden`
--

CREATE TABLE `Orden` (
  `idOrden` int(11) NOT NULL COMMENT 'Codigo identificador unico de la Orden',
  `cantidadRequerida` double NOT NULL COMMENT 'Cantidad de Material requerido',
  `cantidadConsumida` double NOT NULL COMMENT 'Cantidad de Material consumido por la Orden',
  `estado` tinyint(1) NOT NULL COMMENT 'Indica si a la Orden le asignaron los Materiales (0= Materiales no asignados, 1= Materiales asignados)',
  `Material_idMaterial` int(11) NOT NULL COMMENT 'Codigo que relaciona la Orden con el Material que es requerido',
  `Plano_idPlano` int(11) NOT NULL COMMENT 'Codigo que relaciona la Orden con el Plano que la origino',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OrdenTramitada`
--

CREATE TABLE `OrdenTramitada` (
  `Orden_idOrden` int(11) NOT NULL COMMENT 'Codigo que relaciona a la Orden tramitada con una Orden',
  `Tramite_idTramite` int(11) NOT NULL COMMENT 'Codigo que relaciona a la Orden tramitada con un Tramite',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Plano`
--

CREATE TABLE `Plano` (
  `idPlano` int(11) NOT NULL COMMENT 'Codigo identificador unico del Plano',
  `Proyecto_idProyecto` int(11) NOT NULL COMMENT 'Codigo que relaciona al Plano con el Proyecto al que pertenece',
  `descripcion` varchar(45) NOT NULL COMMENT 'Descripcion del Plano',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proveedor`
--

CREATE TABLE `Proveedor` (
  `idProveedor` int(11) NOT NULL COMMENT 'Codigo identificador unico del Proveedor',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre de la empresa Proveedora',
  `asesor` varchar(45) NOT NULL COMMENT 'Nombre del asesor que permite el contacto con el Proveedor',
  `telefono` varchar(45) NOT NULL COMMENT 'Telefono de contacto del asesor',
  `correoElectronico` varchar(45) NOT NULL COMMENT 'Correo electronico del asesor',
  `direccion` varchar(45) NOT NULL COMMENT 'Direccion del Proveedor',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proyecto`
--

CREATE TABLE `Proyecto` (
  `idProyecto` int(11) NOT NULL COMMENT 'Codigo identificador unico para Proyecto',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del Proyecto',
  `fechaInicio` date DEFAULT NULL COMMENT 'Fecha de inicio del Proyecto',
  `fechaEntrega` date DEFAULT NULL COMMENT 'Fecha de entrega del Proyecto',
  `porcentajeAvance` varchar(45) DEFAULT NULL COMMENT 'Numero entre 1 y 100 que representa el porcentaje de avance del Proyecto',
  `Cliente_idCliente` int(11) NOT NULL COMMENT 'Codigo que relaciona al Proyecto con su respectivo Cliente',
  `EstadoProyecto_idEstadoProyecto` int(11) NOT NULL COMMENT 'Codigo que relaciona al Proyecto con el estado en que se encuentra',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE `Rol` (
  `idRol` int(11) NOT NULL COMMENT 'Codigo identificador unico de Rol',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre del Rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`idRol`, `nombre`) VALUES
(1, 'jefe de Proyecto'),
(2, 'gerente'),
(3, 'disenador'),
(4, 'ejecutor'),
(5, 'almacenista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tramite`
--

CREATE TABLE `Tramite` (
  `idTramite` int(11) NOT NULL COMMENT 'Codigo identificador unico para Tramite',
  `fecha` date NOT NULL COMMENT 'Fecha en que se realizo el Tramite',
  `cantidadAsignada` double NOT NULL COMMENT 'Cantidad de Material asignada en el Tramite',
  `tipo` varchar(45) NOT NULL COMMENT 'Cadena de caracteres que representa el tipo de Tramite (entrada, salida, devolucion)',
  `Empleado_idEmpleado` int(11) NOT NULL COMMENT 'Codigo que relaciona al Tramite con el Empleado que lo ejecuto',
  `Material_idMaterial` int(11) NOT NULL COMMENT 'Codigo que relaciona al Tramite con el Material transferido',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `idUsuario` int(11) NOT NULL COMMENT 'Codigo identificador unico para Usuario',
  `nombreUsuario` varchar(45) NOT NULL COMMENT 'Nombre identificador unico para Usuario',
  `contrasena` varchar(255) DEFAULT NULL,
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`idUsuario`, `nombreUsuario`, `contrasena`, `visibilidad`) VALUES
(1, 'gerente@gmail.com', '$2y$10$/RqexVMi4RtiZtBrO6hVFuCLJosNG/3DtKaQsiVdRGhpd92EeCw8W', 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `alertaOrden`
--
DROP TABLE IF EXISTS `alertaOrden`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `alertaOrden`  AS  select `pr`.`nombre` AS `nombre`,`pr`.`fechaEntrega` AS `fechaEntrega`,`o`.`cantidadRequerida` AS `cantidadRequerida`,`o`.`estado` AS `estado`,`pl`.`descripcion` AS `descripcion`,`m`.`referencia` AS `referencia`,`m`.`cantidadDisponible` AS `cantidadDisponible` from (((`Proyecto` `pr` join `Plano` `pl` on((`pr`.`idProyecto` = `pl`.`Proyecto_idProyecto`))) join `Orden` `o` on((`o`.`Plano_idPlano` = `pl`.`idPlano`))) join `Material` `m` on((`o`.`Material_idMaterial` = `m`.`idMaterial`))) where ((`pl`.`visibilidad` = 1) and (`o`.`visibilidad` = 1) and (`pr`.`visibilidad` = 1)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ArchivoPlano`
--
ALTER TABLE `ArchivoPlano`
  ADD PRIMARY KEY (`idArchivo`,`Empleado_idEmpleado`,`Plano_idPlano`),
  ADD KEY `fk_Archivo_Empleado1_idx` (`Empleado_idEmpleado`),
  ADD KEY `fk_ArchivoPlano_Plano1_idx` (`Plano_idPlano`);

--
-- Indices de la tabla `Cliente`
--
ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `DirectorioProveedor`
--
ALTER TABLE `DirectorioProveedor`
  ADD PRIMARY KEY (`Material_idMaterial`,`Proveedor_idProveedor`),
  ADD KEY `fk_Material_has_Proveedor_Proveedor1_idx` (`Proveedor_idProveedor`),
  ADD KEY `fk_Material_has_Proveedor_Material1_idx` (`Material_idMaterial`);

--
-- Indices de la tabla `Empleado`
--
ALTER TABLE `Empleado`
  ADD PRIMARY KEY (`idEmpleado`,`Rol_idRol`,`Usuario_idUsuario`),
  ADD UNIQUE KEY `documento_UNIQUE` (`documento`),
  ADD KEY `fk_Empleado_Rol1_idx` (`Rol_idRol`),
  ADD KEY `fk_Empleado_Usuario1_idx` (`Usuario_idUsuario`);

--
-- Indices de la tabla `EquipoTrabajo`
--
ALTER TABLE `EquipoTrabajo`
  ADD PRIMARY KEY (`Empleado_idEmpleado`,`Proyecto_idProyecto`),
  ADD KEY `fk_Empleado_has_Proyecto_Proyecto1_idx` (`Proyecto_idProyecto`),
  ADD KEY `fk_Empleado_has_Proyecto_Empleado1_idx` (`Empleado_idEmpleado`);

--
-- Indices de la tabla `EstadoProyecto`
--
ALTER TABLE `EstadoProyecto`
  ADD PRIMARY KEY (`idEstadoProyecto`);

--
-- Indices de la tabla `Informe`
--
ALTER TABLE `Informe`
  ADD PRIMARY KEY (`idArchivo`,`Empleado_idEmpleado`,`Proyecto_idProyecto`),
  ADD KEY `fk_Archivo_Empleado1_idx` (`Empleado_idEmpleado`),
  ADD KEY `fk_Archivo_Proyecto1_idx` (`Proyecto_idProyecto`);

--
-- Indices de la tabla `Material`
--
ALTER TABLE `Material`
  ADD PRIMARY KEY (`idMaterial`);

--
-- Indices de la tabla `Orden`
--
ALTER TABLE `Orden`
  ADD PRIMARY KEY (`idOrden`,`Material_idMaterial`,`Plano_idPlano`),
  ADD KEY `fk_MaterialRequerido_Material1_idx` (`Material_idMaterial`),
  ADD KEY `fk_MaterialRequerido_Plano1_idx` (`Plano_idPlano`);

--
-- Indices de la tabla `OrdenTramitada`
--
ALTER TABLE `OrdenTramitada`
  ADD PRIMARY KEY (`Orden_idOrden`,`Tramite_idTramite`),
  ADD KEY `fk_OrdenTramitada_Tramite1_idx` (`Tramite_idTramite`);

--
-- Indices de la tabla `Plano`
--
ALTER TABLE `Plano`
  ADD PRIMARY KEY (`idPlano`,`Proyecto_idProyecto`),
  ADD KEY `fk_Plano_Proyecto1_idx` (`Proyecto_idProyecto`);

--
-- Indices de la tabla `Proveedor`
--
ALTER TABLE `Proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `Proyecto`
--
ALTER TABLE `Proyecto`
  ADD PRIMARY KEY (`idProyecto`,`Cliente_idCliente`,`EstadoProyecto_idEstadoProyecto`),
  ADD KEY `fk_Proyecto_Cliente1_idx` (`Cliente_idCliente`),
  ADD KEY `fk_Proyecto_EstadoProyecto1_idx` (`EstadoProyecto_idEstadoProyecto`);

--
-- Indices de la tabla `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `Tramite`
--
ALTER TABLE `Tramite`
  ADD PRIMARY KEY (`idTramite`,`Empleado_idEmpleado`,`Material_idMaterial`),
  ADD KEY `fk_Tramite_Empleado1_idx` (`Empleado_idEmpleado`),
  ADD KEY `fk_Tramite_Material1_idx` (`Material_idMaterial`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ArchivoPlano`
--
ALTER TABLE `ArchivoPlano`
  MODIFY `idArchivo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico del Plano', AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `Cliente`
--
ALTER TABLE `Cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para Cliente', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `Empleado`
--
ALTER TABLE `Empleado`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para Empleado', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `EstadoProyecto`
--
ALTER TABLE `EstadoProyecto`
  MODIFY `idEstadoProyecto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para estado de Proyecto', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `Informe`
--
ALTER TABLE `Informe`
  MODIFY `idArchivo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo unico identificador del archivo';
--
-- AUTO_INCREMENT de la tabla `Material`
--
ALTER TABLE `Material`
  MODIFY `idMaterial` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para Material', AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `Orden`
--
ALTER TABLE `Orden`
  MODIFY `idOrden` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico de la Orden', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `Plano`
--
ALTER TABLE `Plano`
  MODIFY `idPlano` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico del Plano', AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `Proveedor`
--
ALTER TABLE `Proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico del Proveedor', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `Proyecto`
--
ALTER TABLE `Proyecto`
  MODIFY `idProyecto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para Proyecto', AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `Rol`
--
ALTER TABLE `Rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico de Rol', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `Tramite`
--
ALTER TABLE `Tramite`
  MODIFY `idTramite` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para Tramite', AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para Usuario', AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ArchivoPlano`
--
ALTER TABLE `ArchivoPlano`
  ADD CONSTRAINT `fk_ArchivoPlano_Plano1` FOREIGN KEY (`Plano_idPlano`) REFERENCES `Plano` (`idPlano`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Archivo_Empleado10` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `Empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `DirectorioProveedor`
--
ALTER TABLE `DirectorioProveedor`
  ADD CONSTRAINT `fk_Material_has_Proveedor_Material1` FOREIGN KEY (`Material_idMaterial`) REFERENCES `Material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Material_has_Proveedor_Proveedor1` FOREIGN KEY (`Proveedor_idProveedor`) REFERENCES `Proveedor` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Empleado`
--
ALTER TABLE `Empleado`
  ADD CONSTRAINT `fk_Empleado_Rol1` FOREIGN KEY (`Rol_idRol`) REFERENCES `Rol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Empleado_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `EquipoTrabajo`
--
ALTER TABLE `EquipoTrabajo`
  ADD CONSTRAINT `fk_Empleado_has_Proyecto_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `Empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Empleado_has_Proyecto_Proyecto1` FOREIGN KEY (`Proyecto_idProyecto`) REFERENCES `Proyecto` (`idProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Informe`
--
ALTER TABLE `Informe`
  ADD CONSTRAINT `fk_Archivo_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `Empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Archivo_Proyecto1` FOREIGN KEY (`Proyecto_idProyecto`) REFERENCES `Proyecto` (`idProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Orden`
--
ALTER TABLE `Orden`
  ADD CONSTRAINT `fk_MaterialRequerido_Material1` FOREIGN KEY (`Material_idMaterial`) REFERENCES `Material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MaterialRequerido_Plano1` FOREIGN KEY (`Plano_idPlano`) REFERENCES `Plano` (`idPlano`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `OrdenTramitada`
--
ALTER TABLE `OrdenTramitada`
  ADD CONSTRAINT `fk_OrdenTramitada_Orden1` FOREIGN KEY (`Orden_idOrden`) REFERENCES `Orden` (`idOrden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrdenTramitada_Tramite1` FOREIGN KEY (`Tramite_idTramite`) REFERENCES `Tramite` (`idTramite`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Plano`
--
ALTER TABLE `Plano`
  ADD CONSTRAINT `fk_Plano_Proyecto1` FOREIGN KEY (`Proyecto_idProyecto`) REFERENCES `Proyecto` (`idProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Proyecto`
--
ALTER TABLE `Proyecto`
  ADD CONSTRAINT `fk_Proyecto_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `Cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Proyecto_EstadoProyecto1` FOREIGN KEY (`EstadoProyecto_idEstadoProyecto`) REFERENCES `EstadoProyecto` (`idEstadoProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Tramite`
--
ALTER TABLE `Tramite`
  ADD CONSTRAINT `fk_Tramite_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `Empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tramite_Material1` FOREIGN KEY (`Material_idMaterial`) REFERENCES `Material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
