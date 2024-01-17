<?php
if (isset($_SESSION['username']) && isset($_SESSION['id_user']) ) {
  // Redirect to the login page if not logged in
  header("Location: " . BASEURL . "orders/index");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Deliziosa | Welcome to our page!!</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/index.css" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    />
</head>  
  <body class="bg-dark-metal text-light">
    <nav class="navbar navbar-expand-lg py-3 fixed-top" data-bs-theme="dark">
      <div class="container">
        <a class="navbar-brand fs-3" href="#"
          ><span class="text-light acme">Deli</span
          ><span class="text-warning acme">ziosa</span></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto position-relative">
            <a
              class="nav-link me-4 mt-2 text-light"
              aria-current="page"
              href="#hero"
              >Home</a
            >
            <a class="nav-link me-4 mt-2 text-light" href="#about-us"
              >About Us</a
            >
            <a class="nav-link me-4 mt-2 text-light" href="#testimonials"
              >Testimonials</a
            >
            <a class="nav-link me-4 mt-2 text-light" href="#contact">Contact</a>
            <a class="nav-link" href="<?= BASEURL; ?>login/index"
              ><button
                type="button"
                class="btn btn-reservation btn-warning rounded-0 border border-warning"
              >
                Login
              </button></a
            >
          </div>
        </div>
      </div>
    </nav>

    <main>
      <section id="hero">
        <div class="container d-flex justify-content-center align-items-center">
          <div class="content text-center">
            <h1 class="text-light brand acme" id="brand-hero">
              Deli<span class="text-warning acme">ziosa</span>
            </h1>
            <h2 class="text-light mt-3 fs-1">
              Eat <span class="text-warning">well</span>, be
              <span class="text-warning">happy</span>
            </h2>
            <a
              class="text-decoration-none d-block mt-4"
              href="<?= BASEURL; ?>login/index"
              ><button
                type="button"
                class="btn btn-warning rounded-0 text-warning-emphasis booking-btn fs-4 border border-warning"
              >
                Book Now
              </button></a
            >
          </div>
        </div>
      </section>

      <section id="about-us" class="position-relative">
        <div class="container">
          <h2 class="fs-1 acme text-center">
            ABOUT <span class="acme text-warning">US</span>
          </h2>

          <div class="content row justify-content-between">
            <div class="col-lg-6 col-md-12">
              <p class="text-justify">
                At <span class="acme">Deli</span
                ><span class="text-warning acme">ziosa</span>, we're not just a
                restaurant; we're a culinary haven with a story deeply rooted in
                tradition and innovation. Located in the heart of Jakarta, our
                kitchen is a symphony of fresh, locally-sourced ingredients and
                skillful craftsmanship. Our warm and inviting ambiance, coupled
                with a menu featuring timeless classics and imaginative
                creations, ensures that every visit is an unforgettable journey
                through the world of Italian cuisine. At
                <span class="acme">Deli</span
                ><span class="text-warning acme">ziosa</span>, we create
                memories with every meal, making each dining experience a
                celebration of life's delicious moments. Welcome to
                <span class="acme">Deli</span
                ><span class="text-warning acme">ziosa</span>, where the essence
                of Italian cuisine comes to life!
              </p>
              <div class="menu-link mt-4 position-relative">
                <div
                  class="line bg-warning position-absolute top-50 translate-middle-y"
                ></div>
                <p>
                  <a
                    class="acme text-light text-decoration-none fs-3"
                    href="<?= BASEURL; ?>img/menu.jpg"
                    download
                    >See Our Menu</a
                  >
                </p>
              </div>
            </div>

            <div class="col-lg-5 col-md-12 d-flex justify-content-center">
              <img
                src="<?= BASEURL; ?>img/lasagna.svg"
                alt="Lasagna Picture"
                class="img-fluid"
                id="img-about"
              />
            </div>
          </div>
        </div>
      </section>

      <section id="gallery">
        <div class="container">
          <h2 class="fs-2 acme text-sm-center text-md-start" id="title-gallery">
            GAL<span class="acme text-warning">LLERY</span>
          </h2>

          <div class="d-flex gallery-images justify-content-between">
            <div class="mt-5 rounded shadow img-gallery img-gallery-1"></div>
            <div class="mt-5 rounded shadow img-gallery img-gallery-3"></div>
            <div class="mt-5 rounded shadow img-gallery img-gallery-2"></div>
          </div>
          <div class="d-flex gallery-images justify-content-between">
            <div class="mt-5 rounded shadow img-gallery img-gallery-2"></div>
            <div class="mt-5 rounded shadow img-gallery img-gallery-1"></div>
            <div class="mt-5 rounded shadow img-gallery img-gallery-3"></div>
          </div>
        </div>
      </section>

      <section id="testimonials">
        <h2 class="fs-1 acme text-center" id="title-testimonials">
          WHAT PEOPLE SAY <span class="text-warning acme">ABOUT US?</span>
        </h2>
        <div id="testimonials-container" class="d-flex gap-5 overflow-x-scroll">
          <div class="card p-5 text-center" style="width: 18rem">
            <img
              src="<?= BASEURL; ?>img/profiles/Antoni.jpg"
              class="rounded-circle card-img-top mx-auto border border-secondary-subtle"
              alt="Image profile"
            />
            <div class="card-body">
              <p class="card-text mt-4 fs-4 acme profile-name">Jake</p>
              <p class="card-text mt-4 fs-5 review">
                “All I can say is great food, great service.”
              </p>
            </div>
          </div>
          <div class="card p-5 text-center" style="width: 18rem">
            <img
              src="<?= BASEURL; ?>img/profiles/cesar-rincon-XHVpWcr5grQ-unsplash.jpg"
              class="rounded-circle card-img-top mx-auto border border-secondary-subtle"
              alt="Image profile"
            />
            <div class="card-body">
              <p class="card-text mt-4 fs-4 acme profile-name">Caesar</p>
              <p class="card-text mt-4 fs-5 review">
                “Such an incredible experience to visiting this restaurant.”
              </p>
            </div>
          </div>
          <div class="card p-5 text-center" style="width: 18rem">
            <img
              src="<?= BASEURL; ?>img/profiles/itay-verchik-6ZKGBzrDd3I-unsplash.jpg"
              class="rounded-circle card-img-top mx-auto border border-secondary-subtle"
              alt="Image profile"
            />
            <div class="card-body">
              <p class="card-text mt-4 fs-4 acme profile-name">Eliza</p>
              <p class="card-text mt-4 fs-5 review">
                “Such an incredible experience to visiting this restaurant.”
              </p>
            </div>
          </div>
          <div class="card p-5 text-center" style="width: 18rem">
            <img
              src="<?= BASEURL; ?>img/profiles/Antoni.jpg"
              class="rounded-circle card-img-top mx-auto border border-secondary-subtle"
              alt="Image profile"
            />
            <div class="card-body">
              <p class="card-text mt-4 fs-4 acme profile-name">Jake</p>
              <p class="card-text mt-4 fs-5 review">
                “All I can say is great food, great service.”
              </p>
            </div>
          </div>
          <div class="card p-5 text-center" style="width: 18rem">
            <img
              src="<?= BASEURL; ?>img/profiles/cesar-rincon-XHVpWcr5grQ-unsplash.jpg"
              class="rounded-circle card-img-top mx-auto border border-secondary-subtle"
              alt="Image profile"
            />
            <div class="card-body">
              <p class="card-text mt-4 fs-4 acme profile-name">Caesar</p>
              <p class="card-text mt-4 fs-5 review">
                “Such an incredible experience to visiting this restaurant.”
              </p>
            </div>
          </div>
          <div class="card p-5 text-center" style="width: 18rem">
            <img
              src="<?= BASEURL; ?>img/profiles/itay-verchik-6ZKGBzrDd3I-unsplash.jpg"
              class="rounded-circle card-img-top mx-auto border border-secondary-subtle"
              alt="Image profile"
            />
            <div class="card-body">
              <p class="card-text mt-4 fs-4 acme profile-name">Eliza</p>
              <p class="card-text mt-4 fs-5 review">
                “Such an incredible experience to visiting this restaurant.”
              </p>
            </div>
          </div>
        </div>
      </section>

      <section id="recognition">
        <div class="container">
          <h2 class="fs-2 acme text-center">
            RECOGNIZED <span class="text-warning acme">BY</span>
          </h2>

          <div id="awards" class="d-flex justify-content-around flex-wrap">
            <img
              src="<?= BASEURL; ?>img/recognition/2022-Good-Food-Award-Winner-01.png"
              alt="Awards Image"
              class="img-awards img-fluid ms-4"
            />
            <img
              src="<?= BASEURL; ?>img/recognition/BBCGF-Awards-2022_logo-reverse-gold.png"
              alt="Awards Image"
              class="img-awards img-fluid ms-4"
            />
            <img
              src="<?= BASEURL; ?>img/recognition/Openrice en.png"
              alt="Awards Image"
              class="img-awards img-fluid ms-4"
            />
            <img
              src="<?= BASEURL; ?>img/recognition/resto.png"
              alt="Awards Image"
              class="img-awards img-fluid ms-4"
            />
          </div>
        </div>
      </section>
      <section id="contact">
        <div class="container">
          <div class="row justify-content-between">
            <div class="col-lg-5 col-md-6 d-flex align-items-center">
              <div class="title d-block" id="contact-title">
                <h2
                  class="fs-4vw acme text-sm-center text-md-start"
                  id="title-contact"
                >
                  GET IN <br class="d-sm-none d-md-block" /><span
                    class="acme text-warning"
                    >TOUCH</span
                  >
                </h2>
              </div>
            </div>
            <div class="col-lg-5 col-md-6 mt-sm-4 mt-md-0">
              <form class="contact-form">
                <div class="mb-3">
                  <input
                    type="email"
                    class="form-control rounded-0"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    placeholder="Email"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                    required
                  />
                </div>
                <div class="mb-3">
                  <div class="form-floating">
                    <textarea
                      class="form-control rounded-0"
                      placeholder="Type here..."
                      id="floatingTextarea2"
                      style="height: 100px"
                      required
                    ></textarea>
                  </div>
                </div>
                <button
                  type="submit"
                  class="btn btn-warning text-warning-emphasis rounded-0 mt-3 submit-btn"
                >
                  Submit
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
      <section id="location">
        <div class="container">
          <h2 class="fs-2 text-center acme">
            OUR <span class="text-warning acme">LOCATION</span>
          </h2>
          <div class="ratio ratio-16x9 mt-5">
            <iframe
              class="shadow"
              src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
            ></iframe>
          </div>
        </div>
      </section>

      <footer class="bg-black pb-2 pt-4">
        <div
          class="container d-flex justify-content-between align-items-center"
        >
          <div class="company-copyrights">
            <p class="mt-2">
              &copy;<span class="acme">Deli</span
              ><span class="text-warning acme">ziosa</span> all rights reserved,
              2023.
            </p>
          </div>
          <div class="social-media d-inline-block mb-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="30"
              height="30"
              viewBox="0 0 30 30"
              fill="none"
              class="social-media-icon me-3"
            >
              <g clip-path="url(#clip0_12_66)">
                <path
                  d="M28.3438 0H1.65625C0.74125 0 0 0.74125 0 1.65625V28.345C0 29.2588 0.74125 30 1.65625 30H16.025V18.3825H12.115V13.855H16.025V10.5163C16.025 6.64125 18.3913 4.53125 21.8488 4.53125C23.505 4.53125 24.9275 4.655 25.3425 4.71V8.76L22.945 8.76125C21.065 8.76125 20.7013 9.655 20.7013 10.965V13.8562H25.185L24.6012 18.3837H20.7013V30H28.3463C29.2588 30 30 29.2587 30 28.3438V1.65625C30 0.74125 29.2587 0 28.3438 0Z"
                  fill="#F2F4F5"
                />
              </g>
              <defs>
                <clipPath id="clip0_12_66">
                  <rect width="30" height="30" fill="white" />
                </clipPath>
              </defs>
            </svg>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="30"
              height="30"
              viewBox="0 0 30 30"
              fill="none"
              class="social-media-icon me-3"
            >
              <g clip-path="url(#clip0_12_64)">
                <path
                  d="M30 5.69631C28.8962 6.18631 27.71 6.51631 26.465 6.66506C27.7363 5.90381 28.7125 4.69756 29.1712 3.26006C27.9825 3.96506 26.665 4.47756 25.2625 4.75381C24.1412 3.55756 22.54 2.81006 20.77 2.81006C16.7962 2.81006 13.8763 6.51756 14.7738 10.3663C9.66 10.1101 5.125 7.66006 2.08875 3.93631C0.47625 6.70256 1.2525 10.3213 3.9925 12.1538C2.985 12.1213 2.035 11.8451 1.20625 11.3838C1.13875 14.2351 3.1825 16.9026 6.1425 17.4963C5.27625 17.7313 4.3275 17.7863 3.3625 17.6013C4.145 20.0463 6.4175 21.8251 9.1125 21.8751C6.525 23.9038 3.265 24.8101 0 24.4251C2.72375 26.1713 5.96 27.1901 9.435 27.1901C20.8625 27.1901 27.3187 17.5388 26.9287 8.88256C28.1312 8.01381 29.175 6.93006 30 5.69631Z"
                  fill="#F2F4F5"
                />
              </g>
              <defs>
                <clipPath id="clip0_12_64">
                  <rect width="30" height="30" fill="white" />
                </clipPath>
              </defs>
            </svg>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="30"
              height="30"
              viewBox="0 0 30 30"
              fill="none"
              class="social-media-icon"
            >
              <g clip-path="url(#clip0_12_59)">
                <path
                  d="M15 2.70375C19.005 2.70375 19.48 2.71875 21.0625 2.79125C25.1275 2.97625 27.0262 4.905 27.2112 8.94C27.2837 10.5212 27.2975 10.9963 27.2975 15.0013C27.2975 19.0075 27.2825 19.4813 27.2112 21.0625C27.025 25.0938 25.1313 27.0262 21.0625 27.2112C19.48 27.2837 19.0075 27.2988 15 27.2988C10.995 27.2988 10.52 27.2837 8.93875 27.2112C4.86375 27.025 2.975 25.0875 2.79 21.0613C2.7175 19.48 2.7025 19.0063 2.7025 15C2.7025 10.995 2.71875 10.5212 2.79 8.93875C2.97625 4.905 4.87 2.975 8.93875 2.79C10.5212 2.71875 10.995 2.70375 15 2.70375ZM15 0C10.9262 0 10.4163 0.0175 8.81625 0.09C3.36875 0.34 0.34125 3.3625 0.09125 8.815C0.0175 10.4163 0 10.9262 0 15C0 19.0737 0.0175 19.585 0.09 21.185C0.34 26.6325 3.3625 29.66 8.815 29.91C10.4163 29.9825 10.9262 30 15 30C19.0737 30 19.585 29.9825 21.185 29.91C26.6275 29.66 29.6625 26.6375 29.9088 21.185C29.9825 19.585 30 19.0737 30 15C30 10.9262 29.9825 10.4163 29.91 8.81625C29.665 3.37375 26.6388 0.34125 21.1862 0.09125C19.585 0.0175 19.0737 0 15 0ZM15 7.2975C10.7463 7.2975 7.2975 10.7463 7.2975 15C7.2975 19.2537 10.7463 22.7038 15 22.7038C19.2537 22.7038 22.7025 19.255 22.7025 15C22.7025 10.7463 19.2537 7.2975 15 7.2975ZM15 20C12.2387 20 10 17.7625 10 15C10 12.2387 12.2387 10 15 10C17.7612 10 20 12.2387 20 15C20 17.7625 17.7612 20 15 20ZM23.0075 5.19375C22.0125 5.19375 21.2062 6 21.2062 6.99375C21.2062 7.9875 22.0125 8.79375 23.0075 8.79375C24.0012 8.79375 24.8062 7.9875 24.8062 6.99375C24.8062 6 24.0012 5.19375 23.0075 5.19375Z"
                  fill="#F5F5F5"
                />
              </g>
              <defs>
                <clipPath id="clip0_12_59">
                  <rect width="30" height="30" fill="white" />
                </clipPath>
              </defs>
            </svg>
          </div>
        </div>
      </footer>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASEURL; ?>js/contactvalidation.js"></script>
    <script>
      const navbar = document.querySelector("nav");
      window.onscroll = () => {
        if (this.scrollY <= 10)
          navbar.className = "navbar navbar-expand-lg py-3 fixed-top";
        else
          navbar.className =
            "navbar navbar-expand-lg py-3 fixed-top bg-semidark shadow-sm";
      };
    </script>
  </body>
</html>
