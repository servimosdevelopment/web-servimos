<?php
session_start();
if (empty($_SESSION['admin'])) {
  header('Location: ../../../logout.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta name="description" content="servimos">
  <title>Servimos</title>
  <link rel="icon" href="../img/logo_serv.ico" type="image/x-icon" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/notification.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini">
  <!-- Navbar-->
  <header class="app-header"><a class="app-header__logo" href="../inicio.php" target="blank">Servimos</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="../logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
        </ul>
      </li>
      <li><a class="app-nav__item" href="notification.php"><i class="app-nav__icon icon fa fa-bell"></i><span class="app-menu__label"></span><span class="notification-count"><strong></strong></span></a></li>
    </ul>
  </header>
  <?php include_once("includes/nav.php");
  ?>