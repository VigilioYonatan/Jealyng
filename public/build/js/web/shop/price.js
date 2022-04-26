const btnFiltro = document.querySelector('#btnFiltro');


btnFiltro.addEventListener('click', e => {
    e.preventDefault();
    filtros.classList.toggle('filtros-active');
})

btnCerrarFiltro.addEventListener('click', e => {
    e.preventDefault();
    filtros.classList.remove('filtros-active');
})