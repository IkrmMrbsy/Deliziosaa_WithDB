<main class="d-flex justify-content-center align-items-center h-100 p-5">
  <section class="update-profile rounded shadow-lg border border-dark-subtle">
    <h1 class="text-center mb-5 fw-bold">
      Update <span class="text-warning">Profile</span>
    </h1>
    <form action="<?=BASEURL;?>customers/update" method="post">
      <input type="hidden" name="id_customers" value="<?=$data['customers']['id_customers']?>">

      <div class="mb-4">
        <input
          type="text"
          class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
          placeholder="Fullname"
          name="name"
          required
          value="<?=$data['customers']['name']?>"
        />
      </div>
      <div class="mb-4">
        <input
          type="email"
          class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
          placeholder="Email"
          name="email"
          required
          value="<?=$data['customers']['email']?>"
        />
      </div>
      <div class="mb-4">
        <input
          type="text"
          class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
          placeholder="Phone Numbers"
          name="numbers_phone"
          required
          value="<?=$data['customers']['numbers_phone']?>"
        />
      </div>
      <div class="mb-4">
        <input
          type="password"
          class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
          name="password"
          id="password"
          placeholder="Password"
          required
          value="<?=$data['customers']['password']?>"
        />
      </div>
      <div class="form-check mb-4">
        <input class="form-check-input border border-dark-subtle" type="checkbox" id="show-password" onclick="showPassword()">
        <label class="form-check-label" for="show-password">
            Show password
        </label>
      </div>
      <button
        type="submit"
        class="btn btn-warning btn-secondary-warning border border-secondary-warning form-control rounded-0 mt-1"
      >
        Submit
      </button>
    </form>
  </section>
</main>
