const productos = document.querySelector('#productos');
const cardCard = document.querySelector('.cart-cards');
const btnCarrito = document.querySelector('#btn-carrito');
const btnCloseCart = document.querySelector('#btnCloseCart');
const carrito = document.querySelector('#carrito');
btnCarrito.addEventListener('click', (e) => {
    e.preventDefault();
    carrito.classList.add('showCart');



})

// document.addEventListener('click', (e) => {
//     if (!e.target.classList.contains('showCart')) {
//         carrito.classList.remove('showCart');
//     }
// })

btnCloseCart.addEventListener('click', () => {
    carrito.classList.remove('showCart');
});
let carritoInfo = [];

// productos.addEventListener('click', (e) => {
//     if (e.target.classList.contains('card-btn')) {
//         const carrito = document.querySelector('#carrito');
//         carrito.classList.add('show2');
//         const idProducto = e.target.dataset.id;
//         // apiAddCart(idProducto);
//     }
// })

