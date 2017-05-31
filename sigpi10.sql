-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2017 a las 12:59:51
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
CREATE PROCEDURE `actualizarEmpleado` (`_nombreCompleto` VARCHAR(50), `_documento` VARCHAR(50), `_telefonoFijo` VARCHAR(50), `_telefonoCelular` VARCHAR(50), `_correoElectronico` VARCHAR(50), `_direccion` VARCHAR(50), `_idRol` INT, `_idUsuario` INT, `_idEmpleado` INT)  BEGIN
	UPDATE Usuario SET nombreUsuario = _correoElectronico WHERE idUsuario = _idUsuario;	
	
    UPDATE Empleado SET nombreCompleto = _nombreCompleto, documento = _documento, telefonoFijo = _telefonoFijo, 
    telefonoCelular = _telefonoCelular, correoElectronico = _correoElectronico, direccion = _direccion, Rol_idRol = _idRol
    WHERE idEmpleado = _idEmpleado;
END$$

CREATE PROCEDURE `actualizarProveedor` (`_nombre` VARCHAR(50), `_asesor` VARCHAR(50), `_telefono` VARCHAR(50), `_correoElectronico` VARCHAR(50), `_direccion` VARCHAR(50), `_idProveedor` INT)  BEGIN
    UPDATE Proveedor SET nombre = _nombre, asesor = _asesor, telefono = _telefono,
     correoElectronico = _correoElectronico, direccion =_direccion WHERE idProveedor = _idProveedor;
END$$

CREATE PROCEDURE `actualizarProyecto` (`_nombre` VARCHAR(50), `_inicio` DATE, `_fin` DATE, `_avance` VARCHAR(50), `_cliente` INT, `_estado` INT, `_idProyecto` INT)  BEGIN
    UPDATE Proyecto SET nombre = _nombre, fechaInicio = _inicio, fechaEntrega = _fin,
     porcentajeAvance = _avance, Cliente_idCliente =_cliente, estadoProyecto_idEstadoProyecto = _estado WHERE idProyecto = _idProyecto;
END$$

CREATE PROCEDURE `buscarCorreo` (`_email` VARCHAR(50))  BEGIN
    SELECT count(*) AS usuario
    FROM Usuario
    where nombreUsuario = _email AND visibilidad = 1;
END$$

CREATE PROCEDURE `buscarUsuario` (`_idEmpleado` VARCHAR(50))  BEGIN
    select contrasena, nombreUsuario
    from Empleado inner join usuario on Empleado.Usuario_idUsuario = Usuario.idUsuario 
    where idEmpleado = _idEmpleado AND usuario.visibilidad = 1;
END$$

CREATE PROCEDURE `cambiarContrasena` (`_email` VARCHAR(50), `_pass` VARCHAR(255))  BEGIN
    UPDATE usuario
    SET contrasena = _pass
    where nombreUsuario = _email AND visibilidad = 1;
END$$

CREATE PROCEDURE `consultarIdRol` (`_nombre` VARCHAR(45))  SELECT idRol FROM rol WHERE nombre = _nombre;$$

CREATE PROCEDURE `eliminarDirectorio` (`_idMaterial` INT, `_idProveedor` INT)  BEGIN
    DELETE FROM DirectorioProveedor 
    WHERE (Material_idMaterial = _idMaterial) AND ( Proveedor_idProveedor = _idProveedor);
END$$

CREATE PROCEDURE `eliminarEquipo` (`_idEmpleado` INT, `_idProyecto` INT)  BEGIN
    DELETE FROM equipoTrabajo  
    WHERE (Empleado_idEmpleado = _idEmpleado) AND ( proyecto_idProyecto = _idProyecto);
END$$

CREATE PROCEDURE `eliminarInforme` (`_idArchivo` INT)  BEGIN
    UPDATE Informe SET visibilidad = 0 WHERE idArchivo = _idArchivo;
END$$

CREATE PROCEDURE `inhabilitarEmpleado` (`_idEmpleado` INT)  BEGIN
	UPDATE Usuario SET visibilidad = 0 WHERE idUsuario = (SELECT Usuario_idUsuario FROM Empleado WHERE idEmpleado = _idEmpleado);	
	
    UPDATE Empleado SET visibilidad = 0 WHERE idEmpleado = _idEmpleado;
END$$

