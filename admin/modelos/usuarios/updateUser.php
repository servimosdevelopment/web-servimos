<?php
session_start();
include_once("../../../includes/conexion.php");

if (!empty($_POST)) {
    if ($_SESSION['rol'] != 1) {
        $respuesta = array('status' => false, 'msg' => 'Usted no tiene permitido hacer esta acción');
    } else {
        $id = $_POST['id'];
        $nombre = $_POST['nombreUpdate'];
        $rol = $_POST['listRolUpdate'];
        $activo = $_POST['listEstadoUpdate'];

        // Verificar si el usuario actual está intentando desactivarse a sí mismo
        if ($_SESSION['id'] == $id && $activo == 0) {
            $respuesta = array('status' => false, 'msg' => 'No puede desactivarse a sí mismo');
        } else {
            $sqlUpdate = 'UPDATE usuarios SET nombre=?, rol=?, activo=? WHERE id=?';
            $queryUpdate = $con->prepare($sqlUpdate);
            $result = $queryUpdate->execute(array($nombre, $rol, $activo, $id));

            if ($result) {
                $respuesta = array('status' => true, 'msg' => 'Usuario actualizado exitosamente');
            } else {
                $respuesta = array('status' => false, 'msg' => 'Ha ocurrido un error');
            }
        }
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
