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
        where t2.id is not null and t2.id_usuario = $id_usuario;
        ";
        $qqry=$this->pdo->query($qry);
        return $qqry->fetchAll();
    }

    function agregar_nuevo_actividad($nombre_actividad,$descripcion,$punteo,$etapa,$id_usuario,$id_clase){ //agrega actividad 1
        global $pdo;
        try{
            $pdo->beginTransaction();
            $qry="insert into actividad (nombre_actividad,descripcion,punteo,id_etapa,id_usuario,id_clase) 
            values ('$nombre_actividad', '$descripcion', $punteo, $etapa,$id_usuario, $id_clase);";
            $qqry=$pdo->query($qry);
            if (!$qqry) {
                echo "Error insercion: " . $pdo->errorInfo()[2];
                $pdo->rollBack();
                return null;
            }

            $id_actividad = $pdo->lastInsertId();
            $pdo->commit();
            return $id_actividad;
        }catch(Exception $e){
            $pdo->rollBack();
            return null;
        }
    }

    function add_etapa($nombre_etapa,$id_usuario,$id_bimestre){ //agrega nueva etapa
        global $pdo;
        $qry="
        start transaction;
        insert into etapa (nombre_etapa,id_usuario,id_bimestre)
        values ('$nombre_etapa',$id_usuario,$id_bimestre);
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

    function showClases(){//muestra las etapas existentes cuando se crea/actualiza un alumno
        $id_usuario = $_SESSION['id'];
        global $pdo;
        $qry="
        SELECT id, CONCAT(grado, ' - ', seccion) AS grado FROM clase WHERE id_usuario = $id_usuario;";
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

    function get_estudiantes_clase($id_clase){
        global $pdo;
        try{
            $qry = "select id from estudiante where id_clase = $id_clase";
            $qqry = $pdo->query($qry);
            $res = $qqry->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            return null;
        }
    }

    function actualizar_estudiantes_nueva_actividad($lista_id_estud, $id_actividad){
        try{
            $this->pdo->beginTransaction();
            foreach($lista_id_estud as $estudiante){
                $query = "insert into actividad2(nota_actividad, id_estudiantes, id_actividad)
                values (0, " . $estudiante['id'] .", $id_actividad)";
                if(!($this->pdo->query($query))){
                    throw new Exception("Error en el primer insert: " . $this->pdo->error);
                }
            }

            $this->pdo->commit();
        }catch(Exception $e){
            $this->pdo->rollback();
            echo "Error en la transacción: " . $e->getMessage();
        }
        
    }

}

?>