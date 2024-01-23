    <main class="d-flex justify-content-center align-items-center h-100">
      <section
        class="form-container rounded shadow-lg border border-dark-subtle"
      >
        <h1 class="text-center mb-5 fw-bold">
          Add <span class="text-warning">New Party</span>
        </h1>
        <form class="mb-3" action="<?= (!empty($data['party']['id_party'])) ? BASEURL.'party/update' : BASEURL.'party/add'; ?>" method="post">
          <?php if (!empty($data['party']['id_party'])) { ?>
              <div class="mb-4">
                <input
                    type="text"
                    class="form-control rounded-0 bg-dark-subtle border border-dark-subtle disabled text-body-emphasis"
                    required
                    name="id_party"
                    readonly
                    value="<?= $data['party']['id_party'];?>"
                />
              </div>
          <?php } ?>
          <div class="mb-4">
            <input
              type="text"
              class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
              placeholder="Party Type"
              required
              min="1"
              name="party_type"
              value="<?=(!empty($data['party']['id_party'])) ? $data['party']['party_type'] : '';?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="number"
              class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
              placeholder="Capacity"
              required
              min="1"
              name="capacity"
              value="<?=(!empty($data['party']['id_party'])) ? $data['party']['capacity'] : '';?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="number"
              class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
              placeholder="Price"
              required
              min="1"
              name="price"
              value="<?=(!empty($data['party']['id_party'])) ? $data['party']['price'] : '';?>"
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
