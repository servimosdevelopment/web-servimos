<?php
include_once("../../../includes/conexion.php");

if (!empty($_POST)) {

    $idContract = $_POST['idContract'];
    $empresa_idUpdate = $_POST['empresa_idUpdate'];
    $cargoUpdate = $_POST['cargoUpdate'];
    $estado_hvUpdate = $_POST['estado_hvUpdate'];
    $tipoUpdate = $_POST['tipoUpdate'];
    $fecha_inicioUpdate = $_POST['fecha_inicioUpdate'];
    $fecha_terminacionUpdate = isset($_POST['fecha_terminacionUpdate']) ? $_POST['fecha_terminacionUpdate'] : null;
    $estado = $_POST['estado'];

    if ($tipoUpdate == '1') {
        $fecha_terminacionUpdate = null;
    }

    $sqlUpdate = 'UPDATE contrato SET empresa_id=?, cargo=?, estado_hv=?, tipo = ?, fecha_inicio=?, fecha_terminacion=?, activo=? WHERE id=?';
    $queryUpdate = $con->prepare($sqlUpdate);
    $result = $queryUpdate->execute(array(
        $empresa_idUpdate,
        $cargoUpdate,
        $estado_hvUpdate,
        $tipoUpdate,
        $fecha_inicioUpdate,
        $fecha_terminacionUpdate,
        $estado,
        $idContract,
    ));

    if ($result) {
        $respuesta = array('status' => true, 'msg' => 'Contrato actualizado exitosamente');
    } else {
        $respuesta = array('status' => false, 'msg' => 'Ha ocurrido un error');
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
