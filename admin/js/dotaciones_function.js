var dotaciones_table;

document.addEventListener('DOMContentLoaded', function () {

    var id_personSelect = document.querySelector('#persona_id');
    var id_personSelectUpdate = document.querySelector('#persona_idUpdate');
    

    dotaciones_table = $('#dotaciones_table').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        /*"language": {
            "url": "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-CO.json"
        },*/
        "ajax": {
            "url": "./modelos/dotaciones/dotacionesTable.php",
            "dataSrc": ""
        },
        "columns": [
            { "data": "acciones" },
            { "data": "id" },
            { "data": "nombre_persona" },
            { "data": "fecha_entrega" },
            { "data": "fecha_tentativa_renovar" },
            { "data": "observacion" },
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    // Realiza una solicitud AJAX para obtener la lista de personas
    var request_person = new XMLHttpRequest();
    var url_person = './modelos/personas/personTable.php'; // Ruta al archivo PHP que devuelve la lista de personas
    request_person.open('GET', url_person, true);
    request_person.send();

    request_person.onreadystatechange = function () {
        if (request_person.readyState === 4 && request_person.status === 200) {
            var personas = JSON.parse(request_person.responseText);
            var personasUpdate = JSON.parse(request_person.responseText);

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


    var dotacionesForm = document.querySelector('#dotacionesForm');
    dotacionesForm.onsubmit = function (e) {
        e.preventDefault();

        var id_persona = document.querySelector('#persona_id').value;;

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './modelos/dotaciones/saveDotaciones.php';
        var form = new FormData(dotacionesForm);
        form.append('id_persona', id_persona);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var datas = JSON.parse(request.responseText);
                    try {

                        if (datas.status) {
                            $("#dotacionesModal").modal('hide');
                            dotacionesForm.reset();
                            swal('Dotaciones', datas.msg, 'success');
                            dotaciones_table.ajax.reload();
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

    var dotacionesFormUpdate = document.querySelector('#dotacionesFormUpdate');
    dotacionesFormUpdate.onsubmit = function (e) {
        e.preventDefault();

        var persona_idUpdate = document.querySelector('#persona_idUpdate').value;

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './modelos/dotaciones/updateDotaciones.php';
        var formUpdate = new FormData(dotacionesFormUpdate);
        formUpdate.append('persona_idUpdate', persona_idUpdate);
        request.open('POST', url, true);
        request.send(formUpdate);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var datas = JSON.parse(request.responseText);
                    try {

                        if (datas.status) {
                            $("#dotacionesModalUpdate").modal('hide');
                            dotacionesFormUpdate.reset();
                            swal('Dotaciones', datas.msg, 'success');
                            dotaciones_table.ajax.reload();
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

function readDotacionesUpdate(id) {
    var idDotaciones = id;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './modelos/dotaciones/readDotacionesUpdate.php?id=' + idDotaciones;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);

            if (data.status) {
                document.querySelector('#idDotaciones').value = data.datos.id;
                document.querySelector('#persona_idUpdate').value = data.datos.persona_id;
                document.querySelector('#fecha_entregaUpdate').value = data.datos.fecha_entrega;
                document.querySelector('#fecha_tentativa_renovarUpdate').value = data.datos.fecha_tentativa_renovar;
                document.querySelector('#observacionUpdate').value = data.datos.observacion;

                $('#dotacionesModalUpdate').modal('show');

            } else {
                swal('Error', data.ms, 'error');
            }
        }
    }
}

function deleteDotaciones(id) {
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
            var url = './modelos/dotaciones/deleteDotaciones.php?id=' + encodeURIComponent(idUser);
            request.open('POST', url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4) {
                    if (request.status == 200) {
                        var data = JSON.parse(request.responseText);
                        if (data.status) {
                            swal('Registro', data.msg, 'success');
                            dotaciones_table.ajax.reload();
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

function openModalDotaciones() {
    $('#dotacionesModal').modal('show');
}