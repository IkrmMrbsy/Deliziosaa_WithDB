<?php
  if (!isset($_SESSION['username']) && !isset($_SESSION['id_user']) ) {
    // Redirect to the login page if not logged in
    header("Location: " . BASEURL);
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$data['title']?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="<?= BASEURL; ?>css/index.css">
</head>
<body class="bg-light">
  <nav class="navbar py-3 fixed-top bg-dark" data-bs-theme="dark">
    <div class="container-fluid justify-content-start z-2">
      <button class="navbar-toggler" type="button">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand fs-2 ms-4 opacity-on" href="#">
        <span class="text-light acme">Deli</span><span class="text-warning acme">ziosa</span>
      </a>
    </div>
  </nav>
  <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark bg-dark pt-4 fixed-top sidebar sidebar-out z-1 shadow-lg" style="width: 280px; height: 100vh">
    <br /><br /><br />
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="<?=BASEURL;?>party/index" class="nav-link text-white">
          <i class="fa-solid fa-people-group me-2"></i> Party
        </a>
      </li>
      <li>
        <a href="<?=BASEURL;?>meals/index" class="nav-link text-white">
          <i class="fa-solid fa-clock me-2"></i> Meals
        </a>
      </li>
      <li>
        <a href="<?=BASEURL;?>seat/index" class="nav-link text-white">
          <i class="fa-solid fa-champagne-glasses me-2"></i> Class
        </a>
      </li>
      <li>
        <a href="<?=BASEURL;?>customers/index" class="nav-link text-white">
          <i class="fa-solid fa-users me-2"></i> Customers
        </a>
      </li>
      <li>
        <a href="<?= BASEURL; ?>orders/index" class="nav-link text-white">
          <i class="fa-solid fa-spoon me-2"></i> Orders
        </a>
      </li>
    </ul>
    <hr />
    <div class="dropdown">
      <a href="<?=BASEURL;?>" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-user me-3"></i>
        <strong><?=$_SESSION['username'];?></strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <?php if(!isset($_SESSION['is_admin'])) : ?>
        <li>
          <a class="dropdown-item" href="Profile/update_profile.html">Profile</a>
        </li>
        <li><hr class="dropdown-divider" /></li>
        <?php endif;?>
        <li><a class="dropdown-item" href="<?=BASEURL;?>login/logout">Sign out</a></li>
      </ul>
    </div>
  </div>
