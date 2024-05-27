var contract_table;

var tipoSelectUpdate = document.getElementById('tipoUpdate');
var fechaTerminacionGroupUpdate = document.getElementById('fecha_terminacion_groupUpdate');
var fechaTerminacionInputUpdate = document.getElementById('fecha_terminacionUpdate');


function toggleFechaTerminacionUpdate() {
    if (tipoSelectUpdate.value == '1') { // Termino indefinido
        fechaTerminacionGroupUpdate.style.display = 'none';
        fechaTerminacionInputUpdate.removeAttribute('required');
        fechaTerminacionInputUpdate.value = ''; // Clear the value to avoid sending it
    } else { // Termino fijo
        fechaTerminacionGroupUpdate.style.display = 'block';
        fechaTerminacionInputUpdate.setAttribute('required', 'required');
    }
}

document.addEventListener('DOMContentLoaded', function () {

    var id_personSelect = document.querySelector('#id_persona');
    var empresa_idSelect = document.querySelector('#empresa_id');
    var id_personSelectUpdate = document.querySelector('#id_personaUpdate');
    var empresa_idSelectUpdate = document.querySelector('#empresa_idUpdate');
    var tipoSelect = document.getElementById('tipo');
    var fechaTerminacionGroup = document.getElementById('fecha_terminacion_group');
    var fechaTerminacionInput = document.getElementById('fecha_terminacion');


    function toggleFechaTerminacion() {
        if (tipoSelect.value == '1') { // Termino indefinido
            fechaTerminacionGroup.style.display = 'none';
            fechaTerminacionInput.removeAttribute('required');
            fechaTerminacionInput.value = ''; // Clear the value to avoid sending it
        } else { // Termino fijo
            fechaTerminacionGroup.style.display = 'block';
            fechaTerminacionInput.setAttribute('required', 'required');
        }
    }

    // Initial call to set the correct state based on the default selection
    toggleFechaTerminacion();
    toggleFechaTerminacionUpdate();

    // Add event listener to handle changes
    tipoSelect.addEventListener('change', toggleFechaTerminacion);
    tipoSelectUpdate.addEventListener('change', toggleFechaTerminacionUpdate);

    contract_table = $('#contract_table').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        /*"language": {
            "url": "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-CO.json"
        },*/
        "ajax": {
            "url": "./modelos/contratos/contratoTable.php",
            "dataSrc": ""
        },
        "columns": [
            { "data": "acciones" },
            { "data": "id" },
            { "data": "nombre_persona" },
            { "data": "nombre_empresa" },
            { "data": "cargo" },
            { "data": "estado_hv" },
            {
                "data": "tipo",
                "render": function (data, type, row) {
                    if (data == "1") {
                        return '<span class="">Termino indefinido</span>';
                    } else {
                        return '<span class="">Termino fijo</span>';
                    }
                }
            },
            { "data": "fecha_inicio" },
            {
                "data": "fecha_terminacion",
                "render": function (data, type, row) {
                    if (data != null) {
                        return data;
                    } else {
                        return '<span class="">No aplica</span>';
                    }
                }
            },
            {
                "data": "activo",
                "render": function (data, type, row) {
                    if (data == 1) {
                        return '<span class="badge rounded-pill bg-success">Activo</span>';
                    } else {
                        return '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                    }
                }
            },
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    // Realiza una solicitud AJAX para obtener la lista de personas
    var request_persona = new XMLHttpRequest();
    var url_persona = './modelos/personas/personTable.php'; // Ruta al archivo PHP que devuelve la lista de personas
    request_persona.open('GET', url_persona, true);
    request_persona.send();

    // Realiza una solicitud AJAX para obtener la lista de empresas
    var request_company = new XMLHttpRequest();
    var url_company = './modelos/company/companyTable.php'; // Ruta al archivo PHP que devuelve la lista de empresas
    request_company.open('GET', url_company, true);
    request_company.send();

    request_persona.onreadystatechange = function () {
        if (request_persona.readyState === 4 && request_persona.status === 200) {
            var personas = JSON.parse(request_persona.responseText);
            var personasUpdate = JSON.parse(request_persona.responseText);

            // Llena el campo de selección de personas con las personas obtenidos
            personas.forEach(function (persona) {
                var option = document.createElement('option');
                option.value = persona.id;
                option.textContent = persona.nombre;
                id_personSelect.appendChild(option);
            });

            personasUpdate.forEach(function (persona) {
                var option = document.createElement('option');
                option.value = persona.id;
                option.textContent = persona.nombre;
                id_personSelectUpdate.appendChild(option);
            });

        }
    };

    request_company.onreadystatechange = function () {
        if (request_company.readyState === 4 && request_company.status === 200) {
            var companies = JSON.parse(request_company.responseText);
            var companiesUpdate = JSON.parse(request_company.responseText);


            // Llena el campo de selección de empresas con las empresas obtenidas
            companies.forEach(function (company) {
                var option = document.createElement('option');
                option.value = company.id;
                option.textContent = company.nombre;
                empresa_idSelect.appendChild(option);
            });

            companiesUpdate.forEach(function (company) {
                var option = document.createElement('option');
                option.value = company.id;
                option.textContent = company.nombre;
                empresa_idSelectUpdate.appendChild(option);
            });

        }
    };

    var contractForm = document.querySelector('#contractForm');
    contractForm.onsubmit = function (e) {
        e.preventDefault();

        var id_persona = document.querySelector('#id_persona').value;
        var empresa_id = document.querySelector('#empresa_id').value;
        var tipo = document.querySelector('#tipo').value;

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './modelos/contratos/saveContrato.php';
        var form = new FormData(contractForm);
        form.append('id_persona', id_persona);
        form.append('empresa_id', empresa_id);
        form.append('tipo', tipo);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var datas = JSON.parse(request.responseText);
                    try {

                        if (datas.status) {
                            $("#contractModal").modal('hide');
                            contractForm.reset();
                            swal('Contrato', datas.msg, 'success');
                            contract_table.ajax.reload();
                        } else {
                            swal('Error', datas.msg, 'error');
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

    var contractFormUpdate = document.querySelector('#contractFormUpdate');
    contractFormUpdate.onsubmit = function (e) {
        e.preventDefault();

        var id_personaUpdate = document.querySelector('#id_personaUpdate').value;
        var empresa_idUpdate = document.querySelector('#empresa_idUpdate').value;
        var tipoUpdate = document.querySelector('#tipoUpdate').value;
        var estado = document.querySelector('#estado').value;

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './modelos/contratos/updateContrato.php';
        var formUpdate = new FormData(contractFormUpdate);
        formUpdate.append('id_personaUpdate', id_personaUpdate);
        formUpdate.append('empresa_idUpdate', empresa_idUpdate);
        formUpdate.append('tipoUpdate', tipoUpdate);
        formUpdate.append('estado', estado);
        request.open('POST', url, true);
        request.send(formUpdate);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var datas = JSON.parse(request.responseText);
                    try {

                        if (datas.status) {
                            $("#contractModalUpdate").modal('hide');
                            contractFormUpdate.reset();
                            swal('Contrato', datas.msg, 'success');
                            contract_table.ajax.reload();
                        } else {
                            swal('Error', datas.msg, 'error');
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

// function readContractUpdate(id) {
//     var idContract = id;
//     var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
//     var url = './modelos/contratos/readContratoUpdate.php?id=' + idContract;
//     request.open('GET', url, true);
//     request.send();
//     request.onreadystatechange = function () {
//         if (request.readyState == 4 && request.status == 200) {
//             var data = JSON.parse(request.responseText);

//             // Selecciona los campos de selección de personas y empresas en el modal de actualización
//             // var id_personaSelectUpdate = document.querySelector('#id_personaUpdate');
//             var empresa_idSelectUpdate = document.querySelector('#empresa_idUpdate');


//             // Establece los valores seleccionados para los campos de selección de departamentos
//             //id_personaSelectUpdate.value = data.datos.id_persona;
//             empresa_idSelectUpdate.value = data.datos.empresa_id;



//             // Muestra el modal de actualización con los datos de la persona
//             if (data.status) {
//                 document.querySelector('#idContract').value = data.datos.id;
//                 document.querySelector('#id_personaUpdate').value = data.datos.id_persona;

//                 // document.querySelector('#id_personaUpdate').value = data.datos.id_persona;
//                 // document.querySelector('#empresa_idUpdate').value = data.datos.empresa_id;
//                 document.querySelector('#cargoUpdate').value = data.datos.cargo;
//                 document.querySelector('#estado_hvUpdate').value = data.datos.estado_hv;
//                 document.querySelector('#tipoUpdate').value = data.datos.tipo;
//                 document.querySelector('#fecha_inicioUpdate').value = data.datos.fecha_inicio;
//                 document.querySelector('#fecha_terminacionUpdate').value = data.datos.fecha_terminacion;
//                 document.querySelector('#estado').value = data.datos.activo;



//                 $('#contractModalUpdate').modal('show');

//             } else {
//                 swal('Error', data.ms, 'error');
//             }
//         }
//     }
// }

function readContractUpdate(id) {
    var idContract = id;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './modelos/contratos/readContratoUpdate.php?id=' + idContract;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);

            if (data.status) {

                // Selecciona los campos del formulario de actualización
                document.querySelector('#idContract').value = data.datos.id;
                document.querySelector('#id_personaUpdate').value = data.datos.id_persona;
                document.querySelector('#empresa_idUpdate').value = data.datos.empresa_id;
                document.querySelector('#cargoUpdate').value = data.datos.cargo;
                document.querySelector('#estado_hvUpdate').value = data.datos.estado_hv;
                document.querySelector('#tipoUpdate').value = data.datos.tipo;
                document.querySelector('#fecha_inicioUpdate').value = data.datos.fecha_inicio;

                // Asegúrate de que el campo de fecha de terminación se rellena correctamente
                if (data.datos.fecha_terminacion) {
                    document.querySelector('#fecha_terminacionUpdate').value = data.datos.fecha_terminacion;
                } else {
                    document.querySelector('#fecha_terminacionUpdate').value = ''; // Limpia el valor si no hay fecha de terminación
                }

                document.querySelector('#estado').value = data.datos.activo;


                toggleFechaTerminacionUpdate();
                tipoSelectUpdate.addEventListener('change', toggleFechaTerminacionUpdate);

                // Muestra el modal de actualización con los datos del contrato
                $('#contractModalUpdate').modal('show');
            } else {
                swal('Error', data.msg, 'error');
            }
        }
    }
}

function deleteContract(id) {
    var idUser = id;
    swal({
        title: "Eliminar",
        text: "¿Desea Eliminar al registro seleccionado?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (confirm) {

        if (confirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './modelos/contratos/deleteContrato.php?id=' + encodeURIComponent(idUser);
            request.open('POST', url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4) {
                    if (request.status == 200) {
                        var data = JSON.parse(request.responseText);
                        if (data.status) {
                            swal('Registro', data.msg, 'success');
                            contract_table.ajax.reload();
                        } else {
                            swal('Error', data.msg, 'error');
                        }
                    } else {
                        swal('Error', 'Error en la solicitud al servidor', 'error');
                    }
                }
            }
        }
    });
}

function openModalContract() {
    $('#contractModal').modal('show');
}