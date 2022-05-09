const cards = document.querySelector('#cards');
const cardCard = document.querySelector('.cart-cards');
const totalProducto = document.querySelectorAll('.totalProducto');
const carritoTotal = document.querySelector('#carritoTotal');
const carritoTotal2 = document.querySelector('.cart-float__title h4');
const carritoContainer = document.querySelector('#carrito');
const btnPay = document.querySelector('.tablaCarrito-pay__btn');
const carritoTitle = document.querySelector('.carrito__title');
const tablaCarrito = document.getElementById('tabla-carrito'); //carrito.php

// paypal container 
const paypalContainer = document.getElementById('paypal-button-container');
const paypalButtonContainer = document.getElementById('paypal-button-container');




let carritoCaja = [];
let favoritos = [];
listCarrito();


async function listCarrito() {
    const url = `${apiGlobal}/apiListCarrito`;
    try {
        const response = await fetch(url);
        const respuesta = await response.json();
        carritoCaja = respuesta.carrito;
        insertarCarrito()

        if (tablaCarrito) {
            insertarCarrito2()
        }
    } catch (error) {
        console.log(error);
    }
}

// favoritosPe.addEventListener('click', e => {
//     console.log(e.target);
// })

//si existe cards
if (cards) {
    cards.addEventListener('click', e => {
        if (e.target.classList.contains('best-card__view')) {
            const id = e.target.parentElement.parentElement.parentElement.dataset.id;
            apiConsultarIdProducto(id);
            return;
        }
        if (e.target.classList.contains('icoFavoritoBTN')) {

            const heart = e.target;
            const id = e.target.parentElement.parentElement.parentElement.dataset.id;
            apiAddFavorito(id, heart);
            return;
        }
    })

}

async function apiAddFavorito(id, heart) {
    const url = `${apiGlobal}/apiAddFavorito`;
    const formData = new FormData;
    formData.append('id_prod', id);
    try {
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const resultado = await respuesta.json();
        if (resultado.id) {
            favoritos = [...favoritos, id];

            heart.classList.add('favorito');
            heart.classList.remove('nofavorito');
            msgSuccessFavorito(`Añadido a Favoritos <a style="padding:0rem .3rem;  color: #fff; font-size: 1.2rem;" href="${resultado.nombre ? `/perfil?user=${resultado.nombre}` : '/login'}"> ver</a>`);
            return;
        }
        if (resultado.eliminado) {

            heart.classList.remove('favorito');
            heart.classList.add('nofavorito');
            msgSuccessFavorito('Removido de favoritos')
            return;
        }
    } catch (error) {
        console.log(error);
    }

}



async function apiConsultarIdProducto(id) {
    const url = `${apiGlobal}/apiConsultarIdProducto?id=${id}`;
    try {
        const response = await fetch(url);
        const respuesta = await response.json();
        abrirCard(respuesta.producto)
    } catch (error) {
        console.log(error);
    }
}

