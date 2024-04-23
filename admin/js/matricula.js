$('#tablamatricula').DataTable();
var tablamatricula;

document.addEventListener('DOMContentLoaded',function(){
    tablamatricula = $('#tablamatricula').DataTable({
      "aProcessing": true,
      "aServerSide": true,
      "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      },
      "ajax": {
          "url": "./modelos/matricula/tabla_matricula.php",
          "dataSrc":""
      },
      "columns": [
         
          {"data":"idmatricula"},
          {"data":"nom_estudiante"},
          {"data":"apestudiante"},
          {"data":"nom_profesor"},
          {"data":"aprofesor"},
          {"data":"nom_asignatura"},
          {"data":"fecha_matricula"},
          {"data":"acciones"}
      ],
      "responsive": true,
      "bDestroy": true,
      "iDisplayLength": 10,
      "order": [[0,"asc"]]
    });

    var formatricula= document.querySelector('#formatricula');
    formatricula.onsubmit= function(e){
        e.preventDefault();

        var id_matricula= document.querySelector('#idmatricula').value;
        var list_estudiante= document.querySelector('#list_estudiante').value;
        var list_profesor= document.querySelector('#list_profesor').value;
        var fecha_matricula= document.querySelector('#fecha_matricula').value;

        if(id_matricula=='' || list_profesor =='' || list_estudiante=='' || fecha_matricula==''){
            swal('Alerta','Por favor complete todos los campos','error');
            return false;
        }

        var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/matricula/guardarmat.php';
        var form = new FormData(formatricula);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange=function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $("#modalmatricula").modal('hide');
                    formasignacion.reset();
                    swal('Matricula',data.msg,'success');
                    tablamatricula.ajax.reload();
                }else{
                    swal('Matricula',data.msg,'error');
                }
            }
        }
    }

    var formatriculaactu = document.querySelector('#formatriculaactu');
    formatriculaactu.onsubmit= function(e){
        e.preventDefault();


        var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/matricula/actuamatricula.php';
        var form = new FormData(formatriculaactu);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange=function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $("#modalmatriculaactu").modal('hide');
                    formatriculaactu.reset();
                    swal('Matricula',data.msg,'success');
                    tablamatricula.ajax.reload();
                }else{
                    swal('Matricula',data.msg,'error');
                }
            }
        }
    }


    
})

function abrirmodalmatricula() {
    $("#modalmatricula").modal('show');
}

window.addEventListener('load',function(){
    mostrarprofesormat();
    mostrarestdiante();
    mostrarprofesormatactu();
    mostrarestudianteactu();
},false)

function mostrarprofesormat(){
    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/opciones/opcionprofmat.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var datos= JSON.parse(request.responseText);
           datos.forEach(function(valor){
               datos += '<option value="'+valor.idAsignacion_asignaturas+'">Profesor:'+valor.nombres+',  Asignatura: '+valor.nom_asignatura+'</option>'
           })
        }
        document.querySelector('#list_profesor').innerHTML = datos;
    }
}
function mostrarestdiante(){
    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/opciones/opcionest.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var datos= JSON.parse(request.responseText);
           datos.forEach(function(valor){
               datos += '<option value="'+valor.idestudiante+'">'+valor.nom_est+'</option>'
           })
        }
        document.querySelector('#list_estudiante').innerHTML = datos;
    }
}

function mostrarprofesormatactu(){
    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/opciones/opcionprofmat.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var datos= JSON.parse(request.responseText);
           datos.forEach(function(valor){
               datos += '<option value="'+valor.idAsignacion_asignaturas+'">Profesor:'+valor.nombres+',  Asignatura: '+valor.nom_asignatura+'</option>'
           })
        }
        document.querySelector('#list__profesor').innerHTML = datos;
    }
}
function mostrarestudianteactu(){
    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/opciones/opcionest.php';
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var datos= JSON.parse(request.responseText);
           datos.forEach(function(valor){
               datos += '<option value="'+valor.idestudiante+'">'+valor.nom_est+'</option>'
           })
        }
        document.querySelector('#list__estudiante').innerHTML = datos;
    }
}

function actualizarmatricula(id){
    var id__matricula=id;

    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/matricula/actualizarmatricula.php?id__matricula='+id__matricula;
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(request.status){
                document.querySelector('#id_mat').value= data.datos.idmatricula;
                document.querySelector('#list__estudiante').value= data.datos.m_idestudiante;
                document.querySelector('#list__profesor').value= data.datos.m_idprofesor;
                document.querySelector('#fecha__matricula').value= data.datos.fecha_matricula;
                $("#modalmatriculaactu").modal('show');
            }else{
                swal('Asignacion',data.msg,'error');
            }
        }
    }
}
