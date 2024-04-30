resetpasstoday@gmail.com
info*reset*
passkeys=info*reset*
-------------------------   outlook
restablecer_contrasenia@outlook.com
info*reset*

Se crea roles
1 admin
2 profesor
3 consultor

se crea el puesto = 
('1','Gestor del Sistema'),
('2','Director'),
('3','Subdirector'),
('4','Profesor'),
('5','Presidente de clase'),
('6','Alumno'),
('7','Padres')

primero se crea la persona   =
('1','1025','Wilson Antonio','Vasquez Grijalva','Guatemala','wvasquezg1@miumg.edu.gt','44775039','1'),
('2','1','Pepito','Lopez','Antigua','xlive123x@gmail.com','11223344','2'),
('3','100','Mario','Bros','Boca del monte','nintendo@gmail.com','44332211','4'),
('4','754','Anastacio','Push','Amatitlan','correo@colegio.com','00552244','6')
   									id_puesto

segundo se crea el login 
('1','Wilson','1','1'), 
('2','Pepito','1','2'),
('3','Mario','2	','3'),
('4','Push','3','4')
           id_rol,idpersonas,password

UPDATE `login` SET `password`= SHA2('1', 256) WHERE id=1


/*ROLES*/
select t1.usuario,t2.nombre
FROM (
    /*tabla login*/
 select  id,usuario,id_rol from login
) t1 left join
(/*tabla roles*/
    select id,nombre,descripcion from roles
) t2 on t1.id_rol = t2.id;

------------------------

select /*Datos generales de acceso account*/
t1.usuario,t2.nombre as rol,t3.correo,t4.descripcion,t1.pass
FROM 
( /*tabla login*/ 
	select id,usuario,id_rol,id_personas,pass from login ) t1 left join 
(/*tabla roles*/ 
	select id,nombre,descripcion from roles ) t2 on t1.id_rol = t2.id left JOIN 
(/*tabla persona*/ 
	select id,correo,id_puesto from persona ) t3 on t1.id_personas = t3.id left JOIN 
(/*tabla puesto*/ 
	select id,descripcion from puesto ) t4 on t3.id_puesto = t4.id 
where t3.correo = 'wvasquezg1@miumg.edu.gt' and t1.pass = 1;


select 
	t1.id,t1.usuario,t2.nombre as rol,t3.correo,t4.descripcion,t1.pass
FROM 
( /*tabla login*/ 
	select id,usuario,id_rol,id_personas,pass from login ) t1 left join 
(/*tabla roles*/ 
	select id,nombre,descripcion from roles ) t2 on t1.id_rol = t2.id left JOIN 
(/*tabla persona*/ 
	select id,correo,id_puesto from persona ) t3 on t1.id_personas = t3.id left JOIN 
(/*tabla puesto*/ 
	select id,descripcion from puesto ) t4 on t3.id_puesto = t4.id 
where t1.usuario = 'Pepito' and t1.pass = '1';
-----------------------------------------------------------------------
select pass from login where pass = '$2y$10$SqZDBkRwD96vmvij72UVS.Oo5tf8qCBZI9bPhzhSx.x7Kjfyg92IW' ;
select * from login where id=1
update login set pass = 1 where id = 1; 


select 
 t1.nombres,t1.apellidos,t3.grado,t3.seccion, t4.total_nota
from
(
/*tabla persona*/
select id,nombres,apellidos,correo,id_puesto from persona ) t1 left join 
(
/*tabla puesto tomar solo el id=6 alumnos*/
select id,descripcion from puesto where id=6) t2 on t2.id = t1.id_puesto left join 
(
/*tabla clase */
select id,grado,seccion,fecha from clase) t3 left join 
(
/*tabla estudiante*/
select id,clave,total_nota,id_persona,id_clase from estudiante) t4 on t4.id_persona = t1.id
where t1.id = 1 and t4.id_clase = t3.id; 

insert into clase values (3,'Tercero Basico','B',now())
select * from clase

agregamos como persona 
select * from persona where id=5  id=id++
CREATE SEQUENCE persona_id_seq START WITH 1; /*que inicia secuencia en el id=1*/
insert into persona values(NEXT VALUE FOR persona_id_seq,2,'manitas','pies','','','',6)

agregar alumno:
insert into estudinte values (1,1,'',1,1)

,id_puesto=6 alumnos

select * from persona where id_puesto=6

insert into estudiante values(4,4,null,6,3)

select id,clave,total_nota,id_persona,id_clase from estudiante



select 
 t1.nombres,t1.apellidos,t3.grado,t3.seccion, t4.total_nota
from
(
/*tabla persona*/
select id,nombres,apellidos,correo,id_puesto from persona ) t1 left join 
(
/*tabla puesto tomar solo el id=6 alumnos*/
select id,descripcion from puesto where id=6) t2 on t2.id = t1.id_puesto left join 
(
/*tabla clase */
select id,grado,seccion,fecha from clase) t3 left join 
(
/*tabla estudiante*/
select id,clave,total_nota,id_persona,id_clase from estudiante) t4 on t4.id_persona = t1.id
where t1.id = 1 and t4.id_clase = t3.id; 


select 
	t1.id as id1, t2.id as id2,t1.nombres,t2.descripcion
