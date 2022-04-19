
// agregar carrito
const btnCarrito = document.querySelector('#btn-carrito');
const btnCloseCart = document.querySelector('#btnCloseCart');
const carrito = document.querySelector('#carrito');
btnCarrito.addEventListener('click', (e) => {
    e.preventDefault();
    carrito.classList.add('showCart');
    document.body.style.cssText = 'overflow:hidden'; // ocultar el scroll

    modalBlack()


})

btnCloseCart.addEventListener('click', () => {
    carrito.classList.remove('showCart');
    const contenidoBlack = document.querySelector('.container-black2');
    document.body.style.cssText = 'overflow:visible'; // ocultar el scroll

    contenidoBlack.remove();
});



