$('#tablaasignatura').DataTable();
var tablaasignatura;

document.addEventListener('DOMContentLoaded',function(){
    tablaasignatura = $('#tablaasignatura').DataTable({
      "aProcessing": true,
      "aServerSide": true,
      "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      },
      "ajax": {
          "url": "./modelos/asignaturas/tabla_asignaturas.php",
          "dataSrc":""
      },
      "columns": [
         
          {"data":"idasignatura"},
          {"data":"nom_asignatura"},
          {"data":"creditos"},
          {"data":"acciones"}
      ],
      "responsive": true,
      "bDestroy": true,
      "iDisplayLength": 10,
      "order": [[0,"asc"]]
    });

    var formasignatura = document.querySelector('#formasignatura');
    formasignatura.onsubmit= function(e){
        e.preventDefault();

        var idasignatura= document.querySelector('#idasignatura').value;
        var nom_asignatura= document.querySelector('#nom_asignatura').value;
        var creditos= document.querySelector('#creditos').value;

        if(idasignatura =='' || nom_asignatura =='' || creditos ==''){
            swal('Alerta','Por favor complete todos los campos','error');
            return false;
        }

        var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/asignaturas/guardarasig.php';
        var form = new FormData(formasignatura);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange=function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $("#modalasignatura").modal('hide');
                    formasignatura.reset();
                    swal('Asignatura',data.msg,'success');
                    tablaasignatura.ajax.reload();
                }else{
                    swal('Asignatura',data.msg,'error');
                }
            }
        }
    }

    var formasignaturaactu= document.querySelector('#formasignaturaactu');
    formasignaturaactu.onsubmit= function(e){
        e.preventDefault();
        /*var idpro= document.querySelector('#idpro').value;*/

        var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/asignaturas/actuasig.php';
        var formu = new FormData(formasignaturaactu);
        request.open('POST',url,true);
        request.send(formu);
        request.onreadystatechange=function(){
            if(request.readyState == 4 && request.status == 200){
                var datas = JSON.parse(request.responseText);
                if(request.status){
                    $("#modalasignaturaactu").modal('hide');
                    formasignaturaactu.reset();
                    swal('Asignatura',datas.msg,'success');
                    tablaasignatura.ajax.reload();
                }else{
                    swal('Asignatura',datas.msg,'error');
                }
            }
        }
    }


    
})

function abrirmodalas() {
    $("#modalasignatura").modal('show');
}

function actualizarasig(id){
    var id_asignatura=id;

    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/asignaturas/actualizarasig.php?id_asignatura='+id_asignatura;
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(request.status){
                document.querySelector('#idasignaturaactu').value= data.datos.idasignatura;
                document.querySelector('#nom__asignatura').value= data.datos.nom_asignatura;
                document.querySelector('#credito').value= data.datos.creditos;
                $("#modalasignaturaactu").modal('show');
            }else{
                swal('Asignatura',data.msg,'error');
            }
        }
    }
}
