<?php
session_start();
include_once("../../../includes/conexion.php");
$sql = 'SELECT 
contrato.id,
persona.nombre AS nombre_persona,
empresa.nombre AS nombre_empresa,
contrato.cargo AS cargo,
contrato.estado_hv AS estado_hv,
contrato.tipo AS tipo,
contrato.fecha_inicio AS fecha_inicio,
contrato.fecha_terminacion AS fecha_terminacion,
contrato.activo
FROM 
contrato
JOIN 
persona ON contrato.id_persona = persona.id
JOIN 
empresa ON contrato.empresa_id = empresa.id
ORDER BY contrato.activo ASC
';
$query = $con->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($consulta); $i++) {
    if ($_SESSION['rol'] != 1 ){
        $consulta[$i]['acciones'] = '
        <div class="btn-group" role="group">
            <button class="btn btn-primary" title="Actualizar" onclick="readContractUserUpdate(' . $consulta[$i]['id'] . ')">Actualizar</button>
        </div>';
    }else{
        $consulta[$i]['acciones'] = '
        <div class="btn-group" role="group">
            <button class="btn btn-primary" title="Actualizar" onclick="readContractUpdate(' . $consulta[$i]['id'] . ')">Actualizar</button>
            <button class="btn btn-danger" title="Eliminar" onclick="deleteContract(' . $consulta[$i]['id'] . ')">Eliminar</button>
        </div>';
    }
}

echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
