<main class="d-flex justify-content-center align-items-center h-100">
      <section
        class="form-container rounded shadow-lg border border-dark-subtle"
      >
        <h1 class="text-center mb-5 fw-bold">
          Add <span class="text-warning">New Customers</span>
        </h1>
        <form class="mb-3" action="<?= (!empty($data['customers']['id_customers'])) ? BASEURL.'customers/update' : BASEURL.'customers/add'; ?>" method="post">
          <?php if (!empty($data['customers']['id_customers'])) { ?>
              <div class="mb-4">
                <input
                    type="hidden" 
                    name="id_customers" 
                    value="<?= $data['customers']['id_customers'];?>"
                />

                <input
                    type="text"
                    class="form-control rounded-0 bg-dark-subtle border border-dark-subtle disabled text-body-emphasis"
                    required
                    name="id_customers"
                    disabled
                    value="<?= $data['customers']['id_customers'];?>"
                />
              </div>
          <?php } ?>
          <div class="mb-4">
            <input
              type="text"
              class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
              placeholder="Customer's Name"
              required
              name="name"
              value="<?=(!empty($data['customers']['id_customers'])) ? $data['customers']['name'] : '';?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="email"
              class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
              placeholder="Email"
              required
              name="email"
              value="<?=(!empty($data['customers']['id_customers'])) ? $data['customers']['email'] : '';?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
              placeholder="Phone Numbers"
              required
              name="numbers_phone"
              pattern="[0-9]{12}"
              value="<?=(!empty($data['customers']['id_customers'])) ? $data['customers']['numbers_phone'] : '';?>"
            />
          </div>
          <div class="mb-3">
                <input
                type="password"
                class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
                placeholder="Password"
                id="password"
                required
                name="password"
                />
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
