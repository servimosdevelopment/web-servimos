<?php
include_once("../../../includes/conexion.php");

if (!empty($_POST)) {

    $idVacaciones = $_POST['idVacaciones'];
    $fecha_inicioUpdate = $_POST['fecha_inicioUpdate'];
    $fecha_finUpdate = $_POST['fecha_finUpdate'];


    $sqlUpdate = 'UPDATE vacaciones SET fecha_inicio = ?, fecha_fin =? WHERE id=?';
    $queryUpdate = $con->prepare($sqlUpdate);
    $result = $queryUpdate->execute(array(
        $fecha_inicioUpdate,
        $fecha_finUpdate,
        $idVacaciones
    ));

    if ($result) {
        $respuesta = array('status' => true, 'msg' => 'Fechas  actualizadas exitosamente');
    } else {
        $respuesta = array('status' => false, 'msg' => 'Ha ocurrido un error');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}