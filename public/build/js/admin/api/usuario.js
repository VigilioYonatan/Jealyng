const tabla = document.getElementById('tbody');

tabla.addEventListener('click', e => {
    if (e.target.getAttribute("type") == 'radio') {
        const id = e.target.parentElement.parentElement.parentElement.dataset.id;
        const value = e.target.value;
        const values = { id, value };
        apiActualizarRol(values);
    }
    if (e.target.classList.contains('return')) {
        const id = e.target.parentElement.parentElement.dataset.id;
      
        const img = e.target.parentElement.parentElement.children[4].children[0].src;
        const nombre = e.target.parentElement.parentElement.children[1].textContent;
        const imagen = img.substr(41);

        abrirCard(nombre, 'usuarios', imagen);
        const yes = document.querySelector('.eliminar__btnYes');

        const modal = document.querySelector('.mostrar-card');
        const contenidoBlack = document.querySelector('.container-black2');

        yes.onclick = e => {

            apiEliminarUsuario(id);
            document.body.style.cssText = 'overflow:visible'; // desocultar el scroll
            modal.remove();
            contenidoBlack.remove();
        }
    };
})

async function apiEliminarUsuario(id) {
    const url = `${apiGlobal}/apiEliminarPerfil`;

    const formData = new FormData();
    formData.append('id_user', id);
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        if (respuesta.eliminado) {
            window.open('/admin/usuarios', '_self');
        }
    } catch (error) {
        console.log(error);
    }
}

async function apiActualizarRol(values) {
    const { id, value } = values;
    const formData = new FormData();
    formData.append('id_user', id);
    formData.append('id_rol', value);

    const url = `${apiGlobal}/apiPerfilRol`;
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