<?php
//$id_usuario = $_SESSION['id'];
//Data
class actividades_modelo{
    private $pdo;
    public function __construct()
    {
        global $pdo;
        $this->pdo=$pdo;
    }
    function get_actividades(){
        $id_usuario = $_SESSION['id'];
        $qry="
        select 
            t2.id,t2.clave,t1.nombres,t1.apellidos,t3.grado,t3.seccion,t4.nota_actividad,t5.nombre_actividad,'X' as acciones
        from 
        (/*tabla persona*/
            select id,nombres,apellidos,correo,id_puesto from persona) t1 left join 
        (/*tabla estudiantes*/
            select id,clave,total_nota,id_persona,id_clase,id_usuario from estudiante) t2 on t1.id = t2.id_persona left join
        (/*tabla clase*/
            select id,grado,seccion,fecha from clase) t3 on t2.id_clase = t3.id left join
                (/*tabla actividad2*/
                        select id,nota_actividad,id_estudiantes,id_actividad from actividad2 ) t4 on t4.id_estudiantes = t2.id left join 
                (/*tabla actividad principal*/
                        select id,nombre_actividad,descripcion,punteo,id_etapa,id_usuario from actividad ) t5 on t5.id = t4.id_actividad	
        where t2.id is not null and t2.id_usuario = $id_usuario;		
        ";
        $qqry=$this->pdo->query($qry);
        return $qqry->fetchAll();
    }

    function agregar_nuevo_actividad($nombre_actividad,$descripcion,$punteo,$etapa,$id_usuario){ //agrega actividad 1
        global $pdo;
        $qry="
        start transaction;
        insert into actividad (nombre_actividad,descripcion,punteo,id_etapa,id_usuario)
        values ('$nombre_actividad', '$descripcion', '$punteo', $etapa,$id_usuario);
        commit;
        ";
        $qqry=$pdo->query($qry);
            if (!$qqry) {
                echo "Error insercion: " . $pdo->errorInfo()[2];
                exit;
            }
    }

    function add_etapa($nombre_etapa,$id_usuario){ //agrega nueva etapa
        global $pdo;
        $qry="
        start transaction;
        insert into etapa (nombre_etapa,id_usuario)
        values ('$nombre_etapa',$id_usuario);
        commit;
        ";
        $qqry=$pdo->query($qry);
            if (!$qqry) {
                echo "Error en la insercion: " . $pdo->errorInfo()[2];
                exit;
            }
    }

    function show(){//muestra las etapas existentes cuando se crea/actualiza un alumno
        $id_usuario = $_SESSION['id'];
        global $pdo;
        $qry="
        select id,nombre_etapa from etapa where id_usuario = $id_usuario;
        ";
        $qqry=$pdo->query($qry);
        return $qqry->fetchAll();
    }

    function editar_actividad1($id,$nombre_actividad,$descripcion,$punteo,$etapa)
    {
        global $pdo;

        try {
            $pdo->beginTransaction();

            // actualizar data
            $stmt_persona = $pdo->prepare("update actividad set id=? ,nombre_actividad=? ,descripcion=? ,punteo=? ,id_etapa=? WHERE id = $id");
            $stmt_persona->execute([$id,$nombre_actividad,$descripcion,$punteo,$etapa]);

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    function eliminar_actividad($id){ //eliminar
        global $pdo;
        
        // Eliminar en 'actividad'
        $qry = "delete from actividad where id = :id";
        $stmt = $pdo->prepare($qry);
        $stmt->bindParam(':id', $id);  //evita inserciones por usuarios con conocimientos SQL
        $stmt->execute();              //fin ejecucion
    
    }

    function eliminar_etapa($id){ //eliminar
        global $pdo;
        
        // Eliminar en 'actividad'
        $qry = "delete from etapa where id = :id";
        $stmt = $pdo->prepare($qry);
        $stmt->bindParam(':id', $id);  //evita inserciones por usuarios con conocimientos SQL
        $stmt->execute();              //fin ejecucion
    
    }

    function consultar_etapa($id){
        $id_usuario = $_SESSION['id'];
        global $pdo;
        $qry="
        select 
        t2.id,
        t1.id as id_etapa,
        t2.nombre_actividad,
        t2.descripcion,
        t2.punteo,
        t1.nombre_etapa,
        'X' as acciones
    from 
    (/*tabla etapa*/
        select id,nombre_etapa from etapa) t1 left join 
    (/*tabla actividades*/
        select id,nombre_actividad,descripcion,punteo,id_etapa,id_usuario from actividad) t2 on t1.id = t2.id_etapa
    where t2.id is not null and t2.id_usuario = $id_usuario and t1.id = $id;
        ";
        $qqry=$pdo->query($qry);
        $resultados = $qqry->fetchAll();
    if (empty($resultados)) {
        return null;
    }
    return $resultados;
    }

}

?>