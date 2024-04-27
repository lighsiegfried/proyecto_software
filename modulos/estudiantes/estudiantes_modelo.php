<?php

//Data
class estudiantes_modelo{
    private $pdo;
    public function __construct()
    {
        global $pdo;
        $this->pdo=$pdo;
    }
    function get_alumnos(){
        $qry="
        select 
            t2.id,t2.clave,t1.nombres,t1.apellidos,t3.grado,t3.seccion,t2.total_nota,'X' as acciones
        from 
        (/*tabla persona*/
            select id,nombres,apellidos,correo,id_puesto from persona) t1 left join 
        (/*tabla estudiantes*/
            select id,clave,total_nota,id_persona,id_clase from estudiante) t2 on t1.id = t2.id_persona left join
        (/*tabla clase*/
            select id,grado,seccion,fecha from clase) t3 on t2.id_clase = t3.id
        where t2.id is not null
        ";
        $qqry=$this->pdo->query($qry);
        return $qqry->fetchAll();
    }

    function id_up_personas(){ //captura id a ingresar en personas..
        global $pdo;
        $qry="
        select id+1 as id from persona order by id desc limit 1;";
        $qqry=$pdo->query($qry);
        return $qqry->fetchAll();
    }

    function existe_clase_asignacion($id_clase){ //captura clave futura de alumno, si es null o vacia, sera igual a 1
        global $pdo;
        $qry="
        select 
            t1.clave+1 as clave
        from 
        (/*tabla estudiantes*/
            select id,clave,total_nota,id_persona,id_clase from estudiante) t1 left join 
        (/*tabla clase*/
            select id,grado,seccion,fecha  from clase) t2 on t2.id=t1.id_clase
        where id_clase = $id_clase order by t1.clave desc limit 1
        ;";
        $qqry=$pdo->query($qry);
        $resultados = $qqry->fetchAll();
    if (empty($resultados)) {
        return null;
    }
    return $resultados;
}

    function agregar_nuevo_usuario($nombres,$apellidos,$correo,$puesto,$usuario,$rol,$id_persona_mas_uno,$contrasenia){
        global $pdo;
        $qry="
        start transaction;

        -- Insertar en la tabla de persona
        insert into persona (nombres, apellidos, correo, id_puesto)
        values ('$nombres', '$apellidos', '$correo', $puesto);

        -- Insertar en la tabla de login
        insert into login (usuario, id_rol, id_personas, pass)
        values ('$usuario', $rol, $id_persona_mas_uno , '$contrasenia');

        commit;
        ";
        $qqry=$pdo->query($qry);
            if (!$qqry) {
                echo "Error en la consulta: " . $pdo->errorInfo()[2];
                exit;
            }
    }

    function agregar_nuevo_alumno($nombres,$apellidos,$correo,$puesto,$id_clave,$id_persona_mas_uno,$id_clase){
        global $pdo;
        $qry="
        start transaction;

        -- Insertar en la tabla de persona
        insert into persona (nombres, apellidos, correo, id_puesto)
        values ('$nombres', '$apellidos', '$correo', $puesto);

        -- Insertar en la tabla estudiante
        insert into estudiante (clave,total_nota,id_persona,id_clase)
        values ($id_clave,null,$id_persona_mas_uno,$id_clase);

        commit;
        ";
        $qqry=$pdo->query($qry);
            if (!$qqry) {
                echo "Error en la consulta: " . $pdo->errorInfo()[2];
                exit;
            }
    }

    function add_class($grado,$seccion){ //agrega nueva clase
        global $pdo;
        $qry="
        insert into clase (grado,seccion,fecha)
        values ('$grado', '$seccion', now());
        ";
        $qqry=$pdo->query($qry);
            if (!$qqry) {
                echo "Error en la consulta: " . $pdo->errorInfo()[2];
                exit;
            }
    }

    function show_class(){//muestra las clases existentes cuando se crea/actualiza un alumno
        global $pdo;
        $qry="
        select id,grado,seccion,fecha from clase;
        ";
        $qqry=$pdo->query($qry);
        return $qqry->fetchAll();
    }




    function editar_usuario($id, $nombres, $apellidos, $correo, $puesto, $usuario, $rol, $id_personas, $contrasenia)
    {
        global $pdo;

        try {
            $pdo->beginTransaction();

            // Actualizar la tabla de persona
            $stmt_persona = $pdo->prepare("update persona SET nombres = ?, apellidos = ?, correo = ?, id_puesto = ? WHERE id = ?");
            $stmt_persona->execute([$nombres, $apellidos, $correo, $puesto, $id_personas]);

            // Actualizar la tabla login
            $stmt_login = $pdo->prepare("update login SET usuario = ?, id_rol = ?, pass = ? WHERE id = ?");
            $stmt_login->execute([$usuario, $rol, $contrasenia, $id]);

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function capturar_personas($id){ //captura id personas para actualizar/editar/eliminar data.
        global $pdo;
        $qry="
        select id_personas from login where id = $id;";
        $qqry=$pdo->query($qry);
        return $qqry->fetchAll();
    }


    function eliminar_usuario($id,$persona){ //eliminar usuario y persona asignada a usuario
        global $pdo;
        
        // Eliminar en 'login'
        $qryLogin = "delete from login where id = :id";
        $stmtLogin = $pdo->prepare($qryLogin);
        $stmtLogin->bindParam(':id', $id);  //evita inserciones por usuarios con conocimientos SQL
        $stmtLogin->execute();              //fin ejecucion
    
        // Eliminar en 'persona'
        $qryPersona = "delete from persona where id = :id";
        $stmtPersona = $pdo->prepare($qryPersona);
        $stmtPersona->bindParam(':id', $persona); 
        $stmtPersona->execute();
    }


}

?>