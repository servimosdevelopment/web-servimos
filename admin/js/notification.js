$(document).ready(function(){
    $.ajax({
        url: './modelos/notifications/notifications.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var notificacionesDiv = $('#notifications');
            var menuNotificaciones = $('.app-nav__item .notification-count');
            
            var totalNotificaciones = 0;
            
            // Crear contadores para cada tipo de notificación
            var contratosCount = response.contratos.length;
            var vacacionesInicioCount = response.vacaciones_inicio.length;
            var vacacionesFinCount = response.vacaciones_fin.length;
            var cumpleanosCount = response.cumpleanos.length;
            var dotacionesCount = response.dotaciones.length;
            
            totalNotificaciones = contratosCount + vacacionesInicioCount + vacacionesFinCount + cumpleanosCount + dotacionesCount;

            if (totalNotificaciones > 0) {
                notificacionesDiv.empty(); // Limpiar cualquier notificación anterior
                menuNotificaciones.text(totalNotificaciones); // Actualizar el contador de notificaciones
                
                // Procesar contratos próximos a vencer
                response.contratos.forEach(function(notificacion) {
                    var mensaje = 'El contrato de ' + notificacion.nombre + ' vence en ' + notificacion.dias_restantes + ' días.';
                    notificacionesDiv.append('<div class="notificacion">' + mensaje + '</div>');
                });

                // Procesar vacaciones próximas a iniciar
                response.vacaciones_inicio.forEach(function(notificacion) {
                    var mensaje = 'Las vacaciones de ' + notificacion.nombre + ' inician en ' + notificacion.dias_restantes + ' días.';
                    notificacionesDiv.append('<div class="notificacion">' + mensaje + '</div>');
                });

                // Procesar vacaciones próximas a terminar
                response.vacaciones_fin.forEach(function(notificacion) {
                    var mensaje = 'Las vacaciones de ' + notificacion.nombre + ' terminan en ' + notificacion.dias_restantes + ' días.';
                    notificacionesDiv.append('<div class="notificacion">' + mensaje + '</div>');
                });

                // Procesar cumpleaños próximos
                response.cumpleanos.forEach(function(notificacion) {
                    var diasRestantes = notificacion.dias_restantes;
                    if (diasRestantes === 0) {
                        var mensaje = '¡Hoy es el cumpleaños de ' + notificacion.nombre + '!';
                        notificacionesDiv.append('<div class="notificacion notificacion-hoy">' + mensaje + '</div>');
                    } else {
                        var mensaje = 'El cumpleaños de ' + notificacion.nombre + ' es en ' + diasRestantes + ' días.';
                        notificacionesDiv.append('<div class="notificacion">' + mensaje + '</div>');
                    }
                });

                // Procesar renovaciones de dotaciones próximas
                response.dotaciones.forEach(function(notificacion) {
                    var mensaje = 'La dotación de ' + notificacion.nombre + ' necesita renovación en ' + notificacion.dias_restantes + ' días.';
                    notificacionesDiv.append('<div class="notificacion">' + mensaje + '</div>');
                });
            } else {
                notificacionesDiv.empty();
                menuNotificaciones.text('0');
                notificacionesDiv.append('<div class="notificacion">No hay notificaciones próximas.</div>');
            }
        },
        error: function() {
            $('#notifications').text('Hubo un error al obtener las notificaciones.');
        }
    });
});
