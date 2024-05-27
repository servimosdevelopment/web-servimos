<!-- Modals CreateContract -->
<div class="modal fade" id="contractModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Nueva Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="contractForm" name="contractForm">
                    <div class="form-group">
                        <label for="label-control">Nombre persona</label>
                        <select class="form-control" name="id_persona" id="id_persona">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Empresa donde labora:</label>
                        <select class="form-control" name="empresa_id" id="empresa_id">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Cargo:</label>
                        <input type="text" class="form-control" name="cargo" id="cargo">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Estado HV:</label>
                        <textarea class="form-control" name="estado_hv" id="estado_hv"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Tipo de contrato:</label>
                        <select class="form-control" name="tipo" id="tipo">
                            <option value="1">Termino indefinido</option>
                            <option value="0">Termino fijo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Fecha de inicio</label>
                        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                    </div>
                    <div class="form-group" id="fecha_terminacion_group">
                        <label for="label-control">Fecha de Terminación</label>
                        <input type="date" class="form-control" name="fecha_terminacion" id="fecha_terminacion">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modals UpdateContract -->
<div class="modal fade" id="contractModalUpdate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Actualizar Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="contractFormUpdate" name="contractFormUpdate">
                    <input type="hidden" name="idContract" id="idContract" value="">
                    <div class="form-group">
                        <label for="label-control">Nombre persona</label>
                        <select class="form-control" name="id_personaUpdate" id="id_personaUpdate" disabled>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Empresa donde labora:</label>
                        <select class="form-control" name="empresa_idUpdate" id="empresa_idUpdate">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Cargo:</label>
                        <input type="text" class="form-control" name="cargoUpdate" id="cargoUpdate">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Estado HV:</label>
                        <textarea class="form-control" name="estado_hvUpdate" id="estado_hvUpdate"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Tipo de contrato:</label>
                        <select class="form-control" name="tipoUpdate" id="tipoUpdate">
                            <option value="1">Termino indefinido</option>
                            <option value="0">Termino fijo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Fecha de inicio</label>
                        <input type="date" class="form-control" name="fecha_inicioUpdate" id="fecha_inicioUpdate">
                    </div>
                    <div class="form-group" id="fecha_terminacion_groupUpdate">
                        <label for="label-control">Fecha de Terminación</label>
                        <input type="date" class="form-control" name="fecha_terminacionUpdate" id="fecha_terminacionUpdate">
                    </div>
                    <label for="label-control">Estado:</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>