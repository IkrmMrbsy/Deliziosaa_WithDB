<main class="d-flex justify-content-center align-items-center h-100">
    <section class="order rounded shadow-lg border border-dark-subtle">
        <h1 class="text-center mb-5 fw-bold">
            Order <span class="text-warning">Here</span>
        </h1>
        <form action="<?= (!empty($data['orders']['id_orders'])) ? BASEURL.'orders/update' : BASEURL.'orders/add'; ?>" method="post">
            <div class="mb-4">
                <?php if (!empty($data['orders']['id_orders'])): ?>
                    <input
                        type="hidden" 
                        name="id_orders" 
                        value="<?= $data['orders']['id_orders'];?>"
                    />

                    <input
                        type="text"
                        class="form-control rounded-0 bg-dark-subtle border border-dark-subtle disabled text-body-emphasis"
                        required
                        name="id_orders"
                        disabled
                        value="<?= $data['orders']['id_orders'];?>"
                    />
                <?php endif; ?>
            </div>
            <div class="mb-4">
                <div class="mb-4">
                    <?php if(isset($_SESSION['is_admin'])): ?>
                        <select
                            class="form-select rounded-0 bg-body-secondary border border-dark-subtle"
                            aria-label="Meals" name="id_customers"
                        >
                            <?php if(empty($data['orders']['id_orders'])): ?>
                                <option selected disabled>Choose the user</option>
                            <?php endif; ?>
                            <?php if(!empty($data['orders']['id_orders'])) : ?>
                                <?php foreach ($data['customers'] as $customer): ?>
                                    <option value="<?= $customer['id_customers'] ?>" <?= ($customer['id_customers'] == $data['orders']['id_orders']) ? 'selected' : '' ?>>
                                        <?= $customer['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <?php foreach ($data['customers'] as $customer): ?>
                                    <option value="<?= $customer['id_customers'] ?>">
                                        <?= $customer['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    <?php else: ?>
                        <input
                            type="hidden"
                            name="id_customers"
                            value="<?= $data['customers']['id_customers']?>"
                        />

                        <input
                            type="text"
                            class="form-control rounded-0 bg-dark-subtle border border-dark-subtle disabled text-body-emphasis"
                            required
                            name="id_customers"
                            disabled
                            value="<?= $data['customers']['name']?>"
                        />
                    <?php endif; ?>
                </div>
            </div>
            <div class="mb-4">
                <select
                    class="form-select rounded-0 bg-body-secondary border border-dark-subtle"
                    aria-label="Meals" name="id_meals"
                >
                    <?php if(empty($data['orders']['id_orders'])): ?>
                        <option selected disabled>Pick your time</option>
                    <?php endif; ?>
                    <?php if (!empty($data['orders']['id_orders'])): ?>
                        <?php foreach ($data['meals'] as $meals): ?>
                            <option value="<?= $meals['id_meals'] ?>" <?= ($meals['id_meals'] == $data['orders']['id_orders']) ? 'selected' : '' ?>>
                                <?= $meals['meals_type'].' - '.$meals['time_desc'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php foreach ($data['meals'] as $meals): ?>
                            <option value="<?= $meals['id_meals'] ?>">
                                <?= $meals['meals_type'].' - '.$meals['time_desc'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <?php if (!empty($data['orders']['id_orders'])): ?>
                <div class="mb-4">
                    <select
                        class="form-select rounded-0 bg-body-secondary border border-dark-subtle"
                        aria-label="Paid Status" name="paid_stat" id="paid-stat" onchange="changeSelectBackground(this)"
                    >
                        <option class="bg-danger-subtle text-danger" value="Pending">Pending</option>
                        <option class="bg-success-subtle text-success" value="Paid">Paid</option>
                    </select>
                </div>
            <?php endif; ?>
            <div class="mb-4">
                <input
                    type="date"
                    class="form-control rounded-0 bg-body-secondary border border-dark-subtle"
                    placeholder="Choose your date"
                    required
                    name="date_reservation"
                    value="<?=(!empty($data['orders']['id_orders'])) ? $data['orders']['date_reservation'] : '' ;?>"
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
