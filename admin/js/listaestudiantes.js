$('#tablaestudiantes').DataTable();
var tablaestudiante;

document.addEventListener('DOMContentLoaded',function(){
    tablaestudiante = $('#tablaestudiantes').DataTable({
      "aProcessing": true,
      "aServerSide": true,
      "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      },
      "ajax": {
          "url": "./modelos/estudiante/tabla_estudiantes.php",
          "dataSrc":""
      },
      "columns": [
         
          {"data":"idestudiante"},
          {"data":"nom_estudiante"},
          {"data":"apestudiante"},
          {"data":"acciones"}
      ],
      "responsive": true,
      "bDestroy": true,
      "iDisplayLength": 10,
      "order": [[0,"asc"]]
    });

    var formestudiante = document.querySelector('#formestudiante');
    formestudiante.onsubmit= function(e){
        e.preventDefault();

        var idestudiante= document.querySelector('#idestudiante').value;
        var nom_estudiante= document.querySelector('#nom_estudiante').value;
        var apestudiante= document.querySelector('#apestudiante').value;
        var epassword= document.querySelector('#epassword').value;

        if(idestudiante =='' || nom_estudiante =='' || apestudiante =='' || epassword ==''){
            swal('Alerta','Por favor complete todos los campos','error');
            return false;
        }

        var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/estudiante/guardarest.php';
        var form = new FormData(formestudiante);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange=function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $("#modalestudiante").modal('hide');
                    formprofesor.reset();
                    swal('Estudiante',data.msg,'success');
                    tablaestudiante.ajax.reload();
                }else{
                    swal('Estudiante',data.msg,'error');
                }
            }
        }
    }

    var formestudianteactu= document.querySelector('#formestudianteactu');
    formestudianteactu.onsubmit= function(e){
        e.preventDefault();
        /*var idpro= document.querySelector('#idpro').value;*/

        var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/estudiante/actuaest.php';
        var formu = new FormData(formestudianteactu);
        request.open('POST',url,true);
        request.send(formu);
        request.onreadystatechange=function(){
            if(request.readyState == 4 && request.status == 200){
                var datas = JSON.parse(request.responseText);
                if(request.status){
                    $("#modalestudianteactu").modal('hide');
                    formestudianteactu.reset();
                    swal('Estudiante',datas.msg,'success');
                    tablaestudiante.ajax.reload();
                }else{
                    swal('Estudiante',datas.msg,'error');
                }
            }
        }
    }


    
})

function abrirmodalest() {
    $("#modalestudiante").modal('show');
}

function actualizarest(id){
    var idest=id;

    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/estudiante/actualizarest.php?idest='+idest;
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(request.status){
                document.querySelector('#idestudianteactu').value= data.datos.idestudiante;
                document.querySelector('#nom__estudiante').value= data.datos.nom_estudiante;
                document.querySelector('#a_pestudiante').value= data.datos.apestudiante;
                document.querySelector('#e_password').value= data.datos.epassword;
                $("#modalestudianteactu").modal('show');
            }else{
                swal('Estudiante',data.msg,'error');
            }
        }
    }
}
