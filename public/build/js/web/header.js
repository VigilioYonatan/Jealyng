const hamburguer = document.getElementById('hamburguer');
const btnPerfil = document.getElementById('perfil_imagen');
const perfilInfo = document.querySelector('#perfilInfo');
const navbar = document.querySelector('.navbar');
const icoBuscador = document.getElementById('icoBuscador');
const input = document.querySelector('.header-search__inp')

icoBuscador.addEventListener('click', e => {
    e.preventDefault();
    const logo = document.querySelector('.header__logo');
    const search = document.querySelector('.header-search');
    search.classList.toggle('input-responsive');
    input.classList.toggle('show');
    logo.classList.toggle('hidden');
})
// dark mode 
const mode = document.querySelector('#mode');
// buscador 
const buscador = document.getElementById('buscador');
const mostrarBuscador = document.querySelector('.header-search__buscador');
// buscador 
buscador.addEventListener('keyup', e => {

    mostrarBuscador.classList.add('show');
    const palabra = e.target.value;
    apiProductosBuscar(palabra);




    // contendorBuscador.classList.add('mostrar');

})

document.addEventListener('click', (e) => {

    if (!e.target.classList.contains('header-search__buscador')) {
        mostrarBuscador.classList.remove('show');
    }
})

async function apiProductosBuscar(palabra) {
    const url = `http://localhost:3000/apiBuscadorNombreProducto?nombre=${palabra}`;
    try {
        const response = await fetch(url);
        const respuesta = await response.json();
        imprimirBuscador(respuesta.producto);
    } catch (error) {
        console.log(error);
    }
}


function imprimirBuscador(producto) {
    limpiarBuscador()
    if (producto.length <= 0) {
        const span = document.createElement('span');
        span.className = 'header-search__no'
        span.textContent = 'No se econtró productos';
        contendorBuscador.appendChild(span)
    }
    producto.forEach(pro => {
        const { id_prod, nombre_prod, imagen_prod, precio_prod } = pro;
        const regexName = /[$%&|<>#+-]/gi;
        const nombre = nombre_prod.replace(regexName, '_').split(' ').join('-')
        let html = `
        <a href='/producto?nombre=${nombre}' class="header-search__pro">
            <span>${id_prod}</span>
            <span>${nombre_prod}</span>
            <img src=" ./build/img/productos/${imagen_prod}" alt="${nombre_prod}">
            <span>S/ ${precio_prod} </span>
        </a>`;

        const div = document.createElement('div');
        div.innerHTML = html;

        contendorBuscador.appendChild(div.firstElementChild);
    });

}

function limpiarBuscador() {
    while (contendorBuscador.children[1]) {
        contendorBuscador.removeChild(contendorBuscador.children[1])
    }
}

// hamburguesa 

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

// modo oscuro 
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
