const formularioContenedor = document.querySelector('.formulario');
olvideContraseña.addEventListener('click', e => {
    e.preventDefault();
    const form = e.target.parentElement.parentElement;
    const formularioContainer = e.target.parentElement.parentElement.parentElement;
    form.classList.add('hidden');
    form.classList.remove('form');
    let html = `
                <h4 class="form__title">Recuperar Cuenta</h4>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="correo">Correo Electrónico:</label>
                    <div class="form-prop-inp">
                        <svg width="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M207.8 20.73c-93.45 18.32-168.7 93.66-187 187.1c-27.64 140.9 68.65 266.2 199.1 285.1c19.01 2.888 36.17-12.26 36.17-31.49l.0001-.6631c0-15.74-11.44-28.88-26.84-31.24c-84.35-12.98-149.2-86.13-149.2-174.2c0-102.9 88.61-185.5 193.4-175.4c91.54 8.869 158.6 91.25 158.6 183.2l0 16.16c0 22.09-17.94 40.05-40 40.05s-40.01-17.96-40.01-40.05v-120.1c0-8.847-7.161-16.02-16.01-16.02l-31.98 .0036c-7.299 0-13.2 4.992-15.12 11.68c-24.85-12.15-54.24-16.38-86.06-5.106c-38.75 13.73-68.12 48.91-73.72 89.64c-9.483 69.01 43.81 128 110.9 128c26.44 0 50.43-9.544 69.59-24.88c24 31.3 65.23 48.69 109.4 37.49C465.2 369.3 496 324.1 495.1 277.2V256.3C495.1 107.1 361.2-9.332 207.8 20.73zM239.1 304.3c-26.47 0-48-21.56-48-48.05s21.53-48.05 48-48.05s48 21.56 48 48.05S266.5 304.3 239.1 304.3z" />
                        </svg>
                        <input class="form-prop-inp__input" type="email" placeholder="Correo Electrónico..." id="correo">
                    </div>
                </div>
                <button class="form__btn">Recuperar</button>
                <div class="form-link">
                    <a class="form-link__link" href='#' id='btnAcceder'>Acceder</a>
                </div>
            `;
    const formulario = document.createElement('form');
    formulario.className = 'form';
    formulario.id = 'formularioRecuperar';
    formulario.innerHTML = html;
    formulario.appendChild(form);
    formularioContainer.prepend(formulario);

    const btnAcceder = document.getElementById('btnAcceder');

    btnAcceder.addEventListener('click', (e) => {
        e.preventDefault();
        form.classList.remove('hidden');
        form.classList.add('form');
        formularioRecuperar.remove();

    })

    formulario.addEventListener('submit', e => {
        e.preventDefault();
        let correoErrores = [];
        const correo = formulario.children[1].children[1].children[1].value;
        const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        // correo no debe estar vacio
        if (correo.length <= 0) {
            correoErrores = [...correoErrores, 'Correo Electrónico no debe estar vacio'];
        } else if (!regexCorreo.test(correo)) {
            correoErrores = [...correoErrores, 'Correo Inválido'];
        }
        //si están mal los inputs      
        imprimirErrores(correoErrores, formulario.children[1]);
        if (correoErrores.length <= 0) {
            const formularioRecuperar = document.querySelector('#formularioRecuperar');
            formularioRecuperar.classList.add('hidden');
            formularioRecuperar.classList.remove('form');
            loading(formularioContenedor)
            apiRecuperar(correo);
        }
    });
})


async function apiRecuperar(correo) {
    const url = 'http://localhost:3000/apiRecuperar';

    const formData = new FormData();
    formData.append('email_user', correo);
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        const formularioRecuperar = document.querySelector('#formularioRecuperar');
        console.log(respuesta);
        if (respuesta.correoInvalido) {

            formularioRecuperar.classList.remove('hidden');
            formularioRecuperar.classList.add('form');
            const spinner = document.querySelector('.spinner-loading');
            spinner.remove();
            msgError(respuesta.correoInvalido);
            return;
        }
        if (respuesta.respuesta) {
            formularioRecuperar.remove();
            const spinner = document.querySelector('.spinner-loading');
            spinner.remove();
            success(formularioContenedor, respuesta.respuesta)
            return;
        }
    } catch (error) {
        console.log(error);
    }
}