function abrirCard(producto) {
    const { id_prod, nombre_prod, descripcion_prod, imagen2_prod, imagen_prod, precio_prod, stock_prod, nombre_categoria, nombre_subcat, nombre_descuento, nombre_marca, nombre_estadoPro } = producto;
    const regexName = /[$%&|<>#+-]/gi;
    const nombre = nombre_prod.replace(regexName, '_').split(' ').join('-')
    limpiarCard();
    const html = `
        <div class="mostrar-card">
        <div class="mostrar-card-container2" data-id="${id_prod}">
            <div class="mostrar-card-container2__card" >
                <div id="glider" class="mostrar-card-container2__list">
                    <div class="mostrar-card-container2__elm">
                        <img class="mostrar-card-container2__img" src="./build/img/productos/${imagen_prod}" alt="">
                        ${nombre_descuento > 0.1 ? `
                            <span class="best-card__best2">- %${nombre_descuento * 100}</span>` : ''}
                    </div>
        
                       
                    <div class="mostrar-card-container2__elm">
                        <img class="mostrar-card-container2__img" src="./build/img/productos/${imagen2_prod}" alt="">
                        ${nombre_descuento > 0.1 ? `
                        <span class="best-card__best2">- %${nombre_descuento * 100}</span>` : ''}
                    </div>
                    
                </div>
                <div role="tablist" class="carousel__indicadores"></div>
            </div>  
            <div class="mostrar-card__info">
                    <span class="mostrar-card__id">ID: ${id_prod}</span>
                    <span class="mostrar-card__name">${nombre_prod}</span>
                    <span class="mostrar-card__desc">Antes: <b>S/. ${precio_prod}</b></span>
                    <span class="mostrar-card__price">Ahora: S/. ${Number(precio_prod - (precio_prod * nombre_descuento)).toFixed(2)}</span>
                    <div class="mostrar-card__qty">
                        <input class="mostrar-card__cantidad" type="number" value="1"  >
                        <span class="mostrar-card__stock">Stock: <b>${stock_prod <= 0 ? 'Agotado' : stock_prod}</b></span>
                    </div>
                    <div class="mostrar-card-desc">
                        <span class="mostrar-card-desc__title">Descripcion:</span>
                        <p class="mostrar-card-desc__txt">
                        ${descripcion_prod}
                        </p> 
                    </div>
                    <a class="mostrar-card__masinfo" href="/producto?nombre=${nombre}">Más informacion</a>
                    ${stock_prod <= 0 ?
            `<span class="mostrar-card__agotado" >
                <svg class="header-info__ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M80 192V144C80 64.47 144.5 0 224 0C303.5 0 368 64.47 368 144V192H384C419.3 192 448 220.7 448 256V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V256C0 220.7 28.65 192 64 192H80zM144 192H304V144C304 99.82 268.2 64 224 64C179.8 64 144 99.82 144 144V192z"></path>
                </svg> <b>Agotado</b></span>`
            :
            `<a class="mostrar-card__add" href="" >
                    <svg class="header-info__ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M352 160v-32C352 57.42 294.579 0 224 0 153.42 0 96 57.42 96 128v32H0v272c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V160h-96zm-192-32c0-35.29 28.71-64 64-64s64 28.71 64 64v32H160v-32zm160 120c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zm-192 0c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24z"></path>
                   </svg> <b>Agregar Carrito</b>
              </a>`}
                </div >
            <span class="mostrar-card__close2">X</span>
        </div >
       
    </div >
           
        </div > `;
    const div = document.createElement('div');
    div.innerHTML = html;
    document.body.prepend(div.firstElementChild);



    modalBlack()
    const modal = document.querySelector('.mostrar-card');
    const contenidoBlack = document.querySelector('.container-black2');
    const btnCerrar = document.querySelector('.mostrar-card__close2');
    const agregarCarrito = document.querySelector('.mostrar-card__add');

    if (agregarCarrito) {
        const cantidad = agregarCarrito.parentElement.children[4].children[0];
        cantidad.addEventListener('change', e => {
            if (Number(cantidad.value) > Number(stock_prod)) {
                cantidad.value = stock_prod;
            }
            if (Number(cantidad.value) < 1) {
                cantidad.value = 1;
            }
        })


        agregarCarrito.addEventListener('click', e => {
            e.preventDefault();
            const values = {
                cantidad: cantidad.value,
                id: id_prod
            }

            apiAddCarrito(values); // pasamos la id del producto
        })
    }


    contenidoBlack.addEventListener('click', e => {
        modal.remove();
        contenidoBlack.remove();
    })

    btnCerrar.addEventListener('click', e => {
        modal.remove();
        contenidoBlack.remove();
    })


    sliderCard('.mostrar-card-container2__list');


}


async function apiAddCarrito(values) {
    const url = `${apiGlobal}/apiAddCarrito`;
    const formData = new FormData();

    const { id, cantidad } = values;

    formData.append('id_prod', id);
    formData.append('cantidad_carrito', cantidad);
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();

        const modalBlack = document.querySelector('.container-black2');
        const mostrarCard = document.querySelector('.mostrar-card');
        if (respuesta.carrito) {
            carritoCaja = respuesta.carrito;

            insertarCarrito()

            if (modalBlack) {
                modalBlack.remove();
            }
            if (mostrarCard) {
                mostrarCard.remove();
            }

            const INFO_PRODUCTO_NOTI = respuesta.carrito.filter(e => e.id_prod === id);

            mostrarProductoNotificacion(INFO_PRODUCTO_NOTI[0]);
        }
        if (respuesta.añadido) {

            mostrarCard.remove();
            modalBlack.remove();
            const carrito = document.querySelector('#carrito');
            carrito.classList.add('showCart');
            document.body.style.cssText = 'overflow:visible'; // ocultar el scroll
        }
    } catch (error) {
        console.log(error);
    }
}

