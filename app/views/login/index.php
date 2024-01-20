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
    <title>Deliziosa | Join Us!</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/index.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    />
  </head>
  <body class="bg-login overflow-x-hidden">
    <main class="d-flex justify-content-around p-5">
      <section
        class="logo-slogan logo-slogan text-center d-flex flex-column justify-content-center"
      >
        <a href="<?=BASEURL;?>home/index" class="text-decoration-none logo-slogan-link">
          <h1 class="text-light brand acme fs-6vw" id="sign-logo">
            Deli<span class="text-warning acme">ziosa</span>
          </h1>
          <p class="fs-1 text-light" id="sign-slogan">
            Reserve, <span class="text-warning">Dine, Light</span>
          </p>
        </a>
      </section>
      <section class="sign-form d-flex flex-column align-items-center rounded">
        <div class="login rounded">
          <h1 class="acme text-center mb-5 text-light">
            Login <span class="text-warning acme">Here</span>
          </h1>
          <form action="<?=BASEURL;?>login/login" method="post">
            <div class="mb-4">
              <input
                type="email"
                class="form-control rounded-0"
                placeholder="Email"
                name="email"
                required
                autocomplete="off"
              />
            </div>
            <div class="mb-4">
              <input
                type="password"
                class="form-control rounded-0"
                placeholder="Password"
                name="password"
                required
                autocomplete="off"
              />
            </div>
            <button
              type="submit"
              class="btn btn-warning form-control rounded-0 mt-1"
            >
              Submit
            </button>
          </form>
          <a
            class="text-center text-warning mt-3 form-link d-block"
            id="reg-link"
            >Doesn't have any account?</a
          >
          <a href="<?= BASEURL; ?>admin/index"
            class="text-center text-warning mt-3 form-link d-block"
            
            >Login as admin</a
          >
        </div>

        <div class="register rounded d-none">
          <h1 class="acme text-center mb-5 text-light">
            Register <span class="text-warning acme">Here</span>
          </h1>
          <form action="<?=BASEURL;?>login/register" method="post">
            <div class="mb-4">
              <input
                type="text"
                class="form-control rounded-0"
                placeholder="Fullname"
                name="fullname"
                required
                autocomplete="off"
              />
            </div>
            <div class="mb-4">
              <input
                type="email"
                class="form-control rounded-0"
                placeholder="Email"
                name="email"
                required
                autocomplete="off"
              />
            </div>
            <div class="mb-4">
              <input
                type="text"
                class="form-control rounded-0"
                placeholder="Phone Numbers"
                name="phoneNumbers"
                required
                autocomplete="off"
                pattern="[0-9]{12}"
              />
            </div>
            <div class="mb-4">
              <input
                type="password"
                class="form-control rounded-0"
                placeholder="Password"
                id="password"
                name="password"
                required
                autocomplete="off"
              />
              
            </div>
            <div class="form-check mb-4">
              <input class="form-check-input" type="checkbox" id="show-password" onclick="showPassword()">
              <label class="form-check-label text-light" for="show-password">
                  Show password
              </label>
            </div>
            <button
              type="submit"
              class="btn btn-warning form-control rounded-0 mt-1"
            >
              Submit
            </button>
          </form>
          <a
            class="text-center text-warning mt-3 form-link d-block"
            id="login-link"
            >Already have an account?</a
          >
        </div>
      </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASEURL; ?>js/loginform.js"></script>
  </body>
</html>
