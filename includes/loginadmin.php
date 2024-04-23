<?php
    // Iniciar la sesión al principio del script
    session_start();

    // Verificar si se ha enviado algún dato mediante el método POST
    if (!empty($_POST)) {
        // Verificar si se han proporcionado ambos campos: email y contraseña
        if (empty($_POST['email']) || empty($_POST['password'])) {
            // Mostrar una advertencia si faltan campos
            echo '<div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Cuidado!</strong> Parece que no has llenado todos los campos.
            </div>';
        } else {
            // Incluir el archivo de conexión a la base de datos
            include("conexion.php");

            // Obtener el email y la contraseña del formulario
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Consulta preparada para obtener los datos del usuario por su email
            $sql = 'SELECT * FROM usuarios WHERE usuarios.email= ?';
            $query = $con->prepare($sql);
            $query->execute(array($email));
            $resultado = $query->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontró algún usuario con el email proporcionado
            if ($query->rowCount() > 0) {
                // Verificar si la contraseña proporcionada coincide con la almacenada en la base de datos
                if (password_verify($password, $resultado['password'])) {

                    if($resultado['activo']==1){
                         // Iniciar sesión y establecer variables de sesión
                        $_SESSION['admin'] = true;
                        $_SESSION['id'] = $resultado['id'];
                        $_SESSION['nombre'] = $resultado['nombre'];
                        $_SESSION['email'] = $resultado['email'];
                        $_SESSION['rol'] = $resultado['rol'];

                        // Mostrar un mensaje de éxito si la autenticación fue exitosa
                        echo '<div class="alert alert-success"><button type="button" 
                        class="close" data-dismiss="alert"></button>Ingresando..</div>';
                    }else{
                        echo '<div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Alerta!</strong> Al parecer su usuario se encuentra inactivo,
                        comuniquese con el administrador
                        </div>';
                    }
                   
                } else {
                    // Mostrar un mensaje de error si la contraseña es incorrecta
                    echo '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Cuidado!</strong> La contraseña no es valida
                    </div>';
                }
            } else {
                // Mostrar un mensaje de error si no se encontró ningún usuario con el email proporcionado
                echo '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Cuidado!</strong>Usuario no encontrado
                </div>';
            }
        }
    }
?>
