$('#userstable').DataTable();
var userstable;

document.addEventListener('DOMContentLoaded',function(){
    userstable = $('#userstable').DataTable({
      "aProcessing": true,
      "aServerSide": true,
      "language": {
          "url": "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-CO.json"
      },
      "ajax": {
          "url": "./modelos/usuarios/userstable.php",
          "dataSrc":""
      },
      "columns": [
         
          {"data":"acciones"},
          {"data":"id"},
          {"data":"nombre"},
          {"data":"email"},
          { "data":"rol",
            "render": function (data, type, row) {
                if (data == "1") {
                    return '<span class="">Administrador</span>';
                } else {
                    return '<span class="">Asistente</span>';
                }
            }
          
          },
          {"data":"fecha_registro"},
          {
            "data": "activo",
            "render": function (data, type, row) {
                if (data == 1) {
                    return '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    return '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }
            }
          }
      ],
      "responsive": true,
      "bDestroy": true,
      "iDisplayLength": 10,
      "order": [[0,"asc"]]
    });

    var userForm = document.querySelector('#userForm');
    userForm.onsubmit = function(e){
        e.preventDefault();

        var nombre= document.querySelector('#nombre').value;
        var email= document.querySelector('#email').value;
        var password= document.querySelector('#password').value;
        var listRol= document.querySelector('#listRol').value;

        if (!nombre || !email || !password|| !listRol) {
            swal('Alerta', 'Por favor complete todos los campos', 'error');
            return false;
        }
        

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/usuarios/saveUser.php';
        var form = new FormData(userForm);
        form.append('listRol', listRol);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function() {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var data = JSON.parse(request.responseText);
                    try {
                        
                        if (data.status) {
                            $("#userModal").modal('hide');
                            userForm.reset();
                            swal('Usuario', data.msg, 'success');
                            userstable.ajax.reload();
                        } else {
                            swal('Error', data.msg, 'error');
                        }
                    } catch (error) {
                        console.error('Error al analizar la respuesta JSON:', error);
                        
                    }
                } else {
                    console.error('Error en la solicitud AJAX:', request.status);
                }
            }
        };
        
    }

    var updateUserForm = document.querySelector('#updateUserForm');
    updateUserForm.onsubmit = function(e){
        e.preventDefault();
        
        var nombreUpdate= document.querySelector('#nombreUpdate').value;
        var listRolUpdate= document.querySelector('#listRolUpdate').value;
        var listEstadoUpdate= document.querySelector('#listEstadoUpdate').value;
        console.log(nombreUpdate, listRolUpdate, listEstadoUpdate)
        if (!nombreUpdate || !listRolUpdate || !listEstadoUpdate) {
            swal('Alerta', 'Por favor complete todos los campos', 'error');
            return false;
        }
        

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var url='./modelos/usuarios/updateUser.php';
        var formUpdate = new FormData(updateUserForm);
        formUpdate.append('listRolUpdate', listRolUpdate);
        formUpdate.append('listEstadoUpdate', listEstadoUpdate);
        request.open('POST',url,true);
        request.send(formUpdate);
        request.onreadystatechange = function() {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    var dataUpdate = JSON.parse(request.responseText);
                    try {
                        
                        if (dataUpdate.status) {
                            $("#updateUserModal").modal('hide');
                            updateUserForm.reset();
                            swal('Usuario', dataUpdate.msg, 'success');
                            userstable.ajax.reload();
                        } else {
                            swal('Error', dataUpdate.msg, 'error');
                        }
                    } catch (error) {
                        console.error('Error al analizar la respuesta JSON:', error);
                        
                    }
                } else {
                    console.error('Error en la solicitud AJAX:', request.status);
                }
            }
        };
        
    }
})

function readUserUpdate(id){
    var idUser = id;

    var request= (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var url='./modelos/usuarios/readUserUpdate.php?id='+idUser;
    request.open('GET',url,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            if(data.status){
                document.querySelector('#id').value= data.datos.id;
                document.querySelector('#nombreUpdate').value= data.datos.nombre;
                //document.querySelector('#emailUpdate').value= data.datos.email;
                //document.querySelector('#passwordUpdate').value= data.datos.password;
                document.querySelector('#listRolUpdate').value= data.datos.rol;
                document.querySelector('#listEstadoUpdate').value= data.datos.activo;
                $("#updateUserModal").modal('show');
            }else{
                swal('Error',data.msg,'error');
            }
        }
    }
}

function deleteUser(id){
    var idUser = id;
    swal({
        title: "Eliminar",
        text: "¿Desea Eliminar al Usuario seleccionado?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(confirm){
        
        if(confirm){
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './modelos/usuarios/deleteUser.php?id=' + encodeURIComponent(idUser);
            request.open('POST', url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(); 
            request.onreadystatechange = function(){
                if(request.readyState == 4){
                    if(request.status == 200){
                        var data = JSON.parse(request.responseText);
                        if(data.status){
                           swal('Usuario', data.msg, 'success');
                           userstable.ajax.reload();
                        }else {
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

function openModal() {
    $("#userModal").modal('show');
}




