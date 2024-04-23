<?php
session_start();
include_once("../../../includes/conexion.php");


if (!empty($_POST)) {
    if ($_SESSION['rol'] != 1) {
        $respuesta = array('status' => false, 'msg' => 'Usted no tiene permitido hacer esta acción'); 
    } else {

        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rol = $_POST['listRol'];

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'SELECT * FROM usuarios WHERE email = ?'; 
        $query = $con->prepare($sql);
        $query->execute(array($email));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) { 
            $respuesta = array('status' => false, 'msg' => 'El Email ingresado esta asociado a otro usuario');
        } else {
            $sqlinsert = 'INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)';
            $queryinsert = $con->prepare($sqlinsert);
            $resultado = $queryinsert->execute(array($nombre, $email, $password, $rol));

            if ($resultado) {
                $respuesta = array('status' => true, 'msg' => 'Usuario registrado exitosamente');
            }
        }
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>