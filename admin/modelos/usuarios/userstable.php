<?php
include_once("../../../includes/conexion.php");
$sql = 'SELECT * FROM usuarios';
$query = $con->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($consulta); $i++) {
    $consulta[$i]['acciones'] = '
        <div class="btn-group" role="group">
            <button class="btn btn-primary" title="Actualizar" onclick="readUserUpdate(' . $consulta[$i]['id'] . ')">Actualizar</button>
            <button class="btn btn-danger" title="Eliminar" onclick="deleteUser(' . $consulta[$i]['id'] . ')">Eliminar</button>
        </div>';
}

echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
