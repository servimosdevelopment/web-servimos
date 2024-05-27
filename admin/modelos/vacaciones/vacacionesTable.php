<?php
session_start();
include_once("../../../includes/conexion.php");
$sql = 'SELECT 
vacaciones.id,
persona.nombre AS nombre_persona,
fecha_inicio,
fecha_fin
FROM 
vacaciones
JOIN 
persona ON vacaciones.persona_id = persona.id
';
$query = $con->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($consulta); $i++) {
    if ($_SESSION['rol'] != 1 ){
        $consulta[$i]['acciones'] = '
        <div class="btn-group" role="group">
            <button class="btn btn-primary" title="Actualizar" onclick="readVacacionesUpdate(' . $consulta[$i]['id'] . ')">Actualizar</button>
        </div>';
    }else{
        $consulta[$i]['acciones'] = '
        <div class="btn-group" role="group">
            <button class="btn btn-primary" title="Actualizar" onclick="readVacacionesUpdate(' . $consulta[$i]['id'] . ')">Actualizar</button>
            <button class="btn btn-danger" title="Eliminar" onclick="deleteVacaciones(' . $consulta[$i]['id'] . ')">Eliminar</button>
        </div>';
    }
}

echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
