create database MESA_AYUDA;

USE MESA_AYUDA;

CREATE TABLE MESA_AYUDA.AREA (IDAREA VARCHAR(10) NOT NULL,
                              NOMBRE VARCHAR(50) NOT NULL,
                              FKEMPLE VARCHAR(20) NULL,
                              PRIMARY KEY (IDAREA));

CREATE TABLE MESA_AYUDA.EMPLEADO (IDEMPLEADO VARCHAR(20) NOT NULL,
                                  NOMBRE VARCHAR( 100 ) NOT NULL,
                                  FOTO VARCHAR(200),
                                  HOJAVIDA VARCHAR(200),
                                  TELEFONO VARCHAR( 15 ) NOT NULL,
                                  EMAIL VARCHAR( 100 ) NOT NULL,
                                  DIRECCION VARCHAR( 100 ) NOT NULL,
                                  X DOUBLE,
                                  Y DOUBLE,
                                  fkEMPLE_JEFE VARCHAR(20),
                                  fkAREA VARCHAR(10) NOT NULL,
                                  Estado enum('Activo','Inactivo') not null DEFAULT 'Activo',
                                  PRIMARY KEY (IDEMPLEADO) );

ALTER TABLE MESA_AYUDA.AREA ADD CONSTRAINT CONS_FKEMPLE FOREIGN KEY ( FKEMPLE ) REFERENCES EMPLEADO ( IDEMPLEADO );

ALTER TABLE EMPLEADO ADD CONSTRAINT CONS_FKAREA FOREIGN KEY ( FKAREA ) REFERENCES AREA ( IDAREA ); ALTER TABLE EMPLEADO ADD CONSTRAINT CONS_FKEMPLE1 FOREIGN KEY ( FKEMPLE_JEFE ) REFERENCES EMPLEADO ( IDEMPLEADO );

CREATE TABLE MESA_AYUDA.REQUERIMIENTO ( IDREQ INT AUTO_INCREMENT NOT NULL,
                                       FKAREA VARCHAR(10) NOT NULL,
                                       TITULO VARCHAR(50) NOT NULL,
                                       PRIMARY KEY (IDREQ));
                                       
ALTER TABLE REQUERIMIENTO ADD CONSTRAINT CONS_FKAREA1 FOREIGN KEY ( FKAREA ) REFERENCES AREA ( IDAREA );

CREATE TABLE MESA_AYUDA.ESTADO ( IDESTADO VARCHAR(1) NOT NULL,
                                NOMBRE VARCHAR(30) NOT NULL , PRIMARY KEY ( IDESTADO ) );

CREATE TABLE MESA_AYUDA.DETALLEREQ ( IDDETALLE INT AUTO_INCREMENT NOT NULL , FECHA date NOT NULL , OBSERVACION VARCHAR (4000) NOT NULL , FKREQ INT NOT NULL, FKESTADO VARCHAR(1) NOT NULL, FKEMPLE VARCHAR(20) NOT NULL, FKEMPLEASIGNADO VARCHAR(20) NULL, PRIMARY KEY ( IDDETALLE) );

ALTER TABLE DETALLEREQ ADD CONSTRAINT CONS_FKEMPLE2 FOREIGN KEY ( FKEMPLE ) REFERENCES EMPLEADO ( IDEMPLEADO );

ALTER TABLE DETALLEREQ ADD CONSTRAINT CONS_FKREQ FOREIGN KEY ( FKREQ ) REFERENCES REQUERIMIENTO ( IDREQ ); 

ALTER TABLE DETALLEREQ ADD CONSTRAINT CONS_ESTADO FOREIGN KEY ( FKESTADO ) REFERENCES ESTADO ( IDESTADO ); 

ALTER TABLE DETALLEREQ ADD CONSTRAINT CONS_FKEMPLEASIG FOREIGN KEY (FKEMPLEASIGNADO ) REFERENCES EMPLEADO ( IDEMPLEADO);

CREATE TABLE CARGO( IDCARGO INT AUTO_INCREMENT,
                    NOMBRE VARCHAR(100) NOT NULL,
					Estado enum('Activo','Inactivo') not null DEFAULT 'Activo',
                   PRIMARY KEY(IDCARGO) );

#CREATE TABLE CARGO_POR_EMPLEADO ( FKCARGO INT AUTO_INCREMENT,
CREATE TABLE CARGO_POR_EMPLEADO (IDCARGO_EMPLEADO INT AUTO_INCREMENT,
								 FKCARGO INT NOT NULL,
                                 FKEMPLE VARCHAR(20) NOT NULL,
                                 FECHAINI DATE NOT NULL,
                                 FECHAFIN DATE,
                                 PRIMARY KEY(IDCARGO_EMPLEADO) );
                                # PRIMARY KEY(FKCARGO,FKEMPLE) );

