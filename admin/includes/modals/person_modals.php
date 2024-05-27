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
            <label for="label-control">Fecha de expedición documento</label>
            <input type="date" class="form-control" name="fecha_expedicion_cedula" id="fecha_expedicion_cedula">
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
            <label for="label-control">Departamento de residencia:</label>
            <select class="form-control" name="departamento_residencia" id="departamento_residencia">
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Municipio de residencia:</label>
            <select class="form-control" name="municipio_residencia" id="municipio_residencia">
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Dirección:</label>
            <input type="text" class="form-control" name="direccion" id="direccion">
          </div>
          <div class="form-group">
            <label for="label-control">Barrio:</label>
            <input type="text" class="form-control" name="barrio" id="barrio">
          </div>
          <div class="form-group">
            <label for="label-control">Tipo de sangre (Grupo sanguíneo):</label>
            <select class="form-control" name="tipo_sangre" id="tipo_sangre">
              <option value="1">A+</option>
              <option value="2">A-</option>
              <option value="3">B+</option>
              <option value="4">B-</option>
              <option value="5">AB+</option>
              <option value="6">AB-</option>
              <option value="7">O+</option>
              <option value="8">O-</option>
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">EPS:</label>
            <input type="text" class="form-control" name="eps" id="eps">
          </div>
          <div class="form-group">
            <label for="label-control">Fondo de Pensiones y de Cesantías:</label>
            <input type="text" class="form-control" name="afp" id="afp">
          </div>
          <div class="form-group">
            <label for="label-control">Estado civil:</label>
            <select class="form-control" name="estado_civil" id="estado_civil">
              <option value="Soltero/a">Soltero/a</option>
              <option value="Casado/a">Casado/a</option>
              <option value="Viudo/a">Viudo/a</option>
              <option value="Divorciado/a">Divorciado/a</option>
              <option value="Union libre">Union libre</option>
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Estrato:</label>
            <select class="form-control" name="id_estrato" id="id_estrato">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Escolaridad:</label>
            <select class="form-control" name="id_escolaridad" id="id_escolaridad">
              <option value="1">Sin escolaridad</option>
              <option value="2">Primaria incompleta</option>
              <option value="3">Primaria completa</option>
              <option value="4">Secundaria incompleta</option>
              <option value="5">Secundaria completa</option>
              <option value="6">Universidad incompleta</option>
              <option value="7">Universidad completa</option>
              <option value="8">Posgrado</option>
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Hijos:</label>
            <textarea class="form-control" name="hijos" id="hijos" placeholder="Nombre&#10;Tipo y número de documento"></textarea>
          </div>
          <div class="form-group">
            <label for="label-control">Teléfono:</label>
            <input type="text" class="form-control" name="telefono" id="telefono">
          </div>
          <div class="form-group">
            <label for="label-control">WhatsApp:</label>
            <input type="text" class="form-control" name="whatsapp" id="whatsapp">
          </div>
          <div class="form-group">
            <label for="label-control">Email</label>
            <input type="email" pattern="^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com|outlook\.com)$" class="form-control" name="email" id="email">
          </div>
          <div class="form-group">
            <label for="label-control">Contacto de Emergencia:</label>
            <textarea class="form-control" name="contacto_emergencia" id="contacto_emergencia" placeholder="Nombre&#10;Numero de teléfono"></textarea>
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

