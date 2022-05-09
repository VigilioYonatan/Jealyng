const formProductos = document.querySelector('#formProductos');
const selectCategoria = document.getElementById('categoria');
const buscador = document.getElementById('buscador');
const tbody = document.querySelector('#tbody');

let producto = [];



listarProductos();

async function listarProductos() {
    const url = `${apiGlobal}/apiListarProductos`;
    try {
        const response = await fetch(url);
        const respuesta = await response.json();


        producto = respuesta.productos
  
        imprimirProductos();

    } catch (error) {
        console.log(error);
    }
}

buscador.addEventListener('keyup', e => {
    const palabra = e.target.value;
    apiBuscarProducto(palabra);

})

async function apiBuscarProducto(palabra) {
    const url = `${apiGlobal}/apiBuscarProductos?nombre=${palabra}`;
    try {
        const response = await fetch(url);
        const resultado = await response.json();
        producto = resultado.productos;
        imprimirProductos();
    } catch (error) {
        console.log(error);
    }
}


function imprimirProductos() {
    limpiarTablaBody();
    //imprime si está vacio
    const info = {
        tabla: producto,
        body: tbody,
        mensaje: 'No hay productos',
        colspan: 7
    };
    listaVacia(info);

    producto.forEach(pro => {
        const { id_prod, nombre_prod, descripcion_prod,
            precio_prod, imagen_prod, imagen2_prod, stock_prod, id_categoria, id_subcategoria, id_marca, id_descuento, id_estado, nombre_categoria,
            nombre_subcat, nombre_marca, nombre_descuento,
            nombre_estadoPro } = pro;

        const tr = document.createElement('tr');
        const tdId = document.createElement('td');
        tdId.textContent = id_prod;
        const tdnombre = document.createElement('td');
        tdnombre.textContent = nombre_prod;
        const tdimagen = document.createElement('td');
        const img = document.createElement('img');
        img.src = `../build/img/productos/${imagen_prod}`;
        img.width = 50;
        tdimagen.appendChild(img);
        const tdprecio = document.createElement('td');
        tdprecio.textContent = `S/. ${precio_prod}`;
        const tdstock = document.createElement('td');
        tdstock.textContent = `${stock_prod} unidades`;
        const tdestado = document.createElement('td');
        tdestado.textContent = nombre_estadoPro;
        const tdopciones = document.createElement('td');

        const spanActualizar = document.createElement('span');
        spanActualizar.className = `status delivered`;
        spanActualizar.textContent = 'Actualizar';
        const spanEliminar = document.createElement('span');
        spanEliminar.className = `status return`;
        spanEliminar.textContent = 'Borrar';
        tdopciones.appendChild(spanActualizar);
        tdopciones.appendChild(spanEliminar);
        tr.appendChild(tdId);
        tr.appendChild(tdnombre);
        tr.appendChild(tdimagen);
        tr.appendChild(tdprecio);
        tr.appendChild(tdstock);
        tr.appendChild(tdestado);
        tr.appendChild(tdopciones);

        tbody.appendChild(tr);

        spanEliminar.onclick = e => {
            abrirCard(nombre_prod, 'productos', imagen_prod);
            const yes = document.querySelector('.eliminar__btnYes');

            const modal = document.querySelector('.mostrar-card');
            const contenidoBlack = document.querySelector('.container-black2');

            yes.onclick = e => {

                apiEliminarProducto(id_prod, imagen_prod, imagen2_prod);
                document.body.style.cssText = 'overflow:visible'; // desocultar el scroll
                modal.remove();
                contenidoBlack.remove();
            }

        }

        tdId.onclick = e => {
            html = `<div class="mostrar-card">
                        <div class="mostrar-card__containerCard">
                            <div class="eliminar">
                                <span class="eliminar__title">${nombre_prod} </span>
                                <img class="eliminar__img" src="../build/img/productos/${imagen_prod}">
                                <div class="eliminar__info">
                                    <div class="eliminar__infos">
                                        <span >ID: <b>${id_prod}</b></span>    
                                        <span >Precio: S/.<b>${precio_prod}</b></span>    
                                        <span >Descripcion:<br> <b>${descripcion_prod}</b></span> 
                                    </div>   
                                    <div class="eliminar__infos">
                                        <span >Stock: <b>${stock_prod}</b></span>    
                                        <span >Categoria: <b>${nombre_categoria}</b></span>    
                                        <span >Subcategoria: <b>${nombre_subcat}</b></span>  
                                    </div>
                                    <div class="eliminar__infos">  
                                        <span >Marca: <b>${nombre_marca}</b></span>    
                                        <span >Descuento: <b>${nombre_descuento * 100} %</b></span>    
                                        <span >Estado: <b>${nombre_estadoPro}</b></span>    
                                   </div>
                                </div> 
                            </div>
                        <span class="mostrar-card__close">x</span>
                        </div>
                    </div>`;
            abrirActualizar(html)


        }

        spanActualizar.onclick = e => {
            modalBlack()
            const formUpd = document.querySelector('.mostrar-card-upd');
            formUpd.classList.add('mostrar');
            const formActualizar = document.querySelector('#updProductos');
            const titulo = formActualizar.children[0];
            const nombreUpd = formActualizar.children[1].children[0];
            const descripcionUpd = formActualizar.children[2].children[0];
            const precioUpd = formActualizar.children[3].children[0].children[0];
            const stockUpd = formActualizar.children[3].children[1].children[0];
            const marcaUpd = formActualizar.children[3].children[2].children[0];
            const descuentoUpd = formActualizar.children[4].children[0].children[0];
            const estadoUpd = formActualizar.children[4].children[1].children[0];
            const imagenUpd = formActualizar.children[5].children[0].files;
            const categoriaUpd = formActualizar.children[4].children[2].children[0];

            const img = formActualizar.children[6];
            // const subcategoriaUpd = formActualizar.children[4].children[3].children[0]
            titulo.textContent = `Actualizar ${nombre_prod}`;
            nombreUpd.value = nombre_prod;
            descripcionUpd.value = descripcion_prod;
            precioUpd.value = precio_prod;
            stockUpd.value = stock_prod;
            marcaUpd.value = id_marca;
            descuentoUpd.value = id_descuento;
            estadoUpd.value = id_estado;
            categoriaUpd.value = id_categoria;
            img.src = `../build/img/productos/${imagen_prod}`;
            apiSubcategorias(id_categoria, formActualizar);

            formActualizar.addEventListener('submit', e => {
                e.preventDefault();
           
                const values = {
                    id_prod: id_prod,
                    nombre_pro: nombreUpd.value,
                    descripcion_prod: descripcionUpd.value,
                    precio_prod: precioUpd.value,
                    stock_prod: stockUpd.value,
                    id_marca: marcaUpd.value,
                    id_descuento: descuentoUpd.value,
                    id_estado: estadoUpd.value,
                    id_categoria: categoriaUpd.value,
                    id_subcategoria: id_subcategoria,
                    imagenUp: imagenUpd,

                }
                apiUpdProducto(values);

                nombreUpd.value = '';
                descripcionUpd.value = '';
                precioUpd.value = '';
                stockUpd.value = '';
                marcaUpd.value = '';
                descuentoUpd.value = '';
                estadoUpd.value = '';
                categoriaUpd.value = '';
                formActualizar.children[5].children[0].value = '';
            })

            // cerrar modal 
            const btnCerrarUpd = document.querySelector('.mostrar-card__close');
            const contenidoBlack = document.querySelector('.container-black2');
            btnCerrarUpd.onclick = e => {
                formUpd.classList.remove('mostrar');
                contenidoBlack.remove();
            }
        }

    })


}

