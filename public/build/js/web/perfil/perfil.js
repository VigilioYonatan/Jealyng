// const formDatos = document.querySelector('#formDatos');


const links = document.querySelector('#links');
imprimirDatos();
links.addEventListener('click', e => {

    e.preventDefault();
    limpiarFormularios();

    if (e.target.dataset.link === 'datos') {
        imprimirDatos();
        // console.log(e.target.classList.contains('selected'));


    }
    if (e.target.dataset.link === 'direccion') {
        imprimirDireccion();

    }
})

const formUser = document.querySelector('#formularios');

let usuario = {};


// limpiarFormularios()
async function imprimirDatos() {
    const url = 'http://localhost:3000/apiUserPerfil';
    try {
        const response = await fetch(url);
        const respuesta = await response.json();
        console.log(respuesta);
        if (respuesta.usuario) {
            usuario = respuesta.usuario;
            imprimirUsuariosDatos();

        }
    } catch (error) {
        console.log(error);
    }
}

function imprimirUsuariosDatos() {
    const { id_user,
        nombre_user,
        apellidoMaterno_user,
        apellidoPaterno_user,
        direccion_user,
        email_user,
        imagen_user,
        nacimiento_user,
        telefono_user } = usuario;
    let html = `
    <form  class="form show " id="formDatos" data-form="datos">
                <h4 class="form__title">Datos Personales</h4>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="nombre">Nombre:</label>
                    <div class="form-prop-inp">
                        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">

                            <path
                                d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z" />
                        </svg>
                        <input class="form-prop-inp__input" type="text" placeholder="Nombre de usuario..." id="nombre"
                            value="${nombre_user}">
                    </div>
                </div>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="apellidoPaterno">Apellido Paterno:</label>
                    <div class="form-prop-inp">
                        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path
                                d="M224 64C224 99.35 195.3 128 160 128C124.7 128 96 99.35 96 64C96 28.65 124.7 0 160 0C195.3 0 224 28.65 224 64zM144 384V480C144 497.7 129.7 512 112 512C94.33 512 80.01 497.7 80.01 480V287.8L59.09 321C49.67 336 29.92 340.5 14.96 331.1C.0016 321.7-4.491 301.9 4.924 286.1L44.79 223.6C69.72 184 113.2 160 160 160C206.8 160 250.3 184 275.2 223.6L315.1 286.1C324.5 301.9 320 321.7 305.1 331.1C290.1 340.5 270.3 336 260.9 321L240 287.8V480C240 497.7 225.7 512 208 512C190.3 512 176 497.7 176 480V384L144 384z" />
                        </svg>
                        <input class="form-prop-inp__input" type="text" placeholder="Apellido Paterno..."
                            id="apellidoPaterno" value="${apellidoPaterno_user}">
                    </div>
                </div>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="apellidoMaterno">Apellido Materno:</label>
                    <div class="form-prop-inp">
                        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path
                                d="M223.1 64C223.1 99.35 195.3 128 159.1 128C124.7 128 95.1 99.35 95.1 64C95.1 28.65 124.7 0 159.1 0C195.3 0 223.1 28.65 223.1 64zM70.2 400C59.28 400 51.57 389.3 55.02 378.9L86.16 285.5L57.5 323.3C46.82 337.4 26.75 340.2 12.67 329.5C-1.415 318.8-4.175 298.7 6.503 284.7L65.4 206.1C87.84 177.4 122.9 160 160 160C197.2 160 232.2 177.4 254.6 206.1L313.5 284.7C324.2 298.7 321.4 318.8 307.3 329.5C293.3 340.2 273.2 337.4 262.5 323.3L233.9 285.6L264.1 378.9C268.4 389.3 260.7 400 249.8 400H232V480C232 497.7 217.7 512 200 512C182.3 512 168 497.7 168 480V400H152V480C152 497.7 137.7 512 120 512C102.3 512 88 497.7 88 480V400H70.2z" />
                        </svg>
                        <input class="form-prop-inp__input" type="text" placeholder="Apellido Materno..."
                            id="apellidoMaterno" value="${apellidoMaterno_user}">
                    </div>
                </div>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="telefono">Telefono:</label>
                    <div class="form-prop-inp">
                        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z" />
                        </svg>
                        <input class="form-prop-inp__input" type="tel" placeholder="Telefono..." id="telefono"
                            value="${telefono_user}">
                    </div>
                </div>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="nacimiento">Fecha de Nacimiento:</label>
                    <div class="form-prop-inp">
                        <svg class="ico-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M255.1 192H.1398C2.741 117.9 41.34 52.95 98.98 14.1C112.2 5.175 129.8 9.784 138.9 22.92L255.1 192zM384 160C384 124.7 412.7 96 448 96H480C497.7 96 512 110.3 512 128C512 145.7 497.7 160 480 160H448V224C448 249.2 442.2 274.2 430.9 297.5C419.7 320.8 403.2 341.9 382.4 359.8C361.6 377.6 336.9 391.7 309.7 401.4C282.5 411 253.4 416 223.1 416C194.6 416 165.5 411 138.3 401.4C111.1 391.7 86.41 377.6 65.61 359.8C44.81 341.9 28.31 320.8 17.05 297.5C5.794 274.2 0 249.2 0 224H384L384 160zM31.1 464C31.1 437.5 53.49 416 79.1 416C106.5 416 127.1 437.5 127.1 464C127.1 490.5 106.5 512 79.1 512C53.49 512 31.1 490.5 31.1 464zM416 464C416 490.5 394.5 512 368 512C341.5 512 320 490.5 320 464C320 437.5 341.5 416 368 416C394.5 416 416 437.5 416 464z" />
                        </svg>
                        <input class="form-prop-inp__input" type="date" id="nacimiento"
                            value="${nacimiento_user}">
                    </div>
                </div>


                <button class="form__btn">
                    <svg class="ico-form2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z" />
                    </svg>Actualizar</button>
            </form>
    `;

    const div = document.createElement('div');
    div.innerHTML = html;


    formUser.appendChild(div.firstElementChild);

    const formDatos = document.querySelector('#formDatos');
    console.log(formDatos);

    const nombre = formDatos.children[1].children[1].children[1];
    const apellidoP = formDatos.children[2].children[1].children[1];
    const apellidoM = formDatos.children[3].children[1].children[1];
    const telefono = formDatos.children[4].children[1].children[1];
    const nacimiento = formDatos.children[5].children[1].children[1];
    formDatos.addEventListener('submit', e => {

        e.preventDefault();

        const values = {
            nombre: nombre.value,
            apellidoP: apellidoP.value,
            apellidoM: apellidoM.value,
            telefono: telefono.value,
            nacimiento: nacimiento.value,
        };
        validarFormulario(values);

    });

}



