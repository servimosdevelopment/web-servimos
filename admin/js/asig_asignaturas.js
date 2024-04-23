$('#tablaasignacion').DataTable();
var tabla_asig_asignatura;

document.addEventListener('DOMContentLoaded',function(){
    tabla_asig_asignatura = $('#tablaasignacion').DataTable({
      "aProcessing": true,
      "aServerSide": true,
      "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      },
      "ajax": {
          "url": "./modelos/asig_asignaturas/tabla_asig_asignatura.php",
          "dataSrc":""
      },
      "columns": [
         
          {"data":"idAsignacion_asignaturas"},
          {"data":"nom_profesor"},
          {"data":"aprofesor"},
          {"data":"nom_asignatura"},
          {"data":"fecha_asignacion"},
          {"data":"acciones"}
      ],
      "responsive": true,
      "bDestroy": true,
      "iDisplayLength": 10,
      "order": [[0,"asc"]]
    });

    var formasignacion = document.querySelector('#formasignacion');
    formasignacion.onsubmit= function(e){
        e.preventDefault();

        var idasignacion= document.querySelector('#idasignacion').value;
        var profesor_id= document.querySelector('#profesor_id').value;
        var asignatura_id= document.querySelector('#asignatura_id').value;

        if(idasignacion =='' || profesor_id =='' || asignatura_id==''){
            swal('Alerta','Por favor complete todos los campos','error');
            return false;
        }

        var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/asig_asignaturas/guardarasignacion.php';
        var form = new FormData(formasignacion);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange=function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $("#modalasignacion").modal('hide');
                    formasignacion.reset();
                    swal('Asignación',data.msg,'success');
                    tabla_asig_asignatura.ajax.reload();
                }else{
                    swal('Asignación',data.msg,'error');
                }
            }
        }
    }

    var formasignacionactu = document.querySelector('#formasignacionactu');
    formasignacionactu.onsubmit= function(e){
        e.preventDefault();


        var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/asig_asignaturas/actuaasignacion.php';
        var form = new FormData(formasignacionactu);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange=function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $("#modalasignacionactu").modal('hide');
                    formasignacion.reset();
                    swal('Asignación',data.msg,'success');
                    tabla_asig_asignatura.ajax.reload();
                }else{
                    swal('Asignación',data.msg,'error');
                }
            }
        }
    }


    
})

function abrirmodalasig() {
    $("#modalasignacion").modal('show');
}

window.addEventListener('load',function(){
    mostrarprofesor();
    mostrarasignatura();
    mostrarprofesoractu();
    mostrarasignaturaactu();
},false)

function mostrarprofesor(){
    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/opciones/opcionprof.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var datos= JSON.parse(request.responseText);
           datos.forEach(function(valor){
               datos += '<option value="'+valor.idprofesor+'">'+valor.nombres+'</option>'
           })
        }
        document.querySelector('#profesor_id').innerHTML = datos;
    }
}
function mostrarasignatura(){
    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/opciones/opcionasig.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var datos= JSON.parse(request.responseText);
           datos.forEach(function(valor){
               datos += '<option value="'+valor.idasignatura+'">'+valor.nom_asignatura+'</option>'
           })
        }
        document.querySelector('#asignatura_id').innerHTML = datos;
    }
}

function mostrarprofesoractu(){
    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/opciones/opcionprof.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var datos= JSON.parse(request.responseText);
           datos.forEach(function(valor){
               datos += '<option value="'+valor.idprofesor+'">'+valor.nombres+'</option>'
           })
        }
        document.querySelector('#profesor__id').innerHTML = datos;
    }
}
function mostrarasignaturaactu(){
    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/opciones/opcionasig.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var datos= JSON.parse(request.responseText);
           datos.forEach(function(valor){
               datos += '<option value="'+valor.idasignatura+'">'+valor.nom_asignatura+'</option>'
           })
        }
        document.querySelector('#asignatura__id').innerHTML = datos;
    }
}

function actualizarasignacion(id){
    var id_asignacion=id;

    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/asig_asignaturas/actualizarasignacion.php?id__asignacion='+id_asignacion;
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(request.status){
                document.querySelector('#id_asig').value= data.datos.idAsignacion_asignaturas;
                document.querySelector('#profesor__id').value= data.datos.asig_idProfesor;
                document.querySelector('#asignatura_id').value= data.datos.asig_idAsignatura;
                document.querySelector('#fecha_asignacion').value= data.datos.fecha_asignacion;
                $("#modalasignacionactu").modal('show');
            }else{
                swal('Asignacion',data.msg,'error');
            }
        }
    }
}
