<?php
if (isset($_SESSION['username']) && isset($_SESSION['id_user']) ) {
    // Redirect to the login page if not logged in
    header("Location: " . BASEURL . "orders/index");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Deliziosa | Admin</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/index.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    />
  </head>
<body class="bg-login overflow-x-hidden">
    <main class="d-flex justify-content-around p-5">
        <section class="logo-slogan text-center d-flex flex-column justify-content-center">
            <a href="<?= BASEURL ?>index.html" class="d-block text-decoration-none logo-slogan-link">
                <h1 class="text-light brand acme fs-6vw" id="sign-logo">
                    Deli<span class="text-warning acme">ziosa</span>
                </h1>
                <p class="fs-1 text-light" id="sign-slogan">
                    Reserve, <span class="text-warning">Dine, Light</span>
                </p>
            </a>
        </section>
        <section class="sign-form d-flex flex-column justify-content-center">
            <div class="login">
                <h1 class="acme text-center mb-5 text-light">
                    Admin Login <span class="text-warning acme">Here</span>
                </h1>
                <form action="<?= BASEURL ?>login/admin" method="post">
                    <div class="mb-4">
                        <input type="text" class="form-control rounded-0" name="username" placeholder="Username" required>
                    </div>
                    <div class="mb-4">
                        <input type="password" class="form-control rounded-0" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-warning form-control rounded-0 mt-1">
                        Login
                    </button>
                </form>
                </a>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASEURL ?>js/loginform.js"></script>
</body>
</html>
