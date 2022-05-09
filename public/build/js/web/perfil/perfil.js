const formDatos = document.querySelector('#formularios');


const links = document.querySelector('#links');
const forms = document.querySelectorAll('.form');


let favoritosId = [];

links.addEventListener('click', e => {

    e.preventDefault();
    // limpiarFormularios(formDatos);

    if (e.target.dataset.link === 'datos') {

        forms[0].classList.remove('hidden');
        forms[1].classList.add('hidden');
        forms[2].classList.add('hidden');
        forms[3].classList.add('hidden');
    }
    if (e.target.dataset.link === 'direccion') {
        forms[0].classList.add('hidden');
        forms[1].classList.remove('hidden');
        forms[2].classList.add('hidden');
        forms[3].classList.add('hidden');
    }
    if (e.target.dataset.link === 'historial') {
        forms[0].classList.add('hidden');
        forms[1].classList.add('hidden');
        forms[2].classList.remove('hidden');
        forms[3].classList.add('hidden');
    }
    if (e.target.dataset.link === 'favoritos') {
        forms[0].classList.add('hidden');
        forms[1].classList.add('hidden');
        forms[2].classList.add('hidden');
        forms[3].classList.remove('hidden');
    }
})



function limpiarFormularios() {
    while (formUser.firstElementChild) {
        formUser.removeChild(formUser.firstElementChild)
    }
}

const nombre = forms[0].children[1].children[1].children[1];
const apellidoP = forms[0].children[2].children[1].children[1];
const apellidoM = forms[0].children[3].children[1].children[1];
const telefono = forms[0].children[4].children[1].children[1];
const fecha = forms[0].children[5].children[1].children[1];
forms[0].addEventListener('submit', e => {
    e.preventDefault();
    const values = {
        nombre: nombre.value,
        apellidoP: apellidoP.value,
        apellidoM: apellidoM.value,
        telefono: telefono.value,
        fecha: fecha.value
    };

    apiUpdateDatos(values);
})

async function apiUpdateDatos(values) {

    const { nombre, apellidoP, apellidoM, telefono, fecha } = values;
    const formData = new FormData;
    formData.append('nombre_user', nombre);
    formData.append('apellidoMaterno_user', apellidoM);
    formData.append('apellidoPaterno_user', apellidoP);
    formData.append('telefono_user', telefono);
    formData.append('nacimiento_user', fecha);

    const url = 'http://localhost:3000/apiPerfilDatos';
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
    } catch (error) {
        console.log(error);
    }
}

const departamento = forms[1].children[1].children[1].children[0]
const provincia = forms[1].children[2].children[1].children[0]
const distrito = forms[1].children[3].children[1].children[0]
const direccion = forms[1].children[4].children[1].children[1]

forms[1].addEventListener('submit', e => {
    e.preventDefault();
    const values = {
        departamento,
        provincia,
        distrito,
        direccion
    }
    apiPerfilEnvio(values);

})



const apiFavoritos = async () => {
    const url = 'http://localhost:3000/apiViewFavorito';
    try {
        const respuesta = await fetch(url);
        const resultado = await respuesta.json();
        if (resultado.fav) {
            favoritosId = resultado.favoritos;
            printFavoritos();
            return;
        }
    } catch (error) {
        console.log(error);
    }

}

apiFavoritos();





const printFavoritos = () => {


    limpiarFavoritos()
    if (favoritosId.length < 1) {
        const html = `<span class="cart-info__empty">No hay favoritos añadidos</span>`;
        const div = document.createElement('div');
        div.innerHTML = html;
        favoritosPe.append(div.firstElementChild);
    }
    let i = 1;
    favoritosId.forEach(fav => {
        const { idFavorito, id_prod, imagen_prod, nombre_prod, precio_prod } = fav;
        const regexName = /[$%&|<>#+-]/gi;
        const nombre = nombre_prod.replace(regexName, '_').split(' ').join('-');

        let html = `
                    <div class="tablaCarrito__products">
                    <span>${i++}</span>
                    <img src="./build/img/productos/${imagen_prod}" alt="">
                    <a
                        href="producto?nombre=${nombre}">${nombre_prod}</a>
                        <div class=" tablaCarrito__qty">
                        <svg Onclick="eliminar(${id_prod},${idFavorito})" width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                            xmlns=" http://www.w3.org/2000/svg">
                            <path class="icoFavoritoBTN" opacity="0.75"
                                d="M4.3314 12.0474L12 20L19.6686 12.0474C20.5211 11.1633 21 9.96429 21 8.71405C21 6.11055 18.9648 4 16.4543 4C15.2487 4 14.0925 4.49666 13.24 5.38071L12 6.66667L10.76 5.38071C9.90749 4.49666 8.75128 4 7.54569 4C5.03517 4 3 6.11055 3 8.71405C3 9.96429 3.47892 11.1633 4.3314 12.0474Z"
                                fill="red" />
                            <path d=" M4.3314 12.0474L12 20L19.6686 12.0474C20.5211 11.1633 21 9.96429 21 8.71405C21
                                6.11055 18.9648 4 16.4543 4C15.2487 4 14.0925 4.49666 13.24 5.38071L12 6.66667L10.76
                                5.38071C9.90749 4.49666 8.75128 4 7.54569 4C5.03517 4 3 6.11055 3 8.71405C3 9.96429
                                3.47892 11.1633 4.3314 12.0474Z" stroke="#000" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    </div>`;
        const div = document.createElement('div');
        div.innerHTML = html;
        favoritosPe.append(div.firstElementChild);
    })
}

const eliminar = (id_prod, idFavorito) => {
    const confirmar = confirm('Deseas quitar este productos  de tus favoritos');
    if (confirmar) {

        eliminarFavorito(id_prod, idFavorito);
    }
}


function limpiarFavoritos() {
    while (favoritosPe.children[1]) {
        favoritosPe.removeChild(favoritosPe.children[1])
    }

}

const eliminarFavorito = async (id_prod, idFavorito) => {

    const url = `http://localhost:3000/apiRemoveFavorito`;
    const formData = new FormData;
    formData.append('idFavorito', idFavorito);
    formData.append('id_prod', id_prod);
    try {
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formData,
        });
        const resultado = await respuesta.json();
        if (resultado.resultado) {


            favoritosId = favoritosId.filter(fav => fav.idFavorito != resultado.eliminado);


            printFavoritos();
        }
    } catch (error) {
        console.log(error);
    }
}

async function apiPerfilEnvio(values) {

    const { departamento, provincia, distrito, direccion } = values;
    const url = 'http://localhost:3000/apiPerfilEnvio';


    const formData = new FormData;
    formData.append('departamento', departamento.value);
    formData.append('provincia', provincia.value);
    formData.append('distrito', distrito.value);
    formData.append('direccion', direccion.value);
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
    } catch (error) {
        console.log(error);
    }
}