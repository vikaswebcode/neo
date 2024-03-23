jQuery(document).ready(() => {
    const ideasSwiper = new Swiper('.templates-slider', {
        loop: false,
        slidesPerView: 'auto',
        spaceBetween: 70,
        navigation: {
            nextEl: '.templates-slider-btn-next',
            prevEl: '.templates-slider-btn-prev',
        },
        freeMode: {
            enabled: true,
            sticky: true,
        },
        grabCursor: true,
    })
});