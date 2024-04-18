<?php 
require_once('../../config/config.php');

// Suponiendo que el nombre de usuario se almacena en una variable llamada $usuario
$usuario = $_POST['usuario']; // Asegúrate de obtener el valor del nombre de usuario de donde corresponda en tu aplicación

// Evita la vulnerabilidad de inyección SQL utilizando sentencias preparadas
$query = "
select t1.usuario,t2.nombre
FROM (
    /*tabla login*/
 select  id,usuario,id_rol from login
) t1 left join
(/*tabla roles*/
    select id,nombre,descripcion from roles
) t2 on t1.id_rol = t2.id
where t1.usuario = ?;
";
$stmt = $conexion->prepare($query);

// Verifica si la preparación de la consulta fue exitosa
if ($stmt) {
    // Enlaza parámetros y ejecuta la consulta
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    // Obtiene el resultado de la consulta
    $result = $stmt->get_result();
    
    // Verifica si se obtuvieron resultados
    if ($result->num_rows > 0) {
        echo "La consulta se realizó con éxito y se encontraron resultados.";
    } else {
        echo "La consulta se realizó con éxito pero no se encontraron resultados.";
    }
} else {
    echo "Error al preparar la consulta.";
}
?>