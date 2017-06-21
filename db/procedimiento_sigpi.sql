--Empleado


DELIMITER //
CREATE PROCEDURE registrarEmpleado(
 _nombreCompleto VARCHAR(50),
 _contrasena VARCHAR(255),
 _documento VARCHAR(50),
 _telefonoFijo VARCHAR(50),
 _telefonoCelular VARCHAR(50),
 _correoElectronico VARCHAR(50),
 _direccion VARCHAR(50),
 _idRol int
 )
BEGIN
	INSERT INTO Usuario(nombreUsuario, contrasena, visibilidad) VALUES( _correoElectronico, _contrasena, 1);	
	
    INSERT INTO Empleado (nombreCompleto, documento, telefonoFijo, 
     telefonoCelular, correoElectronico, direccion, Rol_idRol,Usuario_idUsuario, 
     visibilidad) 
    VALUES(_nombreCompleto, _documento, _telefonoFijo, _telefonoCelular, _correoElectronico,
     _direccion, _idRol, (SELECT idUsuario FROM Usuario WHERE nombreUsuario = _correoElectronico AND visibilidad = 1), 1);
END //



DELIMITER //
CREATE PROCEDURE actualizarEmpleado(
 _nombreCompleto VARCHAR(50),
 _documento VARCHAR(50),
 _telefonoFijo VARCHAR(50),
 _telefonoCelular VARCHAR(50),
 _correoElectronico VARCHAR(50),
 _direccion VARCHAR(50),
 _idRol int,
 _idUsuario int,
 _idEmpleado int
 )
BEGIN
	UPDATE Usuario SET nombreUsuario = _correoElectronico WHERE idUsuario = _idUsuario;	
	
    UPDATE Empleado SET nombreCompleto = _nombreCompleto, documento = _documento, telefonoFijo = _telefonoFijo, 
    telefonoCelular = _telefonoCelular, correoElectronico = _correoElectronico, direccion = _direccion, Rol_idRol = _idRol
    WHERE idEmpleado = _idEmpleado;
END //

DELIMITER //
CREATE  PROCEDURE inhabilitarEmpleado(
 _idEmpleado int
 )
BEGIN
	UPDATE Usuario SET visibilidad = 0 WHERE idUsuario = (SELECT Usuario_idUsuario FROM Empleado WHERE idEmpleado = _idEmpleado);	
	
    UPDATE Empleado SET visibilidad = 0 WHERE idEmpleado = _idEmpleado;
END //


--login 

DELIMITER //
CREATE PROCEDURE login(
 _email VARCHAR(50)
 )
BEGIN
    select idEmpleado, nombreCompleto, Rol_idRol, nombre as rol, contrasena
    from Empleado inner join usuario on Empleado.Usuario_idUsuario = Usuario.idUsuario 
    inner join rol on Empleado.Rol_idRol = Rol.idRol 
    where nombreUsuario = _email AND usuario.visibilidad = 1;
END //

DELIMITER //
CREATE PROCEDURE buscarCorreo(
 _email VARCHAR(50)
 )
BEGIN
    SELECT count(*) AS usuario
    FROM Usuario
    where nombreUsuario = _email AND visibilidad = 1;
END //

DELIMITER //
CREATE PROCEDURE cambiarContrasena(
 _email VARCHAR(50),
 _pass varchar(255)
 )
BEGIN
    UPDATE usuario
    SET contrasena = _pass
    where nombreUsuario = _email AND visibilidad = 1;
END 


DELIMITER //
CREATE PROCEDURE buscarUsuario(
 _idEmpleado VARCHAR(50)
 )
BEGIN
    select contrasena, nombreUsuario
    from Empleado inner join usuario on Empleado.Usuario_idUsuario = Usuario.idUsuario 
    where idEmpleado = _idEmpleado AND usuario.visibilidad = 1;
END //

--crear equipos


DELIMITER //
CREATE PROCEDURE nuevoEquipo(
_idEmpleado int,
_idProyecto int
)
BEGIN
    insert into equipoTrabajo (Empleado_idEmpleado, Proyecto_idProyecto, visibilidad)
    values (_idEmpleado, _idProyecto, 1);
END//

--eliminarEquipo

DELIMITER //
CREATE PROCEDURE eliminarEquipo
(
_idEmpleado int,
_idProyecto int
)
BEGIN
    DELETE FROM equipoTrabajo  
    WHERE (Empleado_idEmpleado = _idEmpleado) AND ( proyecto_idProyecto = _idProyecto);
END//

--crear directorio


