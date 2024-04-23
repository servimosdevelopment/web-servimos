<?php
  session_start();
   if(!empty($_POST)){
    if(empty($_POST['usuarioprof']) || empty($_POST['passprof'])){
        echo '<div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Cuidado!</strong> Parece que no has llenado todos los campos.
      </div>';
    }else{
            include("conexion.php");
            $usuario = $_POST['usuarioprof'];
            $pass= $_POST['passprof'];

            $sql='SELECT * FROM profesor WHERE profesor.idprofesor= ?';
            $query = $con->prepare($sql);
            $query->execute(array($usuario));
            $resultado= $query->fetch(PDO::FETCH_ASSOC);

            if($query->rowCount() > 0){
                if(password_verify($pass, $resultado['ppassword'])){
                    $_SESSION['profesor']= true;
                    $_SESSION['idprofesor']=$resultado['idprofesor'];
                    $_SESSION['nom_profesor'] = $resultado['nom_profesor'];
                    $_SESSION['aprofesor'] =$resultado['aprofesor'];

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

