jQuery(document).ready(() => {
    const reviewsSwiper = new Swiper('.reviews-slider', {
        loop: false,
        slidesPerView: 'auto',
        spaceBetween: 40,
        freeMode: {
            enabled: true,
            sticky: true,
        },
        grabCursor: true,
    })
});