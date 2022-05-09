// mensaje erroneas
function msgError(mensaje) {
    let html = `<span class='msg-error'><svg class='icoError' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM232 152C232 138.8 242.8 128 256 128s24 10.75 24 24v128c0 13.25-10.75 24-24 24S232 293.3 232 280V152zM256 400c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 385.9 273.4 400 256 400z"/></svg> ${mensaje}</span>`;
    const div = document.createElement('div');
    div.innerHTML = html;
    document.body.prepend(div.firstElementChild);
}
//mensajes correctos
function msgSuccess(mensaje) {
    let html = `<span class='msg-success'><svg class='icoError' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M274.7 304H173.3C77.61 304 0 381.6 0 477.3C0 496.5 15.52 512 34.66 512H413.3C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM632.3 134.4c-9.703-9-24.91-8.453-33.92 1.266l-87.05 93.75l-38.39-38.39c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l56 56C499.5 285.5 505.6 288 512 288h.4375c6.531-.125 12.72-2.891 17.16-7.672l104-112C642.6 158.6 642 143.4 632.3 134.4z"/></svg>${mensaje}</span>`;
    const div = document.createElement('div');
    div.innerHTML = html;
    document.body.prepend(div.firstElementChild);
}
//mensajes correctosIco
function msgSuccessFavorito(mensaje) {
    const favoritoMessage = document.querySelector('.msg-error');
    if (favoritoMessage) {
        favoritoMessage.remove();
    }
    let html = `<span class='msg-error'><svg class='icoError' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/></svg>${mensaje}</span>`;
    const div = document.createElement('div');
    div.innerHTML = html;
    document.body.prepend(div.firstElementChild);


}

//success
function success(container, mensaje) {
    let html = `<div class='success-container'>
                    <h4 class='success-container__title'>Felicidades</h4>
                    <span class='success-container__txt'>${mensaje}</span>
                    <svg class='success-container__ico' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M464 64C490.5 64 512 85.49 512 112C512 127.1 504.9 141.3 492.8 150.4L478.9 160.8C412.3 167.2 356.5 210.8 332.6 270.6L275.2 313.6C263.8 322.1 248.2 322.1 236.8 313.6L19.2 150.4C7.113 141.3 0 127.1 0 112C0 85.49 21.49 64 48 64H464zM294.4 339.2L320.8 319.4C320.3 324.9 320 330.4 320 336C320 378.5 335.1 417.6 360.2 448H64C28.65 448 0 419.3 0 384V176L217.6 339.2C240.4 356.3 271.6 356.3 294.4 339.2zM640 336C640 415.5 575.5 480 496 480C416.5 480 352 415.5 352 336C352 256.5 416.5 192 496 192C575.5 192 640 256.5 640 336zM540.7 292.7L480 353.4L451.3 324.7C445.1 318.4 434.9 318.4 428.7 324.7C422.4 330.9 422.4 341.1 428.7 347.3L468.7 387.3C474.9 393.6 485.1 393.6 491.3 387.3L563.3 315.3C569.6 309.1 569.6 298.9 563.3 292.7C557.1 286.4 546.9 286.4 540.7 292.7H540.7z"/></svg>
                </div>`;
    const div = document.createElement('div');
    div.innerHTML = html;
    container.prepend(div.firstElementChild);
}
//success
function successProfile(container, mensaje, eliminar1) {
    let html = `<div class='success-container3'>
                    <div class="mostrar-card-container3">
                        <h4 class='success-container__title'>Felicidades</h4>
                        <span class='success-container__txt'>${mensaje}</span>
                        <svg class='success-container__ico' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M223.1 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 223.1 256zM274.7 304H173.3C77.61 304 0 381.7 0 477.4C0 496.5 15.52 512 34.66 512h286.4c-1.246-5.531-1.43-11.31-.2832-17.04l14.28-71.41c1.943-9.723 6.676-18.56 13.68-25.56l45.72-45.72C363.3 322.4 321.2 304 274.7 304zM371.4 420.6c-2.514 2.512-4.227 5.715-4.924 9.203l-14.28 71.41c-1.258 6.289 4.293 11.84 10.59 10.59l71.42-14.29c3.482-.6992 6.682-2.406 9.195-4.922l125.3-125.3l-72.01-72.01L371.4 420.6zM629.5 255.7l-21.1-21.11c-14.06-14.06-36.85-14.06-50.91 0l-38.13 38.14l72.01 72.01l38.13-38.13C643.5 292.5 643.5 269.7 629.5 255.7z"/></svg>
                        <span class="mostrar-card__close">X</span>
                    </div>
                </div>`;
    const div = document.createElement('div');
    div.innerHTML = html;
    container.appendChild(div.firstElementChild);

    const btnClose = document.querySelector('.mostrar-card__close');
    const modalBlacks = document.querySelector('.container-black2');

    btnClose.addEventListener('click', e => {
        eliminar1.remove();
        modalBlacks.remove();
    })

}
//success
function getError(container, mensaje) {
    let html = `<div class='success-container'>
                    <h4 class='success-container__title'>Upss...</h4>
                    <span class='success-container__txt'>${mensaje}</span>
                    <svg class='success-container__icoError' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM232 152C232 138.8 242.8 128 256 128s24 10.75 24 24v128c0 13.25-10.75 24-24 24S232 293.3 232 280V152zM256 400c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 385.9 273.4 400 256 400z"/></svg>
                    <a class='enlace__error' href='/'>Ir a inicio</a>
                </div>`;
    const div = document.createElement('div');
    div.innerHTML = html;
    container.prepend(div.firstElementChild);
}

