<?php
session_start();
include_once("../../../includes/conexion.php");


if (!empty($_GET)) {
    $idUser = $_GET['id'];
    if ($_SESSION['rol'] != 1) {
        $respuesta = array('status' => false, 'msg' => 'Usted no tiene permitido hacer esta acción'); // Ensure correct syntax for array initialization
    } else {

        $sql = 'DELETE FROM empresa WHERE id=?';
        $query = $con->prepare($sql);
        $result = $query->execute(array($idUser));


        if ($result) {
            $respuesta = array('status' => true, 'msg' => 'Registro eliminado exitosamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error');
        }
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}