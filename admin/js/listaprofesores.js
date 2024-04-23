$('#tableprofesores').DataTable();
var tableprofesores;

document.addEventListener('DOMContentLoaded',function(){
    tableprofesores = $('#tableprofesores').DataTable({
      "aProcessing": true,
      "aServerSide": true,
      "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
      },
      "ajax": {
          "url": "./modelos/profesores/tabla_profesores.php",
          "dataSrc":""
      },
      "columns": [
         
          {"data":"idprofesor"},
          {"data":"nom_profesor"},
          {"data":"aprofesor"},
          {"data":"acciones"}
      ],
      "responsive": true,
      "bDestroy": true,
      "iDisplayLength": 10,
      "order": [[0,"asc"]]
    });

    var formprofesor = document.querySelector('#formprofesor');
    formprofesor.onsubmit= function(e){
        e.preventDefault();

        var idprofesor= document.querySelector('#idprofesor').value;
        var nom_profesor= document.querySelector('#nom_profesor').value;
        var aprofesor= document.querySelector('#aprofesor').value;
        var ppassword= document.querySelector('#ppassword').value;

        if(idprofesor =='' || nom_profesor =='' || aprofesor =='' || ppassword ==''){
            swal('Alerta','Por favor complete todos los campos','error');
            return false;
        }

        var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/profesores/guardarprof.php';
        var form = new FormData(formprofesor);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange=function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $("#modalprofesor").modal('hide');
                    formprofesor.reset();
                    swal('profesor',data.msg,'success');
                    tableprofesores.ajax.reload();
                }else{
                    swal('profesor',data.msg,'error');
                }
            }
        }
    }


    var formprofesoractu = document.querySelector('#formprofesoractu');
    formprofesoractu.onsubmit= function(e){
        e.preventDefault();
        /*var idpro= document.querySelector('#idpro').value;*/

        var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/profesores/actuaprofe.php';
        var formu = new FormData(formprofesoractu);
        request.open('POST',url,true);
        request.send(formu);
        request.onreadystatechange=function(){
            if(request.readyState == 4 && request.status == 200){
                var datas = JSON.parse(request.responseText);
                if(request.status){
                    $("#modalprofesoractu").modal('hide');
                    formprofesoractu.reset();
                    swal('profesor',datas.msg,'success');
                    tableprofesores.ajax.reload();
                }else{
                    swal('profesor',datas.msg,'error');
                }
            }
        }
    }


})

function abrirmodal() {
    $("#modalprofesor").modal('show');
}

function actualizarprof(id){
    var idpro =id;

    var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/profesores/actualizarprof.php?idpro='+idpro;
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(request.status){
                document.querySelector('#idprofesoractu').value= data.datos.idprofesor;
                document.querySelector('#nom__profesor').value= data.datos.nom_profesor;
                document.querySelector('#a_profesor').value= data.datos.aprofesor;
                document.querySelector('#p_password').value= data.datos.ppassword;
                $("#modalprofesoractu").modal('show');
            }else{
                swal('profesor',data.msg,'error');
            }
        }
    }
}
/*
function eliminarprof(id){
    
    var idpro =id;
        swal({
            title: "Eliminar",
            text: "¿Desea Eliminar Profesor?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnconfirm: false,
            closeOnCancel: true
        },function(confirm){
            if(confirm){
                var request= (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
                var url='./modelos/profesores/borrarprof.php?idprofesor'+idpro;
                request.open('GET',url,true);
                request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                request.send(); 
                request.onreadystatechange=function(){
                    if(request.readyState == 4 && request.status == 200){
                        var data = JSON.parse(request.responseText);
                        if(request.status){
                           swal('Profesor',data.msg,'succes');
                           tableprofesores.ajax.reload();
                        }else{
                            swal('profesor',data.msg,'error');
                        }
                    }
                }    
            }
        })

        
}*/
