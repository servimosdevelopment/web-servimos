<?php
session_start();
include_once("../../../includes/conexion.php");
$sql = 'SELECT * FROM usuarios ORDER BY activo ASC';
$query = $con->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($consulta); $i++) {

    if ($_SESSION['rol'] != 1 ){
        $consulta[$i]['acciones'] = '
        <div class="btn-group" role="group">
            <button class="btn btn-primary" title="Actualizar" onclick="readUserUpdate(' . $consulta[$i]['id'] . ')">Actualizar</button>
        </div>';
    }else{
        $consulta[$i]['acciones'] = '
        <div class="btn-group" role="group">
            <button class="btn btn-primary" title="Actualizar" onclick="readUserUpdate(' . $consulta[$i]['id'] . ')">Actualizar</button>
            <button class="btn btn-danger" title="Eliminar" onclick="deleteUser(' . $consulta[$i]['id'] . ')">Eliminar</button>
        </div>';
    }
    
}

echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