//cargando

function loading(container) {
    let html = `
    <div class='spinner-loading'>
        <div class="sk-fading-circle">
            <div class="sk-circle1 sk-circle"></div>
            <div class="sk-circle2 sk-circle"></div>
            <div class="sk-circle3 sk-circle"></div>
            <div class="sk-circle4 sk-circle"></div>
            <div class="sk-circle5 sk-circle"></div>
            <div class="sk-circle6 sk-circle"></div>
            <div class="sk-circle7 sk-circle"></div>
            <div class="sk-circle8 sk-circle"></div>
            <div class="sk-circle9 sk-circle"></div>
            <div class="sk-circle10 sk-circle"></div>
            <div class="sk-circle11 sk-circle"></div>
            <div class="sk-circle12 sk-circle"></div>
    </div>
    </div>`
        ;
    const div = document.createElement('div');
    div.innerHTML = html;
    container.prepend(div.firstElementChild);

}

//imprimir errores formulario

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


function imprimirBuenas(lugar) {
    lugar.children[1].style.cssText = 'border:2px solid green';
}

//limpiar error
function limpiarError(lugar) {
    while (lugar.children[2]) {
        lugar.removeChild(lugar.children[2]);
    }
}
//limpiar 
function limpiar(lugar) {
    while (lugar.firstElementChild) {
        lugar.removeChild(lugar.firstElementChild);
    }
}

// para los fondos negros al abrir 
function containerBlack(contenido, clase, hmb) {
    const div = document.createElement('div');
    div.className = 'container-black';
    document.body.prepend(div);
    div.addEventListener('click', () => {
        contenido.classList.remove(clase);
        hmb.children[1].classList.add('hidden');
        hmb.children[0].classList.remove('hidden');
        div.remove();
    })
}


// modal black
function modalBlack() {
    const div = document.createElement('div');
    div.className = 'container-black2';
    document.body.prepend(div);

}

