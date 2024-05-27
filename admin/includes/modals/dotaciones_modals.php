<!-- Modals CreateDotaciones-->
<div class="modal fade" id="dotacionesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Asignar fecha dotación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dotacionesForm" name="dotacionesForm">
                    <div class="form-group">
                        <label for="label-control">Nombre persona</label>
                        <select class="form-control" name="persona_id" id="persona_id">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Fecha de entrega</label>
                        <input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Fecha de tentativa de reposición</label>
                        <input type="date" class="form-control" name="fecha_tentativa_renovar" id="fecha_tentativa_renovar">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Observación</label>
                        <textarea type="date" class="form-control" name="observacion" id="observacion"></textarea>
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

<!-- Modals UpdateDotaciones-->
<div class="modal fade" id="dotacionesModalUpdate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Actualizar fecha dotación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dotacionesFormUpdate" name="dotacionesFormUpdate">
                    <input type="hidden" name="idDotaciones" id="idDotaciones" value="">
                    <div class="form-group">
                        <label for="label-control">Nombre persona</label>
                        <select class="form-control" name="persona_idUpdate" id="persona_idUpdate">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="label-control">Fecha de entrega</label>
                        <input type="date" class="form-control" name="fecha_entregaUpdate" id="fecha_entregaUpdate">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Fecha de tentativa de reposición</label>
                        <input type="date" class="form-control" name="fecha_tentativa_renovarUpdate" id="fecha_tentativa_renovarUpdate">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Observación</label>
                        <textarea type="date" class="form-control" name="observacionUpdate" id="observacionUpdate"></textarea>
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