ALTER TABLE CARGO_POR_EMPLEADO ADD CONSTRAINT CONS_FKEMPLE3 FOREIGN KEY ( FKEMPLE ) REFERENCES EMPLEADO ( IDEMPLEADO ); ALTER TABLE CARGO_POR_EMPLEADO ADD CONSTRAINT CONS_FKCARGO FOREIGN KEY ( FKCARGO ) REFERENCES CARGO ( IDCARGO );

CREATE TABLE USUARIO( ID INT AUTO_INCREMENT, USUARIO VARCHAR(20) NOT NULL
, PASS VARCHAR(20) NOT NULL , FKIDEMPLEADO VARCHAR(20) NOT NULL, PRIMARY KEY(ID ) );

INSERT INTO estado (IDESTADO, NOMBRE) VALUES 
('1', 'Radicado'),
('2', 'Asignado'),
('3', 'Solucionado Parcialmente'),
('4', 'Solucionado Totalmente'),
('5', 'Cancelado');

INSERT INTO area (IDAREA, NOMBRE, FKEMPLE) VALUES 
('10','INFORMÁTICA',null),
('20','GESTIÓN HUMANA',null),
('30','MANTENIMIENTO',null),
('40','CONTABILIDAD',null);

INSERT INTO cargo (IDCARGO, NOMBRE) VALUES 
(NULL, 'Admin'),
(NULL, 'Empleado');

INSERT INTO empleado 
(IDEMPLEADO , NOMBRE, FOTO, HOJAVIDA, TELEFONO, EMAIL, DIRECCION, X, Y, fkAREA ) VALUES 
('123456789','Administrador','uploads/123456789123456789admin.jpg','uploads/123456789Administrador.pdf','1234567890','admin@mesaayuda.com','calle-CR',4444,5555,'10'),
('1020419235','Juan Esteban','uploads/1020419235.jpg','uploads/1020419235.pdf','3174738789','juanchis@mesaayuda.com','calle102',777,888,'10'),
('1020419236','James','uploads/1020419237.jpg','uploads/1020419237.pdf','3174','james@mesaayuda.com','calle104442',7747,88558,'10');



INSERT INTO usuario 
(USUARIO, PASS, FKIDEMPLEADO) VALUES 
('admin','123','123456789'),
('juan','123','1020419235'),
('james','123','1020419236');


INSERT INTO cargo_por_empleado
(FKCARGO, FKEMPLE, FECHAINI, FECHAFIN) VALUES 
('1','123456789', '2021-05-26','0000-00-00' ),
('2','1020419235', '2021-05-26','0000-00-00' ),
('2','1020419236', '2021-05-26','0000-00-00' );
#('123456789', '2021-05-26', '0000-00-00');
#('123456789', 2021-05-26, 0000-00-00); phpmyadmin

CREATE PROCEDURE EliminarUnUsuario ()
delete from usuario where FKIDEMPLEADO = Cedula;

CREATE PROCEDURE ModificarUsuario (IN Cedula VARCHAR(20),IN Users VARCHAR(20), IN Pass VARCHAR(20))
update usuario set USUARIO = Users, PASS = Pass where FKIDEMPLEADO = Cedula;

CREATE PROCEDURE MostrarTodosLosUsuarios ()
SELECT ID, USUARIO, PASS, FKIDEMPLEADO,NOMBRE,Estado FROM USUARIO INNER JOIN EMPLEADO  ON USUARIO.FKIDEMPLEADO=EMPLEADO.IDEMPLEADO;

CREATE PROCEDURE ConsultarEmpleadoPorCC (in Cedula varchar(20))
select * from Empleado where IDEMPLEADO = Cedula and Estado='Activo';

CREATE PROCEDURE ConsultarSoloEmpleadosActivos ()
SELECT IDEMPLEADO, NOMBRE FROM empleado INNER JOIN cargo_por_empleado ON empleado.IDEMPLEADO=cargo_por_empleado.FKEMPLE where FKCARGO != 1 and Estado='Activo';
 
CREATE PROCEDURE ConsultarTodasLasAreas ()
select * from area;

CREATE PROCEDURE InactivarUnUsuario (in Cedula varchar(20))
update Empleado set Estado = 'Inactivo' where IDEMPLEADO = Cedula;

CREATE PROCEDURE ActivarUnUsuario (in Cedula varchar(20))
update Empleado set Estado = 'Activo' where IDEMPLEADO = Cedula;



