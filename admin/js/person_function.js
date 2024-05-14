//$('#person_table').DataTable();
let person_table;

document.addEventListener('DOMContentLoaded', function () {
    var departamentoSelect = document.querySelector('#departamento_nacimiento');
    var municipioSelect = document.querySelector('#municipio_nacimiento');
    var departamentoReSelect = document.querySelector('#departamento_residencia');
    var municipioReSelect = document.querySelector('#municipio_residencia');
    var departamentoSelectUpdate = document.querySelector('#departamento_nacimientoUpdate');
    var municipioSelectUpdate = document.querySelector('#municipio_nacimientoUpdate');
    var departamentoReSelectUpdate = document.querySelector('#departamento_residenciaUpdate');
    var municipioReSelectUpdate = document.querySelector('#municipio_residenciaUpdate');

    person_table = $('#person_table').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        /*"language": {
            "url": "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-CO.json"
        },*/
        "ajax": {
            "url": "./modelos/personas/personTable.php",
            "dataSrc": ""
        },
        "columns": [
            { "data": "acciones" },
            { "data": "id" },
            { "data": "nombre" },
            { "data": "fecha_nacimiento" },
            { "data": "edad" },
            { "data": "email" },
            { "data": "telefono" },
            { "data": "direccion" },
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    // Realiza una solicitud AJAX para obtener la lista de departamentos
    var request = new XMLHttpRequest();
    var url = './modelos/personas/get_departamentos.php'; // Ruta al archivo PHP que devuelve la lista de departamentos
    request.open('GET', url, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            var departamentos = JSON.parse(request.responseText);
            var departamentosRe = JSON.parse(request.responseText);
            var departamentosUpdate = JSON.parse(request.responseText);
            var departamentosReUpdate = JSON.parse(request.responseText);

            // Llena el campo de selección de departamentos con los departamentos obtenidos
            departamentos.forEach(function (departamento) {
                var option = document.createElement('option');
                option.value = departamento.id_departamento;
                option.textContent = departamento.departamento;
                departamentoSelect.appendChild(option);
            });

            departamentosRe.forEach(function (departamento) {
                var option = document.createElement('option');
                option.value = departamento.id_departamento;
                option.textContent = departamento.departamento;
                departamentoReSelect.appendChild(option);
            });

            departamentosUpdate.forEach(function (departamento) {
                var option = document.createElement('option');
                option.value = departamento.id_departamento;
                option.textContent = departamento.departamento;
                departamentoSelectUpdate.appendChild(option);
            });

            departamentosReUpdate.forEach(function (departamento) {
                var option = document.createElement('option');
                option.value = departamento.id_departamento;
                option.textContent = departamento.departamento;
                departamentoReSelectUpdate.appendChild(option);
            });


            // Dispara manualmente el evento de cambio para cargar los municipios del departamento seleccionado
            departamentoSelect.dispatchEvent(new Event('change'));
            departamentoReSelect.dispatchEvent(new Event('change'));
            departamentoSelectUpdate.dispatchEvent(new Event('change'));
            departamentoReSelectUpdate.dispatchEvent(new Event('change'));
        }
    };

    // Agrega un evento de cambio al campo de selección de departamentos
    departamentoSelect.addEventListener('change', function () {
        var departamentoId = this.value;

        // Realiza una solicitud AJAX para obtener los municipios asociados con el departamento seleccionado
        var request = new XMLHttpRequest();
        var url = './modelos/personas/get_municipios.php?departamento_id=' + encodeURIComponent(departamentoId);
        request.open('GET', url, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                var municipios = JSON.parse(request.responseText);

                // Limpia el campo de selección de municipios
                municipioSelect.innerHTML = '';

                // Llena el campo de selección de municipios con los municipios obtenidos
                municipios.forEach(function (municipio) {
                    var option = document.createElement('option');
                    option.value = municipio.id_municipio;
                    option.textContent = municipio.municipio;
                    municipioSelect.appendChild(option);
                });
            }
        };
    });

    departamentoReSelect.addEventListener('change', function () {
        var departamentoReId = this.value;

        // Realiza una solicitud AJAX para obtener los municipios asociados con el departamento seleccionado
        var request = new XMLHttpRequest();
        var url = './modelos/personas/get_municipios.php?departamento_id=' + encodeURIComponent(departamentoReId);
        request.open('GET', url, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                var municipiosRe = JSON.parse(request.responseText);

                // Limpia el campo de selección de municipios
                municipioReSelect.innerHTML = '';

                // Llena el campo de selección de municipios con los municipios obtenidos
                municipiosRe.forEach(function (municipioRe) {
                    var option = document.createElement('option');
                    option.value = municipioRe.id_municipio;
                    option.textContent = municipioRe.municipio;
                    municipioReSelect.appendChild(option);
                });
            }
        };
    });

    departamentoSelectUpdate.addEventListener('change', function () {
        var departamentoId = this.value;

        // Realiza una solicitud AJAX para obtener los municipios asociados con el departamento seleccionado
        var request = new XMLHttpRequest();
        var url = './modelos/personas/get_municipios.php?departamento_id=' + encodeURIComponent(departamentoId);
        request.open('GET', url, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                var municipiosUpdate = JSON.parse(request.responseText);

                // Limpia el campo de selección de municipios
                municipioSelectUpdate.innerHTML = '';

                // Llena el campo de selección de municipios con los municipios obtenidos
                municipiosUpdate.forEach(function (municipio) {
                    var option = document.createElement('option');
                    option.value = municipio.id_municipio;
                    option.textContent = municipio.municipio;
                    municipioSelectUpdate.appendChild(option);
                });
            }
        };
    });

    departamentoReSelectUpdate.addEventListener('change', function () {
        var departamentoReId = this.value;

        // Realiza una solicitud AJAX para obtener los municipios asociados con el departamento seleccionado
        var request = new XMLHttpRequest();
        var url = './modelos/personas/get_municipios.php?departamento_id=' + encodeURIComponent(departamentoReId);
        request.open('GET', url, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                var municipiosReUpdate = JSON.parse(request.responseText);

                // Limpia el campo de selección de municipios
                municipioReSelectUpdate.innerHTML = '';

                // Llena el campo de selección de municipios con los municipios obtenidos
                municipiosReUpdate.forEach(function (municipioRe) {
                    var option = document.createElement('option');
                    option.value = municipioRe.id_municipio;
                    option.textContent = municipioRe.municipio;
                    municipioReSelectUpdate.appendChild(option);
                });
            }
        };
    });

    var personForm = document.querySelector('#personForm');
    personForm.onsubmit = function (e) {
        e.preventDefault();

        var sexo = document.querySelector('#sexo').value;
        var departamento_nacimiento = document.querySelector('#departamento_nacimiento').value;
        var municipio_nacimiento = document.querySelector('#municipio_nacimiento').value;
        var departamento_residencia = document.querySelector('#departamento_residencia').value;
        var municipio_residencia = document.querySelector('#municipio_residencia').value;
        var tipo_sangre = document.querySelector('#tipo_sangre').value;
        var estado_civil = document.querySelector('#estado_civil').value;
        var id_estrato = document.querySelector('#id_estrato').value;
        var id_escolaridad = document.querySelector('#id_escolaridad').value;


        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './modelos/personas/savePerson.php';
        var form = new FormData(personForm);
        form.append('sexo', sexo);
        form.append('departamento_nacimiento', departamento_nacimiento);
        form.append('municipio_nacimiento', municipio_nacimiento);
        form.append('departamento_residencia', departamento_residencia);
        form.append('municipio_residencia', municipio_residencia);
        form.append('tipo_sangre', tipo_sangre);
        form.append('estado_civil', estado_civil);
        form.append('id_estrato', id_estrato);
        form.append('id_escolaridad', id_escolaridad);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var data = JSON.parse(request.responseText);
                    try {

                        if (data.status) {
                            $("#personModal").modal('hide');
                            personForm.reset();
                            swal('Persona', data.msg, 'success');
                            person_table.ajax.reload();
                        } else {
                            swal('Error', data.msg, 'error');
                        }
                    } catch (error) {
                        console.error('Error al analizar la respuesta JSON:', error);

                    }
                } else {
                    console.error('Error en la solicitud AJAX:', request.status);
                }
            } else {
                console.error('Error en la solicitud AJAX:', request.status);
            }
        };

    }

    var personFormUpdate = document.querySelector('#personFormUpdate');
    personFormUpdate.onsubmit = function (e) {
        e.preventDefault();

        var sexoUpdate = document.querySelector('#sexoUpdate').value;
        var departamento_nacimientoUpdate = document.querySelector('#departamento_nacimientoUpdate').value;
        var municipio_nacimientoUpdate = document.querySelector('#municipio_nacimientoUpdate').value;
        var departamento_residenciaUpdate = document.querySelector('#departamento_residenciaUpdate').value;
        var municipio_residenciaUpdate = document.querySelector('#municipio_residenciaUpdate').value;
        var tipo_sangreUpdate = document.querySelector('#tipo_sangreUpdate').value;
        var estado_civilUpdate = document.querySelector('#estado_civilUpdate').value;
        var id_estratoUpdate = document.querySelector('#id_estratoUpdate').value;
        var id_escolaridadUpdate = document.querySelector('#id_escolaridadUpdate').value;


        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './modelos/personas/updatePerson.php';
        var formUpdate = new FormData(personFormUpdate);
        formUpdate.append('sexoUpdate', sexoUpdate);
        formUpdate.append('departamento_nacimientoUpdate', departamento_nacimientoUpdate);
        formUpdate.append('municipio_nacimientoUpdate', municipio_nacimientoUpdate);
        formUpdate.append('departamento_residenciaUpdate', departamento_residenciaUpdate);
        formUpdate.append('municipio_residenciaUpdate', municipio_residenciaUpdate);
        formUpdate.append('tipo_sangreUpdate', tipo_sangreUpdate);
        formUpdate.append('estado_civilUpdate', estado_civilUpdate);
        formUpdate.append('id_estratoUpdate', id_estratoUpdate);
        formUpdate.append('id_escolaridadUpdate', id_escolaridadUpdate);
        request.open('POST', url, true);
        request.send(formUpdate);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var dataUpdate = JSON.parse(request.responseText);
                    try {

                        if (dataUpdate.status) {
                            $("#personModalUpdate").modal('hide');
                            personFormUpdate.reset();
                            swal('Persona', dataUpdate.msg, 'success');
                            person_table.ajax.reload();
                        } else {
                            swal('Error', dataUpdate.msg, 'error');
                        }
                    } catch (error) {
                        console.error('Error al analizar la respuesta JSON:', error);

                    }
                } else {
                    console.error('Error en la solicitud AJAX:', request.status);
                }
            } else {
                console.error('Error en la solicitud AJAX:', request.status);
            }
        };

    }
});

