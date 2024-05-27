var vacaciones_table;

document.addEventListener('DOMContentLoaded', function () {

    var id_personSelect = document.querySelector('#persona_id');
    var id_personSelectUpdate = document.querySelector('#persona_idUpdate');
    

    vacaciones_table = $('#vacaciones_table').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        /*"language": {
            "url": "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-CO.json"
        },*/
        "ajax": {
            "url": "./modelos/vacaciones/vacacionesTable.php",
            "dataSrc": ""
        },
        "columns": [
            { "data": "acciones" },
            { "data": "id" },
            { "data": "nombre_persona" },
            { "data": "fecha_inicio" },
            { "data": "fecha_fin" },
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


    var vacacionesForm = document.querySelector('#vacacionesForm');
    vacacionesForm.onsubmit = function (e) {
        e.preventDefault();

        var id_persona = document.querySelector('#persona_id').value;;

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './modelos/vacaciones/saveVacaciones.php';
        var form = new FormData(vacacionesForm);
        form.append('id_persona', id_persona);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var datas = JSON.parse(request.responseText);
                    try {

                        if (datas.status) {
                            $("#vacacionesModal").modal('hide');
                            vacacionesForm.reset();
                            swal('Vacaciones', datas.msg, 'success');
                            vacaciones_table.ajax.reload();
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

    var vacacionesFormUpdate = document.querySelector('#vacacionesFormUpdate');
    vacacionesFormUpdate.onsubmit = function (e) {
        e.preventDefault();

        var persona_idUpdate = document.querySelector('#persona_idUpdate').value;

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './modelos/vacaciones/updateVacaciones.php';
        var formUpdate = new FormData(vacacionesFormUpdate);
        formUpdate.append('persona_idUpdate', persona_idUpdate);
        request.open('POST', url, true);
        request.send(formUpdate);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var datas = JSON.parse(request.responseText);
                    try {

                        if (datas.status) {
                            $("#vacacionesModalUpdate").modal('hide');
                            vacacionesFormUpdate.reset();
                            swal('Vacaciones', datas.msg, 'success');
                            vacaciones_table.ajax.reload();
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

function readVacacionesUpdate(id) {
    var idVacaciones = id;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './modelos/vacaciones/readVacacionesUpdate.php?id=' + idVacaciones;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);

            if (data.status) {
                document.querySelector('#idVacaciones').value = data.datos.id;
                document.querySelector('#persona_idUpdate').value = data.datos.persona_id;
                document.querySelector('#fecha_inicioUpdate').value = data.datos.fecha_inicio;
                document.querySelector('#fecha_finUpdate').value = data.datos.fecha_fin;

                $('#vacacionesModalUpdate').modal('show');

            } else {
                swal('Error', data.ms, 'error');
            }
        }
    }
}

function deleteVacaciones(id) {
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
            var url = './modelos/vacaciones/deleteVacaciones.php?id=' + encodeURIComponent(idUser);
            request.open('POST', url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4) {
                    if (request.status == 200) {
                        var data = JSON.parse(request.responseText);
                        if (data.status) {
                            swal('Registro', data.msg, 'success');
                            vacaciones_table.ajax.reload();
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

function openModalVacaciones() {
    $('#vacacionesModal').modal('show');
}