DELIMITER //
CREATE PROCEDURE nuevoDirectorio(
_idMaterial int,
_idProveedor int
)
BEGIN
    insert into DirectorioProveedor (Material_idMaterial, Proveedor_idProveedor, visibilidad)
    values (_idMaterial, _idProveedor, 1);
END//

--eliminarDirectorio

DELIMITER //
CREATE PROCEDURE eliminarDirectorio
(
_idMaterial int,
_idProveedor int
)
BEGIN
    DELETE FROM DirectorioProveedor 
    WHERE (Material_idMaterial = _idMaterial) AND ( Proveedor_idProveedor = _idProveedor);
END//

--registrarProveedor
DELIMITER //
CREATE PROCEDURE registrarProveedor(
 _nombre VARCHAR(50),
 _asesor VARCHAR(50),
 _telefono VARCHAR(50),
 _correoElectronico VARCHAR(50),
 _direccion VARCHAR(50)
 )
BEGIN
    INSERT INTO Proveedor (nombre, asesor, telefono, correoElectronico, direccion, visibilidad) 
    VALUES(_nombre, _asesor, _telefono, _correoElectronico, _direccion, 1);
END //

--actualizarProveedor
DELIMITER //
CREATE PROCEDURE actualizarProveedor(
  _nombre VARCHAR(50),
  _asesor VARCHAR(50),
  _telefono VARCHAR(50),
  _correoElectronico VARCHAR(50),
  _direccion VARCHAR(50),
  _idProveedor int
 )
BEGIN
    UPDATE Proveedor SET nombre = _nombre, asesor = _asesor, telefono = _telefono,
     correoElectronico = _correoElectronico, direccion =_direccion WHERE idProveedor = _idProveedor;
END //

--inhabilitarProveedor
DELIMITER //
CREATE PROCEDURE inhabilitarProveedor(
	_idProveedor int
)	
BEGIN
    UPDATE Proveedor SET visibilidad = 0 WHERE idProveedor = _idProveedor;
    DELETE FROM DirectorioProveedor WHERE Proveedor_idProveedor = _idProveedor;	
END//



 --Proyecto


DELIMITER //
CREATE PROCEDURE registrarProyecto(
 _nombre VARCHAR(50),
 _inicio DATE,
 _fin DATE,
 _avance VARCHAR(50),
 _cliente int,
 _estado int,
 _idEmpleado int
 )
BEGIN
    INSERT INTO Proyecto (nombre,fechaInicio,fechaEntrega,porcentajeAvance,Cliente_idCliente,estadoProyecto_idEstadoProyecto,visibilidad)
    VALUES(_nombre, _inicio, _fin, _avance, _cliente, _estado, 1);
    INSERT INTO equipoTrabajo (Empleado_idEmpleado, Proyecto_idProyecto,visibilidad)
    VALUES(_idEmpleado, (SELECT idProyecto FROM Proyecto 
        WHERE nombre = _nombre AND fechaInicio = _inicio AND Cliente_idCliente = _cliente AND fechaEntrega = _fin) ,1);
END //

DELIMITER //
CREATE PROCEDURE actualizarProyecto(
 _nombre VARCHAR(50),
 _inicio DATE,
 _fin DATE,
 _avance VARCHAR(50),
 _cliente int,
 _estado int,
 _idProyecto int
 )
BEGIN
    UPDATE Proyecto SET nombre = _nombre, fechaInicio = _inicio, fechaEntrega = _fin,
     porcentajeAvance = _avance, Cliente_idCliente =_cliente, estadoProyecto_idEstadoProyecto = _estado WHERE idProyecto = _idProyecto;
END //

DELIMITER //
CREATE  PROCEDURE inhabilitarProyecto(
 _idProyecto int
 )
BEGIN
    UPDATE Proyecto SET visibilidad = 0 WHERE idProyecto = _idProyecto;  
    UPDATE Plano SET visibilidad = 0 WHERE Proyecto_idProyecto = _idProyecto;  
    UPDATE ArchivoPlano SET visibilidad = 0 WHERE Plano_idPlano = (SELECT idPlano FROM Plano WHERE Proyecto_idProyecto = _idProyecto);  
    UPDATE Orden SET visibilidad = 0 WHERE Plano_idPlano = (SELECT idPlano FROM Plano WHERE Proyecto_idProyecto = _idProyecto);    
    UPDATE EquipoTrabajo SET visibilidad = 0 WHERE Proyecto_idProyecto = _idProyecto; 
END //

--Informe 

