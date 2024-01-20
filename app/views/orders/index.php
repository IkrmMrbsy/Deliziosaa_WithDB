    <main class="container p-5">
      <section
        class="bg-white shadow order-data rounded p-5 w-100 overflow-x-scroll"
      >
        <div class="d-flex justify-content-between">
          <h1 class="fs-1 fw-semibold">Order <span class="text-warning">List</span></h1>
        </div>
        <hr />
        <a href="<?= BASEURL; ?>orders/form" class="btn btn-green mt-2 rounded-0 border border-success">
          Add new order
        </a>
        <form action="<?= BASEURL; ?>orders/search" method="post" class="mt-4">
          <div class="input-group mb-3 z-0">
            <input
              type="text"
              class="form-control rounded-0 z-0"
              placeholder="Search Order"
              aria-label="Search Order"
              aria-describedby="button-search"
              name="keyword"
            />
            <button
              class="btn btn-primary rounded-0"
              type="submit"
              id="button-search"
            >
              <i class="fa-solid fa-magnifying-glass text-light"></i>
            </button>
          </div>
        </form>
        <div class="row">
          <div class="col">
              <?php Flasher::flash(); ?>
          </div>
        </div>
        <table class="table table-hover mt-4">
          <thead class="table-dark">
            <tr>
              <th scope="col">ID Order</th>
              <th scope="col">Customer</th>
              <th scope="col">Total Price</th>
              <!-- <th scope="col">Meals</th> -->
              <th scope="col">Paid Status</th>
              <th scope="col">Paid Date</th>
              <!-- <th scope="col">Reservation Date</th>
              <th scope="col">Ticket Code</th> -->
              <th scope="col">Detail</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($data['orders'] as $order) :?>
            <tr>
              <td><?=$order['id_orders'];?></td>
              <td><?=$order['name'];?></td>
              <td><?=$order['total_price'];?></td>
              <?= ($order['paid_stat'] !== 'Paid') 
                    ? '<td class="fw-semibold table-danger text-danger">'.$order['paid_stat'].'</td>' 
                    : '<td class="fw-semibold table-success text-success">'.$order['paid_stat'].'</td>';?>
              <td><?= (is_null($order['date_paid'])) ? '-' : $order['date_paid'];?></td>
              
              <td class="table-primary">
                <a data-bs-toggle="modal" data-bs-target="#detailModal" onclick="showDetail(this)" data-id="<?=$order['id_orders'];?>">
                  <i class="fa-solid fa-eye text-primary"></i>
                </a>
              </td>
              <?php if($order['total_price'] != 0 && $order['paid_stat'] !== 'Paid') : ?>
                <td class="table-warning">
                  <a href="<?= BASEURL; ?>orders/form/<?=$order['id_orders'];?>" class="text-decoration-none"
                    ><i class="text-warning fa-solid fa-pen"></i
                  ></a>
                </td>
              <?php else : ?>
                <td class="table-warning">
                  <?= ($order['paid_stat'] !== 'Paid')? '<p class="text-danger fw-semibold">Add reservation first</p>' : '<p class="text-success fw-semibold">Already paid</p>'?>
                </td>
              <?php endif ?>
              <td class="table-danger">
                <a href="<?= BASEURL; ?>orders/delete/<?=$order['id_orders'];?>" class="text-decoration-none"
                  ><i class="text-danger fa-solid fa-trash"></i
                ></a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </section>
    </main>

  <!-- Modal -->
  <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="detailModalLabel">Order Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="meals-type"></p>
          <p id="reservation-date"></p>
          <p id="ticket-code"></p>
        </div>
        <div class="modal-footer">
          <a class="btn btn-primary btn-rsv" id="btn-new-rsv" href="">Add new reservation</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