function validarFormulario(values) {
    const { nombre, apellidoP, apellidoM, telefono, nacimiento } = values;
    //errores
    let errorNombre = [],
        errorApellidoP = [],
        errorApellidoM = [],
        errorTelefono = [];


    // nombre no debestar vacio
    if (nombre.length <= 0) errorNombre = [...errorNombre, 'Nombre no debe estar vacio'];
    // mayor a 3 caracteres
    if (nombre.length >= 1 && nombre.length < 3) errorNombre = [...errorNombre, 'Nombre demasiado corto min 3 carácteres'];
    if (nombre.length > 15) errorNombre = [...errorNombre, 'Nombre demasiado largo min 15 carácteres'];
    // validar solo letras
    const regex = /^[a-zA-Z\s]*$/;
    if (!regex.test(nombre)) errorNombre = [...errorNombre, 'Solo está permitido letras'];


    // mayor a 3 caracteres
    if (apellidoP.length >= 1 && apellidoP.length < 3) errorApellidoP = [...errorApellidoP, 'Apellido Paterno corto min 3 carácteres'];
    if (apellidoP.length > 20) errorApellidoP = [...errorApellidoP, 'Apellido Paterno largo min 15 carácteres'];
    // validar solo letras

    if (!regex.test(apellidoP)) errorApellidoP = [...errorApellidoP, 'Solo está permitido letras'];


    // mayor a 3 caracteres
    if (apellidoM.length >= 1 && apellidoM.length < 3) errorApellidoM = [...errorApellidoM, 'Apellido Paterno corto min 3 carácteres'];
    if (apellidoM.length > 20) errorApellidoM = [...errorApellidoM, 'Apellido Paterno largo min 15 carácteres'];
    // validar solo letras
    if (!regex.test(apellidoM)) errorApellidoM = [...errorApellidoM, 'Solo está permitido letras'];


    const regexNumero = /^[0-9]*$/;
    if (!regexNumero.test(telefono)) errorTelefono = [...errorTelefono, 'Solo se permite numeros'];
    if (telefono.length <= 1 && telefono.length >= 15 && telefono.length <= 8) errorTelefono = [...errorTelefono, 'Numero de digitos inválidos'];

    //si están bien los inputs
    imprimirBuenas(formDatos.children[1])
    imprimirBuenas(formDatos.children[2])
    imprimirBuenas(formDatos.children[3])
    imprimirBuenas(formDatos.children[4])
    imprimirBuenas(formDatos.children[5])

    //si están mal los inputs
    imprimirErrores(errorNombre, formDatos.children[1]);
    imprimirErrores(errorApellidoP, formDatos.children[2]);
    imprimirErrores(errorApellidoM, formDatos.children[3]);
    imprimirErrores(errorTelefono, formDatos.children[4]);


    const formContenedor = formDatos.parentElement;

    // si no hay errores consultar api
    if (errorNombre.length <= 0 &&
        errorApellidoP.length <= 0 &&
        errorApellidoM.length <= 0 &&
        errorTelefono.length <= 0) {
        formDatos.classList.add('hidden');
        loading(formContenedor)
        apiActualizarDato(values);
    }
}