CREATE PROCEDURE UpdateAnEmployeeForCC(
in Nombre varchar(100), in Foto varchar(200), in HojaVida varchar(200), in Telefono varchar(15), in Email varchar(100), in Direccion varchar(100),
in x double, in y double, in Cedula varchar(20))

update Empleado set NOMBRE = Nombre, FOTO = Foto, HOJAVIDA = HojaVida, TELEFONO = Telefono, EMAIL = Email, DIRECCION = Direccion,
X = x, Y = y where IDEMPLEADO = Cedula;
 
CREATE PROCEDURE AllPositions ()
select * from Cargo;

CREATE PROCEDURE NewArea (in Nombre varchar(100))
INSERT INTO cargo (NOMBRE) VALUES (Nombre);

CREATE PROCEDURE ValidateArea (in Nombre varchar(100))
select IDCARGO from Cargo where Cargo.NOMBRE = (Nombre);

CREATE PROCEDURE UpdateArea (in id int, in Nombre varchar(100))
update Cargo set NOMBRE = Nombre where IDCARGO = id;

#CREATE PROCEDURE DeleteArea (in id int)
#delete from Cargo where IDCARGO = id;


CREATE PROCEDURE DeleteArea (in id int,in FechaInicial date,in FechaActual date)
update cargo_por_empleado set FECHAFIN = FechaActual where FKCARGO=id and FECHAFIN=FechaInicial;
#update cargo_por_empleado set FECHAFIN = '2222-10-10' where FKCARGO=1 and FECHAFIN='0000-00-00';

CREATE PROCEDURE UpdateDeleteArea (in id int,in Estado varchar(100))
update cargo set Estado = Estado where IDCARGO=id;


CREATE PROCEDURE AllAreaAlert ()
select * from Area where FKEMPLE IS NULL;


#///////////////

CREATE PROCEDURE ValidateEmployee (in Cedula varchar(20))
select NOMBRE from Empleado where IDEMPLEADO = Cedula;

CREATE PROCEDURE ValidateUser (in Users varchar(20))
select ID from usuario where USUARIO = Users;

#drop procedure ValidateUser

CREATE PROCEDURE SaveEmployee (
in Cedula varchar(20),
in Nombre varchar(100),
in Foto varchar(200),
in HojaVida varchar(200),
in Telefono varchar(15),
in Email varchar(100),
in Direccion varchar(100),
in x double,
in y double,
in fkarea varchar(20))
insert into empleado (IDEMPLEADO, NOMBRE, FOTO, HOJAVIDA, TELEFONO, EMAIL, DIRECCION, X, Y, fkAREA)
      values(Cedula,Nombre,Foto,HojaVida,Telefono,Email,Direccion,x,y,fkarea);

CREATE PROCEDURE SaveCargo_por_empleado (
in Fkcargo int,
in Fkemple varchar(20),
in Fechaini date,
in Fechafin date)
insert into cargo_por_empleado (FKCARGO , FKEMPLE , FECHAINI, FECHAFIN)
      values(Fkcargo, Fkemple, Fechaini, Fechafin);

CREATE PROCEDURE SaveUsuario (
in usu varchar(20),
in contra varchar(20),
in cedula varchar(20))
insert into usuario (USUARIO , PASS , FKIDEMPLEADO)
      values(usu, contra, cedula);

CREATE PROCEDURE Consultonlyname (in Cedula varchar(20))
select NOMBRE from Empleado where IDEMPLEADO = Cedula;


CREATE PROCEDURE ConsultonlyEmployeeForArea (in area varchar(10))
SELECT IDEMPLEADO ,NOMBRE FROM empleado INNER JOIN cargo_por_empleado ON empleado.IDEMPLEADO=cargo_por_empleado.FKEMPLE where FKCARGO  != 1 and fkAREA = area and Estado='Activo';


CREATE PROCEDURE UpdateEmployeeBoss (in jefe varchar(20),in area varchar(10))
update empleado set fkEMPLE_JEFE = jefe where fkAREA = area ;


CREATE PROCEDURE ReportEmployee ()
SELECT IDEMPLEADO ,empleado.NOMBRE AS NOMBREEMPLEADO,fkEMPLE_JEFE, area.NOMBRE AS NOMBREAREA FROM empleado INNER JOIN area ON empleado.fkAREA=area.IDAREA where IDEMPLEADO!=fkEMPLE_JEFE and empleado.NOMBRE!='Administrador' and Estado='Activo';













#drop database mesa_ayuda;

#describe DETALLEREQ;
#use mesa_ayuda;
#select * from area;
#select * from DETALLEREQ;
#select * from REQUERIMIENTO;
#select * from empleado;
#select * from cargo;
#select * from cargo_por_empleado;