DELIMITER //
CREATE  PROCEDURE registrarInforme(
 _nombre varchar(45),
 _tipoArchivo varchar(100),
 _tamano varchar(45),
 _ruta varchar(100),
 _idEmpleado int,
 _idProyecto int
 )
BEGIN
    INSERT INTO Informe (nombre, tipoArchivo, tamano, ruta, Empleado_idEmpleado, Proyecto_idProyecto, visibilidad)
    VALUES (_nombre, _tipoArchivo, _tamano, _ruta, _idEmpleado, _idProyecto, 1); 
END //

DELIMITER //
CREATE PROCEDURE inhabilitarInforme(
_idArchivo int
)
BEGIN
    UPDATE Informe SET visibilidad = 0 WHERE idArchivo = _idArchivo;
END//

--Plano

DELIMITER //
CREATE  PROCEDURE registrarPlano(
 _nombre varchar(45),
 _tipoArchivo varchar(100),
 _tamano varchar(45),
 _ruta varchar(100),
 _idEmpleado int,
 _idProyecto int
 )
BEGIN
    INSERT INTO Plano (Proyecto_idProyecto, descripcion, visibilidad)
    VALUES (_idProyecto, _nombre, 1);

    INSERT INTO ArchivoPlano (tipoArchivo, tamano, ruta, Empleado_idEmpleado, Plano_idPlano, visibilidad)
    VALUES (_tipoArchivo, _tamano, _ruta, _idEmpleado, (SELECT idPlano FROM Plano WHERE descripcion = _nombre AND Proyecto_idProyecto = _idProyecto),1);
END //

DELIMITER //
CREATE PROCEDURE inhabilitarPlano
(_idArchivo int
)
BEGIN
    UPDATE Plano SET visibilidad = 0 WHERE idPlano = (SELECT Plano_idPlano FROM ArchivoPlano WHERE idArchivo = _idArchivo);
    UPDATE Orden SET visibilidad = 0 WHERE Plano_idPlano = (SELECT Plano_idPlano FROM ArchivoPlano WHERE idArchivo = _idArchivo);
    UPDATE ArchivoPlano SET visibilidad = 0 WHERE  idArchivo = _idArchivo;
END//

--Material
DELIMITER//
CREATE PROCEDURE nuevoMaterial(
    _referencia VARCHAR(50),
    _especificaciones TEXT,
    _unidadMedida VARCHAR(50),
    _cantDisponible double
     )
 BEGIN
    INSERT INTO Material(referencia,especificaciones,unidadMedida,cantDisponible,visibilidad)
    VALUES(_referencia,_especificaciones,_unidadMedida,_cantDisponible,1);
    INSERT INTO Tramite(fecha, cantidadAsignada, tipo, Empleado_idEmpleado,Material_idMaterial,visibilidad) 
    VALUES (CURDATE(),_cantDisponible,'Entrada','$_SESSION[idEmpleado]', (select max(idMaterial) from Material), 1)
 END //


--Material

DELIMITER //
CREATE PROCEDURE registrarMaterial(
    _referencia varchar(45),
    _especificaciones varchar(45),
    _unidadMedida varchar(45),
    _cantDisponible double,
    _idEmpleado int)
BEGIN
    INSERT INTO Material(referencia,especificaciones,unidadMedida,cantidadDisponible,visibilidad)VALUES( _referencia, _especificaciones,_unidadMedida,_cantDisponible,1);
    INSERT INTO Tramite(fecha,cantidadAsignada,tipo,Empleado_idEmpleado,Material_idMaterial,visibilidad)VALUES(CURDATE(),_cantDisponible,'Entrada',_idEmpleado,(SELECT idMaterial FROM Material WHERE referencia=_referencia AND especificaciones=_especificaciones),'1'); 
END //

DELIMITER //
CREATE PROCEDURE actualizarMaterial(
    _idMaterial int,
    _referencia varchar(45),
    _especificaciones varchar(45),
    _unidadMedida varchar(45),
 )
BEGIN
    UPDATE Material SET referencia=_referencia,especificaciones=_especificaciones,unidadMedida=_unidadMedida
    WHERE idMaterial=_idMaterial;
   
END //
DELIMITER //
CREATE PROCEDURE inhabilitarMaterial(
idMaterial int)
BEGIN
	UPDATE Materiales SET visibilidad = 0 WHERE idMaterial = _idMaterial;
END //


--Rol

DELIMITER //
CREATE PROCEDURE consultarIdRol(
    _nombre varchar(45))
    SELECT idRol FROM rol WHERE nombre = _nombre;
BEGIN
END //


--Consultas para reporte de materiales
DELIMITER $$