CREATE PROCEDURE `inhabilitarPlano` (`_idArchivo` INT)  BEGIN
    UPDATE Plano SET visibilidad = 0 WHERE idPlano = (SELECT Plano_idPlano FROM ArchivoPlano WHERE idArchivo = _idArchivo);
    UPDATE Orden SET visibilidad = 0 WHERE Plano_idPlano = (SELECT Plano_idPlano FROM ArchivoPlano WHERE idArchivo = _idArchivo);
    UPDATE ArchivoPlano SET visibilidad = 0 WHERE  idArchivo = _idArchivo;
END$$

CREATE PROCEDURE `inhabilitarProveedor` (`_idProveedor` INT)  BEGIN
    UPDATE Proveedor SET visibilidad = 0 WHERE idProveedor = _idProveedor;
    DELETE FROM DirectorioProveedor WHERE Proveedor_idProveedor = _idProveedor;	
END$$

CREATE PROCEDURE `inhabilitarProyecto` (`_idProyecto` INT)  BEGIN
    UPDATE Proyecto SET visibilidad = 0 WHERE idProyecto = _idProyecto;  
    UPDATE Plano SET visibilidad = 0 WHERE Proyecto_idProyecto = _idProyecto;  
    UPDATE ArchivoPlano SET visibilidad = 0 WHERE Plano_idPlano = (SELECT idPlano FROM Plano WHERE Proyecto_idProyecto = _idProyecto);  
    UPDATE Orden SET visibilidad = 0 WHERE Plano_idPlano = (SELECT idPlano FROM Plano WHERE Proyecto_idProyecto = _idProyecto);    
    UPDATE EquipoTrabajo SET visibilidad = 0 WHERE Proyecto_idProyecto = _idProyecto; 
END$$

CREATE PROCEDURE `login` (`_email` VARCHAR(50))  BEGIN
    select idEmpleado, nombreCompleto, Rol_idRol, nombre as rol, contrasena
    from Empleado inner join usuario on Empleado.Usuario_idUsuario = Usuario.idUsuario 
    inner join rol on Empleado.Rol_idRol = Rol.idRol 
    where nombreUsuario = _email AND usuario.visibilidad = 1;
END$$

CREATE PROCEDURE `nuevoDirectorio` (`_idMaterial` INT, `_idProveedor` INT)  BEGIN
    insert into DirectorioProveedor (Material_idMaterial, Proveedor_idProveedor, visibilidad)
    values (_idMaterial, _idProveedor, 1);
END$$

CREATE PROCEDURE `nuevoEquipo` (`_idEmpleado` INT, `_idProyecto` INT)  BEGIN
    insert into equipoTrabajo (Empleado_idEmpleado, Proyecto_idProyecto, visibilidad)
    values (_idEmpleado, _idProyecto, 1);
END$$

CREATE PROCEDURE `registrarEmpleado` (`_nombreCompleto` VARCHAR(50), `_contrasena` VARCHAR(255), `_documento` VARCHAR(50), `_telefonoFijo` VARCHAR(50), `_telefonoCelular` VARCHAR(50), `_correoElectronico` VARCHAR(50), `_direccion` VARCHAR(50), `_idRol` INT)  BEGIN
	INSERT INTO Usuario(nombreUsuario, contrasena, visibilidad) VALUES( _correoElectronico, _contrasena, 1);	
	
    INSERT INTO Empleado (nombreCompleto, documento, telefonoFijo, 
     telefonoCelular, correoElectronico, direccion, Rol_idRol,Usuario_idUsuario, 
     visibilidad) 
    VALUES(_nombreCompleto, _documento, _telefonoFijo, _telefonoCelular, _correoElectronico,
     _direccion, _idRol, (SELECT idUsuario FROM Usuario WHERE nombreUsuario = _correoElectronico AND visibilidad = 1), 1);
END$$

CREATE PROCEDURE `registrarInforme` (`_nombre` VARCHAR(45), `_tipoArchivo` VARCHAR(100), `_tamano` VARCHAR(45), `_ruta` VARCHAR(100), `_idEmpleado` INT, `_idProyecto` INT)  BEGIN
    INSERT INTO Informe (nombre, tipoArchivo, tamano, ruta, Empleado_idEmpleado, Proyecto_idProyecto, visibilidad)
    VALUES (_nombre, _tipoArchivo, _tamano, _ruta, _idEmpleado, _idProyecto, 1); 
