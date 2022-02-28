create database jobs;
Use jobs;
-- drop table Usuario;
Create table Usuario(
	IDUsuarioPK integer auto_increment primary key not null,
    NombreUsuario varchar(70) not null,
    CorreoUsuario varchar(100) not null unique,
    PasswordU varchar (260) not null,
    Rol tinyint not null default '2',
    EstadoUsuario tinyint not null default '1'
);

Create table clase(
	IDClasePK integer auto_increment primary key not null,
    NombreClase varchar(100) not null,
    EnlaceClase varchar(300),
    EnlacePortafolio varchar(300),
    HoraInicio time,
    HoraFin time
);

Create table horario(
	IDHorarioPK integer auto_increment primary key not null,
    LunesFK integer,
    MartesFK integer,
    MiercolesFK integer,
    JuevesFK integer,
    ViernesFK integer
);

-- drop table job;
create table job(
	IDJobPK integer auto_increment primary key not null,
    TituloJob varchar(100) not null,
    Descripcion varchar(500),
    fechaCreacion date not null,
    FechaLimite date,
    EstadoJob tinyint not null default '1',
    IDUsuarioFK integer not null
);

#drop table job_eliminado;
#Tabla para guardar tareas eliminadas
Create table job_eliminado(
	IDJobEPK integer auto_increment primary key not null,
    fechaEliminacion datetime not null,
    TituloJob varchar(100) not null,
    Descripcion varchar(500),
    FechaCreacion date not null,
    FechaLimite date,
    EstadoJob tinyint not null default '1',
    IDUsuarioFK integer not null
);

#drop table historial_sql;
Create table historial_sql(
	IDHistorialPK integer auto_increment primary key not null,
    Fecha datetime not null,
    TablaAfectada varchar(50) not null,
    Accion varchar(150) not null,
    Equipo varchar(100) not null,
    NombreUserEquipo varchar(100) not null,
    IdUsuarioFk integer not null
);

# ALTER TABLE usuario CHANGE NombreUsuario CorreoUsuario varchar(100) not null unique;
# ALTER TABLE usuario ADD NombreUsuario varchar(70) not null AFTER IDUsuarioPK;
-- ALTER TABLE job ADD IDUsuarioFK integer not null;
-- ALTER TABLE clase ADD HoraInicio time;
-- ALTER TABLE clase ADD HoraFin time;
-- FechaInicio date not null,
# ALTER TABLE job ADD FechaCreacion datetime not null AFTER Descripcion;
# ALTER TABLE job_eliminado ADD fechaCreacion date AFTER Descripcion;
    -- FechaFin date not null
    
#ALTER TABLE job_eliminado MODIFY FechaCreacion date not null;
#ALTER TABLE job_eliminado MODIFY FechaEliminacion datetime not null;
#ALTER TABLE job_eliminado change FechaCreacion fechaCreacion date not null;
#ALTER TABLE job_eliminado change FechaEliminacion fechaEliminacion datetime not null;
 
 
 Alter table horario
 add constraint Clases_Horario_Lunes
 foreign key (LunesFK)
 references clase(IDClasePK) on update cascade;
 
Alter table horario
add constraint Clases_Horario_Martes
foreign key (MartesFK)
references clase(IDClasePK) on update cascade;

Alter table horario
add constraint Clases_Horario_Miercoles
foreign key (MiercolesFK)
references clase(IDClasePK) on update cascade;

Alter table horario
add constraint Clases_Horario_Jueves
foreign key (JuevesFK)
references clase(IDClasePK) on update cascade;

Alter table horario
add constraint Clases_Horario_Viernes
foreign key (ViernesFK)
references clase(IDClasePK) on update cascade;

Alter table job
add constraint tiene_una
foreign key (IDUsuarioFK)
references Usuario(IDUsuarioPK) on update cascade;

Alter table job_eliminado
add constraint elimino
foreign key (IDUsuarioFK)
references usuario(IDUsuarioPK) on update cascade;

Alter table historial_sql
add constraint hizo
foreign key (IdUsuarioFK)
references usuario(IDUsuarioPK) on update cascade;

INSERT INTO usuario values(null, "Jhon Camargo", "JhonCamargo21", "$2y$10$3LioBl3o0Cc8zXVgSRP6yOArhw7QRa36oyILxgD63csCstgDBD7Mq", 1, 1);
INSERT INTO usuario values(null,"Alexander Cadena", "AdminCamargo", "$2y$10$3LioBl3o0Cc8zXVgSRP6yOArhw7QRa36oyILxgD63csCstgDBD7Mq", 1, 1);

