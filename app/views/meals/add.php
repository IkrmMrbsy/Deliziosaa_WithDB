<main class="d-flex justify-content-center align-items-center h-100">
      <section
        class="reservation-det rounded shadow-lg border border-dark-subtle"
      >
        <h1 class="text-center mb-5 fw-bold">
          Add <span class="text-warning">New Meals Category</span>
        </h1>
        <form class="mb-3" action="<?= (!empty($data['meals']['id_meals'])) ? BASEURL.'meals/update' : BASEURL.'meals/add'; ?>" method="post" onsubmit="return validateTimeRange()">
          <?php if (!empty($data['meals']['id_meals'])) { ?>
              <div class="mb-4">
                <input
                    type="hidden" 
                    name="id_meals" 
                    value="<?= $data['meals']['id_meals'];?>"
                />

                <input
                    type="text"
                    class="form-control rounded-0 bg-dark-subtle border border-dark-subtle disabled text-body-emphasis"
                    required
                    name="id_meals"
                    disabled
                    value="<?= $data['meals']['id_meals'];?>"
                />
              </div>
          <?php } ?>
          <div class="mb-4">
            <input
              type="text"
              class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
              placeholder="Meals Type"
              required
              min="1"
              name="meals_type"
              value="<?=(!empty($data['meals']['id_meals'])) ? $data['meals']['meals_type'] : '';?>"
            />
          </div>
          <div class="mb-4">
            <input
              type="text"
              class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
              placeholder="Time Description (Ex: 00.00 AM-12.00 AM)"
              required
              min="1"
              name="time_desc"
              id="time-desc"
              value="<?=(!empty($data['meals']['id_meals'])) ? $data['meals']['time_desc'] : '';?>"
              oninput="validateTimeRange()"
            />
            <small class="text-danger fw-bold time-desc-err d-block mt-2"></small>
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
