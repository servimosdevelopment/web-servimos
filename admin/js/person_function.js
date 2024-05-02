//$('#person_table').DataTable();
var person_table;

document.addEventListener('DOMContentLoaded', function () {
    var departamentoSelect = document.querySelector('#departamento_nacimiento');
    var municipioSelect = document.querySelector('#municipio_nacimiento');

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
            { "data": "telefono"},
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

            // Llena el campo de selección de departamentos con los departamentos obtenidos
            departamentos.forEach(function (departamento) {
                var option = document.createElement('option');
                option.value = departamento.id_departamento;
                option.textContent = departamento.departamento;
                departamentoSelect.appendChild(option);
            });

            // Dispara manualmente el evento de cambio para cargar los municipios del departamento seleccionado
            departamentoSelect.dispatchEvent(new Event('change'));
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
});


function openModal(){
    $('#personModal').modal('show');
}