function mostrarProductoNotificacion(info) {
    limpiarNotificacion();
    const { nombre_prod, imagen_prod, precio, stock_prod, cantidad_carrito } = info;
    let html = `
    <div class="notificacion">
        <div class="notificacion-container">
            <p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M256 32V51.2C329 66.03 384 130.6 384 208V226.8C384 273.9 401.3 319.2 432.5 354.4L439.9 362.7C448.3 372.2 450.4 385.6 445.2 397.1C440 408.6 428.6 416 416 416H32C19.4 416 7.971 408.6 2.809 397.1C-2.353 385.6-.2883 372.2 8.084 362.7L15.5 354.4C46.74 319.2 64 273.9 64 226.8V208C64 130.6 118.1 66.03 192 51.2V32C192 14.33 206.3 0 224 0C241.7 0 256 14.33 256 32H256zM224 512C207 512 190.7 505.3 178.7 493.3C166.7 481.3 160 464.1 160 448H288C288 464.1 281.3 481.3 269.3 493.3C257.3 505.3 240.1 512 224 512z" />
                </svg>
                <span>Producto Añadido</span>
            </p>
            <div class="notificacion-product">
                <img src="./build/img/productos/${imagen_prod}" alt="">
                <div class="notificacion-product__info">
                    <p>Nombre: <b>${nombre_prod}</b></p>
                    <p>Precio: <b>S/. ${Number(precio).toFixed(2)}</b></p>
                    <p>Unidades: <b>${cantidad_carrito} Unidades</b></p>
                </div>
            </div>
        </div>
        <span id="cerrar">x</span>
    </div>`;

    const div = document.createElement('div');
    div.innerHTML = html;
    document.body.prepend(div.firstElementChild);

    const notificacion = document.querySelector('.notificacion');
    setTimeout(() => {
        notificacion.classList.add('mostrarNotificacion');

    }, 8000);

    cerrar.onclick = e => {
        notificacion.classList.add('mostrarNotificacion');

    }
}

function limpiarNotificacion() {
    const notificacion = document.querySelector('.notificacion');
    if (notificacion) {

        notificacion.remove();
    }
}
function limpiarCard() {
    const container = document.querySelector('.container-black2');
    const mostrarCard = document.querySelector('.mostrar-card');
    if (container && mostrarCard) {
        container.remove();
        mostrarCard.remove();
    }
}

