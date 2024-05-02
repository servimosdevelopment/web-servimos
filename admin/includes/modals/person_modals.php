<!-- Modals CreatePerson -->
<div class="modal fade" id="personModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Nueva persona</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="personForm" name="personForm">
          <div class="form-group">
            <label for="label-control">Nº de identificación:</label>
            <input type="num" class="form-control" name="cedula" id="cedula">
          </div>
          <div class="form-group">
            <label for="label-control">Nombres y apellidos:</label>
            <input type="text" class="form-control" name="nombre" id="nombre">
          </div>
          <div class="form-group">
            <label for="label-control">Sexo:</label>
            <select class="form-control" name="sexo" id="sexo">
              <option value="M">Masculino</option>
              <option value="F">Femenino</option>
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Fecha de nacimiento</label>
            <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento">
          </div>
          <div class="form-group">
            <label for="label-control">Departamento de nacimiento:</label>
            <select class="form-control" name="departamento_nacimiento" id="departamento_nacimiento">
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Municipio de nacimiento:</label>
            <select class="form-control" name="municipio_nacimiento" id="municipio_nacimiento">
            </select>
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