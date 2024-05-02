<?php
include_once("../../../includes/conexion.php");

$sql = "SELECT id_departamento, departamento FROM departamentos ORDER BY departamento ASC";
$stmt = $con->prepare($sql);
$stmt->execute();

// Obtener los resultados como un arreglo asociativo
$departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convertir el arreglo de departamentos a formato JSON y enviarlo como respuesta
echo json_encode($departamentos);
