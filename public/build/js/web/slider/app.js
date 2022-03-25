console.log('hola');
var glider = new Glider(document.querySelector('.wallpaper-list'), {
    slidesToShow: 1, // empieza como modo celular . muestra el tamaño de la imagen
    slidesToScroll: 1, // cuando le das siguiente los pasos que va dar
    draggable: true, // arrastable
    dots: '.carousel__indicadores',  // indicador de abajo
    arrows: {
        prev: '.wallpaper-previous',  //boton anterior
        next: '.wallpaper-next' //boton siguiente
    },
    responsive: [ //responsive
        {
            // screens greater than >= 775px
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

// funcion automatico
function sliderAuto(slider, miliseconds) {
    const slidesCount = slider.track.childElementCount;
    let slideTimeout = null;
    let nextIndex = 1;

    function slide() {
        slideTimeout = setTimeout(
            function () {
                if (nextIndex >= slidesCount) {
                    nextIndex = 0;
                }
                slider.scrollItem(nextIndex++);
            },
            miliseconds
        );
    }

    slider.ele.addEventListener('glider-animated', function () {
        window.clearInterval(slideTimeout);
        slide();
    });

    slide();
}
sliderAuto(glider, 3000)