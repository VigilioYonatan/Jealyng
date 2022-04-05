const btnWallpaper = document.getElementById('btnWallpaper');
btnWallpaper.addEventListener('click', e => {
    e.preventDefault();
    document.body.style.cssText = 'overflow:hidden'; // ocultar el scroll
    const headerProfile = document.querySelector('.header-info-user');
    headerProfile.classList.remove('mostrar');
    modalBlack()
    const mensaje = {
        titulo: 'Cambiar portada de perfil',
        mess: 'recomendable (1080px x 520px)',
        alerta: 'Max 2mb'
    };
    abrirImagen(mensaje);
    const mostrarCard = document.querySelector('.mostrar-card');


    mostrarCard.addEventListener('submit', e => {
        e.preventDefault();
        let errorFoto = [];
        const inputFoto = document.querySelector('#inputFoto');

        if (inputFoto.files[0]) {
            if (inputFoto.files[0].type !== 'image/jpeg' && inputFoto.files[0].type !== 'image/jpg' && inputFoto.files[0].type !== 'image/png' && inputFoto.files[0].type !== 'image/webp') {
                errorFoto = [...errorFoto, 'Formato de imagen No válida'];
            }
            if (inputFoto.files[0].size > 2000000) {
                errorFoto = [...errorFoto, 'Imagen demasiado pesado max 1mb'];
            }

        } else {
            errorFoto = [...errorFoto, 'No ha subido ni una imagen'];
        }

        //si están mal los inputs      
        imprimirErrorImagen(errorFoto, mostrarCard.children[0].children[2]);
        console.log(inputFoto.files);
        if (errorFoto.length <= 0) {
            loading(mostrarCard.children[0].children[2]);
            const btnActualizar = document.querySelector('.form__btn');
            btnActualizar.remove(); // chau btn
            apiActualizarPortada(inputFoto.files[0]);
        }
    })

    const modalBlacks = document.querySelector('.container-black2');
    const btnCerrar = document.querySelector('.mostrar-card__close');

    modalBlacks.addEventListener('click', e => {
        modalBlacks.remove();
        mostrarCard.remove();
        document.body.style.cssText = 'overflow:visible'; // desocultar el scroll

    })
    btnCerrar.addEventListener('click', e => {
        modalBlacks.remove();
        mostrarCard.remove();
        document.body.style.cssText = 'overflow:visible'; // desocultar el scroll

    })

})

async function apiActualizarPortada(inputFoto) {
    const formData = new FormData();
    formData.append('wallpaper_user', inputFoto);
    const url = 'http://localhost:3000/apiPerfilWallpaper';
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        if (respuesta.portada) {
            const perfilPortada = document.querySelector('.perfil-info-user__wallpaper img');

            if (perfilPortada) {
                perfilPortada.src = `build/img/usuarios/${respuesta.portada}`


                // traendo spiner
                const spinner = document.querySelector('.spinner-loading');
                spinner.remove();
                const mostrarCard = document.querySelector('.mostrar-card');
                limpiar(mostrarCard)
                successProfile(mostrarCard, 'Cambiaste tu foto de portada correctamente', mostrarCard);
                document.body.style.cssText = 'overflow:visible'; // desocultar el scroll

            }
        }
    } catch (error) {
        console.log(error);
    }
}

