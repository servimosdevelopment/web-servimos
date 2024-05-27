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
        $epsUpdate = $_POST['epsUpdate'];
        $afpUpdate = $_POST['afpUpdate'];
        $estado_civilUpdate = $_POST['estado_civilUpdate'];
        $id_estratoUpdate = $_POST['id_estratoUpdate'];
        $id_escolaridadUpdate = $_POST['id_escolaridadUpdate'];
        $hijosUpdate = $_POST['hijosUpdate'];
        $telefonoUpdate = $_POST['telefonoUpdate'];
        $whatsappUpdate = $_POST['whatsappUpdate'];
        $emailUpdate = $_POST['emailUpdate'];
        $contacto_emergenciaUpdate = $_POST['contacto_emergenciaUpdate'];
        $estado = $_POST['estado'];

        $sql = 'SELECT * FROM persona WHERE (cedula = ? or nombre = ?) AND id != ?';
        $query = $con->prepare($sql);
        $query->execute(array($cedulaUpdate, $nombreUpdate, $idUpdate));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
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
                eps = ?,
                afp = ?,
                estado_civil = ?,
                id_estrato = ?,
                id_escolaridad = ?,
                hijos = ?,
                telefono = ?,
                whatsapp = ?,
                email = ?,
                contacto_emergencia = ?,
                activo = ?
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
                $epsUpdate,
                $afpUpdate,
                $estado_civilUpdate,
                $id_estratoUpdate,
                $id_escolaridadUpdate,
                $hijosUpdate,
                $telefonoUpdate,
                $whatsappUpdate,
                $emailUpdate,
                $contacto_emergenciaUpdate,
                $estado,
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