function imprimirDireccion() {
    const { id_user,
        nombre_user,
        apellidoMaterno_user,
        apellidoPaterno_user,
        direccion_user,
        email_user,
        imagen_user,
        nacimiento_user,
        telefono_user } = usuario;
    let html = `
    <form  class="form" id="formDatos" data-form="datos">
                <h4 class="form__title">Origen de Envío</h4>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="departamento">Departamento:</label>
                    <div class="form-prop-inpSelect ">
                        <select id='departamento' class="form-prop-inp__select" >
                        
                        </select>
                    </div>
                </div>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="provincia">Provincia:</label>
                    <div class="form-prop-inpSelect ">
                        <select id='provincia' class="form-prop-inp__select" >
                        
                        </select>
                    </div>
                </div>
                <div class="form-prop">
                    <label class="form-prop__lbl" for="distrito">Distrito:</label>
                    <div class="form-prop-inpSelect ">
                        <select id='distrito' class="form-prop-inp__select" >
                        
                        </select>
                    </div>
                </div>
                
                
                <button class="form__btn">
                    <svg class="ico-form2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z" />
                    </svg>Actualizar</button>
            </form>
    `;

    const div = document.createElement('div');
    div.innerHTML = html;


    formUser.appendChild(div.firstElementChild);
    apiMostrarDepartamento();
    apiMostrarProvincias()
    apiMostrarDistritos();
    const formDatos = document.querySelector('#formDatos');
    console.log(formDatos);


}

async function apiMostrarProvincias() {
    const url = 'http://localhost:3000/apiUserProvincia';
    try {
        const response = await fetch(url);
        const respuesta = await response.json();
        imprimirProvincias(respuesta.provincia);
    } catch (error) {
        console.log(error);
    }
}


function imprimirProvincias(provincia) {
    provincia.forEach(({ idProvincia, provincia }) => {
        const option = document.createElement('option');
        option.value = idProvincia;
        option.textContent = provincia

        const provincias = document.getElementById('provincia');
        provincias.appendChild(option);
    });
}
async function apiMostrarDepartamento() {
    const url = 'http://localhost:3000/apiUserDepartamento';
    try {
        const response = await fetch(url);
        const respuesta = await response.json();
        console.log(respuesta);
        imprimirDepartamentos(respuesta.departamentos);
    } catch (error) {
        console.log(error);
    }
}


function imprimirDepartamentos(departamentos) {
    departamentos.forEach(({ idDepartamento, departamento }) => {
        const option = document.createElement('option');
        option.value = idDepartamento;
        option.textContent = departamento

        const departamentos = document.getElementById('departamento');
        departamentos.appendChild(option);
    });
}
async function apiMostrarDistritos() {
    const url = 'http://localhost:3000/apiUserDistritos';
    try {
        const response = await fetch(url);
        const respuesta = await response.json();
        console.log(respuesta);
        imprimirDistritos(respuesta.distrito);
    } catch (error) {
        console.log(error);
    }
}


function imprimirDistritos(distrito) {
    distrito.forEach(({ idDistrito, distrito }) => {
        const option = document.createElement('option');
        option.value = idDistrito;
        option.textContent = distrito

        const distritos = document.getElementById('distrito');
        distritos.appendChild(option);
    });
}


async function apiActualizarDato(values) {
    const { nombre, apellidoP, apellidoM, telefono, nacimiento } = values;

    const formData = new FormData();
    formData.append('nombre_user', nombre);
    formData.append('apellidoPaterno_user', apellidoP);
    formData.append('apellidoMaterno_user', apellidoM);
    formData.append('telefono_user', telefono);
    formData.append('nacimimiento_user', nacimiento);

    const url = 'http://localhost:3000/apiPerfilDatos';
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        console.log(respuesta);
        if (respuesta.resultado) {
            const spinner = document.querySelector('.spinner-loading');
            spinner.remove();
            successProfile(formUser, respuesta.resultado);
            const nombre1 = document.querySelector('.header-info-user__title b');
            const nombre2 = document.querySelector('.perfil-info-user__title');
            const nombreImagen = document.querySelector('.header-info-user__perfil');
            const nombreHeader = document.querySelector('.header-info-perfil span');
            nombre1.textContent = nombre;
            nombre2.textContent = nombre;
            if (nombreImagen) { nombreImagen.textContent = nombre[0]; }

            if (nombreHeader) { nombreHeader.textContent = nombre[0]; }
        }
    } catch (error) {
        console.log(error);
    }
}

function limpiarFormularios() {
    while (formUser.firstElementChild) {
        formUser.removeChild(formUser.firstElementChild)
    }
}
