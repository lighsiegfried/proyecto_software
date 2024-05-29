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

        $qry_init = "SET @row_number = 0;";
        $this->pdo->exec($qry_init);

        $qry="
        SELECT @row_number:=@row_number+1 AS indice, p.nombres, p.apellidos, a2.nota_actividad as notaEstudiante, a.punteo as notaActividad, a.id as idActividad, e.id as etapaId ,
        'X' as opciones, a.nombre_actividad as nombreActividad, a2.id as idActividad2
        FROM actividad a 
        LEFT JOIN etapa e ON a.id_etapa = e.id
        LEFT JOIN actividad2 a2 ON a2.id_actividad = a.id
        LEFT JOIN estudiante es ON a2.id_estudiantes = es.id
        LEFT JOIN persona p ON p.id = es.id_persona
        where a.id_usuario = $id_usuario;";
        $qqry=$this->pdo->query($qry);
        return $qqry->fetchAll();
    }

    function get_actividades_filter($idEtapa){
        $id_usuario = $_SESSION['id'];

        $qry_init = "SET @row_number = 0;";
        $this->pdo->exec($qry_init);

        $qry="
        SELECT @row_number:=@row_number+1 AS indice, p.nombres, p.apellidos, a2.nota_actividad as notaEstudiante, a.punteo as notaActividad, a.id as idActividad, e.id as etapaId ,
        'X' as opciones, a.nombre_actividad as nombreActividad, a2.id as idActividad2
        FROM actividad a 
        LEFT JOIN etapa e ON a.id_etapa = e.id
        LEFT JOIN actividad2 a2 ON a2.id_actividad = a.id
        LEFT JOIN estudiante es ON a2.id_estudiantes = es.id
        LEFT JOIN persona p ON p.id = es.id_persona
        where a.id_usuario = $id_usuario AND e.id = $idEtapa;";
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

    function editar_actividad1($idActividad2,$notaAsignada)
    {
        global $pdo;

        try {
            $pdo->beginTransaction();

            // actualizar data
            $stmt_persona = $pdo->prepare("update actividad2 set nota_actividad=? WHERE id = $idActividad2");
            $stmt_persona->execute([$notaAsignada]);

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