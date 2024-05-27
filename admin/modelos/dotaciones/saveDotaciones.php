<?php
include_once("../../../includes/conexion.php");

try {
    if (!empty($_POST)) {
        $id_persona = $_POST['id_persona'];
        $fecha_entrega = $_POST['fecha_entrega'];
        $fecha_tentativa_renovar = $_POST['fecha_tentativa_renovar'];
        $observacion = $_POST['observacion'];

        $sql = 'SELECT * FROM dotacion WHERE persona_id = ?';
        $query = $con->prepare($sql);
        $query->execute(array($id_persona));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array('status' => false, 'msg' => 'La persona ingresada está asociada a dotación previa');
        } else {
            $sqlinsert = 'INSERT INTO dotacion (
            persona_id,
            fecha_entrega, 
            fecha_tentativa_renovar,
            observacion
            ) VALUES (?, ?, ?, ?)';
            $queryinsert = $con->prepare($sqlinsert);
            $resultado = $queryinsert->execute(array(
                $id_persona,
                $fecha_entrega,
                $fecha_tentativa_renovar,
                $observacion
            ));

            if ($resultado) {
                $respuesta = array('status' => true, 'msg' => 'Fechas asignadas exitosamente');
            } else {
                $respuesta = array('status' => false, 'msg' => 'Error al asignar');
            }
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Error al asignar');
    }
} catch (PDOException $e) {
    $respuesta = array('status' => false, 'msg' => 'Error en la consulta SQL: ' . $e->getMessage());
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);