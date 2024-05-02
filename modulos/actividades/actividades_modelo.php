<?php

//Data
class actividades_modelo{
    private $pdo;
    public function __construct()
    {
        global $pdo;
        $this->pdo=$pdo;
    }
    function get_actividades(){
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
            select id,nombre_actividad,descripcion,punteo,id_etapa from actividad) t2 on t1.id = t2.id_etapa
        where t2.id is not null;
        ";
        $qqry=$this->pdo->query($qry);
        return $qqry->fetchAll();
    }

    function agregar_nuevo_actividad($nombre_actividad,$descripcion,$punteo,$etapa){ //agrega actividad 1
        global $pdo;
        $qry="
        start transaction;
        insert into actividad (nombre_actividad,descripcion,punteo,id_etapa)
        values ('$nombre_actividad', '$descripcion', '$punteo', $etapa);
        commit;
        ";
        $qqry=$pdo->query($qry);
            if (!$qqry) {
                echo "Error insercion: " . $pdo->errorInfo()[2];
                exit;
            }
    }

    function add_etapa($nombre_etapa){ //agrega nueva etapa
        global $pdo;
        $qry="
        start transaction;
        insert into etapa (nombre_etapa)
        values ('$nombre_etapa');
        commit;
        ";
        $qqry=$pdo->query($qry);
            if (!$qqry) {
                echo "Error en la insercion: " . $pdo->errorInfo()[2];
                exit;
            }
    }

    function show(){//muestra las etapas existentes cuando se crea/actualiza un alumno
        global $pdo;
        $qry="
        select id,nombre_etapa from etapa;
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


}

?>