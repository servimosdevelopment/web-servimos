<?php
session_start();
include_once("../../../includes/conexion.php");

try {
    if (!empty($_POST)) {
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $sexo = $_POST['sexo'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $fecha_expedicion_cedula = $_POST['fecha_expedicion_cedula'];
        $departamento_nacimiento = $_POST['departamento_nacimiento'];
        $municipio_nacimiento = $_POST['municipio_nacimiento'];
        $departamento_residencia = $_POST['departamento_residencia'];
        $municipio_residencia = $_POST['municipio_residencia'];
        $direccion = $_POST['direccion'];
        $barrio = $_POST['barrio'];
        $tipo_sangre = $_POST['tipo_sangre'];
        $estado_civil = $_POST['estado_civil'];
        $id_estrato = $_POST['id_estrato'];
        $id_escolaridad = $_POST['id_escolaridad'];
        $telefono = $_POST['telefono'];
        $whatsapp = $_POST['whatsapp'];
        $email = $_POST['email'];

        $sql = 'SELECT * FROM persona WHERE cedula = ? or nombre = ?';
        $query = $con->prepare($sql);
        $query->execute(array($cedula, $nombre));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array('status' => false, 'msg' => 'La cedula ingresada o el nombre está asociado a otra persona');
        } else {
            $sqlinsert = 'INSERT INTO persona (cedula,
            nombre, 
            sexo,
            fecha_nacimiento,
            fecha_expedicion_cedula,
            departamento_nacimiento,
            municipio_nacimiento,
            departamento_residencia,
            municipio_residencia,
            direccion,
            barrio,
            tipo_sangre,
            estado_civil,
            id_estrato,
            id_escolaridad,
            telefono,
            whatsapp,
            email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $queryinsert = $con->prepare($sqlinsert);
            $resultado = $queryinsert->execute(array(
                $cedula,
                $nombre,
                $sexo,
                $fecha_nacimiento,
                $fecha_expedicion_cedula,
                $departamento_nacimiento,
                $municipio_nacimiento,
                $departamento_residencia,
                $municipio_residencia,
                $direccion,
                $barrio,
                $tipo_sangre,
                $estado_civil,
                $id_estrato,
                $id_escolaridad,
                $telefono,
                $whatsapp,
                $email
            ));

            if ($resultado) {
                $respuesta = array('status' => true, 'msg' => 'Usuario registrado exitosamente');
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
?>

/*
session_start();
include_once("../../../includes/conexion.php");


if (!empty($_POST)) {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $sexo = $_POST['sexo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $fecha_expedicion_cedula = $_POST['fecha_expedicion_cedula'];
    $departamento_nacimiento = $_POST['departamento_nacimiento'];
    $municipio_nacimiento = $_POST['municipio_nacimiento'];
    $departamento_residencia = $_POST['departamento_residencia'];
    $municipio_residencia = $_POST['municipio_residencia'];
    $direcccion = $_POST['direccion'];
    $barrio = $_POST['barrio'];
    $tipo_sangre = $_POST['tipo_sangre'];
    $estado_civil = $_POST['estado_civil'];
    $id_estrato = $_POST['id_estrato'];
    $id_escolaridad = $_POST['id_escolaridad'];
    $telefono = $_POST['telefono'];
    $whatsapp = $_POST['whatsapp'];
    $email = $_POST['email'];


    $sql = 'SELECT * FROM persona WHERE cedula = ? or nombre = ?';
    $query = $con->prepare($sql);
    $query->execute(array($cedula, $nombre));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $respuesta = array('status' => false, 'msg' => 'La cedula ingresada o el nombre esta asociado a otra persona');
    } else {
        $sqlinsert = 'INSERT INTO persona (cedula,
        nombre, 
        sexo,
        fecha_nacimiento,
        fecha_expedicion_cedula,
        departamento_nacimiento,
        municipio_nacimiento,
        departamento_residencia,
        municipio_residencia,
        direcccion,
        barrio,
        tipo_sangre,
        estado_civil,
        id_estrato,
        id_escolaridad,
        telefono,
        whatsapp,
        email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $queryinsert = $con->prepare($sqlinsert);
        $resultado = $queryinsert->execute(array(
            $cedula,
            $nombre,
            $sexo,
            $fecha_nacimiento,
            $fecha_expedicion_cedula,
            $departamento_nacimiento,
            $municipio_nacimiento,
            $departamento_residencia,
            $municipio_residencia,
            $direcccion,
            $barrio,
            $tipo_sangre,
            $estado_civil,
            $id_estrato,
            $id_escolaridad,
            $telefono,
            $whatsapp,
            $email
        ));

        if ($resultado) {
            $respuesta = array('status' => true, 'msg' => 'Usuario registrado exitosamente');
        } else {
            $respuesta = array('status' => false, 'msg' => 'Error al registrar');
        }
    }
} else {
    $respuesta = array('status' => false, 'msg' => 'Error al registrar');
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);*/



