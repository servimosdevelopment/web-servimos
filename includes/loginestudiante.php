<?php
    session_start();
   if(!empty($_POST)){
    if(empty($_POST['usuario_est']) || empty($_POST['pass_est'])){
        echo '<div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Cuidado!</strong> Parece que no has llenado todos los campos.
      </div>';
    }else{
            include("conexion.php");
            $usuario = $_POST['usuario_est'];
            $pass= $_POST['pass_est'];

            $sql='SELECT * FROM estudiante WHERE estudiante.idestudiante= ?';
            $query = $con->prepare($sql);
            $query->execute(array($usuario));
            $resultado= $query->fetch(PDO::FETCH_ASSOC);

            if($query->rowCount() > 0){
                if(password_verify($pass, $resultado['epassword'])){
                    $_SESSION['estudiante']= true;
                    $_SESSION['idestudiante']=$resultado['idestudiante'];
                    $_SESSION['nom_estudiante'] = $resultado['nom_estudiante'];
                    $_SESSION['apestudiante'] =$resultado['apestudiante'];

                    echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"></button>Ingresando..</div>';
                }else{
                    echo '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Cuidado!</strong> Datos incorrectos
                  </div>';
                }
            }else{
                echo '<div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert">&times;</button>
                   <strong>¡Cuidado!</strong> Datos incorrectos
                 </div>';
            }
        }
    }
?>
