//$('#person_table').DataTable();
var person_table;

document.addEventListener('DOMContentLoaded', function () {
    person_table = $('#person_table').DataTable({
        
    });
})

function openModal(){
    $('#personModal').modal('show');
}