<?php

include_once("../../../includes/conexion.php");

try {
    if (!empty($_POST)) {
        $idUpdate = $_POST['idUpdate'];
        $cedulaUpdate = $_POST['cedulaUpdate'];
        $nombreUpdate = $_POST['nombreUpdate'];
        $sexoUpdate = $_POST['sexoUpdate'];
        $fecha_nacimientoUpdate = $_POST['fecha_nacimientoUpdate'];
        $fecha_expedicion_cedulaUpdate = $_POST['fecha_expedicion_cedulaUpdate'];
        $departamento_nacimientoUpdate = $_POST['departamento_nacimientoUpdate'];
        $municipio_nacimientoUpdate = $_POST['municipio_nacimientoUpdate'];
        $departamento_residenciaUpdate = $_POST['departamento_residenciaUpdate'];
        $municipio_residenciaUpdate = $_POST['municipio_residenciaUpdate'];
        $direccionUpdate = $_POST['direccionUpdate'];
        $barrioUpdate = $_POST['barrioUpdate'];
        $tipo_sangreUpdate = $_POST['tipo_sangreUpdate'];
        $estado_civilUpdate = $_POST['estado_civilUpdate'];
        $id_estratoUpdate = $_POST['id_estratoUpdate'];
        $id_escolaridadUpdate = $_POST['id_escolaridadUpdate'];
        $telefonoUpdate = $_POST['telefonoUpdate'];
        $whatsappUpdate = $_POST['whatsappUpdate'];
        $emailUpdate = $_POST['emailUpdate'];

        $sql = 'SELECT * FROM persona WHERE cedula = ? or nombre = ?';
        $query = $con->prepare($sql);
        $query->execute(array($cedulaUpdate, $nombreUpdate));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result['id'] != $idUpdate) {
            $respuesta = array('status' => false, 'msg' => 'La cedula ingresada o el nombre está asociado a otra persona');
        } else {
            $sqlUpdate = 'UPDATE persona SET
                cedula = ?,
                nombre = ?,
                sexo = ?,
                fecha_nacimiento = ?,
                fecha_expedicion_cedula = ?,
                departamento_nacimiento = ?,
                municipio_nacimiento = ?,
                departamento_residencia = ?,
                municipio_residencia = ?,
                direccion = ?,
                barrio = ?,
                tipo_sangre = ?,
                estado_civil = ?,
                id_estrato = ?,
                id_escolaridad = ?,
                telefono = ?,
                whatsapp = ?,
                email = ?
                WHERE id = ?';
            $queryUpdate = $con->prepare($sqlUpdate);
            $resultado = $queryUpdate->execute(array(
                $cedulaUpdate,
                $nombreUpdate,
                $sexoUpdate,
                $fecha_nacimientoUpdate,
                $fecha_expedicion_cedulaUpdate,
                $departamento_nacimientoUpdate,
                $municipio_nacimientoUpdate,
                $departamento_residenciaUpdate,
                $municipio_residenciaUpdate,
                $direccionUpdate,
                $barrioUpdate,
                $tipo_sangreUpdate,
                $estado_civilUpdate,
                $id_estratoUpdate,
                $id_escolaridadUpdate,
                $telefonoUpdate,
                $whatsappUpdate,
                $emailUpdate,
                $idUpdate
            ));

            if ($resultado) {
                $respuesta = array('status' => true, 'msg' => 'Persona actualizada Correctamente');
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
