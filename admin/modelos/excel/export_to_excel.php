<?php
include_once("../../../includes/conexion.php");

$sql = "SELECT p.id AS persona_id, p.cedula, p.nombre AS persona_nombre, p.sexo, p.eps, p.afp AS fondo_pension,
        p.fecha_nacimiento, p.fecha_expedicion_cedula, p.edad, p.direccion AS persona_direccion, p.hijos AS hijos, 
        p.contacto_emergencia AS contacto_emergencia,
        p.barrio AS persona_barrio, p.telefono AS persona_telefono, p.whatsapp AS persona_whatsapp, 
        p.email AS persona_email, p.activo AS persona_activo, c.id AS contrato_id, c.cargo AS contrato_cargo, 
        c.estado_hv AS contrato_estado_hv, CASE c.tipo WHEN '1' THEN 'Tipo 1' WHEN '0' THEN 'Tipo 0' END AS contrato_tipo, 
        c.fecha_inicio AS contrato_fecha_inicio, c.fecha_terminacion AS contrato_fecha_terminacion, 
        c.activo AS contrato_activo, e.nombre AS empresa_nombre, e.nit AS empresa_nit, e.direccion AS empresa_direccion, 
        e.telefono AS empresa_telefono, e.email AS empresa_email, e.representante_legal AS empresa_representante_legal, 
        e.activo AS empresa_activo, d.fecha_entrega AS dotacion_fecha_entrega, d.fecha_tentativa_renovar AS dotacion_fecha_tentativa_renovar, 
        d.observacion AS dotacion_observacion, v.fecha_inicio AS vacaciones_fecha_inicio, v.fecha_fin AS vacaciones_fecha_fin, 
        es.nivel AS escolaridad_nivel, estr.valor AS estrato_valor, ts.tipo AS tipo_sangre_tipo, dpto_nac.departamento AS departamento_nacimiento, 
        mun_nac.municipio AS municipio_nacimiento, dpto_res.departamento AS departamento_residencia, 
        mun_res.municipio AS municipio_residencia 
        FROM persona p 
        LEFT JOIN contrato c ON p.id = c.id_persona 
        LEFT JOIN empresa e ON c.empresa_id = e.id 
        LEFT JOIN dotacion d ON p.id = d.persona_id 
        LEFT JOIN vacaciones v ON p.id = v.persona_id 
        LEFT JOIN escolaridad es ON p.id_escolaridad = es.id 
        LEFT JOIN estrato estr ON p.id_estrato = estr.id 
        LEFT JOIN tipo_sangre ts ON p.tipo_sangre = ts.id 
        LEFT JOIN departamentos dpto_nac ON p.departamento_nacimiento = dpto_nac.id_departamento 
        LEFT JOIN municipios mun_nac ON p.municipio_nacimiento = mun_nac.id_municipio 
        LEFT JOIN departamentos dpto_res ON p.departamento_residencia = dpto_res.id_departamento 
        LEFT JOIN municipios mun_res ON p.municipio_residencia = mun_res.id_municipio";
        
$stmt = $con->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
