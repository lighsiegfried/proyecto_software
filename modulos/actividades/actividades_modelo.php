<?php
//Data
class usuarios_modelo{
    private $pdo;
    public function __construct()
    {
        global $pdo;
        $this->pdo=$pdo;
        //$this->cod_usuario=$_SESSION['usuario']['cod_usuario'];
    }
    //funciones select * from kardex_procesos


    function get_fechas(){ //lista de usuarios de PRODUCCION
        global $pdo;
        $qry="
        select distinct date_format(fecha_solicitud, '%Y-%m') as fecha_mes, year(fecha_solicitud) as anio,
            (
                case
                    when month(fecha_solicitud) = '1' then 'Enero'
                    when month(fecha_solicitud) = '2' then 'Febrero'
                    when month(fecha_solicitud) = '3' then 'Marzo'
                    when month(fecha_solicitud) = '4' then 'Abril'
                    when month(fecha_solicitud) = '5' then 'Mayo'
                    when month(fecha_solicitud) = '6' then 'Junio'
                    when month(fecha_solicitud) = '7' then 'Julio'
                    when month(fecha_solicitud) = '8' then 'Agosto'
                    when month(fecha_solicitud) = '9' then 'Septiembre'
                    when month(fecha_solicitud) = '10' then 'Octubre'
                    when month(fecha_solicitud) = '11' then 'Noviembre'
                    when month(fecha_solicitud) = '12' then 'Diciembre'
                end 
            ) as meses
        from kardex_procesos where proceso_bodega in (1) and estado=2
        order by anio asc;";
        $qqry=$pdo->query($qry);
        return $qqry->fetchAll();
    }

    function get_usuarios(){

        $qry="
        select 
        t1.id,t1.usuario,t2.nombre as rol,t3.correo,t4.descripcion,t1.pass
    FROM 
    ( /*tabla login*/ 
        select id,usuario,id_rol,id_personas,pass from login ) t1 left join 
    (/*tabla roles*/ 
        select id,nombre,descripcion from roles ) t2 on t1.id_rol = t2.id left JOIN 
    (/*tabla persona*/ 
        select id,correo,id_puesto from persona ) t3 on t1.id_personas = t3.id left JOIN 
    (/*tabla puesto*/ 
        select id,descripcion from puesto ) t4 on t3.id_puesto = t4.id 
        ";
        $qqry=$this->pdo->query($qry);
        return $qqry->fetchAll();
    }


    function get_kardex_procesos_bodega($year,$month){
        $qry="
select 
        id_copia,t6.id_codigo_barra,
        (
            case
            when tipo_orden=1 then 'Produccion'
            when tipo_orden=2 then 'Preparacion' end
        ) as tipo_orden,
        pedido,
        if 	(t5.paso >=0, t5.paso , 'Ruta no Asignada') as paso,
        t4.descripcion as bodega, t3.descripcion as proceso_bodega, 
        (
            case
            when t1.estado=0 then 'Pendiente de Escanear/Validar'
            when t1.estado=1 then 'Escaneado'
            when t1.estado=2 then 'Completado'
            when t1.estado=3 then 'No Ubicado'
            else 'Sin asignar Estado' end
        ) as estado,
        (
            case
            when actual=1 then 'Bulto asignado al Area'
            when t1.estado=2 then 'Bulto pasara al siguiente paso'
            else 'Bulto No Asignado al Area' end
        ) as actual,
        (
            case
            when activo=0 then 'Desasignado'
            when activo=1 then 'Activo' end
        ) as activo,
        if (accion_observacion is not null and accion_observacion !='null' and accion_observacion !='' , accion_observacion , 
                (
                    case
                    when accion_observacion is null then 'Sin Comentarios'
                    when accion_observacion=''	 		then 'Campo vacio'
                    when accion_observacion='null' 	then 'Atencion, Bulto no encontrado' end
                ) 
        ) as accion_observacion,
        date_format(fecha_solicitud, '%Y-%m-%d %H:%i') as fecha_solicitud, nombre , date_format(fecha_solicitud, '%Y-%m-%d %H:%i') as fecha_usuario,
        if (timestampdiff(hour, fecha_solicitud, fecha_usuario) <= 23, 
                (
                case
                        when timestampdiff(hour, fecha_solicitud, fecha_usuario) < 1 then 'Menos de 1 hora'
                        when timestampdiff(hour, fecha_solicitud, fecha_usuario) = 1 then '1 hora'
                        else concat(timestampdiff(hour, fecha_solicitud, fecha_usuario), ' horas') 
                end
                ),
				(
				case
						when timestampdiff(day, fecha_solicitud, fecha_usuario) = 1 then concat('1 dia y ' , timestampdiff(hour, fecha_solicitud, fecha_usuario) - (timestampdiff(day, fecha_solicitud, fecha_usuario) * 24),' horas ')
						when timestampdiff(month, fecha_solicitud, fecha_usuario) = 0 then concat(timestampdiff(day, fecha_solicitud, fecha_usuario), ' dias y ', timestampdiff(hour, fecha_solicitud, fecha_usuario) - (timestampdiff(day, fecha_solicitud, fecha_usuario) * 24),' horas ')
						when timestampdiff(month, fecha_solicitud, fecha_usuario)  = 1 then '1 mes'
                    else concat(timestampdiff(month, fecha_solicitud, fecha_usuario),' meses y ',timestampdiff(day, fecha_solicitud, fecha_usuario) - (timestampdiff(month, fecha_solicitud, fecha_usuario) * 30),' dias')
				end
				)) as tiempo_transcurrido
from 
(  
    /*Encabezado*/
    select id_copia,id_codigo_barra as id_codigo_barrauno , pedido,bodega,proceso_bodega,estado,actual,tipo_orden,id_ruta,accion_observacion,fecha_solicitud,activo, cod_usuario,fecha_usuario from kardex_procesos where bodega in(2,3) and year(fecha_solicitud) = '$year' and month(fecha_solicitud) = '$month' and cod_usuario !=397 and proceso_bodega in (1) and estado=2
) t1 left join
(	 
    /*Nombres de usuarios*/
    select cod_usuario, nombre from ui_usuario where estado=1 order by cod_usuario asc
) t2 on t1.cod_usuario = t2.cod_usuario left join
(
    /*Proceso de Bodega*/
    select cod_proceso_bodega, descripcion, estado from mp_proceso_bodega where estado=1
) t3 on t1.proceso_bodega = t3.cod_proceso_bodega left join
( 
    /*bodega actual*/
    select cod_bodega,descripcion from mp_estacion where cod_bodega is not null order by cod_bodega asc
) t4 on t1.bodega = t4.cod_bodega left join
(
    /*id ruta Paso*/
    select id_ruta as id_ruta2, paso , pedido as pedido2 from mp_orden_produccion_ruta where  estado=1
) t5 on t1.id_ruta = t5.id_ruta2 and t1.pedido = t5.pedido2 left join
(
    /*codigo de barra*/
    select id_codigo_barra as id_codigo_barramain , codigo_barra as id_codigo_barra from mp_codigo_barra 
) t6 on t1.id_codigo_barrauno = t6.id_codigo_barramain
order by id_copia desc  
        ";
        $qqry=$this->pdo->query($qry);
        return $qqry->fetchAll();
    }    


}

?>