const comentario = document.querySelector('#comment');
const id = comentario.parentElement.parentElement.parentElement.parentElement.children[0].children[1].dataset.id;
const c = comentario.children[0];
const containerComentario = document.getElementById('comentarios');
imprimirComentarios(id);
let comentarios = [];
let idUser = '';
async function imprimirComentarios(id) {
    const url = `http://localhost:3000/apiGetComentario?id=${id}`;
    try {
        const response = await fetch(url);
        const respuesta = await response.json();
        comentarios = respuesta.resultado;
        idUser += respuesta.id_user;
        imprimirComentariosHtml();
    } catch (error) {
        console.log(error);
    }
}

function imprimirComentariosHtml() {

    limpiar(containerComentario)

    if (comentarios.length < 1) {
        const span = document.createElement('span');
        span.textContent = 'No hay comentarios ...';
        span.style.cssText = `padding: 2rem 0;display: block;text-align: center; color:var(--color-fonts-primary);`;
        containerComentario.appendChild(span);
    }


    comentarios.forEach(comentario => {
        const { id_comentarios, nombre_user, apellidoPaterno_user, comentarios, fechaComentario, imagen_user, id_user } = comentario;
        html = `<div class="comentario-comment" data-id="${id_comentarios}">
                    ${imagen_user.length > 1 ? `<img src="./build/img/usuarios/${imagen_user}" alt="usuarioJeayng${nombre_user}">` : `<span class="comentario-comment__noImagen">${nombre_user[0]}</span>`}        
                    <div class="comentario-comment__info">
                        <div class="comentario-comment__name">
                            <a href="/user/">${nombre_user} ${apellidoPaterno_user}</a>
                            <span>${fechaComentario}</span>
                        </div>
                        <p>${comentarios}</p>
                        <div class="comentario-comment__btn">
                            ${id_user === idUser ?
                `<button>Editar</button>
                            <button>Eliminar</button> `
                : ''}    
                        </div>    
                    </div>
                </div> `;

        const div = document.createElement('div');
        div.innerHTML = html;
        containerComentario.appendChild(div.firstElementChild);

    });

}
accionesComentario();


function accionesComentario() {
    containerComentario.addEventListener('click', e => {
        const id = e.target.parentElement.parentElement.parentElement.dataset.id;
        const texto = e.target.parentElement.parentElement.children[1].textContent;
        if (e.target.textContent === 'Editar') {
            html = `<div class="mostrar-card">
                        <div class="mostrar-card__containerCard">
                            <div class="eliminar">
                                <span class="eliminar__title">Editar Comentario </span>
                                <form method="post" id="formActualizar" class="comentarios-preguntar__input">
                                    <input type="text" placeholder="Editar Comentario" value="${texto}" >
                                    <button>Actualizar</button>
                                </form> 
                            </div>
                        <span class="mostrar-card__close">x</span>
                        </div>
                    </div>
                        `;
            abrirActualizar(html)

            const formActualizar = document.querySelector('#formActualizar');
            const inputValue = formActualizar.children[0];
            formActualizar.addEventListener('submit', e => {
                e.preventDefault();


                const ERROR_ACTUALIZAR_COMENTARIOS = validarComentario(inputValue);
                if (ERROR_ACTUALIZAR_COMENTARIOS.length < 1) {
                    const values = { inputValue, id };
                    console.log(values);
                    apiEditarComentario(values);
                }
            })
            return;
        }
        if (e.target.textContent === 'Eliminar') {
            html = `<div class="mostrar-card">
                        <div class="mostrar-card__containerCard">
                            <div class="eliminar">
                                <span class="eliminar__title">Estas seguro de eliminar este comentario ?</span>
                                <div class="eliminar__btn">
                                    <button class="eliminar__btnYes">Si</button>
                                    <button class="eliminar__btnNo">No</button>
                                </div> 
                            </div>
                        <span class="mostrar-card__close">x</span>
                        </div>
                    </div>
                        `;
            abrirActualizar(html);
            const btnEliminar = document.querySelector('.eliminar__btnYes');
            btnEliminar.addEventListener('click', e => {
                eliminarComentario(id);
                return;
            })
            const btnCancelar = document.querySelector('.eliminar__btnNo');
            btnCancelar.addEventListener('click', e => {
                cerrarModalComentario()
            })
        }
    })
}

async function apiEditarComentario(values) {
    const { inputValue, id } = values;
    const url = 'http://localhost:3000/actualizarComentario';

    const formData = new FormData;
    formData.append('id', id);
    formData.append('comentarios', inputValue.value);
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        if (respuesta.resultado) {
            comentarios = comentarios.map(e => {
                if (e.id_comentarios === respuesta.comentario.id_comentarios) {
                    e.comentarios = respuesta.comentario.comentarios;
                    e.fecha = respuesta.comentario.fecha
                }
                return e;
            })

            imprimirComentariosHtml();
            cerrarModalComentario()
        }
    } catch (error) {
        console.log(error);
    }
}

async function eliminarComentario(id) {
    const url = 'http://localhost:3000/ApiEliminarComentario';
    const formData = new FormData;
    formData.append('id_comentarios', id);
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });

        const respuesta = await response.json();
        if (respuesta.eliminar) {
            comentarios = comentarios.filter(e => e.id_comentarios !== respuesta.id);
            imprimirComentariosHtml();
            //chau modal
            cerrarModalComentario()

        } else {
            console.log('vivo eres xD');
        }
    } catch (error) {
        console.log(error);
    }
}



comentario.addEventListener('submit', e => {
    e.preventDefault();

    const errorComentarios = validarComentario(c);
    const values = {
        c,
        id
    };
    if (errorComentarios.length < 1) {
        ApiEnviandoComentario(values);
        c.value = '';
        c.style.cssText = 'outline:none';
    }
})


function validarComentario(c) {
    let erroresComentario = []

    if (c.value.length < 1) {
        erroresComentario = [...erroresComentario, 'No debe estar vacio'];
        c.style.cssText = 'outline:2px solid var(--color-error)';
    }

    if (c.value.length > 100) {
        erroresComentario = [...erroresComentario, 'Demasiado largo max 100 caracterés'];
    }

    return erroresComentario;
}


async function ApiEnviandoComentario(values) {
    const { c, id } = values;

    const formData = new FormData;
    formData.append('comentarios', c.value.trim())
    formData.append('id_prod', id)
    const url = 'http://localhost:3000/ApiComentario';
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        if (respuesta.enviado.resultado) {
            comentarios = [...comentarios, respuesta.resultado];
            imprimirComentariosHtml();
        } else {
            window.open('/login', '_self');
        }
    } catch (error) {
        console.log(error);
    }
}

function cerrarModalComentario() {
    const modal = document.querySelector('.mostrar-card');
    const contenidoBlack = document.querySelector('.container-black2');
    document.body.style.cssText = 'overflow:visible'; // desocultar el scroll
    modal.remove();
    contenidoBlack.remove();
}