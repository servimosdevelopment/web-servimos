
function openExport(){

    $.ajax({
        url: './modelos/excel/export_to_excel.php', // Cambia esto por la URL de tu script PHP
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            exportToExcel(data);
        },
        error: function(xhr, status, error){
            console.error('Error en la exportación:', error);
        }
    });
}

function exportToExcel(data) {
    // Crear un nuevo libro de trabajo y una hoja de trabajo
    var wb = XLSX.utils.book_new();
    var ws = XLSX.utils.json_to_sheet(data);

    // Agregar la hoja de trabajo al libro de trabajo
    XLSX.utils.book_append_sheet(wb, ws, 'Datos');

    // Generar el archivo Excel y descargarlo
    XLSX.writeFile(wb, 'exported_data.xlsx');
}
 