function readPersonUpdate(id) {
    var idPerson = id;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './modelos/personas/readPersonUpdate.php?id=' + idPerson;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            console.log(data);

            if (data.status) {
                document.querySelector('#idUpdate').value = data.datos.id;
                document.querySelector('#cedulaUpdate').value = data.datos.cedula;
                document.querySelector('#nombreUpdate').value = data.datos.nombre;
                document.querySelector('#sexoUpdate').value = data.datos.sexo;
                document.querySelector('#fecha_nacimientoUpdate').value = data.datos.fecha_nacimiento;
                document.querySelector('#fecha_expedicion_cedulaUpdate').value = data.datos.fecha_expedicion_cedula;
                document.querySelector('#departamento_nacimientoUpdate').value = data.datos.departamento_nacimiento;
                document.querySelector('#municipio_nacimientoUpdate').value = data.datos.municipio_nacimiento;
                document.querySelector('#departamento_residenciaUpdate').value = data.datos.departamento_residencia;
                document.querySelector('#municipio_residenciaUpdate').value = data.datos.municipio_residencia;
                document.querySelector('#direccionUpdate').value = data.datos.direccion;
                document.querySelector('#barrioUpdate').value = data.datos.barrio;
                document.querySelector('#tipo_sangreUpdate').value = data.datos.tipo_sangre;
                document.querySelector('#estado_civilUpdate').value = data.datos.estado_civil;
                document.querySelector('#id_estratoUpdate').value = data.datos.id_estrato;
                document.querySelector('#id_escolaridadUpdate').value = data.datos.id_escolaridad;
                document.querySelector('#telefonoUpdate').value = data.datos.telefono;
                document.querySelector('#whatsappUpdate').value = data.datos.whatsapp;
                document.querySelector('#emailUpdate').value = data.datos.email;
                $('#personModalUpdate').modal('show');
            }else {
                console.log(data.msg)
            }
        }
    }
}

function openModalPerson() {
    $('#personModal').modal('show');
}