CREATE PROCEDURE `reporteEntradaMaterial` (`_idMaterial` INT)  BEGIN
    SELECT t.fecha, t.cantidadAsignada, e.nombreCompleto
    FROM Tramite AS t INNER JOIN Empleado AS e ON t.Empleado_idEmpleado = e.idEmpleado
    WHERE t.Material_idMaterial = _idMaterial AND t.tipo = 'Entrada';
END$$


CREATE PROCEDURE `conteoReporteEntradaMaterial` (`_idMaterial` INT) BEGIN 
    SELECT COUNT(*) AS numero FROM Tramite
    WHERE Material_idMaterial = _idMaterial AND tipo = 'Entrada';
END$$

CREATE PROCEDURE `reporteDevolucionMaterialProyecto` (`_idMaterial` INT) BEGIN 
    SELECT t.fecha, t.cantidadAsignada, e.nombreCompleto, pl.descripcion AS plano, pr.nombre AS proyecto
    FROM Tramite AS t INNER JOIN Empleado AS e ON t.Empleado_idEmpleado = e.idEmpleado
    INNER JOIN Orden AS o ON o.idOrden = (SELECT idOrden FROM Orden 
        WHERE t.cantidadAsignada = (cantidadRequerida - cantidadConsumida) AND Material_idMaterial = _idMaterial)
    INNER JOIN Plano AS pl ON o.Plano_idPlano = pl.idPlano
    INNER JOIN Proyecto AS pr ON pl.Proyecto_idProyecto = pr.idProyecto
    WHERE t.Material_idMaterial = _idMaterial AND t.tipo = 'Devolucion';
END$$

CREATE PROCEDURE `reporteDevolucionMaterial` (`_idMaterial` INT) BEGIN
    SELECT t.fecha, t.cantidadAsignada, e.nombreCompleto
    FROM Tramite AS t INNER JOIN Empleado AS e ON t.Empleado_idEmpleado = e.idEmpleado
    WHERE t.Material_idMaterial = _idMaterial AND t.tipo = 'Devolucion';
END$$

CREATE PROCEDURE `conteoReporteDevolucionMaterial` (`_idMaterial` INT) BEGIN 
    SELECT COUNT(*) AS numero FROM Tramite
    WHERE Material_idMaterial = _idMaterial AND tipo = 'Devolucion';
END$$

CREATE PROCEDURE `conteoReporteSalidaMaterial` (`_idMaterial` INT) BEGIN 
    SELECT COUNT(*) AS numero FROM Tramite
    WHERE Material_idMaterial = _idMaterial AND tipo = 'Salida';
END$$


CREATE PROCEDURE `reporteSalidaMaterial` (`_idMaterial` INT) BEGIN 
    SELECT t.fecha, t.cantidadAsignada, e.nombreCompleto, pl.descripcion AS plano, pr.nombre AS proyecto
    FROM Tramite AS t INNER JOIN Empleado AS e ON t.Empleado_idEmpleado = e.idEmpleado
    INNER JOIN OrdenTramitada AS ot ON ot.Tramite_idTramite = t.idTramite
    INNER JOIN Orden AS o ON o.idOrden = ot.Orden_idOrden
    INNER JOIN Plano AS pl ON o.Plano_idPlano = pl.idPlano
    INNER JOIN Proyecto AS pr ON pl.Proyecto_idProyecto = pr.idProyecto
    WHERE t.Material_idMaterial = _idMaterial AND t.tipo = 'Salida';
END$$



CREATE PROCEDURE `reporteConsultaMaterial` (`_idMaterial` INT) BEGIN 
    SELECT referencia, especificaciones, unidadMedida, cantidadDisponible
    FROM Material
    WHERE idMaterial = _idMaterial;
END$$

--vista alerta orden

CREATE VIEW alertaOrden 
AS 
SELECT pr.nombre, pr.fechaEntrega, o.cantidadRequerida, o.estado, pl.descripcion, m.referencia, m.cantidadDisponible
FROM Proyecto AS pr INNER JOIN Plano AS pl ON pr.idProyecto = pl.Proyecto_idProyecto
INNER JOIN Orden AS o ON o.Plano_idPlano = pl.idPlano
INNER JOIN Material AS m ON o.Material_idMaterial = m.idMaterial  
<<<<<<< HEAD
WHERE pl.visibilidad = 1 AND o.visibilidad = 1 AND pr.visibilidad = 1;
=======
WHERE pl.visibilidad = 1 AND o.visibilidad = 1 AND pr.visibilidad = 1;



