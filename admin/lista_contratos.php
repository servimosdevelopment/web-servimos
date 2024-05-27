<?php
include_once("includes/header.php");
include_once("includes/modals/contract_modals.php");
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Listado Contratos</h1>
            <button type="button" class="badge btn-success" onclick="openModalContract()">Nuevo Contrato</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Lista Contratos</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="contract_table">
                            <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>ID</th>
                                    <th>Empleado</th>
                                    <th>Empresa donde labora</th>
                                    <th>Cargo</th>
                                    <th>Observación HV</th>
                                    <th>Tipo Contrato</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Terminación</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once("includes/footer.php");
?>