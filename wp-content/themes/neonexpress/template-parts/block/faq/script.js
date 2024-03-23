jQuery(document).ready(($) => {
    $('.toggle').click(function(e) {
      if ($(this).next().hasClass('show') && $(this).hasClass('show')) {
          $(this).removeClass('show')
          $(this).next().removeClass('show');
          $(this).next().slideUp(350);
      } else {
          $('.toggle').removeClass('show')
          $(this).addClass('show')
          $(this).parent().parent().find('li .inner').removeClass('show');
          $(this).parent().parent().find('li .inner').slideUp(350);
          $(this).next().toggleClass('show');
          $(this).next().slideToggle(350);
      }
  });
})
