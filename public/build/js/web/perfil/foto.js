const btnFoto = document.getElementById('btnFoto');
if (btnFoto) {
    btnFoto.addEventListener('click', e => {
        e.preventDefault();
        document.body.style.cssText = 'overflow:hidden'; // ocultar el scroll
        const headerProfile = document.querySelector('.header-info-user');
        headerProfile.classList.remove('mostrar');
        modalBlack()
        const mensaje = {
            titulo: 'Cambiar Foto de Perfil',
            mess: 'Selecciona una imagen',
            alerta: 'Max 1mb'
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
                if (inputFoto.files[0].size > 1000000) {
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
                apiActualizarFoto(inputFoto.files[0]);
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
}


async function apiActualizarFoto(inputFoto) {
    const formData = new FormData();
    formData.append('imagen_user', inputFoto);
    const url = `${apiGlobal}/apiPerfilImagen`;
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        if (respuesta.imagen) {
            const perfilImagen1 = document.querySelectorAll('.header-info-perfil__img');
            const mostrarCard = document.querySelector('.mostrar-card');
            const imagenSpan = document.querySelector('.perfil-info-user__spanProfile');
            if (imagenSpan) {
                successProfile(mostrarCard, 'Cambiaste foto de Perfil correctamente', mostrarCard);
                setTimeout(() => {
                    window.open(`/perfil?user=${respuesta.nombre}`, '_self');
                }, 1000);
            }

            if (perfilImagen1) {
                perfilImagen1.forEach(e => {
                    e.src = `build/img/usuarios/${respuesta.imagen}`
                });

                // traendo spiner
                const spinner = document.querySelector('.spinner-loading');
                spinner.remove();

                limpiar(mostrarCard)
                successProfile(mostrarCard, 'Cambiaste foto de Perfil correctamente', mostrarCard);
                document.body.style.cssText = 'overflow:visible'; // desocultar el scroll
            }


        }
    } catch (error) {
        console.log(error);
    }
}
const imgPerfil = document.getElementById('imgPerfil');
if (imgPerfil) {
    imgPerfil.addEventListener('click', e => {

        html = `<div class="mostrar-card">
                            <div class="mostrar-card__containerCard wallpaperOpen3">
                                <div class="eliminar ">
                                <img style="width:400px; height:500px; object-fit:cover;"   src="./build/img/usuarios/${e.target.src.substr(60)}" alt="">
                                </div>
                            <span class="mostrar-card__close">x</span>
                            </div>
                        </div>`;

        abrirActualizar(html)
    })
}
