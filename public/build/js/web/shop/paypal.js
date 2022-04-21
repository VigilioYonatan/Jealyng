const btnCarritoOption = document.querySelector('#btnCarritoOption');
const btnPayOption = document.querySelector('#btnPayOption');
const btnCompletar = document.querySelector('#btnCompletar');

// selectores
const tablaCarritoContainer = document.querySelector('.tablaCarrito-container');
const tablaCarritoPay = document.querySelector('.tablaCarrito-pay');
const tablaCarritoContainer2 = document.querySelector('.tablaCarrito-container2');
const tablaCarritoPay2 = document.querySelector('.tablaCarrito-pay2');


btnCarritoOption.addEventListener('click', e => {
    btnPayOption.classList.add('CarritoBtn__linked')
    btnCarritoOption.classList.remove('CarritoBtn__linked')
    tablaCarritoContainer.classList.remove('hidden');
    tablaCarritoPay.classList.remove('hidden');
    tablaCarritoContainer2.classList.add('hidden');
    tablaCarritoPay2.classList.add('hidden');
})
btnPayOption.addEventListener('click', e => {
    btnPayOption.classList.remove('CarritoBtn__linked')
    btnCarritoOption.classList.add('CarritoBtn__linked')
    tablaCarritoContainer.classList.add('hidden');
    tablaCarritoPay.classList.add('hidden');
    tablaCarritoContainer2.classList.remove('hidden');
    tablaCarritoPay2.classList.remove('hidden');
})
if (btnCompletar) {
    btnCompletar.addEventListener('click', e => {
        e.preventDefault();
        btnPayOption.classList.remove('CarritoBtn__linked')
        btnCarritoOption.classList.add('CarritoBtn__linked')
        tablaCarritoContainer.classList.add('hidden');
        tablaCarritoPay.classList.add('hidden');
        tablaCarritoContainer2.classList.remove('hidden');
        tablaCarritoPay2.classList.remove('hidden');
    })
}

