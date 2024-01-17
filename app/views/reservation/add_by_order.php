<main class="d-flex justify-content-center align-items-center h-100">
    <section class="reservation-det rounded shadow-lg border border-dark-subtle">
        <h1 class="fw-bold text-center mb-5">Get <span class="text-warning">Your Table</span></h1>

        <form class="mb-3" action="<?= BASEURL; ?>reservation/addByOrders" method="post">
            <div class="mb-4">
                <select class="form-select rounded-0 bg-body-secondary border border-dark-subtle" aria-label="Party" name="id_party">
                    <option selected disabled>Choose your party type</option>
                    <?php foreach ($data['party'] as $party) : ?>
                        <option value="<?= $party['id_party'] ?>">
                            <?= $party['party_type'] . ' - ' . $party['capacity'] . ' people - ' . $party['price'] . ' (IDR)' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <select class="form-select rounded-0 bg-body-secondary border border-dark-subtle" aria-label="Class" name="id_class">
                    <option selected disabled>Choose your reservation class</option>
                    <?php foreach ($data['class'] as $class) : ?>
                        <option value="<?= $class['id_class'] ?>">
                            <?= $class['class_type'] . ' - ' . $class['price'] . ' (IDR)' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <input type="number" class="form-control rounded-0 bg-body-secondary border border-dark-subtle" placeholder="Quantity" required min="1" name="quantity" />
            </div>
            <div class="mb-4">
                <input type="text" class="form-control rounded-0 bg-dark-subtle border border-dark-subtle disabled text-body-emphasis" value="<?= $data['orders_id'] ?>" disabled>
                <input type="hidden" id="id_orders" name="id_orders" value="<?= $data['orders_id'] ?>">
            </div>
            <button type="submit" class="btn btn-warning btn-secondary-warning border border-secondary-warning form-control rounded-0 mt-1">
                Submit
            </button>
        </form>
        <div class="mb-4">
            <button type="button" class="btn btn-green mt-2 rounded-0 border border-secondary-warning form-control">Add new row</button>
        </div>
    </section>
</main>
