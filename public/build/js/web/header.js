const hamburguer = document.getElementById('hamburguer');
const btnPerfil = document.getElementById('perfil_imagen');
const perfilInfo = document.querySelector('#perfilInfo');
const navbar = document.querySelector('.navbar');
const mode = document.querySelector('#mode');
hamburguer.addEventListener('click', e => {
    e.preventDefault();

    if (!navbar.classList.contains('navbar-responsive')) {
        navbar.classList.add('navbar-responsive');
        containerBlack(navbar, 'navbar-responsive', hamburguer)
        hamburguer.children[0].classList.add('hidden');
        hamburguer.children[1].classList.remove('hidden');
        if (perfilInfo) {
            perfilInfo.classList.add('hidden');
            perfilInfo.classList.remove('mostrar');
        }

    } else {
        hamburguer.children[0].classList.remove('hidden');
        hamburguer.children[1].classList.add('hidden');
        navbar.classList.remove('navbar-responsive');
        const containerblack = document.querySelector('.container-black');

        containerblack.remove();
    }

})
if (btnPerfil) {
    btnPerfil.addEventListener('click', e => {
        e.preventDefault();
        navbar.classList.remove('navbar-responsive');
        const containerblack = document.querySelector('.container-black');
        if (containerblack) {
            containerblack.remove();
        }


        perfilInfo.classList.toggle('mostrar');

    })
}

const thema = localStorage.getItem('theme');
document.documentElement.dataset.theme = thema;
mode.addEventListener('click', e => {
    e.preventDefault();
    console.log(document.documentElement.dataset);
    if (document.documentElement.dataset.theme !== 'dark') {
        getLocalStorageTheme('dark');
        mode.children[0].classList.add('hidden');
        mode.children[1].classList.remove('hidden');
        document.documentElement.setAttribute('data-theme', 'dark');
    } else {
        getLocalStorageTheme('');
        mode.children[0].classList.remove('hidden');
        mode.children[1].classList.add('hidden');
        document.documentElement.setAttribute('data-theme', 'light');
    }

});

function getLocalStorageTheme(tipo) {
    localStorage.setItem("theme", tipo);
}
