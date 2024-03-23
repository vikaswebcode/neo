jQuery(document).ready(() => {
    const insSwiper = new Swiper('.ct_slider', {
        loop: true,
        slidesPerView: 5,
        spaceBetween: 20,
        navigation: {
            nextEl: '.ct_slider-btn-next',
            prevEl: '.ct_slider-btn-prev',
        },
        freeMode: {
            enabled: true,
            sticky: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 4,
            },
            992: {
                slidesPerView: 5,
            },
        },
    })
});