<!-- Modals UpdatePerson -->
<div class="modal fade" id="personModalUpdate" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Actualizar Persona</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="personFormUpdate" name="personFormUpdate">
          <input type="hidden" name="idUpdate" id="idUpdate" value=""></input>
          <div class="form-group">
            <label for="label-control">Nº de identificación:</label>
            <input type="num" class="form-control" name="cedulaUpdate" id="cedulaUpdate">
          </div>
          <div class="form-group">
            <label for="label-control">Nombres y apellidos:</label>
            <input type="text" class="form-control" name="nombreUpdate" id="nombreUpdate">
          </div>
          <div class="form-group">
            <label for="label-control">Sexo:</label>
            <select class="form-control" name="sexoUpdate" id="sexoUpdate">
              <option value="M">Masculino</option>
              <option value="F">Femenino</option>
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Fecha de nacimiento</label>
            <input type="date" class="form-control" name="fecha_nacimientoUpdate" id="fecha_nacimientoUpdate">
          </div>
          <div class="form-group">
            <label for="label-control">Fecha de expedición documento</label>
            <input type="date" class="form-control" name="fecha_expedicion_cedulaUpdate" id="fecha_expedicion_cedulaUpdate">
          </div>
          <div class="form-group">
            <label for="label-control">Departamento de nacimiento:</label>
            <select class="form-control" name="departamento_nacimientoUpdate" id="departamento_nacimientoUpdate">
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Municipio de nacimiento:</label>
            <select class="form-control" name="municipio_nacimientoUpdate" id="municipio_nacimientoUpdate">
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Departamento de residencia:</label>
            <select class="form-control" name="departamento_residenciaUpdate" id="departamento_residenciaUpdate">
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Municipio de residencia:</label>
            <select class="form-control" name="municipio_residenciaUpdate" id="municipio_residenciaUpdate">
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Dirección:</label>
            <input type="text" class="form-control" name="direccionUpdate" id="direccionUpdate">
          </div>
          <div class="form-group">
            <label for="label-control">Barrio:</label>
            <input type="text" class="form-control" name="barrioUpdate" id="barrioUpdate">
          </div>
          <div class="form-group">
            <label for="label-control">Tipo de sangre (Grupo sanguíneo):</label>
            <select class="form-control" name="tipo_sangreUpdate" id="tipo_sangreUpdate">
              <option value="1">A+</option>
              <option value="2">A-</option>
              <option value="3">B+</option>
              <option value="4">B-</option>
              <option value="5">AB+</option>
              <option value="6">AB-</option>
              <option value="7">O+</option>
              <option value="8">O-</option>
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">EPS:</label>
            <input type="text" class="form-control" name="epsUpdate" id="epsUpdate">
          </div>
          <div class="form-group">
            <label for="label-control">Fondo de Pensiones y de Cesantías:</label>
            <input type="text" class="form-control" name="afpUpdate" id="afpUpdate">
          </div>
          <div class="form-group">
            <label for="label-control">Estado civil:</label>
            <select class="form-control" name="estado_civilUpdate" id="estado_civilUpdate">
              <option value="Soltero/a">Soltero/a</option>
              <option value="Casado/a">Casado/a</option>
              <option value="Viudo/a">Viudo/a</option>
              <option value="Divorciado/a">Divorciado/a</option>
              <option value="Union libre">Union libre</option>
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Estrato:</label>
            <select class="form-control" name="id_estratoUpdate" id="id_estratoUpdate">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Escolaridad:</label>
            <select class="form-control" name="id_escolaridadUpdate" id="id_escolaridadUpdate">
              <option value="1">Sin escolaridad</option>
              <option value="2">Primaria incompleta</option>
              <option value="3">Primaria completa</option>
              <option value="4">Secundaria incompleta</option>
              <option value="5">Secundaria completa</option>
              <option value="6">Universidad incompleta</option>
              <option value="7">Universidad completa</option>
              <option value="8">Posgrado</option>
            </select>
          </div>
          <div class="form-group">
            <label for="label-control">Hijos:</label>
            <textarea class="form-control" name="hijosUpdate" id="hijosUpdate" placeholder="Nombre&#10;Tipo y número de documento"></textarea>
          </div>
          <div class="form-group">
            <label for="label-control">Teléfono:</label>
            <input type="text" class="form-control" name="telefonoUpdate" id="telefonoUpdate">
          </div>
          <div class="form-group">
            <label for="label-control">WhatsApp:</label>
            <input type="text" class="form-control" name="whatsappUpdate" id="whatsappUpdate">
          </div>
          <div class="form-group">
            <label for="label-control">Email</label>
            <input type="email" pattern="^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com|outlook\.com)$" class="form-control" name="emailUpdate" id="emailUpdate">
          </div>
          <div class="form-group">
            <label for="label-control">Contacto de Emergencia:</label>
            <textarea class="form-control" name="contacto_emergenciaUpdate" id="contacto_emergenciaUpdate" placeholder="Nombre&#10;Numero de teléfono"></textarea>
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