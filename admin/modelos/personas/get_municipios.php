<?php
include_once("../../../includes/conexion.php");

$departamento_id = $_GET['departamento_id'];

$sql = "SELECT id_municipio, municipio FROM municipios WHERE departamento_id = :departamento_id ORDER BY municipio ASC";
$stmt = $con->prepare($sql);
// Vincular el parámetro :departamento_id con el valor proporcionado
$stmt->bindParam(':departamento_id', $departamento_id);
$stmt->execute();

// Obtener los resultados como un arreglo asociativo
$municipios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convertir el arreglo de municipios a formato JSON y enviarlo como respuesta
echo json_encode($municipios);
