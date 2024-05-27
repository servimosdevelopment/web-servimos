<?php
include_once("../../../includes/conexion.php");

try {
    if (!empty($_POST)) {
        $id_persona = $_POST['id_persona'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];

        $sql = 'SELECT * FROM vacaciones WHERE persona_id = ?';
        $query = $con->prepare($sql);
        $query->execute(array($id_persona));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array('status' => false, 'msg' => 'La persona ingresada está asociada a otras vacaciones');
        } else {
            $sqlinsert = 'INSERT INTO vacaciones (
            persona_id,
            fecha_inicio, 
            fecha_fin
            ) VALUES (?, ?, ?)';
            $queryinsert = $con->prepare($sqlinsert);
            $resultado = $queryinsert->execute(array(
                $id_persona,
                $fecha_inicio,
                $fecha_fin
            ));

            if ($resultado) {
                $respuesta = array('status' => true, 'msg' => 'Vacaciones asignadas exitosamente');
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

