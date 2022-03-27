const form = document.getElementById('formulario');

const correo = form.children[1].children[1].children[1];
const password = form.children[2].children[1].children[1];
const eyeOpen = document.getElementById('eye-open');
const eyeClose = document.getElementById('eye-close');

form.addEventListener('submit', e => {
    e.preventDefault(); // evitar que recargue pagina

    // insertando los inputs en un obj
    const values = {
        correo: correo.value.trim(),
        password: password.value.trim()
    }

    // llamando funcion validar formulario
    validarFormulario(values);
    password.value = '';

})

//para que muestre la contraseña
eyeOpen.addEventListener('click', () => {
    password.setAttribute('type', 'text');
    eyeOpen.classList.add('hidden');
    eyeClose.classList.remove('hidden');
})
eyeClose.addEventListener('click', () => {
    password.setAttribute('type', 'password');
    eyeClose.classList.add('hidden');
    eyeOpen.classList.remove('hidden');
})

// funcion validarFormulario
function validarFormulario(values) {
    // destructuring obj 
    const { correo, password } = values;

    //errores
    let errorCorreo = [],
        errorPassword = [];

    // correo no debe estar vacio
    if (correo.length <= 0) errorCorreo = [...errorCorreo, 'Correo Electrónico no debe estar vacio'];
    //solo correos validos
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexCorreo.test(correo)) errorCorreo = [...errorCorreo, 'Correo Inválido'];
    //password no debe estar vacio
    if (password.length <= 0) errorPassword = [...errorPassword, 'Contraseña no debe estar vacio']
    if (password.length >= 1 && password.length <= 5) errorPassword = [...errorPassword, 'Contraseña demasiado corto min 6 carácteres'];


    //si están bien los inputs
    imprimirBuenas(form.children[1])
    imprimirBuenas(form.children[2])


    //si están mal los inputs      
    imprimirErrores(errorCorreo, form.children[1]);
    imprimirErrores(errorPassword, form.children[2]);

    // si no hay errores consultar api
    if (errorCorreo.length <= 0 &&
        errorPassword.length <= 0)
        apiLogin(values);

}

function imprimirBuenas(lugar) {
    lugar.children[1].style.cssText = 'border:2px solid green';
}

function imprimirErrores(error, lugar) {
    limpiarError(lugar);
    error.forEach(text => {
        html = `<span class='spanError'>
        <svg class='icoError'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg>
        ${text}</span>`;
        const div = document.createElement('div');
        div.innerHTML = html;

        lugar.appendChild(div.firstElementChild);
        lugar.children[1].style.cssText = 'border:2px solid rgb(155, 39, 39)';
    })

}

function limpiarError(lugar) {
    while (lugar.children[2]) {
        lugar.removeChild(lugar.children[2]);
    }
}

// api login 
async function apiLogin(values) {

    // destructuring obj 
    const { correo, password } = values;

    const formData = new FormData();
    formData.append('email_user', correo);
    formData.append('password_user', password);
    const url = 'http://localhost:3000/apiLogin';
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        })
        const respuesta = await response.json();
        console.log(respuesta);
        if (respuesta.login) {
            msgError(respuesta.login)
            return;
        }
        if (respuesta.passwordInvalido) {
            msgError(respuesta.passwordInvalido);
            return;
        }
        if (respuesta.logueado) {
            msgSuccess(respuesta.logueado);
            setTimeout(() => {
                window.open('/', '_self');
            }, 3000)
            return;
        }

    } catch (error) {
        console.log(error);
    }
}