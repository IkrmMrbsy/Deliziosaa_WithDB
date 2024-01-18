<main class="container p-5">
      <section
        class="bg-white shadow order-data rounded p-5 w-100 overflow-x-scroll"
      >
        <div class="d-flex justify-content-between">
          <h1 class="fs-1 fw-semibold">Customers <span class="text-warning">List</span></h1>
        </div>
        <hr />
        <a href="<?= BASEURL; ?>customers/form" class="btn btn-green mt-2 rounded-0 border border-success">
          Add new customers
        </a>
        <form action="<?= BASEURL; ?>customers/search" method="post" class="mt-4">
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
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Phone Numbers</th>
              <th scope="col">Email</th>
              <th scope="col">Password</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach($data['customers'] as $customers) :?>
            <tr>
              <th scope="row"><?=$i++;?></th>
              <td><?=$customers['name'];?></td>
              <td><?=$customers['numbers_phone'];?></td>
              <td><?=$customers['email'];?></td>
              <td><?=$customers['password'];?></td>
              <td class="table-warning">
                <a href="<?= BASEURL; ?>customers/form/<?=$customers['id_customers'];?>" class="text-decoration-none"
                  ><i class="text-warning fa-solid fa-pen"></i
                ></a>
              </td>
              <td class="table-danger">
                <a href="<?= BASEURL; ?>customers/delete/<?=$customers['id_customers'];?>" class="text-decoration-none"
                  ><i class="text-danger fa-solid fa-trash"></i
                ></a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </section>
</main>