--registrarCliente
DELIMITER //
CREATE PROCEDURE registrarCliente(
 _nombre VARCHAR(45),
 _telefonoFijo VARCHAR(45),
 _telefonoCelular VARCHAR(45),
 _correoElectronico VARCHAR(45),
 _nit VARCHAR(45)
 )
BEGIN
    INSERT INTO cliente (nombre,telefonoFijo,telefonoCelular,correoElectronico,nit,visibilidad) 
    VALUES(_nombre, _telefonoFijo, _telefonoCelular, _correoElectronico, _nit, 1);
END //

--actualizarCliente
DELIMITER //
CREATE PROCEDURE actualizarCliente(
  _nombre VARCHAR(45),
 _telefonoFijo VARCHAR(45),
 _telefonoCelular VARCHAR(45),
 _correoElectronico VARCHAR(45),
 _nit VARCHAR(45)
 )
BEGIN
    UPDATE Cliente SET nombre = _nombre, telefonoFijo = _telefonoFijo, telefonoCelular = _telefonoCelular,
     correoElectronico = _correoElectronico, nit=_nit WHERE idCliente = _idCliente;
END //

--inhabilitarCliente
DELIMITER //
CREATE PROCEDURE inhabilitarCliente(
	_idCliente int
)	
BEGIN
    UPDATE Cliente SET visibilidad = 0 WHERE idCliente = _idCliente;
END//


-- Estado del proyecto
CREATE PROCEDURE `reporteEstadoProyecto` (`_idProyecto` INT) BEGIN 
    SELECT pr.nombre, pr.fechaInicio, pr.fechaEntrega, pr.porcentajeAvance, ep.nombre AS estado, cl.nombre AS cliente
    FROM EstadoProyecto AS ep INNER JOIN Proyecto AS pr ON ep.idEstadoProyecto = pr.estadoProyecto_idEstadoProyecto
    INNER JOIN Cliente AS cl ON cl.idCliente = pr.Cliente_idCliente

    WHERE pr.idProyecto = _idProyecto;
END$$

CREATE PROCEDURE `reporteEquipoProyecto` (`_idProyecto` INT) BEGIN 
    SELECT em.nombreCompleto, ro.nombre
    FROM Proyecto AS pr INNER JOIN EquipoTrabajo AS eq ON eq.Proyecto_idProyecto = pr.idProyecto
    INNER JOIN Empleado AS em ON em.idEmpleado = eq.Empleado_idEmpleado
    INNER JOIN Rol AS ro ON ro.idRol = em.Rol_idRol
    WHERE pr.idProyecto = _idProyecto AND eq.visibilidad = 1;
END$$


CREATE PROCEDURE `reportePlanosProyecto` (`_idProyecto` INT) BEGIN 
    SELECT pl.descripcion, od.estado, ma.referencia, ma.especificaciones, od.cantidadRequerida, od.cantidadConsumida
    FROM Proyecto AS pr INNER JOIN Plano AS pl ON pl.Proyecto_idProyecto = pr.idProyecto
    INNER JOIN Orden AS od ON od.Plano_idPlano = pl.idPlano
    INNER JOIN Material AS ma ON od.Material_idMaterial = ma.idMaterial
    WHERE pr.idProyecto = _idProyecto AND od.visibilidad = 1;
END$$


CREATE PROCEDURE `conteoEquipo` (`_idProyecto` INT) BEGIN 
    SELECT COUNT(*) AS numero FROM EquipoTrabajo
    WHERE Proyecto_idProyecto = _idProyecto;
END$$

CREATE PROCEDURE `conteoOrdenes` (`_idProyecto` INT) BEGIN 
    SELECT COUNT(*) AS numero FROM Orden
    WHERE Plano_idPlano = (SELECT idPlano FROM Plano WHERE Proyecto_idProyecto = _idProyecto);
END$$


/*
Proyecto: nombre, fechaInicio, fechaEntrega, porcenjaeAvance
EstadoProyecto: nombre
Cliente : nombre
Empleado: nombreCompleto
Rol : nombre
Plano: descripcion
orden : estado
material: referencia, especificaciones


    INNER JOIN EquipoTrabajo AS eq ON eq.Proyecto_idProyecto = pr.idProyecto
    INNER JOIN Empleado AS em ON em.idEmpleado = eq.Empleado_idEmpleado
    INNER JOIN Rol AS ro ON ro.idRol = em.Rol_idRol
    INNER JOIN Plano AS pl ON pl.Proyecto_idProyecto = pr.idProyecto
    

*/

>>>>>>> c96475eb391ad43b49315cc5dd1f221e2c27de4a
