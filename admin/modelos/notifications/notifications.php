<?php
include_once("../../../includes/conexion.php");

try {
    // Contratos a vencer en los próximos 7 días
    $sqlContratos = "
        SELECT p.nombre, 
               DATEDIFF(c.fecha_terminacion, CURDATE()) AS dias_restantes
        FROM contrato c
        JOIN persona p ON c.id_persona = p.id
        WHERE c.fecha_terminacion BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
          AND c.activo = 1
    ";
    $stmtContratos = $con->prepare($sqlContratos);
    $stmtContratos->execute();
    $contratos = $stmtContratos->fetchAll(PDO::FETCH_ASSOC);

    // Vacaciones que inician en los próximos 7 días
    $sqlVacacionesInicio = "
        SELECT p.nombre, 
               DATEDIFF(v.fecha_inicio, CURDATE()) AS dias_restantes
        FROM vacaciones v
        JOIN persona p ON v.persona_id = p.id
        WHERE v.fecha_inicio BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
          AND p.activo = 1
    ";
    $stmtVacacionesInicio = $con->prepare($sqlVacacionesInicio);
    $stmtVacacionesInicio->execute();
    $vacacionesInicio = $stmtVacacionesInicio->fetchAll(PDO::FETCH_ASSOC);

    // Vacaciones que terminan en los próximos 7 días
    $sqlVacacionesFin = "
        SELECT p.nombre, 
               DATEDIFF(v.fecha_fin, CURDATE()) AS dias_restantes
        FROM vacaciones v
        JOIN persona p ON v.persona_id = p.id
        WHERE v.fecha_fin BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
          AND p.activo = 1
    ";
    $stmtVacacionesFin = $con->prepare($sqlVacacionesFin);
    $stmtVacacionesFin->execute();
    $vacacionesFin = $stmtVacacionesFin->fetchAll(PDO::FETCH_ASSOC);

    // Cumpleaños en los próximos 7 días
    $sqlCumpleanos = "
        SELECT p.nombre, 
               DATEDIFF(DATE_FORMAT(CONCAT(YEAR(CURDATE()), '-', DATE_FORMAT(p.fecha_nacimiento, '%m-%d')), '%Y-%m-%d'), CURDATE()) AS dias_restantes,
               CASE 
                   WHEN DATE_FORMAT(p.fecha_nacimiento, '%m-%d') = DATE_FORMAT(CURDATE(), '%m-%d') THEN 1 
                   ELSE 0 
               END AS cumple_hoy
        FROM persona p
        WHERE 
            DATE_FORMAT(p.fecha_nacimiento, '%m-%d') >= DATE_FORMAT(CURDATE(), '%m-%d') AND
            DATE_FORMAT(p.fecha_nacimiento, '%m-%d') <= DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '%m-%d') AND
            p.activo = 1
        ORDER BY DATE_FORMAT(p.fecha_nacimiento, '%m-%d')
    ";
    $stmtCumpleanos = $con->prepare($sqlCumpleanos);
    $stmtCumpleanos->execute();
    $cumpleanos = $stmtCumpleanos->fetchAll(PDO::FETCH_ASSOC);

    // Renovación de dotaciones en los próximos 7 días
    $sqlDotaciones = "
        SELECT p.nombre, 
               DATEDIFF(d.fecha_tentativa_renovar, CURDATE()) AS dias_restantes
        FROM dotacion d
        JOIN persona p ON d.persona_id = p.id
        WHERE d.fecha_tentativa_renovar BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
          AND p.activo = 1
    ";
    $stmtDotaciones = $con->prepare($sqlDotaciones);
    $stmtDotaciones->execute();
    $dotaciones = $stmtDotaciones->fetchAll(PDO::FETCH_ASSOC);

    // Agrupar resultados en un array
    $notificaciones = [
        'contratos' => $contratos,
        'vacaciones_inicio' => $vacacionesInicio,
        'vacaciones_fin' => $vacacionesFin,
        'cumpleanos' => $cumpleanos,
        'dotaciones' => $dotaciones
    ];

    // Devolver resultados en formato JSON
    echo json_encode($notificaciones, JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

