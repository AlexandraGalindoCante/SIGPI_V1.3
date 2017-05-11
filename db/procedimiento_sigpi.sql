
DELIMITER //
create  PROCEDURE registrarEmpleado(

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

call registrarEmpleado('Camila Fuentes','123','10923847','1028934701','128734691234','camilo@gmail.com','calle 3',1);