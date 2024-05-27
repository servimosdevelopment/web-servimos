<?php
include_once("../../../includes/conexion.php");

if (!empty($_GET)) {
    $idVacaciones = $_GET['id'];
    $sql = 'SELECT * FROM vacaciones WHERE id=?';
    $query = $con->prepare($sql);
    $query->execute(array($idVacaciones));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (empty($result)) {
        $respuesta = array('status' => false, 'msg' => 'No se encontraron los datos');
    } else {
        $respuesta = array('status' => true, 'datos' => $result);
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}