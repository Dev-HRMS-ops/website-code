$(document).ready(function() {
    $("#projects-slider-2").owlCarousel({
        loop: true,
        margin: 10,
        dots: false,
        nav: false,
        center:true,
        navText: ["<i class='bi bi-caret-left-fill'></i>", "<i class='bi bi-caret-right-fill'></i>"],
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                dots: true,
                nav: true,
                items: 3
            }
        }
    });
});

$(document).ready(function () {
    $('#hero-slider').owlCarousel({
        loop: true,
        items: 1,
        dots: false,
        autoplay: true,
        smartSpeed: 1600
    });
});
