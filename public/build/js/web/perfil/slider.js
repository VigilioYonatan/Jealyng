// sliderss
var glider = new Glider(document.querySelector('.wallpaper-list'), {
    slidesToShow: 1, // empieza como modo celular . muestra el tamaño de la imagen
    slidesToScroll: 1, // cuando le das siguiente los pasos que va dar
    draggable: true, // arrastable
    dots: '.carousel__indicadores',  // indicador de abajo
    arrows: {
        prev: '.wallpaper-next',  //boton anterior
        next: '.wallpaper-previous' //boton siguiente
    },
    responsive: [ //responsive
        {
            breakpoint: 450,
            settings: {
                // Set to `auto` and provide item width to adjust to viewport
                slidesToShow: 1,
                slidesToScroll: 1,
                duration: 0.5
            }
        }
    ]
});