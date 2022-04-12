const cards = document.querySelector('#cards');
console.log('hola');
// let producto = [];
cards.addEventListener('click', e => {
    if (e.target.classList.contains('best-card__view')) {
        const id = e.target.parentElement.parentElement.parentElement.dataset.id;
        apiConsultarIdProducto(id);
        // abrirCard(id);
    }
})


async function apiConsultarIdProducto(id) {
    const url = `http://localhost:3000/apiConsultarIdProducto?id=${id}`;
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

    const html = `
        <div class="mostrar-card">
        <div class="mostrar-card-container2" data-id="${id_prod}">
            <div class="mostrar-card-container2__card" >
                <div id="glider" class="mostrar-card-container2__list">
                    <div class="mostrar-card-container2__elm">
                        <img class="mostrar-card-container2__img" src="./build/img/productos/${imagen_prod}" alt="">
                    </div>
                    <div class="mostrar-card-container2__elm">
                        <img class="mostrar-card-container2__img" src="./build/img/productos/${imagen2_prod}" alt="">
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
                    ${stock_prod <= 0 ? `<span class="mostrar-card__agotado" ><svg class="header-info__ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M80 192V144C80 64.47 144.5 0 224 0C303.5 0 368 64.47 368 144V192H384C419.3 192 448 220.7 448 256V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V256C0 220.7 28.65 192 64 192H80zM144 192H304V144C304 99.82 268.2 64 224 64C179.8 64 144 99.82 144 144V192z"/></svg> <b>Agotado</b></span > `
            :
            `<a class="mostrar-card__add" href="" ><svg class="header-info__ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M352 160v-32C352 57.42 294.579 0 224 0 153.42 0 96 57.42 96 128v32H0v272c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V160h-96zm-192-32c0-35.29 28.71-64 64-64s64 28.71 64 64v32H160v-32zm160 120c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zm-192 0c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24z"></path>
                            </svg> <b>Agregar Carrito</b></a >`}
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
    const cantidad = agregarCarrito.parentElement.children[4].children[0];
    console.log(cantidad);
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
    const url = 'http://localhost:3000/apiAddCarrito';
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
        console.log(respuesta);
        if (respuesta.carrito) {
            insertarCarrito(respuesta.carrito)
            const modalBlack = document.querySelector('.container-black2');
            const mostrarCard = document.querySelector('.mostrar-card');
            modalBlack.remove();
            mostrarCard.remove();
            carrito.classList.add('showCart');
            setTimeout(() => {
                carrito.classList.remove('showCart');
            }, 3000)
        }
    } catch (error) {
        console.log(error);
    }
}

function insertarCarrito(carrito) {
    // const contador = document.querySelector('.user__cartcount');
    // contador.textContent = result.length;

    limpiarHtml()
    if (carrito.length <= 0) {
        const html = `<span class="cart-info__empty">Está vacio</span>`;
        const div = document.createElement('div');
        div.innerHTML = html;
        cardCard.append(div.firstElementChild);
    }
    console.log(carritoInfo);
    carrito.forEach(pro => {
        const { id_producto, nombre, descripcion, costo, imagen, cantidad, precio } = pro;
        html = `
        <picture class="cart-info" data-id="${id_producto}">
            <img class="cart-info__img" src="./build/img/productos/${imagen}" alt="">
                <div class="cart-info__info">
                    <span class="cart-info__spn">Nombre: <b>${nombre}</b></span>
                    <span class="cart-info__spn">precio: <b>${precio}</b></span>  
                    <div class="cart-info__qty">
                        <span class="cart-info__spn">cantidad: </span>
                        <button class="cart-info__btn" data-action="añadir">+</button>
                        <b>${cantidad}</b>
                        <button class="cart-info__btn" data-action="quitar">-</button>
                    </div>
                </div>
            </picture>`;

        const div = document.createElement('div');
        div.innerHTML = html;
        cardCard.append(div.firstElementChild);
    });
}

function limpiarHtml() {
    while (cardCard.firstElementChild) {
        cardCard.removeChild(cardCard.firstElementChild);
    }
}