// abrirImagen
function abrirImagen(mensaje) {
    const { titulo, mess, alerta } = mensaje;
    const html = `
    <form class="mostrar-card">
    <div class="mostrar-card__container">
        <h3 class="mostrar-card__title">${titulo}</h3>          
        <label class="mostrar-card__lbl" for="inputFoto"><b>${mess}</b>
        <svg class="mostrar-card__ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M447.1 32h-384C28.64 32-.0091 60.65-.0091 96v320c0 35.35 28.65 64 63.1 64h384c35.35 0 64-28.65 64-64V96C511.1 60.65 483.3 32 447.1 32zM111.1 96c26.51 0 48 21.49 48 48S138.5 192 111.1 192s-48-21.49-48-48S85.48 96 111.1 96zM446.1 407.6C443.3 412.8 437.9 416 432 416H82.01c-6.021 0-11.53-3.379-14.26-8.75c-2.73-5.367-2.215-11.81 1.334-16.68l70-96C142.1 290.4 146.9 288 152 288s9.916 2.441 12.93 6.574l32.46 44.51l93.3-139.1C293.7 194.7 298.7 192 304 192s10.35 2.672 13.31 7.125l128 192C448.6 396 448.9 402.3 446.1 407.6z"/></svg>
        </label>
        <span class="mostrar-card__alert"><b>${alerta}</b></span>
        <input class="mostrar-card__file" type="file" accept="image/*"  id="inputFoto">
        <button class="form__btn">
        <svg  class="ico-form2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path
                d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z" />
        </svg>Actualizar</button>
        <span class="mostrar-card__close">X</span>
    </div>
       
</form>`;
    const div = document.createElement('div');
    div.innerHTML = html;
    document.body.prepend(div.firstElementChild);

}
//imprimir error Imagen
function imprimirErrorImagen(error, lugar) {
    limpiarErrorImagen(lugar);
    error.forEach(text => {
        html = `<span class='spanError'>
        <svg class='icoError'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"/></svg>
        ${text}</span>`;
        const div = document.createElement('div');
        div.innerHTML = html;

        lugar.appendChild(div.firstElementChild);
    })

}

//limpiar error Imagen
function limpiarErrorImagen(lugar) {
    while (lugar.children[2]) {
        lugar.removeChild(lugar.children[2]);
    }
}

// mensaje eliminar
function abrirCard(nombre, carpeta, imagen) {
    const html = `
        <div class="mostrar-card">
            <div class="mostrar-card__containerCard">
                <div class="eliminar">
                    <span class="eliminar__title">Estas seguro de eliminar a ${nombre} ?</span>
                    <img class="eliminar__img" src="../build/img/${carpeta}/${imagen}">
                    <div class="eliminar__btn">
                        <button class="eliminar__btnYes">Si</button>
                        <button class="eliminar__btnNo">No</button>
                    </div> 
                </div>
               <span class="mostrar-card__close">x</span>
            </div>
        </div>`;
    document.body.style.cssText = 'overflow:hidden'; // ocultar el scroll
    const div = document.createElement('div');
    div.innerHTML = html;
    document.body.prepend(div.firstElementChild);

    modalBlack()
    const modal = document.querySelector('.mostrar-card');
    const btnCerrar = document.querySelector('.mostrar-card__close');
    const contenidoBlack = document.querySelector('.container-black2');
    const no = document.querySelector('.eliminar__btnNo');
    btnCerrar.addEventListener('click', e => {
        document.body.style.cssText = 'overflow:visible'; // desocultar el scroll
        modal.remove();
        contenidoBlack.remove();

    })
    no.addEventListener('click', e => {
        document.body.style.cssText = 'overflow:visible'; // desocultar el scroll
        modal.remove();
        contenidoBlack.remove();

    })
}


function listaVacia(info) {
    const { tabla, body, mensaje, colspan } = info;
    if (tabla.length <= 0) {
        const td = document.createElement('td');
        td.className = 'eliminar-vacio';
        td.textContent = mensaje;
        td.colSpan = colspan
        body.appendChild(td);
    }
}



// mensaje actualizar
function abrirActualizar(html) {

    document.body.style.cssText = 'overflow:hidden'; // ocultar el scroll
    const div = document.createElement('div');
    div.innerHTML = html;
    document.body.prepend(div.firstElementChild);

    modalBlack()
    const modal = document.querySelector('.mostrar-card');
    const btnCerrar = document.querySelector('.mostrar-card__close');
    const contenidoBlack = document.querySelector('.container-black2');

    btnCerrar.addEventListener('click', e => {
        document.body.style.cssText = 'overflow:visible'; // desocultar el scroll
        modal.remove();
        contenidoBlack.remove();

    })
}


function sliderCard(slider) {
    // sliderss
    var gliderCard = new Glider(document.querySelector(slider), {
        slidesToShow: 1, // empieza como modo celular . muestra el tamaño de la imagen
        slidesToScroll: 1, // cuando le das siguiente los pasos que va dar
        draggable: false, // arrastable
        dots: '.carousel__indicadores',  // indicador de abajo
        arrows: {
            prev: '.wallpaper-next',  //boton anterior
            next: '.wallpaper-previous' //boton siguiente
        }
    });


}