async function apiUpdProducto(values) {
    const formData = new FormData();
    const { id_prod, nombre_pro, descripcion_prod, precio_prod, stock_prod, id_marca, id_descuento, id_estado, id_categoria, id_subcategoria, imagenUp, } = values;
    formData.append('id_prod', id_prod);
    formData.append('nombre_prod', nombre_pro);
    formData.append('descripcion_prod', descripcion_prod);
    formData.append('precio_prod', precio_prod);
    formData.append('stock_prod', stock_prod);
    formData.append('id_marca', id_marca);
    formData.append('id_descuento', id_descuento);
    formData.append('id_estado', id_estado);
    formData.append('id_categoria', id_categoria);
    formData.append('id_subcategoria', id_subcategoria);
    if (imagenUp.length >= 1) {
        formData.append('imagen_prod', imagenUp[0]);
    }



    const url = `${apiGlobal}/apiActualizarProductos`;
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        producto = respuesta.productos;
        imprimirProductos();

        //limpia el input file

    } catch (error) {
        console.log(error);
    }
}

async function apiEliminarProducto(id, img, img2) {

    const url = `${apiGlobal}/apiEliminarProductos`;

    const formData = new FormData();
    formData.append('id', id);
    formData.append('imagen', img);
    formData.append('imagen2', img2);
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        if (respuesta.eliminado) {
            producto = producto.filter(pro => pro.id_prod !== respuesta.id)
            imprimirProductos();
        }

    } catch (error) {
        console.log(error);
    }

}


