<main class="d-flex justify-content-center align-items-center h-100">
      <section
        class="reservation-det rounded shadow-lg border border-dark-subtle"
      >
        <h1 class="text-center mb-5 fw-bold">
          Add <span class="text-warning">New Class</span>
        </h1>
        <form class="mb-3" action="<?= (!empty($data['class']['id_class'])) ? BASEURL.'seat/update' : BASEURL.'seat/add'; ?>" method="post">
          <?php if (!empty($data['class']['id_class'])) { ?>
              <div class="mb-4">
                <input
                    type="hidden" 
                    name="id_class" 
                    value="<?= $data['class']['id_class'];?>"
                />

                <input
                    type="text"
                    class="form-control rounded-0 bg-dark-subtle border border-dark-subtle disabled text-body-emphasis"
                    required
                    name="id_class"
                    disabled
                    value="<?= $data['class']['id_class'];?>"
                />
              </div>
          <?php } ?>
          <div class="mb-4">
            <input
              type="text"
              class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
              placeholder="Class Type"
              required
              name="class_type"
              value="<?=(!empty($data['class']['id_class'])) ? $data['class']['class_type'] : '';?>"
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
              value="<?=(!empty($data['class']['id_class'])) ? $data['class']['price'] : '';?>"
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
