<!-- Modals CreateCompany -->
<div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="companyForm" name="companyForm">
                    <div class="form-group">
                        <label for="label-control">Nit:</label>
                        <input type="text" class="form-control" name="nit" id="nit">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Nombre del cliente:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Dirección:</label>
                        <input type="text" class="form-control" name="direccion" id="direccion">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Teléfono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Email</label>
                        <input type="email" pattern="^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com|outlook\.com)$" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Representante Legal:</label>
                        <input type="text" class="form-control" name="representante_legal" id="representante_legal">
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

<!-- Modals UpdateCompany-->
<div class="modal fade" id="companyModalUpdate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Actualizar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="companyFormUpdate" name="companyFormUpdate">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label for="label-control">Nit:</label>
                        <input type="text" class="form-control" name="nitUpdate" id="nitUpdate">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Nombre del cliente:</label>
                        <input type="text" class="form-control" name="nombreUpdate" id="nombreUpdate">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Dirección:</label>
                        <input type="text" class="form-control" name="direccionUpdate" id="direccionUpdate">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Teléfono:</label>
                        <input type="text" class="form-control" name="telefonoUpdate" id="telefonoUpdate">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Email</label>
                        <input type="email" pattern="^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com|outlook\.com)$" class="form-control" name="emailUpdate" id="emailUpdate">
                    </div>
                    <div class="form-group">
                        <label for="label-control">Representante Legal:</label>
                        <input type="text" class="form-control" name="representante_legalUpdate" id="representante_legalUpdate">
                    </div>
                    <div>
                        <label for="label-control">Estado:</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" type="submit">Actualizar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>