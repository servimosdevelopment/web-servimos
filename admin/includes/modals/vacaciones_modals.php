<!-- Modals CreateVacaciones-->
<div class="modal fade" id="vacacionesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Asignar Vacaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="vacacionesForm" name="vacacionesForm">
                    <div class="form-group">
                        <label for="label-control">Nombre persona</label>
                        <select class="form-control" name="persona_id" id="persona_id">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Fecha de inicio</label>
                        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Fecha de Terminación</label>
                        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
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

<!-- Modals UpdateVacaciones-->
<div class="modal fade" id="vacacionesModalUpdate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">ACtualizar fecha vacaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="vacacionesFormUpdate" name="vacacionesFormUpdate">
                    <input type="hidden" name="idVacaciones" id="idVacaciones" value="">
                    <div class="form-group">
                        <label for="label-control">Nombre persona</label>
                        <select class="form-control" name="persona_idUpdate" id="persona_idUpdate" disabled>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Fecha de inicio</label>
                        <input type="date" class="form-control" name="fecha_inicioUpdate" id="fecha_inicioUpdate">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Fecha de Terminación</label>
                        <input type="date" class="form-control" name="fecha_finUpdate" id="fecha_finUpdate">
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