END$$

CREATE PROCEDURE `registrarPlano` (`_nombre` VARCHAR(45), `_tipoArchivo` VARCHAR(100), `_tamano` VARCHAR(45), `_ruta` VARCHAR(100), `_idEmpleado` INT, `_idProyecto` INT)  BEGIN
    INSERT INTO Plano (Proyecto_idProyecto, descripcion, visibilidad)
    VALUES (_idProyecto, _nombre, 1);

    INSERT INTO ArchivoPlano (tipoArchivo, tamano, ruta, Empleado_idEmpleado, Plano_idPlano, visibilidad)
    VALUES (_tipoArchivo, _tamano, _ruta, _idEmpleado, (SELECT idPlano FROM Plano WHERE descripcion = _nombre AND Proyecto_idProyecto = _idProyecto),1);
END$$

CREATE PROCEDURE `registrarProveedor` (`_nombre` VARCHAR(50), `_asesor` VARCHAR(50), `_telefono` VARCHAR(50), `_correoElectronico` VARCHAR(50), `_direccion` VARCHAR(50))  BEGIN
    INSERT INTO Proveedor (nombre, asesor, telefono, correoElectronico, direccion, visibilidad) 
    VALUES(_nombre, _asesor, _telefono, _correoElectronico, _direccion, 1);
END$$

CREATE PROCEDURE `registrarProyecto` (`_nombre` VARCHAR(50), `_inicio` DATE, `_fin` DATE, `_avance` VARCHAR(50), `_cliente` INT, `_estado` INT, `_idEmpleado` INT)  BEGIN
    INSERT INTO Proyecto (nombre,fechaInicio,fechaEntrega,porcentajeAvance,Cliente_idCliente,estadoProyecto_idEstadoProyecto,visibilidad)
    VALUES(_nombre, _inicio, _fin, _avance, _cliente, _estado, 1);
    INSERT INTO equipoTrabajo (Empleado_idEmpleado, Proyecto_idProyecto,visibilidad)
    VALUES(_idEmpleado, (SELECT idProyecto FROM Proyecto 
        WHERE nombre = _nombre AND fechaInicio = _inicio AND Cliente_idCliente = _cliente AND fechaEntrega = _fin) ,1);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivoplano`
--

CREATE TABLE `archivoplano` (
  `idArchivo` int(11) NOT NULL COMMENT 'Codigo identificador unico del plano',
  `tipoArchivo` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tipo de archivo (pdf)',
  `tamano` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tamaño del archivo en KB',
  `ruta` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ruta que da acceso al archivo',
  `Empleado_idEmpleado` int(11) NOT NULL COMMENT 'Codigo que relaciona al archivo con el empleado que lo agrego',
  `Plano_idPlano` int(11) NOT NULL COMMENT 'Codigo que relaciona al archivo con la entidad plano',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `archivoplano`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL COMMENT 'Codigo identificador unico para cliente',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del cliente',
  `telefonoFijo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Telefono fijo del cliente',
  `telefonoCelular` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Telefono celular del cliente',
  `correoElectronico` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Correo electronico del cliente',
  `nit` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Codigo NIT del cliente',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directorioproveedor`
--

