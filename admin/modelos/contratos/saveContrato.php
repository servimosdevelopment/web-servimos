<?php
include_once("../../../includes/conexion.php");

try {
    if (!empty($_POST)) {
        $id_persona = $_POST['id_persona'];
        $empresa_id = $_POST['empresa_id'];
        $cargo = $_POST['cargo'];
        $estado_hv = $_POST['estado_hv'];
        $tipo = $_POST['tipo'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_terminacion = isset($_POST['fecha_terminacion']) ? $_POST['fecha_terminacion'] : null;

        // Si el tipo de contrato es "Termino indefinido", no usamos fecha_terminacion
        if ($tipo == '1') {
            $fecha_terminacion = null;
        }

        $sql = 'SELECT * FROM contrato WHERE id_persona = ?';
        $query = $con->prepare($sql);
        $query->execute(array($id_persona));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array('status' => false, 'msg' => 'La persona ingresada está asociada a otro contrato');
        } else {
            $sqlinsert = 'INSERT INTO contrato (
            id_persona,
            empresa_id, 
            cargo,
            estado_hv,
            tipo,
            fecha_inicio,
            fecha_terminacion
            ) VALUES (?, ?, ?, ?, ?, ?, ?)';
            $queryinsert = $con->prepare($sqlinsert);
            $resultado = $queryinsert->execute(array(
                $id_persona,
                $empresa_id,
                $cargo,
                $estado_hv,
                $tipo,
                $fecha_inicio,
                $fecha_terminacion
            ));

            if ($resultado) {
                $respuesta = array('status' => true, 'msg' => 'Contrato registrado exitosamente');
            } else {
                $respuesta = array('status' => false, 'msg' => 'Error al registrar');
            }
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Error al registrar');
    }
} catch (PDOException $e) {
    $respuesta = array('status' => false, 'msg' => 'Error en la consulta SQL: ' . $e->getMessage());
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

