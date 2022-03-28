const hamburguer = document.getElementById('hamburguer');

hamburguer.addEventListener('click', e => {
    e.preventDefault();
    const navbar = document.querySelector('.navbar');
    if (!navbar.classList.contains('navbar-responsive')) {
        navbar.classList.add('navbar-responsive');
        containerBlack(navbar, 'navbar-responsive')

    } else {
        navbar.classList.remove('navbar-responsive');
        const containerblack = document.querySelector('.container-black');
        containerblack.remove();
    }

})