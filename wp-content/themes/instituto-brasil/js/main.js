var offset_scroll_nav = 30;

jQuery(function ($) {

    //scroll suave em links para sessoes
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top - offset_scroll_nav}, 800);
    });

    //fixa menu ao descer
    $(window).bind('scroll', function () {
        if ($(window).scrollTop() > offset_scroll_nav) {
            $('#menu').addClass('fix');
        } else {
            $('#menu').removeClass('fix');
        }
    });

    //carrosel cursos
    $('#carr_cursos').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        arrows: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ],
        prevArrow: '<button type="button" class="slick-prev slick-arrow" style="top:35%"><</button>',
        nextArrow: '<button type="button" class="slick-next slick-arrow" style="top:35%"><</button>'

    });

    $('#carr_cursos').css('display', 'block');

    $('#carr_cursos2').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        arrows: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 825,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ],
        prevArrow: '<button type="button" class="slick-prev slick-arrow" style="top:35%"><</button>',
        nextArrow: '<button type="button" class="slick-next slick-arrow" style="top:35%"><</button>'

    });

    $('#carr_cursos2').css('display', 'block');

});

function redireciona(url) {
    window.location.href = url;
}