//limpia el body cuando de la tabla
function limpiarTablaBody() {
    while (tbody.firstElementChild) {
        tbody.removeChild(tbody.firstElementChild);
    }
}

selectCategoria.addEventListener('change', e => {
    apiSubcategorias(e.target.value, formProductos);

})

formProductos.addEventListener('submit', e => {
    e.preventDefault();
    const nombre = formProductos.children[1].children[0];
    const descripcion = formProductos.children[2].children[0];
    const precio = formProductos.children[3].children[0].children[0];
    const stock = formProductos.children[3].children[1].children[0];
    const marca = formProductos.children[3].children[2].children[0];
    const descuento = formProductos.children[4].children[0].children[0];
    const estado = formProductos.children[4].children[1].children[0];
    const categoria = formProductos.children[4].children[2].children[0];
    const subcategoria = formProductos.children[4].children[3].children[0]
    const imagen = formProductos.children[5].children[0];
    const imagen2 = formProductos.children[6].children[0];


    const values = {
        nombre: nombre.value.trim(),
        descripcion: descripcion.value.trim(),
        precio: precio.value.trim(),
        stock: stock.value.trim(),
        marca: marca.value.trim(),
        descuento: descuento.value.trim(),
        estado: estado.value.trim(),
        categoria: categoria.value.trim(),
        subcategoria: subcategoria.value.trim(),
        imagen: imagen.files,
        imagen2: imagen2.files,
    }
    validarFormulario(values)

})


async function apiSubcategorias(id, ruta) {
    const formData = new FormData();
    formData.append('id_categoria', id);
    const url = `${apiGlobal}/apiGetSubcategorias`;
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });

        const respuesta = await response.json();
        if (respuesta.resultado) {
            imprimirSubcategorias(respuesta.resultado, ruta);

        }

    } catch (error) {
        console.log(error);
    }
}

function imprimirSubcategorias(subcategorias, ruta) {
    limpiarFormulario(ruta)
    const label = document.createElement('label');
    label.textContent = 'SubCategorias';
    const select = document.createElement('select');
    subcategorias.forEach(({ id_subcat, nombre_subcat }) => {

        const option = document.createElement('option');
        option.value = id_subcat;
        option.textContent = nombre_subcat;

        select.appendChild(option)
        label.appendChild(select);

    });
    ruta.children[4].appendChild(label);

}

function limpiarFormulario(ruta) {
    while (ruta.children[4].children[3]) {
        ruta.children[4].removeChild(ruta.children[4].children[3])
    }
}


