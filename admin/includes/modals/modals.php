<!-- Modals CreateUser -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="userForm" name="userForm">
          <div class="form-group">
            <label for="label-control">Nombres y apellidos:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" >
          </div>
          <div class="form-group">
            <label for="label-control">Email</label>
            <input type="email" pattern="^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com|outlook\.com)$" class="form-control" name="email" id="email">
          </div>
          <div class="form-group">
            <label for="label-control">Contraseña:</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>
          <div class="form-group">
            <label for="listRol">Rol:</label>
            <select class="form-control" name="listRol" id="listRol">
                <option value="1">Administrador</option>
                <option value="2">Asistente</option>
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

<!-- Modals UpdateUser-->
<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Actualizar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="updateUserForm" name="updateUserForm">
        <input type="hidden" name="id" id="id" value="">
          <div class="form-group">
            <label for="label-control">Nombres y apellidos:</label>
            <input type="text" class="form-control" name="nombreUpdate" id="nombreUpdate" >
          </div>
          <div class="form-group">
            <label for="listRolUpdate">Rol:</label>
            <select class="form-control" name="listRolUpdate" id="listRolUpdate">
                <option value="1">Administrador</option>
                <option value="2">Asistente</option>
            </select>
          </div>
          <div class="form-group">
            <label for="listEstadoUpdate">Estado:</label>
            <select class="form-control" name="listEstadoUpdate" id="listEstadoUpdate">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary" type="submit">Actualizar</button>
         </div>
        </form>
      </div>

    </div>
  </div>
</div>
