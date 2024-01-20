<main class="d-flex justify-content-center align-items-center h-100">
      <section
        class="form-container rounded shadow-lg border border-dark-subtle"
      >
        <h1 class="text-center mb-5 fw-bold">
          Fill <span class="text-warning">the Wallet</span>
        </h1>
        <form class="mb-3" action="<?= (!empty($data['wallet']['id_wallet'])) ? BASEURL.'wallet/update' : BASEURL.'wallet/add'; ?>" method="post">
          <?php if (!empty($data['wallet']['id_wallet'])) : ?>
              <div class="mb-4">
                <input
                    type="hidden" 
                    name="id_wallet" 
                    value="<?= $data['wallet']['id_wallet'];?>"
                />
                <?php if(isset($_SESSION['is_admin'])) : ?>
                    <input
                        type="text"
                        class="form-control rounded-0 bg-dark-subtle border border-dark-subtle disabled text-body-emphasis"
                        required
                        name="id_wallet"
                        disabled
                        value="<?= $data['wallet']['id_wallet'];?>"
                    />
                <?php endif; ?>
              </div>
          <?php endif; ?>
          <div class="mb-4">
            <input
              type="number"
              class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
              placeholder="Fill the wallet (IDR)"
              required
              min="<?=(!isset($_SESSION['is_admin'])) ? $data['wallet']['wallet'] : 0;?>"
              name="wallet"
              value="<?=(!empty($data['wallet']['id_wallet'])) ? $data['wallet']['wallet'] : '';?>"
            />
          </div>
          <?php if(isset($_SESSION['is_admin'])) : ?>
            <div class="mb-4">
                <input
                type="text"
                class="form-control rounded-0 bg-dark-subtle border border-dark-subtle disabled text-body-emphasis"
                placeholder="Capacity"
                required
                name="id_customers"
                value="<?=(!empty($data['wallet']['id_wallet'])) ? $data['wallet']['customers_id'] : '';?>"
                readonly
                />
            </div>
          <?php endif; ?>
          <button
            type="submit"
            class="btn btn-warning btn-secondary-warning border border-secondary-warning form-control rounded-0 mt-1"
          >
            Submit
          </button>
        </form>
      </section>
</main>
