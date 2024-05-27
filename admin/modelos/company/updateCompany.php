<?php

include_once("../../../includes/conexion.php");

try {
    if (!empty($_POST)) {
        $id = $_POST['id'];
        $nitUpdate = $_POST['nitUpdate'];
        $nombreUpdate = $_POST['nombreUpdate'];
        $direccionUpdate = $_POST['direccionUpdate'];
        $telefonoUpdate = $_POST['telefonoUpdate'];
        $emailUpdate = $_POST['emailUpdate'];
        $representante_legalUpdate = $_POST['representante_legalUpdate'];
        $estado = $_POST['estado'];


        $sql = 'SELECT * FROM empresa WHERE (nit = ? or nombre = ?) AND id != ?';
        $query = $con->prepare($sql);
        $query->execute(array($nitUpdate, $nombreUpdate, $id));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array('status' => false, 'msg' => 'El Nit ingresado o el nombre está asociado a otra persona');
        } else {
            $sqlUpdate = 'UPDATE empresa SET
                 nit= ?,
                 nombre= ?,
                 direccion= ?,
                 telefono= ?,
                 email= ?,
                 representante_legal= ?,
                 activo = ?
                WHERE id = ?';
            $queryUpdate = $con->prepare($sqlUpdate);
            $resultado = $queryUpdate->execute(array(
                $nitUpdate,
                $nombreUpdate,
                $direccionUpdate,
                $telefonoUpdate,
                $emailUpdate,
                $representante_legalUpdate,
                $estado,
                $id
                
            ));

            if ($resultado) {
                $respuesta = array('status' => true, 'msg' => 'Cliente actualizado Correctamente');
            } else {
                $respuesta = array('status' => false, 'msg' => 'Error al actualizar');
            }
        }
    } else {
        $respuesta = array('status' => false, 'msg' => 'Error al ractualizar');
    }
} catch (PDOException $e) {
    $respuesta = array('status' => false, 'msg' => 'Error en la consulta SQL: ' . $e->getMessage());
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
