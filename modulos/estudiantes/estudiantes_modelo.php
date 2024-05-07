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
        $id_usuario = $_SESSION['id'];
        $qry="
        select 
            t2.id,t2.clave,t1.nombres,t1.apellidos,t3.grado,t3.seccion,t2.total_nota,'X' as acciones
        from 
        (/*tabla persona*/
            select id,nombres,apellidos,correo,id_puesto from persona) t1 left join 
        (/*tabla estudiantes*/
            select id,clave,total_nota,id_persona,id_clase,id_usuario from estudiante) t2 on t1.id = t2.id_persona left join
        (/*tabla clase*/
            select id,grado,seccion,fecha from clase) t3 on t2.id_clase = t3.id
        where t2.id is not null and t2.id_usuario = $id_usuario
        ";
        $qqry=$this->pdo->query($qry);
        return $qqry->fetchAll();
    }

    function consultar_clase($id){
        $id_usuario = $_SESSION['id'];
        $qry="
        select 
            t2.id,t2.clave,t1.nombres,t1.apellidos,t3.grado,t3.seccion,t2.total_nota
        from 
        (/*tabla persona*/
            select id,nombres,apellidos,correo,id_puesto from persona) t1 left join 
        (/*tabla estudiantes*/
            select id,clave,total_nota,id_persona,id_clase,id_usuario from estudiante) t2 on t1.id = t2.id_persona left join
        (/*tabla clase*/
            select id,grado,seccion,fecha,id_usuario from clase) t3 on t2.id_clase = t3.id
            where t2.id is not null and t2.id_usuario = $id_usuario and t3.id = $id
        ";
        $qqry=$this->pdo->query($qry);
        return $qqry->fetchAll();
    }

    function consultar_clases($id){
        $id_usuario = $_SESSION['id'];
        global $pdo;
        $qry="
        select 
            t2.id,t2.clave,t1.nombres,t1.apellidos,t3.grado,t3.seccion,t2.total_nota
        from 
        (/*tabla persona*/
            select id,nombres,apellidos,correo,id_puesto from persona) t1 left join 
        (/*tabla estudiantes*/
            select id,clave,total_nota,id_persona,id_clase,id_usuario from estudiante) t2 on t1.id = t2.id_persona left join
        (/*tabla clase*/
            select id,grado,seccion,fecha,id_usuario from clase) t3 on t2.id_clase = t3.id
            where t2.id is not null and t2.id_usuario = $id_usuario and t3.id = $id
        ";
        $qqry=$pdo->query($qry);
        $resultados = $qqry->fetchAll();
    if (empty($resultados)) {
        return null;
    }
    return $resultados;
    }

    function id_up_personas(){ //captura id a ingresar en personas..
        global $pdo;
        $qry="
        select id+1 as id from persona order by id desc limit 1;";
        $qqry=$pdo->query($qry);
        return $qqry->fetchAll();
    }

    function existe_clase_asignacion($id_clase){ //captura clave futura de alumno, si es null o vacia, sera igual a 1
        $id_usuario = $_SESSION['id'];
        global $pdo;
        $qry="
        select 
            t1.clave+1 as clave
        from 
        (/*tabla estudiantes*/
            select id,clave,total_nota,id_persona,id_clase,id_usuario from estudiante) t1 left join 
        (/*tabla clase*/
            select id,grado,seccion,fecha,id_usuario  from clase) t2 on t2.id=t1.id_clase
        where id_clase = $id_clase  and t1.id_usuario = $id_usuario order by t1.clave desc limit 1
        ;";
        $qqry=$pdo->query($qry);
        $resultados = $qqry->fetchAll();
    if (empty($resultados)) {
        return null;
    }
    return $resultados;
}

    function insert_pesona($nombres,$apellidos,$correo,$puesto){
        global $pdo;
        $qry="
        start transaction;

        -- Insertar en la tabla de persona
        insert into persona (nombres, apellidos, correo, id_puesto)
        values ('$nombres', '$apellidos', '$correo', $puesto);

        commit;
        ";
        $qqry=$pdo->query($qry);
            if (!$qqry) {
                echo "Error en la consulta: " . $pdo->errorInfo()[2];
                exit;
            }
    }

    function get_id_pesona(){
        $qry="
        select id from persona order by id desc limit 1;
        ";
        $qqry=$this->pdo->query($qry);
        return $qqry->fetchAll();
    }

    function agregar_nuevo_alumno($id_clave,$id_persona,$id_clase,$id_usuario){
        global $pdo;
        $qry="
        start transaction;

        -- Insertar en la tabla estudiante
        insert into estudiante (clave,total_nota,id_persona,id_clase,id_usuario)
        values ($id_clave,null,$id_persona,$id_clase,$id_usuario);

        commit;
        ";
        $qqry=$pdo->query($qry);
            if (!$qqry) {
                echo "Error en la consulta: " . $pdo->errorInfo()[2];
                exit;
            }
    }

    function add_class($grado,$seccion,$id_usuario){ //agrega nueva clase
        global $pdo;
        $qry="
        insert into clase (grado,seccion,fecha,id_usuario)
        values ('$grado', '$seccion', now(),$id_usuario);
        ";
        $qqry=$pdo->query($qry);
            if (!$qqry) {
                echo "Error en la consulta: " . $pdo->errorInfo()[2];
                exit;
            }
    }

    function show_class(){//muestra las clases existentes cuando se crea/actualiza un alumno
        $id_usuario = $_SESSION['id'];
        global $pdo;
        $qry="
        select id,grado,seccion,fecha from clase where id_usuario = $id_usuario;
        ";
        $qqry=$pdo->query($qry);
        return $qqry->fetchAll();
    }


    function editar_usuario($id,$nombres,$apellidos,$correo,$puesto,$id_personas,$clave,$clase, $total_nota)
    {
        global $pdo;

        try {
            $pdo->beginTransaction();

            // Actualizar la tabla de persona
            $stmt_persona = $pdo->prepare("update persona SET nombres = ?, apellidos = ?, correo = ?, id_puesto = ? WHERE id = ?");
            $stmt_persona->execute([$nombres, $apellidos, $correo, $puesto, $id_personas]);

            // Actualizar la tabla estudiante
            $stmt_estudiante = $pdo->prepare("update estudiante SET clave = ?, total_nota = ?, id_persona = ?, id_clase = ? WHERE id = ?");
            $stmt_estudiante->execute([$clave,$total_nota,$id_personas, $clase, $id]);
    

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    //
    function capturar_id_clases($id,$grado,$seccion){ //captura id personas para actualizar/editar/eliminar data.
        global $pdo;
        $id_usuario = $_SESSION['id'];
        $qry="
        select 
            t2.id,t2.clave,t1.id as id_persona,t3.id as id_clase,t1.nombres,t1.apellidos,t3.grado,t3.seccion,t2.total_nota
        from 
        (/*tabla persona*/
            select id,nombres,apellidos,correo,id_puesto from persona) t1 left join 
        (/*tabla estudiantes*/
            select id,clave,total_nota,id_persona,id_clase,id_usuario from estudiante) t2 on t1.id = t2.id_persona left join
        (/*tabla clase*/
            select id,grado,seccion,fecha,id_usuario from clase) t3 on t2.id_clase = t3.id
        where t2.id = $id and t2.id_usuario = $id_usuario and t3.grado = '$grado' and t3.seccion = '$seccion'
        ";
        $qqry=$pdo->query($qry);
        return $qqry->fetchAll();
    }

    function capturar_personas_estudiante($id){ //captura id personas para actualizar/editar/eliminar data.
        global $pdo;
        $qry="
        select id_persona from estudiante where id = $id;";
        $qqry=$pdo->query($qry);
        return $qqry->fetchAll();
    }

    function eliminar_alumno($id,$persona){ //eliminar alumno y persona asignada a alumno
        global $pdo;
        
        // Eliminar en 'login'
        $qryLogin = "delete from estudiante where id = :id";
        $stmtLogin = $pdo->prepare($qryLogin);
        $stmtLogin->bindParam(':id', $id);  //evita inserciones por usuarios con conocimientos SQL
        $stmtLogin->execute();              //fin ejecucion
    
        // Eliminar en 'persona'
        $qryPersona = "delete from persona where id = :id";
        $stmtPersona = $pdo->prepare($qryPersona);
        $stmtPersona->bindParam(':id', $persona); 
        $stmtPersona->execute();
    }

    function eliminar_clase($id){ //eliminar alumno y persona asignada a alumno
        global $pdo;
        
        // Eliminar 
        $qry = "delete from clase where id = :id";
        $stmt = $pdo->prepare($qry);
        $stmt->bindParam(':id', $id);  //evita inserciones por usuarios con conocimientos SQL
        $stmt->execute();              //fin ejecucion
    }

}

?>