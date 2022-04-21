const formDatos = document.querySelector('#formularios');


const links = document.querySelector('#links');
const forms = document.querySelectorAll('.form');
links.addEventListener('click', e => {

    e.preventDefault();
    // limpiarFormularios(formDatos);

    if (e.target.dataset.link === 'datos') {

        forms[0].classList.remove('hidden');
        forms[1].classList.add('hidden');
        forms[2].classList.add('hidden');
    }
    if (e.target.dataset.link === 'direccion') {
        forms[0].classList.add('hidden');
        forms[1].classList.remove('hidden');
        forms[2].classList.add('hidden');
    }
    if (e.target.dataset.link === 'historial') {
        forms[0].classList.add('hidden');
        forms[1].classList.add('hidden');
        forms[2].classList.remove('hidden');
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
        console.log(respuesta);
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
        console.log(respuesta);
    } catch (error) {
        console.log(error);
    }
}