Insert into clase values (null, "Protección ambiental", "https://meet.google.com/bdo-qrah-ggd?hs=224", null),
(null, "Comunicación", null, "https://drive.google.com/drive/u/1/folders/1HKSORR-N4cSeU1esBOiMMJsYIJwD6eUb"),
(null, "Diseño orientado a objetos - JAVA", "https://meet.google.com/jip-beqh-cbd", null),
(null, "Calidad de desarrollo de software", "https://meet.google.com/wqj-sisj-ccm?hs=224", null),
(null, "Diseño UX", null, "https://drive.google.com/drive/folders/1TD0O80ASR1Hq21R0hZHfZaB7z3ukp3mt"),
(null, "Bases de datos", "https://meet.google.com/meet/eax-ctau-zdh", null),
(null, "Cultura fisica", "https://meet.google.com/jic-jpmz-ivt", "https://drive.google.com/drive/u/1/folders/1PR5-vjKHEaorJiwuDyaw4UINGYGYkR1_"),
(null, "Ingles", "https://meet.google.com/aaj-stww-vog", "https://drive.google.com/drive/u/1/folders/1Him_Oq37mS4k7mb5bklqXFKPd8flSKEi"),
(null, "Arquitectura orientada a objetos", "https://meet.google.com/paa-fqys-vmt", "https://drive.google.com/drive/folders/1eTO_tQGf5w9Q_hd36-hJJNbCJp8GxANR?usp=sharing"),
(null, "Seguimiento proyecto", "https://meet.google.com/qjx-vdub-pxp", null);

select * from clase;

Insert into horario values(null, 1, 3, 6, 3, 9),
(null, 2, 4, 7, 8, 10);

INSERT INTO job VALUES (null, "Terminar Proyecto (jobs)", "Culminar proyecto", '2020/3/31', 1,1);
INSERT INTO job VALUES (null, "Terminar Proyecto (votaciones)", "Culminar proyecto", "2022/02/22", 1);
INSERT INTO job VALUES (null, "Terminar Prueba con sp", "Culminar proyecto", '2020/3/31', 2,1);

select * from job;

Delimiter $$
Create procedure SP_Horario_Clase(in pDia varchar(50))
begin
	Select NombreClase, EnlaceClase, EnlacePortafolio from Clase inner join horario on ViernesFK= IDClasePK;
end $$
Delimiter ;

Call SP_Horario_Clase(5);


Delimiter $$
Create procedure sp_select_usuario_login(in pUsuario varchar(50))
begin
	SELECT * FROM Usuario WHERE BINARY CorreoUsuario = pUsuario;
end $$
Delimiter ;

select * from usuario;

Delimiter $$
Create procedure sp_select_job_asc(
	in pEstado tinyint,
    in pId integer
)
begin
	SELECT * FROM job WHERE EstadoJob = pEstado AND IDUsuarioFK = pId order by FechaLimite asc;
end $$
Delimiter ;

Delimiter $$
Create procedure sp_select_job_desc(
	in pEstado tinyint,
    in pId integer
)
begin
	SELECT * FROM job WHERE EstadoJob = pEstado AND IDUsuarioFK = pId order by FechaLimite desc;
end $$
Delimiter ;

#Listar trabajos eiminados de manera descendente
Delimiter $$
Create procedure sp_select_job_eliminado_asc(
    in pId integer
)
begin
	SELECT * FROM job WHERE IDUsuarioFK = pId order by fechaEliminacion asc;
end $$
Delimiter ;

drop procedure sp_update_estado_job;
Delimiter $$
Create procedure sp_update_estado_job(
    in pEstado tinyint,
    in pIDJob integer,
    in pIdUser integer
)
begin
	UPDATE job
    SET EstadoJob = pEstado,
    FechaCreacion = now()
	WHERE IDUsuarioFK = pIdUser AND IDJobPK = pIDJob;
end $$
Delimiter ;

DESCRIBE historial_sql;
#Insertar historial
Delimiter $$
Create procedure sp_insert_historial(
	in pTablaA varchar(50),
    in pAccion varchar(150),
    in pEquipo varchar(100),
    in pNombreE varchar(100),
    in pID integer
)
begin
	insert into historial_sql values (null, now(), pTablaA, pAccion, pEquipo, pNombreE, pID);
end $$
Delimiter ;





Delimiter $$
Create procedure sp_delete_old_job(in pFecha date)
begin
	DELETE FROM job_eliminado WHERE EstadoJob = 2 AND FechaLimite = pFecha;
end $$
Delimiter ;

-- call sp_delete_old_job('2020/3/31');

select * from job;

#Trigger para antes de eliminar

# drop trigger before_delete_job;
Delimiter $$
Create trigger before_delete_job
	before delete
    on job
    for each row
begin
	insert into job_eliminado values (null, now(), old.TituloJob, old.Descripcion, old.FechaCreacion, old.FechaLimite, old.EstadoJob, old.IDUsuarioFK);
end $$
Delimiter ;

# drop trigger before_delete_in_job_eliminado;
Delimiter $$
Create trigger before_delete_in_job_eliminado
	before delete
    on job_eliminado
    for each row
begin
	insert into job values (null, old.TituloJob, old.Descripcion, now(), old.FechaLimite, old.EstadoJob, old.IDUsuarioFK);
end $$
Delimiter ;

#Procedimiento para guardar el historial
#drop trigger insert_historial_sql
Delimiter $$
Create trigger insert_historial_sql 
	before insert
    on job
    for each row
begin
	insert into historial_sql values (null, now(), "Job", "Insertar", current_user(), current_user(), 1);
end  $$
Delimiter ;


