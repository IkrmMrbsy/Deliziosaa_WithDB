<main class="container p-5">
      <section
        class="bg-white shadow order-data rounded p-5 w-100 overflow-x-scroll"
      >
        <div class="d-flex justify-content-between">
          <h1 class="fs-1 fw-semibold">Class <span class="text-warning">List</span></h1>
        </div>
        <hr />
        <?php if(isset($_SESSION['is_admin'])) : ?>
        <a href="<?= BASEURL; ?>seat/form" class="btn btn-green mt-2 rounded-0 border border-success">
          Add new class
        </a>
        <?php endif; ?>
        <form action="<?= BASEURL; ?>seat/search" method="post" class="mt-4">
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
              <th scope="col">Class Type</th>
              <th scope="col">Price</th>
              <?php if(isset($_SESSION['is_admin'])) : ?>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              <?php endif; ?> 
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach($data['class'] as $class) :?>
            <tr>
              <th scope="row"><?=$i++;?></th>
              <td><?=$class['class_type'];?></td>
              <td><?=$class['price'];?></td>
              <?php if(isset($_SESSION['is_admin'])) : ?>
                <td class="table-warning">
                  <a href="<?= BASEURL; ?>seat/form/<?=$class['id_class'];?>" class="text-decoration-none"
                    ><i class="text-warning fa-solid fa-pen"></i
                  ></a>
                </td>
                <td class="table-danger">
                  <a href="<?= BASEURL; ?>seat/delete/<?=$class['id_class'];?>" class="text-decoration-none"
                    ><i class="text-danger fa-solid fa-trash"></i
                  ></a>
                </td>
              <?php endif; ?>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </section>
</main>

