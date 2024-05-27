<?php
include_once("includes/header.php");
$rol = $_SESSION['rol'];
$rolText = ($rol == 1) ? "Administrador" : "Asistente";
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>
                <?php
                echo ($rolText)
                ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Home</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="container-not">
                        <h1 class="next-bir">Notificaciones</h1>
                        <div id="notifications"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once("includes/footer.php");
?>