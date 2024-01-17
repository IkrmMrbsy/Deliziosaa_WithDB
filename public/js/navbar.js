let navbarToggle  = document.querySelector('.navbar-toggler-icon');
let bool = false;

navbarToggle.addEventListener('click', function() {
    let navbarContainer = document.querySelector('.navbar-container');
    console.log(navbarContainer);

    if(!bool) {
        bool = true;
        // navbarBrand.classList.add('opacity-out');
        // navbarBrand.classList.remove('opacity-on');

        let sideBar = document.querySelector('.sidebar');
        sideBar.classList.add('sidebar-in');
        sideBar.classList.remove('sidebar-out');
    } else {
        bool = false;
        // navbarBrand.classList.add('opacity-on');
        // navbarBrand.classList.remove('opacity-out');

        let sideBar = document.querySelector('.sidebar');
        sideBar.classList.add('sidebar-out');
        sideBar.classList.remove('sidebar-in');
    }
})