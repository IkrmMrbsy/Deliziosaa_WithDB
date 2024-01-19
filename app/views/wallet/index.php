<main class="container p-5">
      <section
        class="bg-white shadow order-data rounded p-5 w-100 overflow-x-scroll"
      >
        <div class="d-flex justify-content-between">
          <h1 class="fs-1 fw-semibold">Wallet <span class="text-warning">List</span></h1>
        </div>
        <hr />
        <form action="<?= BASEURL; ?>wallet/search" method="post" class="mt-4">
          <div class="input-group mb-3 z-0">
            <input
              type="text"
              class="form-control rounded-0 z-0"
              placeholder="Search class"
              aria-label="Search class"
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
                <th scope="col">Wallet</th>
                <th scope="col">Customer's Name</th>
                <th scope="col">Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach($data['wallet'] as $wallet) :?>
            <tr>
                <th scope="row"><?=$i++;?></th>
                <td><?=$wallet['wallet'];?></td>
                <td><?=$wallet['name'];?></td>
                <td class="table-warning">
                    <a href="<?= BASEURL; ?>wallet/form/<?=$wallet['id_wallet'];?>" class="text-decoration-none"
                    ><i class="text-warning fa-solid fa-pen"></i
                    ></a>
                </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </section>
</main>

