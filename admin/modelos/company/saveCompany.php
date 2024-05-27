<?php

include_once("../../../includes/conexion.php");

try {
    if (!empty($_POST)) {
        $nit = $_POST['nit'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $representante_legal = $_POST['representante_legal'];

        $sql = 'SELECT * FROM empresa WHERE nit = ? or nombre = ?';
        $query = $con->prepare($sql);
        $query->execute(array($nit, $nombre));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array('status' => false, 'msg' => 'El Nit ingresado o el nombre está asociado a otro Cliente');
        } else {
            $sqlinsert = 'INSERT INTO empresa (nit,
            nombre, 
            direccion,
            telefono,
            email,
            representante_legal) VALUES (?, ?, ?, ?, ?, ?)';
            $queryinsert = $con->prepare($sqlinsert);
            $resultado = $queryinsert->execute(array(
                $nit,
                $nombre,
                $direccion,
                $telefono,
                $email,
                $representante_legal
            ));

            if ($resultado) {
                $respuesta = array('status' => true, 'msg' => 'Cliente registrado exitosamente');
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