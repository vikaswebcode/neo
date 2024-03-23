jQuery(document).ready(() => {
    const insSwiper = new Swiper('.inspiration-slider', {
        loop: false,
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
            nextEl: '.inspiration-slider-btn-next',
            prevEl: '.inspiration-slider-btn-prev',
        },
        freeMode: {
            enabled: true,
            sticky: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
        },
    })
});
