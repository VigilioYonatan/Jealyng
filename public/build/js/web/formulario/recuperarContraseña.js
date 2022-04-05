const eyeOpen = document.getElementById('eye-open');
const eyeClose = document.getElementById('eye-close');
const formularioContenedor = document.querySelector('.formulario');
const form = document.getElementById('formulario');
const password1 = form.children[1].children[1].children[1];
const password2 = form.children[2].children[1].children[1];
const token = form.dataset.id;
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

form.addEventListener('submit', e => {
    e.preventDefault(); // evitar que recargue pagina

    // insertando los inputs en un obj
    const values = {
        password: password1.value.trim(),
        password2: password2.value.trim(),
        token: token
    }
    console.log(values);

    // llamando funcion validar formulario
    validarFormulario(values);
    // password.value = '';
    // password2.value = '';
})

// funcion validarFormulario
function validarFormulario(values) {
    // destructuring obj 
    const { password, password2, token } = values;

    //errores
    let errorPassword = [],
        errorPassword2 = [];


    //password no debe estar vacio
    if (password.length <= 0) errorPassword = [...errorPassword, 'Contraseña no debe estar vacio']
    if (password.length >= 1 && password.length <= 5) errorPassword = [...errorPassword, 'Contraseña demasiado corto min 6 carácteres'];

    //repita contraseña no debe estar vacia
    if (password2.length <= 0) errorPassword2 = [...errorPassword2, 'Contraseña no debe estar vacio']
    //repita contraseña
    if (password2 !== password) errorPassword2 = [...errorPassword2, 'Las contraseñas no son similares'];

    //si están bien los inputs
    imprimirBuenas(form.children[1])
    imprimirBuenas(form.children[2])


    //si están mal los inputs      
    imprimirErrores(errorPassword, form.children[1]);
    imprimirErrores(errorPassword2, form.children[2]);


    // si no hay errores consultar api
    if (errorPassword.length <= 0 &&
        errorPassword2.length <= 0) {
        console.log('hola');
        form.classList.add('hidden');
        loading(formularioContenedor)
        apiRecuperarContraseña(values);
    }

}

async function apiRecuperarContraseña(values) {
    const spinner = document.querySelector('.spinner-loading');

    const { password, password2, token } = values;

    const formData = new FormData();
    formData.append('token', token);
    formData.append('password_user', password2);

    const url = 'http://localhost:3000/recuperar-cuenta-contraseña';

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        })
        const respuesta = await response.json();
        console.log(respuesta);
        if (respuesta.resultado) {
            spinner.remove();
            form.remove();
            success(formularioContenedor, respuesta.mensaje);
            return;
        }
        if (respuesta.error) {
            const spinner = document.querySelector('.spinner-loading');
            spinner.remove();
            form.remove();
            getError(formularioContenedor, respuesta.mensaje);
        }
    } catch (error) {
        spinner.remove();
        form.remove();
        getError(formularioContenedor, 'Ups.. Hubo un error en nuestro sistema :c');
    }
}