function insertarCarrito() {

    limpiarHtml(cardCard)
    if (carritoCaja.length <= 0) {
        const html = `<span class="cart-info__empty">No hay productos añadidos</span>`;
        const div = document.createElement('div');
        div.innerHTML = html;
        cardCard.append(div.firstElementChild);
    }


    carritoCaja.forEach(pro => {
        const { id_prod, nombre_prod, stock_prod, descripcion, costoTotal_carrito, imagen_prod, cantidad_carrito, precio } = pro;
        html = `
        <picture class="cart-info" data-id="${id_prod}">
            <img class="cart-info__img" src="./build/img/productos/${imagen_prod}" alt="">
                <div class="cart-info__info">
                    <span class="cart-info__spn">Nombre: <b>${nombre_prod}</b></span>
                    <span class="cart-info__spn">precio: S/. <b>${Number(precio).toFixed(2)}</b></span>  
                    <span class="cart-info__spn">Stock: <b>${stock_prod} Unidades</b> </span>
                    <div class="cart-info__qty">
                        <span class="cart-info__spn">cantidad: </span>
                        <button class="cart-info__btn ${cantidad_carrito == stock_prod && 'opacity'}  " data-action="añadir" ${cantidad_carrito == stock_prod && 'disabled'}>+</button>
                        <b class="cart-info__spn">${cantidad_carrito}</b>
                        <button class="cart-info__btn" data-action="quitar">-</button>
                    </div>
                </div>
            </picture>`;

        const div = document.createElement('div');
        div.innerHTML = html;

        cardCard.append(div.firstElementChild);


    });

    // aumenta

    const sumall = carritoCaja.map(item => parseFloat(item.costoTotal_carrito)).reduce((prev, curr) => prev + curr, 0);
    totalProducto.forEach(e => {
        e.textContent = Intl.NumberFormat('es-PE', { style: 'currency', currency: 'PEN' }).format(sumall);
        // e.textContent = sumall;
        costoTotalHeader.textContent = Intl.NumberFormat('es-PE', { style: 'currency', currency: 'PEN' }).format(sumall);
    })
    carritoTotal.textContent = carritoCaja.length;
    carritoTotal2.textContent = `${carritoCaja.length} productos`;
}

function insertarCarrito2() {

    limpiarHtml(tablaCarrito);
    limpiarHtml(paypalContainer);


    if (carritoCaja.length <= 0) {
        const tablaContenedor = document.querySelector('.tablaCarrito');
        limpiarHtml(tablaContenedor)
        const CarritoBtnOpciones = document.querySelector('.CarritoBtnOpciones');
        CarritoBtnOpciones.classList.add('hidden');
        let html = `<div class="tablaCarrito-empty">
                        <span>No tienes artículos en el carro de compras.</span>
                        <p>¿Tienes una cuenta? Inicia sesión para ver tus artículos.</p>
                        <div class="tablaCarrito-buttons">
                            <a href="/categoria?nombre=Tecnologia">Empieza a comprar</a>
                        </div>
                    </div>`;
        const div = document.createElement('div');
        div.innerHTML = html;
        tablaContenedor.appendChild(div.firstElementChild);
    }



    carritoCaja.forEach(pro => {
        const { id_prod, nombre_prod, stock_prod, descripcion, costoTotal_carrito, imagen_prod, cantidad_carrito, precio } = pro;
        html = `
        <div class="tablaCarrito__products" data-id=${id_prod}>
            <img src="./build/img/productos/${imagen_prod}" alt="">
            <b>${nombre_prod}</b>
            <div class="tablaCarrito__qty">
                <p class="cart-info__spn">cantidad </p>
                <div class="tablaCarrito__cantidad">
                    <button class="cart-info__btn false  " data-action="añadir" false="">+</button>
                    <b class="cart-info__spn">${cantidad_carrito}</b>
                    <button class="cart-info__btn" data-action="quitar">-</button>
                </div>
            </div>
            <div class="tablaCarrito__qty">
                <p class="cart-info__spn">Precio </p>
                <p>S/ ${Number(precio).toFixed(2)}</p>
            </div>
        </div>`;

        const div = document.createElement('div');
        div.innerHTML = html;

        tablaCarrito.append(div.firstElementChild);



    });


    // aumenta

    const sumall = carritoCaja.map(item => parseFloat(item.costoTotal_carrito)).reduce((prev, curr) => prev + curr, 0);
    totalProducto.forEach(e => {
        e.textContent = Intl.NumberFormat('es-PE', { style: 'currency', currency: 'PEN' }).format(sumall);
        // e.textContent = sumall;
    })

    carritoTotal.textContent = carritoCaja.length;
    carritoTitle.textContent = `(Carrito de compras ${carritoCaja.length} articulos )`;
    carritoTotal2.textContent = `${carritoCaja.length} productos`;

    const precioPaypal = parseFloat(sumall) / 3.73;

    const tablaInformacion = document.querySelector('.tablaCarrito2-container__info');

    const departamento = tablaInformacion.children[1].children[0].textContent;
    const provincia = tablaInformacion.children[2].children[0].textContent;
    const distrito = tablaInformacion.children[3].children[0].textContent;
    const direccion = tablaInformacion.children[4].children[0].textContent;
    if (paypalButtonContainer) {
        paypal.Buttons({

            // Sets up the transaction when a payment button is clicked

            createOrder: (data, actions) => {

                return actions.order.create({

                    purchase_units: [{

                        amount: {

                            value: Number(precioPaypal).toFixed(2), // Can also reference a variable or function
                            description: "Compra de articulos JEALYNG"
                        }

                    }]

                });

            },

            // Finalize the transaction after payer approval

            onApprove: (data, actions) => {

                return actions.order.capture().then(function (orderData) {

                    // Successful capture! For dev/demo purposes:

                    const values = {
                        departamento,
                        provincia,
                        distrito,
                        direccion,
                        orderData: JSON.stringify(orderData),
                        precioPaypal: Number(precioPaypal).toFixed(2),
                        carrito: JSON.stringify(carritoCaja)
                    }
                    enviarInfoPago(values);


                });

            }

        }).render('#paypal-button-container');
    }

}

