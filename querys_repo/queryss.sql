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
where t3.correo = 'wvasquezg1@miumg.edu.gt' and t1.pass = 22;
-----------------------------------------------------------------------

update login set pass = 1 where id = 1; 



