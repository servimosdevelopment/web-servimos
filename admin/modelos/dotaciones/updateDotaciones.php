<?php
include_once("../../../includes/conexion.php");

if (!empty($_POST)) {

    $idDotaciones = $_POST['idDotaciones'];
    $fecha_entregaUpdate = $_POST['fecha_entregaUpdate'];
    $fecha_tentativa_renovarUpdate = $_POST['fecha_tentativa_renovarUpdate'];
    $observacionUpdate = $_POST['observacionUpdate'];


    $sqlUpdate = 'UPDATE dotacion SET fecha_entrega = ?, fecha_tentativa_renovar =?, observacion = ? WHERE id=?';
    $queryUpdate = $con->prepare($sqlUpdate);
    $result = $queryUpdate->execute(array(
        $fecha_entregaUpdate,
        $fecha_tentativa_renovarUpdate,
        $observacionUpdate,
        $idDotaciones
    ));

    if ($result) {
        $respuesta = array('status' => true, 'msg' => 'Fechas  actualizadas exitosamente');
    } else {
        $respuesta = array('status' => false, 'msg' => 'Ha ocurrido un error');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}