async function enviarInfoPago(values) {
    const { departamento,
        provincia,
        distrito,
        direccion,
        orderData, precioPaypal, carrito } = values;

    const formData = new FormData;
    formData.append('distrito', distrito);
    formData.append('direccion', direccion);
    formData.append('datapay', orderData);
    formData.append('monto', precioPaypal);
    formData.append('carrito', carrito);
    const url = `${apiGlobal}/enviarInfoPago`;
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        if (respuesta.resultado) {
            // window.open('/pdfEnvio', '_self');
            window.open('/pedidoConfirmado', '_self');
        }
    } catch (error) {
        console.log(error);
    }
}

//agregar uno
cardCard.addEventListener('click', e => {
    const id = e.target.parentElement.parentElement.parentElement.dataset.id;
    if (e.target.dataset.action === "añadir") {
        apiCambiarCantidad(id, 'apiAumentarQTY');
        return;
    }
    if (e.target.dataset.action === "quitar") {
        apiCambiarCantidad(id, 'apiDisminuirQTY');
        return;
    }
})
if (tablaCarrito) {
    tablaCarrito.addEventListener('click', e => {
        const id = e.target.parentElement.parentElement.parentElement.dataset.id;
        if (e.target.dataset.action === "añadir") {
            apiCambiarCantidad(id, 'apiAumentarQTY');
            return;
        }
        if (e.target.dataset.action === "quitar") {
            apiCambiarCantidad(id, 'apiDisminuirQTY');
            return;
        }
    })
}

// fin aumenta 


async function apiCambiarCantidad(id, ur) {
    const url = `${apiGlobal}/${ur}`;
    const formData = new FormData;
    formData.append('id_prod', id)
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        if (respuesta.cantidad) {
            carritoCaja = carritoCaja.map(e => {
                if (e.id_prod === respuesta.cantidad.id_prod) {
                    e.cantidad_carrito = String(respuesta.cantidad.cantidad_carrito)
                    e.costoTotal_carrito = String(respuesta.cantidad.costoTotal_carrito)

                }
                return e;
            })
            insertarCarrito();

            if (tablaCarrito) {
                insertarCarrito2();
            }

            return
        }

        if (respuesta.id) {
            carritoCaja = carritoCaja.filter(e => e.id_prod !== respuesta.id)
            insertarCarrito();
            if (tablaCarrito) {
                insertarCarrito2();
            }
            return;
        }
    } catch (error) {
        console.log(error);
    }

}



function limpiarHtml(container) {
    while (container.firstElementChild) {
        container.removeChild(container.firstElementChild);
    }
}

// paypal





