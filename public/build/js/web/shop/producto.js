const slider = '.mostrar-card-container2__list';
sliderCard(slider)
//productos.php
const addCart = document.querySelector('#addCart');
const idProd = addCart.parentElement.dataset.id;
const cantidad = addCart.parentElement.children[4].children[0];
const stock_prod = addCart.parentElement.children[4].children[1].children[0].textContent;


cantidad.addEventListener('change', e => {
    if (Number(cantidad.value) > Number(stock_prod)) {
        cantidad.value = stock_prod;
    }
    if (Number(cantidad.value) < 1) {
        cantidad.value = 1;
    }
})


addCart.addEventListener('click', e => {
    e.preventDefault();
    const values = {
        cantidad: cantidad.value,
        id: idProd
    }
    apiAddCarrito(values);
})


