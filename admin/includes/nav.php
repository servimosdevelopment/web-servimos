<?php
$nombre = $_SESSION['nombre'];
$rol = $_SESSION['rol'];
$rolText = ($rol == 1) ? "Administrador" : "Asistente";

?>

<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user">
    <div>
      <p class="app-sidebar__user-name">
        <?php
        echo ($nombre)
        ?>
      </p>
      <p class="app-sidebar__user-designation">
        <?php
        echo ($rolText)
        ?></p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item" href="lista_empresas.php"><i class="app-menu__icon icon fa fa-building-o"></i><span class="app-menu__label">Clientes Corporativos</span></a></li>
    <li><a class="app-menu__item" href="lista_personas.php"><i class="app-menu__icon icon fa fa-id-card"></i><span class="app-menu__label">Personas</span></a></li>
    <li><a class="app-menu__item" href="lista_contratos.php"><i class="app-menu__icon icon fa fa-file"></i><span class="app-menu__label">Contratos</span></a></li>
    <li><a class="app-menu__item" href="lista_usuarios.php"><i class="app-menu__icon icon fa fa-users"></i><span class="app-menu__label">Usuarios</span></a></li>
    <li><a class="app-menu__item" href="lista_vacaciones.php"><i class="app-menu__icon icon fa fa-plane"></i><span class="app-menu__label">Vacaciones</span></a></li>
    <li><a class="app-menu__item" href="lista_dotaciones.php"><i class="app-menu__icon icon fa fa-sign-language"></i><span class="app-menu__label">Dotaciones</span></a></li>
    <li><a class="app-menu__item" href="../logout.php"><i class="app-menu__icon icon fa fa-sign-out fa-lg"></i><span class="app-menu__label">Logout</span></a></li>
  </ul>
</aside>