#drop database buses;
Create database buses; 
use buses;

Create Table empleado
(
	id_empleado int auto_increment Not Null Primary Key,
    cedula varchar(10) unique,
	nombre varchar (30) Not Null,
	apellido varchar (30) Not Null,
	correo varchar (50) Not Null unique,
	telefono varchar (12) Not Null unique,
    cargo varchar(30) Not Null,
	estado boolean Not Null
);
insert into empleado() values(1,"1000625717","Harold","Camargo","harold@gmail.com","319238459","Coordinador administrador",1);
insert into empleado() values(2,"1234567585","Santiago","Jimenez","santiago@gmail.com","319238458","coordinador de rutas",1);
insert into empleado() values(3,"8454412441","Albeiro","Gomez","albeiro@gmail.com","319238457","Conductor",1);
insert into empleado() values(4,"1","al","go","algo@gmail.com","3162","Conductor",1);
insert into empleado() values(5,"2","a","go","a@gmail.com","33","Conductor",1);
insert into empleado() values(6,"3","b","go","b@gmail.com","31462","Conductor",1);
insert into empleado() values(7,"4","c","go","v@gmail.com","3122","Conductor",1);
insert into empleado() values(8,"5","d","go","c@gmail.com","3152","Conductor",1);
insert into empleado() values(9,"6","e","go","d@gmail.com","31652","Conductor",1);
insert into empleado() values(10,"7","f","go","s@gmail.com","31672","Conductor",1);
select * from empleado;

Create table perfil
(
	perfil char(1) not null,
    nombre varchar(20) not null,
    primary key (perfil)
);
insert into perfil() values("1","administrador"); #acceso a todo
insert into perfil() values("2","rutas"); # acceso a asignacion de -rutas a buses -buses a conductores
insert into perfil() values("3","conductor"); # consultar sus rutas asignadas

create table usuario
(
	empleado int not null primary key,
	perfil char(1) not null,    
	usuario varchar(10) not null unique,
    clave varchar(40) not null,
	Foreign Key (perfil) references perfil (perfil),
	Foreign Key (empleado) references empleado (id_empleado)
);
insert into usuario() values("1","1","harold",SHA("123"));
insert into usuario() values("2","2","santiago",SHA("123"));
insert into usuario() values("3","3","albeiro",SHA("123"));
insert into usuario() values("4","3","algo",SHA("123"));
insert into usuario() values("5","3","a",SHA("123"));
insert into usuario() values("6","3","b",SHA("123"));
insert into usuario() values("7","3","c",SHA("123"));
insert into usuario() values("8","3","d",SHA("123"));
insert into usuario() values("9","3","e",SHA("123"));
insert into usuario() values("10","3","f",SHA("123"));
select * from usuario;

create table contrato
(
	id_contrato int auto_increment primary key,
    fecha_inicio date not null,
    fecha_fin date not null,
    conductor int not null unique,
    valor int not null,
    estado char(1),
    foreign key (conductor) references empleado(id_empleado) 
);
# 1 activo pero sin bus
# 2 activo con bus
# 3 contrato expirado
insert into contrato () values(1,"2020-02-02", "2020-09-09", 3, 2000000,"2");
insert into contrato () values(2,"2020-02-02", "2020-09-09", 4, 2000000,"2");
insert into contrato () values(3,"2020-02-02", "2020-09-09", 5, 2000000,"1");
insert into contrato () values(4,"2020-02-02", "2020-09-09", 6, 2000000,"1");
insert into contrato () values(5,"2020-02-02", "2020-09-09", 7, 2000000,"3");
select * from contrato;

create table bus
(
	id_bus int auto_increment primary key,
    placa varchar(6) unique,
    estado char (1) not null
);
# 1 activo pero sin conductor
# 2 activo con conductor
# 3 En reparacion
insert into bus() values (1, "asd122","2");
insert into bus() values (2, "aaaaaa","1");
insert into bus() values (3, "bbbbbb","1");
insert into bus() values (4, "cccccc","2");
insert into bus() values (5, "dddddd","1");
insert into bus() values (6, "eeeeee","1");
select * from bus;

create table detalle_bus_conductor
(
	id_detalle_bus_conductor int auto_increment primary key,
	bus int unique not null,
    conductor int unique not null,
    foreign key (bus) references bus(id_bus),
	foreign key (conductor) references contrato(id_contrato)
);
insert into detalle_bus_conductor() values (1, 1, 1);
insert into detalle_bus_conductor() values (2, 4, 2);
select * from detalle_bus_conductor;
#DELETE from detalle_bus_conductor where id_detalle_bus_conductor = 4;
create table ruta
(
	id_ruta int auto_increment primary key,
    inicio varchar(50),
    intermedio nvarchar (250),
    fin varchar (50)
);
insert into ruta() values (1, "teusaquillo", "Restrepo,Quiroga,Ciudad Jardin", "Guacamayas");
select * from ruta;

create table detalle_ruta
(
	ruta int,
    bus int unique,
    foreign key (ruta) references ruta(id_ruta),
    foreign key (bus) references detalle_bus_conductor(id_detalle_bus_conductor) ON DELETE CASCADE
);
select * from contrato c, empleado e where c.conductor=e.id_empleado and c.estado = 1;
insert into detalle_ruta() values (1,1);
select * from detalle_ruta;
select * from contrato c, empleado e where e.id_empleado=c.conductor and c.estado = '1';
select * from detalle_bus_conductor dbc, contrato c, empleado e, bus b where dbc.conductor=c.id_contrato and dbc.bus=b.id_bus and c.conductor=e.id_empleado and b.id_bus = 1;
select * from detalle_bus_conductor d, bus b where d.bus = b.id_bus;
select * from detalle_ruta;
select * from detalle_bus_conductor d, bus b where d.bus = b.id_bus;
select * from bus;
select dr.bus from detalle_ruta dr, detalle_bus_conductor dbc where dbc.id_detalle_bus_conductor = dr.bus;
select * from detalle_bus_conductor;
select * from detalle_bus_conductor where NOT exists (select * from detalle_ruta r where  id_detalle_bus_conductor= r.bus);
select * from detalle_bus_conductor dbc,  bus b, contrato c, empleado e
where         
dbc.bus = b.id_bus and
dbc.conductor = c.id_contrato and
c.conductor = e.id_empleado and 
NOT exists (select * from detalle_ruta r where  id_detalle_bus_conductor= r.bus);

select * from empleado where not exists (select * from contrato where conductor = id_empleado) and cargo = 'Conductor';