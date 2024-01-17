<main class="d-flex justify-content-center align-items-center h-100">
    <section class="reservation-det rounded shadow-lg border border-dark-subtle">
        <h1 class="text-center mb-5 fw-bold">
            Get <span class="text-warning">Your Table</span>
        </h1>
        <form class="mb-3" action="<?= (!empty($data['reservation']['id_reservation'])) ? BASEURL.'reservation/update' : BASEURL.'reservation/add'; ?>" method="post">
            <?php if (!empty($data['reservation']['id_reservation'])) { ?>
                <div class="mb-4">
                    <input
                        type="hidden" 
                        name="id_reservation" 
                        value="<?= $data['reservation']['id_reservation'];?>"
                    />
                    <input
                        type="text"
                        class="form-control rounded-0 bg-dark-subtle border border-dark-subtle disabled text-body-emphasis"
                        required
                        name="id_reservation"
                        disabled
                        value="<?= $data['reservation']['id_reservation'];?>"
                    />
                </div>
            <?php } ?>
            <div class="mb-4">
                <select
                    class="form-select rounded-0 bg-body-secondary border border-dark-subtle"
                    aria-label="Party"
                    name="id_party"
                >
                    <?php if(empty($data['reservation']['id_reservation'])) : ?>
                        <option selected disabled>Choose your party type</option>
                    <?php endif; ?>
                    <?php foreach ($data['party'] as $party) : ?>
                        <option value="<?= $party['id_party'] ?>" <?= ($party['id_party'] == $data['reservation']['id_reservation']) ? 'selected' : '' ?>>
                            <?= $party['party_type'].' - '.$party['capacity'].' people - '.$party['price'].' (IDR)' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <select
                    class="form-select rounded-0 bg-body-secondary border border-dark-subtle"
                    aria-label="Class"
                    name="id_class"
                >
                    <?php if(empty($data['reservation']['id_reservation'])) : ?>
                        <option selected disabled>Choose your reservation class</option>
                    <?php endif; ?>
                    <?php foreach ($data['class'] as $class) : ?>
                        <option value="<?= $class['id_class'] ?>" <?= ($class['id_class'] == $data['reservation']['id_reservation']) ? 'selected' : '' ?>>
                            <?= $class['class_type'].' - '.$class['price'].' (IDR)' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <input
                    type="number"
                    class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
                    placeholder="Quantity"
                    required
                    min="1"
                    name="quantity"
                    value="<?=(!empty($data['reservation']['id_reservation'])) ? $data['reservation']['quantity'] : '';?>"
                />
            </div>
            <div class="mb-4">
              <?php if(empty($data['reservation']['id_reservation'])) : ?>
                <select
                    class="form-select rounded-0 bg-body-secondary border border-dark-subtle"
                    aria-label="Class"
                    name="id_orders"
                >
                    
                        <option selected disabled>Put the order id here</option>
                        <?php foreach ($data['id_orders'] as $idOrders) : ?>
                            <option value="<?= $idOrders['id_orders'] ?>" <?= ($idOrders['id_orders'] == $data['reservation']['id_reservation']) ? 'selected' : '' ?>>
                                <?= $idOrders['id_orders'] ?>
                            </option>
                        <?php endforeach; ?>
                  </select>
                <?php endif; ?>
                <input
                        type="hidden" 
                        name="id_reservation" 
                        value="<?= $data['reservation']['orders_id'];?>"
                    />
                    <input
                        type="text"
                        class="form-control rounded-0 bg-dark-subtle border border-dark-subtle disabled text-body-emphasis"
                        required
                        name="id_orders"
                        disabled
                        value="<?= $data['reservation']['orders_id'];?>"
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
