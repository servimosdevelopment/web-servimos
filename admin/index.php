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
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Home</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <p>Create your first dashboard</p>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
include_once("includes/footer.php");
?>