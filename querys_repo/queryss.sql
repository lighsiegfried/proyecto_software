

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
update login set pass = 23 where id = 1; 
