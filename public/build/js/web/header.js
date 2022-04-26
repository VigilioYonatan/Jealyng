const hamburguer = document.getElementById('hamburguer');
const btnPerfil = document.getElementById('perfil_imagen');
const perfilInfo = document.querySelector('#perfilInfo');
const navbar = document.querySelector('.navbar');
const icoBuscador = document.getElementById('icoBuscador');
const input = document.querySelector('.header-search__inp')
// dark mode 
const mode = document.querySelector('#mode');
// buscador 
const buscador = document.getElementById('buscador');
const mostrarBuscador = document.querySelectorAll('.header-search__buscador');


icoBuscador.children[2].addEventListener('click', e => {
    e.preventDefault();
    const logo = document.querySelector('.header__logo');
    const search = document.querySelector('.header-search');
    icoBuscador.children[1].classList.toggle('show');

    if (icoBuscador.style.fill === 'var(--color-primary)') {
        icoBuscador.style.cssText = 'fill:#fff';
    } else {
        icoBuscador.style.cssText = 'fill:var(--color-primary)';
    }

    search.classList.toggle('input-responsive');
    input.classList.toggle('show');
    logo.classList.toggle('hidden');
})


icoBuscador.children[1].addEventListener('click', e => {
    icoBuscador.children[1].classList.add('hidden');
    icoBuscador.children[1].classList.remove('show');
    icoBuscador.children[0].classList.add('show');
    buscador.setAttribute('placeholder', 'Buscar usuarios');
})
icoBuscador.children[0].addEventListener('click', e => {
    icoBuscador.children[0].classList.add('hidden');
    icoBuscador.children[0].classList.remove('show');
    icoBuscador.children[1].classList.add('show');
    buscador.setAttribute('placeholder', 'Buscar productos');
})



// buscador 
buscador.addEventListener('keyup', e => {

    const palabra = e.target.value;

    if (e.target.getAttribute('placeholder') === 'Buscar usuarios') {
        mostrarBuscador[1].classList.add('show');
        mostrarBuscador[0].classList.remove('show');
        apiUsuariosBuscar(palabra);
        return;
    }
    if (e.target.getAttribute('placeholder') === 'Buscar productos') {
        mostrarBuscador[0].classList.add('show');
        mostrarBuscador[1].classList.remove('show');
        apiProductosBuscar(palabra);
        return;
    }

    // contendorBuscador.classList.add('mostrar');

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
async function apiUsuariosBuscar(palabra) {
    const url = `http://localhost:3000/apiBuscadorNombreUsuario?nombre=${palabra}`;
    try {
        const response = await fetch(url);
        const respuesta = await response.json();
        console.log(respuesta);
        imprimirUsuarios(respuesta.usuarios);
    } catch (error) {
        console.log(error);
    }
}


function imprimirUsuarios(usuarios) {
    limpiarBuscador(contendorBuscador2)
    if (usuarios.length <= 0) {
        const span = document.createElement('span');
        span.className = 'header-search__no'
        span.textContent = 'No se econtró Usuarios';
        contendorBuscador2.appendChild(span)
    }
    usuarios.forEach(user => {
        const { id_user, nick_user, imagen_user } = user;

        let html = `
        <a href='/perfil?user=${nick_user}' class="header-search__pro">
            <span>${id_user}</span>
            <span>${nick_user}</span>
            <img width="50px" src=" ./build/img/usuarios/${imagen_user}" alt="${nick_user}">
            
        </a>`;

        const div = document.createElement('div');
        div.innerHTML = html;

        contendorBuscador2.appendChild(div.firstElementChild);
    });

}
function imprimirBuscador(producto) {
    limpiarBuscador(contendorBuscador)
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

function limpiarBuscador(contenedor) {
    while (contenedor.children[1]) {
        contenedor.removeChild(contenedor.children[1])
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

    // perfilInfo.addEventListener('click', e => {
    //     console.log();
    //     if (e.target.contains.length < 1) {
    //         console.log('tas afuera');
    //     }
    // })
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


document.addEventListener('click', (e) => {

    if (!e.target.classList.contains('header-search__buscador')) {
        mostrarBuscador.forEach(e => e.classList.remove('show'))
    }


})