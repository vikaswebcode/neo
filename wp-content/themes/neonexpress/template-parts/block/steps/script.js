jQuery(document).ready(($) => {
    const section = $('.steps')
    const sectionHeight = section.height()

    // $(window).resize(function() {
    //     let windowWidth = $(window).width();
    //     let imageWidth = Math.min(windowWidth, 1920);
    //     let imageHeight = 414 + (imageWidth - 1440) * (138 / 480);
        
    //     let containerTop = (imageHeight - $('.steps .container').height()) / 2;
        
    //     if($(window).width() >= 1440 && $(window).width() <= 1920) {
    //         $('.steps .container').css('marginTop', containerTop + 'px');
    //         $('.steps ul li.middle').css('marginTop', containerTop * 4 + 'px');
    //     } else if($(window).width() < 1440) {
    //         $('.steps .container').css('marginTop', 0 + 'px');
    //         $('.steps ul li.middle').css('marginTop', 0 + 'px');
    //     }
    // });
    $(window).resize(function() {
        let windowWidth = $(window).width();
        let imageWidth = Math.min(windowWidth, 1920); // Максимальная ширина изображения 1920px
        let imageHeight = 414 + (imageWidth - 1440) * (138 / 480); // Вычисление высоты изображения
      
        var containerTop = (imageHeight - $('.steps .container').height()) / 2;
      
        if($(window).width() >= 1440 && $(window).width() <= 1920) {
            $('.steps .container').css('top', containerTop + 'px');
        
            // let backgroundPosition = -(containerWidth - windowWidth) / 2;
            // $('.steps').css('background-position-y', backgroundPosition + 'px 0');
        } else if($(window).width() < 1440) {
            $('.steps .container').css('top', 0 + 'px');
            // $('.steps').css('background-position-y', 'center');
        }
      });
      
      $(window).trigger('resize');
});
