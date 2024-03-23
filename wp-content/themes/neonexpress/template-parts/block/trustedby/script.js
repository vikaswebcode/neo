jQuery(document).ready(() => {
    const logosSwiper = new Swiper('.trustedby-companies', {
        loop: false,
        slidesPerView: 2,
        spaceBetween: 40,
        freeMode: {
            enabled: true,
            sticky: true,
        },
        grabCursor: true,
        breakpoints: {
            768: {
                slidesPerView: 3,
                spaceBetween: 60,
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 80,
            },
            1200: {
                slidesPerView: 6,
                spaceBetween: 100,
            },
        },
    })
});