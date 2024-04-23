document.getElementById("formLoginUser").addEventListener("keydown", function(event) {
    // Verificar si la tecla presionada fue Enter
    if (event.key === "Enter") {
      // Detener el comportamiento predeterminado del formulario (evitar envío)
      event.preventDefault();
      // Activar el evento de clic del botón
      document.getElementById("loginadmin").click();
    }
});
  
  
$(document).ready(function(){
    $('#loginadmin').on('click',function(){
        loginadmin();
    })
})

function loginadmin(){
    var email= $('#email').val();
    var password= $('#password').val();
    $.ajax({
        url: './includes/loginadmin.php',
        method: 'POST',
        data: {
            email:email,
            password:password
        },
        success: function(data){
            $('#messageusuario').html(data);
            if(data.indexOf('Ingresando..') >= 0){
                window.location = 'admin/';
            }
        }
    })
}



