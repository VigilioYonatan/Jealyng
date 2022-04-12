const tabla = document.getElementById('tbody');

tabla.addEventListener('click', e => {
    // actualizar 
    if (e.target.classList.contains('delivered')) {
        const id = e.target.parentElement.parentElement.dataset.id;
        const nombre = e.target.parentElement.parentElement.children[1].textContent;
        const imagen = e.target.parentElement.parentElement.children[2].children[0].src.substr(39);

        console.log(id);
        let html = `<div class="mostrar-card">
                        <div class="mostrar-card__containerCard">
                            <div class="eliminar">
                                <form class="admin-form__form" id="updMarcas">
                                    <h4>Actualizar BLUSA MARQUIS MUJER PLISADO BELLA F MQS S21</h4>
                                    <label>Nombre:
                                        <input type="text" placeholder="Nombre del producto" value="${nombre}">
                                    </label>
                                    <label class=" lbl__imagen" for="imagen2">Cambiar Imagen
                                        <input type="file" id="imagen2">
                                    </label>
                                    <img src="../build/img/marcas/${imagen}" alt="" style="width: 80px; align-self:center; margin:.5rem 0">
                                    <button>Actualizar</button>
                                </form>
                            </div>

                        <span class="mostrar-card__close">x</span>
                        </div>
                    </div>`;
        abrirActualizar(html);
        const formMarca = document.getElementById('updMarcas');
        formMarca.addEventListener('submit', e => {
            e.preventDefault();
            const nombreValue = formMarca.children[1].children[0].value;
            const imagenValue = formMarca.children[2].children[0].files;
            const values = {
                id, nombreValue, imagenValue
            };
            console.log(nombreValue);
            console.log(imagenValue);
            // errores aqui
            apiActualizarMarcas(values);
        })

    }

    // eliminar 
    if (e.target.classList.contains('return')) {
        const id = e.target.parentElement.parentElement.dataset.id;
        const img = e.target.parentElement.parentElement.children[2].children[0].src.substr(39);
        const nombre = e.target.parentElement.parentElement.children[1].textContent;

        abrirCard(nombre, 'marcas', img);
        const yes = document.querySelector('.eliminar__btnYes');

        const modal = document.querySelector('.mostrar-card');
        const contenidoBlack = document.querySelector('.container-black2');

        yes.onclick = e => {
            apiEliminarMarcas(id);

            document.body.style.cssText = 'overflow:visible'; // desocultar el scroll
            modal.remove();
            contenidoBlack.remove();
        }

    }
});

async function apiActualizarMarcas(values) {
    const url = 'http://localhost:3000/apiActualizarMarcas';
    const { id, nombreValue, imagenValue } = values;
    const formData = new FormData();
    formData.append('id_marca', id);
    formData.append('nombre_marca', nombreValue);
    imagenValue.length >= 1 && formData.append('imagen_marca', imagenValue[0]);

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        if (respuesta.actualizado) {
            window.open('/admin/marcas', '_self');
            return;
        }
    } catch (error) {
        console.log(error);
    }
}

async function apiEliminarMarcas(id) {
    const url = 'http://localhost:3000/apiEliminarMarcas';
    const formData = new FormData();
    formData.append('id_marca', id);
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        if (respuesta.eliminado) {
            window.open('/admin/marcas', '_self');
            return;
        }
    } catch (error) {
        console.log(error);
    }
}