--Empleado


DELIMITER //
CREATE PROCEDURE registrarEmpleado(
 _nombreCompleto VARCHAR(50),
 _contrasena VARCHAR(50),
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
     _direccion, _idRol, (SELECT idUsuario FROM Usuario WHERE nombreUsuario = _correoElectronico), 1);
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
 _email VARCHAR(50),
 _password VARCHAR(50)
 )
BEGIN
    select idEmpleado, nombreCompleto, Rol_idRol, nombre as rol
    from Empleado inner join usuario on Empleado.Usuario_idUsuario = Usuario.idUsuario 
    inner join rol on Empleado.Rol_idRol = Rol.idRol 
    where nombreUsuario = _email && contrasena = _password;
END //