from
(
/*tabla persona*/
select id,nombres,apellidos,correo,id_puesto from persona ) t1 left join 
(
/*tabla puesto tomar solo el id=6 alumnos*/
select id,descripcion from puesto where id=6) t2 on t2.id = t1.id_puesto left join
(
/*tabla clase */
select id,grado,seccion,fecha from clase) t3 left join 
(
/*tabla estudiante*/
select id,clave,total_nota,id_persona,id_clase from estudiante) t4 on t4.id_clase = t3.id
where t2.id = 6




select 
	t3.id as idclase
from
(
/*tabla clase */
select id,grado,seccion,fecha from clase) t3 left join 
(
/*tabla estudiante*/
select id,clave,total_nota,id_persona,id_clase from estudiante) t4 on t4.id_clase = t3.id

-------------------------------------------------------------------------------------------------------------------
USUARIOS 
/*tabla de usuarios*/
    select 
        t1.id,t1.usuario,t2.nombre as rol,t3.nombres,t3.apellidos,t3.correo,t4.descripcion, 'X' as acciones
    from 
    ( /*tabla login*/ 
        select id,usuario,id_rol,id_personas,pass from login ) t1 left join 
    (/*tabla roles*/ 
        select id,nombre,descripcion from roles ) t2 on t1.id_rol = t2.id left JOIN 
    (/*tabla persona*/ 
        select id,nombres,apellidos,correo,id_puesto from persona ) t3 on t1.id_personas = t3.id left JOIN 
    (/*tabla puesto*/ 
        select id,descripcion from puesto ) t4 on t3.id_puesto = t4.id 

/*manda a traer el ultimo id*/				
select id+1 as id from persona order by id desc limit 1

/*query crear un usuario y una persona*/
start transaction;
-- Insertar en la tabla de persona
insert into persona (nombres, apellidos, correo, id_puesto)
values ('linux ze', 'Op', 'linux@gmail.com', 4);/*en el ultimo dato desplegar una lista de que es, que profesion*/
-- Insertar en la tabla de login
insert into login (usuario, id_rol, id_personas, pass)
values ('viajero', 2, 6, '1');

commit;
------------------------------------------------------------------------------------------------------------------
/*eliminacion de usuarios y personas*/
select id_personas from login where id = 7
select * from login where id = 7
/* query's*/
delete from login where id = 7 
delete from persona where id = 5
-----------------------------------------------------------------------------------------------------------------
select id_personas from login where id=1
select * from persona

start transaction;
-- Actualizar la tabla de persona
   update persona
set nombres = 'Pepito',
    apellidos = 'Lopez',
    correo = 'xlive123x@gmail.com',
    id_puesto = '4'
where id = 2; -- id_persona en tabla login

-- actualiza la tabla login
update login
set usuario = 'Pepitoo',
    id_rol = '2',
    id_personas = 2,
    pass = '2'
where id = 2; -- id unico en tabla login
commit;

select * from persona
select * from login where id=2 
--------------------------------------------
-- agregar clase primero
select id,grado,seccion,fecha  from clase
 
select grado,seccion from clase where grado='fdsa' and seccion='A'   -- que lo lea en minuscula todo y que lo guarde en minuscula tambien



-- persona, asocia el id_persona en  tabla-estudiante
select id,nombres,apellidos,correo,id_puesto from persona

-- estudiante id_clase amarra al id > clase   , id_persona enlaza a id en tabla persona
select id,clave,total_nota,id_persona,id_clase from estudiante

la clave es automatica, se asigna automaticamente , busca en tabla estudiante si no hay asignada una clase, 
de lo contrario inicializa con la clave 1


select t1.clave+1 as clave
from 
(/*tabla estudiantes*/
	select id,clave,total_nota,id_persona,id_clase from estudiante) t1 left join 
(/*tabla clase*/
	select id,grado,seccion,fecha  from clase) t2 on t2.id=t1.id_clase
where id_clase = 2 order by t1.clave desc limit 1


/*consulta de alumnos*/
select 
    t2.id,t2.clave,t1.nombres,t1.apellidos,t3.grado,t3.seccion,t2.total_nota
from 
(/*tabla persona*/
	select id,nombres,apellidos,correo,id_puesto from persona) t1 left join 
(/*tabla estudiantes*/
	select id,clave,total_nota,id_persona,id_clase from estudiante) t2 on t1.id = t2.id_persona left join
(/*tabla clase*/
	select id,grado,seccion,fecha from clase) t3 on t2.id_clase = t3.id
where t2.id is not null


insert into estudiante (clave,total_nota,id_persona,id_clase)
values (2,null,8,2)

--------------------------------------------------------------------------------------------------------
-- se crea una etapa nueva - Es el bimestre
select id,nombre_etapa from etapa

-- actividad
select id,nombre_actividad,descripcion,punteo,id_etapa from actividad

-- relacion  id_estudiante y id_actividad
select id,nota_actividad,id_estudiantes,id_actividad from actividad2

-- examen 1 nombre examen y puntos de cuanto vale
select id,nombre_examen,descripcion, total_examen from examen

-- examen 2 referencia al 1 y agrega nota adquirida en el examen, amarra id_estudiante y id_examen
select id,nota_examen,id_estudiante,id_examen from examen2






















