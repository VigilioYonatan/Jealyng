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
        form.remove();
        getError(formularioContenedor, 'Ups.. Hubo un error en nuestro sistema :c');
    }
}