CREATE TABLE `directorioproveedor` (
  `Material_idMaterial` int(11) NOT NULL COMMENT 'Codigo que relaciona al directorio con el material',
  `Proveedor_idProveedor` int(11) NOT NULL COMMENT 'Codigo que relaciona al directorio con el proveedor',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `directorioproveedor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL COMMENT 'Codigo identificador unico para empleado',
  `nombreCompleto` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombres y apellidos del empleado',
  `documento` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Numero de documento del empleado',
  `telefonoFijo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Telefono fijo del empleado',
  `telefonoCelular` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Telefono celular del empleado',
  `correoElectronico` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Correo electronico del empleado',
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Direccion del lugar de residencia del empleado',
  `Rol_idRol` int(11) NOT NULL COMMENT 'Codigo que relaciona al empleado con un rol',
  `Usuario_idUsuario` int(11) NOT NULL COMMENT 'Codigo que relaciona al empleado con un usuario',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombreCompleto`, `documento`, `telefonoFijo`, `telefonoCelular`, `correoElectronico`, `direccion`, `Rol_idRol`, `Usuario_idUsuario`, `visibilidad`) VALUES
(1, 'Gerente', '1234', '42342', '98121', 'gerente@gmail.com', 'calle 3', 2, 1, 1);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipotrabajo`
--

CREATE TABLE `equipotrabajo` (
  `Empleado_idEmpleado` int(11) NOT NULL COMMENT 'Codigo que relaciona al empleado con un equipo de trabajo',
  `Proyecto_idProyecto` int(11) NOT NULL COMMENT 'Codigo que relaciona al proyecto con un equipo de trabajo',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `equipotrabajo`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoproyecto`
--

CREATE TABLE `estadoproyecto` (
  `idEstadoProyecto` int(11) NOT NULL COMMENT 'Codigo identificador unico para estado de proyecto',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del estado de proyecto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estadoproyecto`
--

INSERT INTO `estadoproyecto` (`idEstadoProyecto`, `nombre`) VALUES
(1, 'diseno'),
(2, 'compra de materiales'),
(3, 'produccion'),
(4, 'ensamblaje'),
(5, 'pruebas'),
(6, 'puesta en marcha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe`
--

CREATE TABLE `informe` (
  `idArchivo` int(11) NOT NULL COMMENT 'Codigo unico identificador del archivo',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre del archivo',
  `tipoArchivo` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tipo de archivo (pdf)',
  `tamano` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tamañ del archivo en KB',
  `ruta` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ruta que da acceso al archivo',
  `Empleado_idEmpleado` int(11) NOT NULL COMMENT 'Codigo que relaciona al archivo con el empleado que lo agrego',
  `Proyecto_idProyecto` int(11) NOT NULL COMMENT 'Codigo que relaciona al archivo con el proyecto al que pertenece',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `informe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `idMaterial` int(11) NOT NULL COMMENT 'Codigo identificador unico para material',
  `referencia` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Referencia con la que el material es reconocido dentro de la empresa',
  `especificaciones` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Dimensiones y otros detalles del material',
  `unidadMedida` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Cadena de caracteres que indica la unidad de medida del material',
  `cantidadDisponible` double NOT NULL COMMENT 'Cantidad disponible de material en el almacen',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `material`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `idOrden` int(11) NOT NULL COMMENT 'Codigo identificador unico de la orden',
  `cantidadRequerida` double NOT NULL COMMENT 'Cantidad de material requerido',
  `cantidadConsumida` double NOT NULL COMMENT 'Cantidad de material consumido por la orden',
  `estado` tinyint(1) NOT NULL COMMENT 'Indica si a la orden le asignaron los materiales (0= materiales no asignados, 1= materiales asignados)',
  `Material_idMaterial` int(11) NOT NULL COMMENT 'Codigo que relaciona la orden con el material que es requerido',
  `Plano_idPlano` int(11) NOT NULL COMMENT 'Codigo que relaciona la orden con el plano que la origino',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordentramitada`
--

CREATE TABLE `ordentramitada` (
  `Orden_idOrden` int(11) NOT NULL COMMENT 'Codigo que relaciona a la orden tramitada con una orden',
  `Tramite_idTramite` int(11) NOT NULL COMMENT 'Codigo que relaciona a la orden tramitada con un tramite',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plano`
--

CREATE TABLE `plano` (
  `idPlano` int(11) NOT NULL COMMENT 'Codigo identificador unico del plano',
  `Proyecto_idProyecto` int(11) NOT NULL COMMENT 'Codigo que relaciona al plano con el proyecto al que pertenece',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripcion del plano',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `plano`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL COMMENT 'Codigo identificador unico del proveedor',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la empresa proveedora',
  `asesor` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del asesor que permite el contacto con el proveedor',
  `telefono` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Telefono de contacto del asesor',
  `correoElectronico` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Correo electronico del asesor',
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Direccion del proveedor',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `idProyecto` int(11) NOT NULL COMMENT 'Codigo identificador unico para proyecto',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del proyecto',
  `fechaInicio` date DEFAULT NULL COMMENT 'Fecha de inicio del proyecto',
  `fechaEntrega` date DEFAULT NULL COMMENT 'Fecha de entrega del proyecto',
  `porcentajeAvance` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Numero entre 1 y 100 que representa el porcentaje de avance del proyecto',
  `Cliente_idCliente` int(11) NOT NULL COMMENT 'Codigo que relaciona al proyecto con su respectivo cliente',
  `EstadoProyecto_idEstadoProyecto` int(11) NOT NULL COMMENT 'Codigo que relaciona al proyecto con el estado en que se encuentra',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL COMMENT 'Codigo identificador unico de rol',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombre`) VALUES
(1, 'jefe de proyecto'),
(2, 'gerente'),
(3, 'disenador'),
(4, 'ejecutor'),
(5, 'almacenista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramite`
--

CREATE TABLE `tramite` (
  `idTramite` int(11) NOT NULL COMMENT 'Codigo identificador unico para tramite',
  `fecha` date NOT NULL COMMENT 'Fecha en que se realizo el tramite',
  `cantidadAsignada` double NOT NULL COMMENT 'Cantidad de material asignada en el tramite',
  `tipo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Cadena de caracteres que representa el tipo de tramite (entrada, salida, devolucion)',
  `Empleado_idEmpleado` int(11) NOT NULL COMMENT 'Codigo que relaciona al tramite con el empleado que lo ejecuto',
  `Material_idMaterial` int(11) NOT NULL COMMENT 'Codigo que relaciona al tramite con el material transferido',
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tramite`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL COMMENT 'Codigo identificador unico para usuario',
  `nombreUsuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre identificador unico para usuario',
  `contrasena` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `visibilidad` tinyint(1) NOT NULL COMMENT 'Indica si un registro es visible (1 visible, 0 no visible)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `contrasena`, `visibilidad`) VALUES
(1, 'gerente@gmail.com', '$2y$10$etxCN1jfFmZCTGqbbdHw7.sIpvur5RfFVW/Lumn/CCk8oRWqaBh9.', 1);


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivoplano`
--
ALTER TABLE `archivoplano`
  ADD PRIMARY KEY (`idArchivo`,`Empleado_idEmpleado`,`Plano_idPlano`),
  ADD KEY `fk_Archivo_Empleado1_idx` (`Empleado_idEmpleado`),
  ADD KEY `fk_ArchivoPlano_Plano1_idx` (`Plano_idPlano`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `directorioproveedor`
--
ALTER TABLE `directorioproveedor`
  ADD PRIMARY KEY (`Material_idMaterial`,`Proveedor_idProveedor`),
  ADD KEY `fk_Material_has_Proveedor_Proveedor1_idx` (`Proveedor_idProveedor`),
  ADD KEY `fk_Material_has_Proveedor_Material1_idx` (`Material_idMaterial`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmpleado`,`Rol_idRol`,`Usuario_idUsuario`),
  ADD UNIQUE KEY `documento_UNIQUE` (`documento`),
  ADD KEY `fk_Empleado_Rol1_idx` (`Rol_idRol`),
  ADD KEY `fk_Empleado_Usuario1_idx` (`Usuario_idUsuario`);

--
-- Indices de la tabla `equipotrabajo`
--
ALTER TABLE `equipotrabajo`
  ADD PRIMARY KEY (`Empleado_idEmpleado`,`Proyecto_idProyecto`),
  ADD KEY `fk_Empleado_has_Proyecto_Proyecto1_idx` (`Proyecto_idProyecto`),
  ADD KEY `fk_Empleado_has_Proyecto_Empleado1_idx` (`Empleado_idEmpleado`);

--
-- Indices de la tabla `estadoproyecto`
--
ALTER TABLE `estadoproyecto`
  ADD PRIMARY KEY (`idEstadoProyecto`);

--
-- Indices de la tabla `informe`
--
ALTER TABLE `informe`
  ADD PRIMARY KEY (`idArchivo`,`Empleado_idEmpleado`,`Proyecto_idProyecto`),
  ADD KEY `fk_Archivo_Empleado1_idx` (`Empleado_idEmpleado`),
  ADD KEY `fk_Archivo_Proyecto1_idx` (`Proyecto_idProyecto`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`idMaterial`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`idOrden`,`Material_idMaterial`,`Plano_idPlano`),
  ADD KEY `fk_MaterialRequerido_Material1_idx` (`Material_idMaterial`),
  ADD KEY `fk_MaterialRequerido_Plano1_idx` (`Plano_idPlano`);

--
-- Indices de la tabla `ordentramitada`
--
ALTER TABLE `ordentramitada`
  ADD PRIMARY KEY (`Orden_idOrden`,`Tramite_idTramite`),
  ADD KEY `fk_OrdenTramitada_Tramite1_idx` (`Tramite_idTramite`);

--
-- Indices de la tabla `plano`
--
ALTER TABLE `plano`
  ADD PRIMARY KEY (`idPlano`,`Proyecto_idProyecto`),
  ADD KEY `fk_Plano_Proyecto1_idx` (`Proyecto_idProyecto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`idProyecto`,`Cliente_idCliente`,`EstadoProyecto_idEstadoProyecto`),
  ADD KEY `fk_Proyecto_Cliente1_idx` (`Cliente_idCliente`),
  ADD KEY `fk_Proyecto_EstadoProyecto1_idx` (`EstadoProyecto_idEstadoProyecto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tramite`
--
ALTER TABLE `tramite`
  ADD PRIMARY KEY (`idTramite`,`Empleado_idEmpleado`,`Material_idMaterial`),
  ADD KEY `fk_Tramite_Empleado1_idx` (`Empleado_idEmpleado`),
  ADD KEY `fk_Tramite_Material1_idx` (`Material_idMaterial`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivoplano`
--
ALTER TABLE `archivoplano`
  MODIFY `idArchivo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico del plano', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para cliente', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para empleado', AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `estadoproyecto`
--
ALTER TABLE `estadoproyecto`
  MODIFY `idEstadoProyecto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para estado de proyecto', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `informe`
--
ALTER TABLE `informe`
  MODIFY `idArchivo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo unico identificador del archivo', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `idMaterial` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para material', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `idOrden` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico de la orden';
--
-- AUTO_INCREMENT de la tabla `plano`
--
ALTER TABLE `plano`
  MODIFY `idPlano` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico del plano', AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico del proveedor', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `idProyecto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para proyecto', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico de rol', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tramite`
--
ALTER TABLE `tramite`
  MODIFY `idTramite` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para tramite', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador unico para usuario', AUTO_INCREMENT=46;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivoplano`
--
ALTER TABLE `archivoplano`
  ADD CONSTRAINT `fk_ArchivoPlano_Plano1` FOREIGN KEY (`Plano_idPlano`) REFERENCES `plano` (`idPlano`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Archivo_Empleado10` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `directorioproveedor`
--
ALTER TABLE `directorioproveedor`
  ADD CONSTRAINT `fk_Material_has_Proveedor_Material1` FOREIGN KEY (`Material_idMaterial`) REFERENCES `material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Material_has_Proveedor_Proveedor1` FOREIGN KEY (`Proveedor_idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_Empleado_Rol1` FOREIGN KEY (`Rol_idRol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Empleado_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `equipotrabajo`
--
ALTER TABLE `equipotrabajo`
  ADD CONSTRAINT `fk_Empleado_has_Proyecto_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Empleado_has_Proyecto_Proyecto1` FOREIGN KEY (`Proyecto_idProyecto`) REFERENCES `proyecto` (`idProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `informe`
--
ALTER TABLE `informe`
  ADD CONSTRAINT `fk_Archivo_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Archivo_Proyecto1` FOREIGN KEY (`Proyecto_idProyecto`) REFERENCES `proyecto` (`idProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `fk_MaterialRequerido_Material1` FOREIGN KEY (`Material_idMaterial`) REFERENCES `material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MaterialRequerido_Plano1` FOREIGN KEY (`Plano_idPlano`) REFERENCES `plano` (`idPlano`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ordentramitada`
--
ALTER TABLE `ordentramitada`
  ADD CONSTRAINT `fk_OrdenTramitada_Orden1` FOREIGN KEY (`Orden_idOrden`) REFERENCES `orden` (`idOrden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrdenTramitada_Tramite1` FOREIGN KEY (`Tramite_idTramite`) REFERENCES `tramite` (`idTramite`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `plano`
--
ALTER TABLE `plano`
  ADD CONSTRAINT `fk_Plano_Proyecto1` FOREIGN KEY (`Proyecto_idProyecto`) REFERENCES `proyecto` (`idProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `fk_Proyecto_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Proyecto_EstadoProyecto1` FOREIGN KEY (`EstadoProyecto_idEstadoProyecto`) REFERENCES `estadoproyecto` (`idEstadoProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tramite`
--
ALTER TABLE `tramite`
  ADD CONSTRAINT `fk_Tramite_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tramite_Material1` FOREIGN KEY (`Material_idMaterial`) REFERENCES `material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