function validarFormulario(values) {
    const { nombre, descripcion, precio, stock, marca, descuento, estado, categoria, subcategoria, imagen, imagen2 } = values;
    const regexNumero = /[0-9]*$/;
    let errorNombre = [], errorDescripcion = [], errorPrecio = [], errorStock = [], errorMarca = [], errorDescuento = [], errorEstado = [], errorCategoria = [], errorSubCategoria = [], errorImagen = [], errorImagen2 = [];

    if (nombre.length <= 0) errorNombre = [...errorNombre, 'No deberia estar vacio este campo'];
    if (nombre.length > 80) errorNombre = [...errorNombre, 'Nombre demasiado Largo max 50 caracteres'];
    if (descripcion.length <= 0) errorDescripcion = [...errorDescripcion, 'No deberia estar vacio este campo'];
    if (precio.length <= 0) errorPrecio = [...errorPrecio, 'Precio no debe estar vacio'];
    if (!regexNumero.test(precio)) errorPrecio = [...errorPrecio, 'Solo numeros'];
    if (stock.length <= 0) errorStock = [...errorStock, 'Stock no debe estar vacio'];
    if (!regexNumero.test(stock)) errorStock = [...errorStock, 'Solo numeros'];
    if (marca === 'marca') errorMarca = [...errorMarca, 'Seleccione una marca'];
    if (descuento === 'descuento') errorDescuento = [...errorDescuento, 'Seleccione un descuento'];
    if (estado === 'estado') errorEstado = [...errorEstado, 'Seleccione un estado'];
    if (categoria === 'categoria') errorCategoria = [...errorCategoria, 'Seleccione una categoria'];
    if (!subcategoria) errorSubCategoria = [...errorSubCategoria, 'Seleccione una categoria'];
    if (imagen.length <= 0) errorImagen = [...errorImagen, 'La imagen no debe estar vacio'];
    if (imagen2.length <= 0) errorImagen2 = [...errorImagen2, 'La imagen2 no debe estar vacio'];

    imprimirErrores(errorNombre, formProductos.children[1])
    imprimirErrores(errorDescripcion, formProductos.children[2])
    imprimirErrores(errorPrecio, formProductos.children[3].children[0])
    imprimirErrores(errorStock, formProductos.children[3].children[1])
    imprimirErrores(errorMarca, formProductos.children[3].children[2])
    imprimirErrores(errorDescuento, formProductos.children[4].children[0])
    imprimirErrores(errorEstado, formProductos.children[4].children[1])
    imprimirErrores(errorCategoria, formProductos.children[4].children[2])
    imprimirErrores(errorImagen, formProductos.children[5])
    imprimirErrores(errorImagen2, formProductos.children[6])



    if (!errorNombre.length && !errorDescripcion.length && !errorPrecio.length && !errorStock.length && !errorMarca.length && !errorMarca.length && !errorDescuento.length && !errorEstado.length && !errorCategoria.length && !errorImagen.length && !errorImagen2.length) {
        apiAddProducto(values)
        return;
    }



}

async function apiAddProducto(values) {
    const { nombre, descripcion, precio, stock, marca, descuento, estado, categoria, subcategoria, imagen, imagen2 } = values;

    const formData = new FormData();
    formData.append('nombre_prod', nombre);
    formData.append('descripcion_prod', descripcion);
    formData.append('precio_prod', precio);
    formData.append('stock_prod', stock);
    formData.append('id_marca', marca);
    formData.append('id_descuento', descuento);
    formData.append('id_estado', estado);
    formData.append('id_categoria', categoria);
    formData.append('id_subcategoria', subcategoria);
    formData.append('imagen_prod', imagen[0]);
    formData.append('imagen2_prod', imagen2[0]);
    const url = `${apiGlobal}/apiAddProductos`;


    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const respuesta = await response.json();
        productoNuevo = respuesta.productos.filter(pro => pro.id_prod === String(respuesta.now.id));
        producto = [...producto, productoNuevo[0]];
        imprimirProductos();

    } catch (error) {
        console.log(error);
    }
}