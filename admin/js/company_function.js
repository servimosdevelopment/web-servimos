let company_table;

document.addEventListener('DOMContentLoaded', function () {

    company_table = $('#company_table').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        /*"language": {
            "url": "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-CO.json"
        },*/
        "ajax": {
            "url": "./modelos/company/companyTable.php",
            "dataSrc": ""
        },
        "columns": [
            { "data": "acciones" },
            { "data": "id" },
            { "data": "nit" },
            { "data": "nombre" },
            { "data": "direccion" },
            { "data": "telefono" },
            { "data": "email" },
            { "data": "representante_legal" },
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

    var companyForm = document.querySelector('#companyForm');
    companyForm.onsubmit = function (e) {
        e.preventDefault();

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './modelos/company/saveCompany.php';
        var form = new FormData(companyForm);
        request.open('POST', url, true);
        request.send(form);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var datas = JSON.parse(request.responseText);
                    try {

                        if (datas.status) {
                            $("#companyModal").modal('hide');
                            companyForm.reset();
                            swal('Cliente', datas.msg, 'success');
                            company_table.ajax.reload();
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

    var companyFormUpdate = document.querySelector('#companyFormUpdate');
    companyFormUpdate.onsubmit = function (e) {
        e.preventDefault();

        var estado = document.querySelector('#estado').value;

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './modelos/company/updateCompany.php';
        var formUpdate = new FormData(companyFormUpdate);
        formUpdate.append('estado', estado);
        request.open('POST', url, true);
        request.send(formUpdate);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var dataUpdate = JSON.parse(request.responseText);
                    try {

                        if (dataUpdate.status) {
                            $("#companyModalUpdate").modal('hide');
                            companyFormUpdate.reset();
                            swal('Cliente', dataUpdate.msg, 'success');
                            company_table.ajax.reload();
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

function readCompanyUpdate(id) {
    var idCompany = id;

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url = './modelos/company/readCompanyUpdate.php?id=' + idCompany;
    request.open('GET', url, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            if (data.status) {
                document.querySelector('#id').value = data.datos.id;
                document.querySelector('#nitUpdate').value = data.datos.nit;
                document.querySelector('#nombreUpdate').value = data.datos.nombre;
                document.querySelector('#direccionUpdate').value = data.datos.direccion;
                document.querySelector('#telefonoUpdate').value = data.datos.telefono;
                document.querySelector('#emailUpdate').value = data.datos.email;
                document.querySelector('#representante_legalUpdate').value = data.datos.representante_legal;
                document.querySelector('#estado').value = data.datos.activo;
                $("#companyModalUpdate").modal('show');
            } else {
                swal('Error', data.msg, 'error');
            }
        }
    }
}

function deleteCompany(id) {
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
            var url = './modelos/company/deleteCompany.php?id=' + encodeURIComponent(idUser);
            request.open('POST', url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4) {
                    if (request.status == 200) {
                        var data = JSON.parse(request.responseText);
                        if (data.status) {
                            swal('Registro', data.msg, 'success');
                            company_table.ajax.reload();
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

function openModalCompany() {
    $('#companyModal').modal('show');
}