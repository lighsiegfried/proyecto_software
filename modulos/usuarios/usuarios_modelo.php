<?php

//Data
class usuarios_modelo{
    private $pdo;
    public function __construct()
    {
        global $pdo;
        $this->pdo=$pdo;
    }
    function get_usuarios(){
        $qry="
        select 
            t1.id,t1.usuario,t2.nombre as rol,t3.nombres,t3.apellidos,t3.correo,t4.descripcion, 'X' as acciones
        FROM 
            ( /*tabla login*/ 
                select id,usuario,id_rol,id_personas,pass from login ) t1 left join 
            (/*tabla roles*/ 
                select id,nombre,descripcion from roles ) t2 on t1.id_rol = t2.id left join 
            (/*tabla persona*/ 
                select id,nombres,apellidos,correo,id_puesto from persona ) t3 on t1.id_personas = t3.id left join 
            (/*tabla puesto*/ 
                select id,descripcion from puesto ) t4 on t3.id_puesto = t4.id 
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