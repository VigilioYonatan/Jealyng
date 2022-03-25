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


var gliderBrand = new Glider(document.querySelector('.brand-list'), {
    slidesToShow: 2, // empieza como modo celular . muestra el tamaño de la imagen
    slidesToScroll: 1, // cuando le das siguiente los pasos que va dar
    draggable: true, // arrastable
    arrows: {
        prev: '.brand-next',  //boton anterior
        next: '.brand-previous' //boton siguiente
    },
    responsive: [ //responsive
        {
            // screens greater than >= 775px
            breakpoint: 450,
            settings: {
                // Set to `auto` and provide item width to adjust to viewport
                slidesToShow: 3,
                slidesToScroll: 1,
                duration: 0.5
            }
        }, {
            // screens greater than >= 1024px
            breakpoint: 800,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                duration: 0.5,
            }
        }, {
            // screens greater than >= 1024px
            breakpoint: 1250,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
                duration: 0.5,
            }
        }
    ]
});
sliderAuto(glider, 3000)
sliderAuto(gliderBrand, 3000)
