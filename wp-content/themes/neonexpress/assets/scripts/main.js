import 'jquery-ui'  
import 'dropzone/dist/dropzone-min'

jQuery(document).ready(function($) {
    $('.default-page').each(function() {
        $(this).children().not('section').wrapAll('<div class="container"></div>');
    });

    if ($('.hero').length === 0) {
        $('.ne-main').addClass('without-hero');
        $('.without-hero').css('padding-top', $('header').outerHeight() + 50)
    }
    
    const blogNav = function() {
        const menuItems = $('.category-link')

        console.log(menuItems)
    }

    blogNav()

    const dropDown = $('<span class="open-children"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M6.99043 3.94022L13.3849 10.5001L6.99043 17.06C6.87595 17.1772 6.81186 17.3345 6.81186 17.4983C6.81186 17.6622 6.87595 17.8195 6.99043 17.9367C7.04603 17.9935 7.1124 18.0386 7.18564 18.0693C7.25889 18.1001 7.33754 18.116 7.41699 18.116C7.49644 18.116 7.57509 18.1001 7.64834 18.0693C7.72158 18.0386 7.78795 17.9935 7.84355 17.9367L14.6476 10.9582C14.767 10.8356 14.8339 10.6712 14.8339 10.5001C14.8339 10.329 14.767 10.1646 14.6476 10.042L7.84487 3.06347C7.78922 3.00632 7.72269 2.9609 7.6492 2.92988C7.57571 2.89887 7.49676 2.88289 7.41699 2.88289C7.33722 2.88289 7.25827 2.89887 7.18478 2.92988C7.11129 2.9609 7.04476 3.00632 6.98912 3.06347C6.87464 3.18068 6.81055 3.33801 6.81055 3.50185C6.81055 3.66568 6.87464 3.82302 6.98912 3.94022L6.99043 3.94022Z" fill="white"/></svg></span>')
    
    $('ul.children').before(dropDown)

    $('span.category-name').on('click', function() {
        let categoryId = $(this).data('category-id');
        let $this = $(this)
        
        $.ajax({
            url: themeVars.ajaxUrl,
            type: 'post',
            data: {
                action: 'get_posts_by_category',
                category_id: categoryId,
            },

            success: function(response) {
                    $('.idea-gallery-listing-caption').text($this.text())
                    if($('.idea-gallery-overlay').hasClass('open')) {
                        $('.idea-gallery-overlay').removeClass('open')
                        $('body').removeClass('open')
                    }
                    $('.templates-list').animate({
                            opacity: 0,
                    }, 1000)
                    setTimeout(()=>{
                        $('.templates-list').html(response)
                        $('.templates-list').animate({
                            opacity: 1,
                    }, 1000)
                    }, 1000)
            },
        });
    });

    $('li[class*="cat-item-"]').each(function() {
        var classNames = $(this).attr('class').split(' ');
        var categoryNumber = null;
    
        $.each(classNames, function(index, className) {
          if (className.indexOf('cat-item-') === 0) {
            var numberString = className.replace('cat-item-', '');
            categoryNumber = parseInt(numberString);
            return false;
          }
        });
    
        if (!isNaN(categoryNumber)) {
          $(this).children('span.category-name').attr('data-category-id', categoryNumber);
        }
    });

    $('.open-children').click(function() {
        if($(this).hasClass('open') && $(this).siblings('.children').hasClass('open')) {
            $(this).siblings('.category-name').removeClass('open')
            $(this).removeClass('open')
            $(this).siblings('.children').removeClass('open').slideUp()
        } else {
            $('.open-children').removeClass('open')
            $('.category-name').removeClass('open')
            $('.children').removeClass('open').slideUp()
            $(this).siblings('.category-name').addClass('open')
            $(this).addClass('open')
            $(this).siblings('.children').addClass('open').slideDown()
        }
    })

    $('.top-category').click(function(){
        $('.idea-gallery-listing-caption').text($(this).text())
        if($(this).hasClass('active')) {
            return
        } else {
            $('.top-category').removeClass('active')
            if($(this).hasClass('top-category_first')) {
                $('.top-category_first').addClass('active')
                $('.category-filter_top-first').css('display', 'block')
                $('.category-filter_top-second').css('display', 'none')
            }
            if($(this).hasClass('top-category_second')) {
                $('.top-category_second').addClass('active')
                $('.category-filter_top-first').css('display', 'none')
                $('.category-filter_top-second').css('display', 'block')
            }
        }
    })

    // Navigation
    const navButton = $('.menu-trigger')
    const filterButton = $('.filter-trigger')

    function navToggle() {
        $('body').toggleClass('open')
        $('.site-header').toggleClass('open')
    }

    function filterToggle() {
        $('body').toggleClass('open')
        $('.idea-gallery-overlay').toggleClass('open')
    }

    navButton.click(navToggle)
    filterButton.click(filterToggle)

    const contactForm = $('#submit-form')

    function showThankYouMessage() {
        $('.thx-message').removeClass('hidden').addClass('fadeIn');
      }
    
      function hideThankYouMessage() {
        $('.thx-message').removeClass('fadeIn').addClass('fadeOut');
        
        setTimeout(function() {
          $('.thx-message').addClass('hidden').removeClass('fadeOut');
        }, 500);
      }

    const sendForm = function() {
        let data = {
            action: 'send_contact_form',
            name: $('input[name="name"').val(),
            contact: $('input[name="contact-data"]').val(),
            message: $('textarea[name="message"]').val(),
        }

        $.ajax({
            type: 'POST',
            url: themeVars.ajaxUrl,
            data: data,
            success: function(){
                $('input[name="name"').val('')
                $('input[name="contact-data"]').val('')
                $('textarea[name="message"]').val('')
                showThankYouMessage();

                setTimeout(function() {
                    hideThankYouMessage();
                }, 5000)
            },
        })
    }

    contactForm.click(function(e) {
        e.preventDefault()
        sendForm()
    })

    $('.hero-scroll').click(function(){
        let headerHeight = $('#masthead').outerHeight()
        let heightHero = $('.hero').outerHeight()
        $('html, body').animate({ scrollTop: heightHero - headerHeight }, 800);
    })

    // CUSTOM QUOTE
    const headerHeight = $('#masthead').outerHeight()

    $('.custom-quote').css('padding-top', headerHeight)

    $('.quote-type__link').click(function(e){
        e.preventDefault()
        $('.get-a-quote__part-one').css('display', 'none')
        $('.get-a-quote__part-two').css('display', 'block')

        sessionStorage.setItem('quoteType', $(this).data('type'))

        if( sessionStorage.getItem('quoteType') === 'business' ) {
            $('#quote-company-field').css('display', 'block')
        } else {
            $('#quote-company-field').css('display', 'none')
            $('#quote-company').val('')
        }
    })

    const emailInput = document.getElementById('quote-email')
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    $('#step-3').click(function(e){
        e.preventDefault()

        const email = emailInput.value.trim();
    
        if (email === "") {
            $('.error-email').hide()
            $('.email-empty').show()
            return;
        } else if(!emailRegex.test(email)) {
            $('.error-email').hide()
            $('.email-incorrect').show()
            return;
        } else {
            $('.error-email').hide()
            $('.get-a-quote__part-one').css('display', 'none')
            $('.get-a-quote__part-two').css('display', 'none')
            $('.get-a-quote__part-three').css('display', 'block')
        }
    })

    $('#back-to-one').click(function(){
        $('.get-a-quote__part-one').css('display', 'block')
        $('.get-a-quote__part-two').css('display', 'none')
        $('.get-a-quote__part-three').css('display', 'none')
    })

    $('#back-to-two').click(function(){
        $('.get-a-quote__part-one').css('display', 'none')
        $('.get-a-quote__part-two').css('display', 'block')
        $('.get-a-quote__part-three').css('display', 'none')
    })

    $('.contact-form-field-icons__up_quantity').on('click', function(){
        if($('#quote-quantity').val().trim() != '') {
            let currentValue = parseInt($('#quote-quantity').val())
            currentValue += 1
            $('#quote-quantity').val(currentValue)
        } else {
            $('#quote-quantity').val(parseInt(1))
            if($('#quote-quantity').val() === 1) {
                let currentValue = parseInt($('#quote-quantity').val())
                currentValue += 1
                $('#quote-quantity').val(currentValue)
            }
        }
    })

    $('.contact-form-field-icons__down_quantity').on('click', function(){
        let currentValue = parseInt($('#quote-quantity').val())

        if (currentValue > 1) {
            currentValue -= 1;
      
            $('#quote-quantity').val(currentValue);
        }
    })

    $('.contact-form-field-icons_date').click(function(){
        $('#quote-date').datepicker({
            minDate: 0,
        })
        $('#quote-date').datepicker('show')
    })

    $(".date-icon").click(function() {
        console.log('click')
        $("#myDateInput").focus();
      });



    /* eslint-disable */
    const calcPrice = function(height, width) {
        let basePrice = 100;
        let size = height * width;
        let price = basePrice + (size * 0.1);

        return price;
    }

    $( "#slider" ).slider({
        step: 10,
        min: 10,
        max: 100,
        slide: function(event, ui) {
            $("#price").text(calcPrice(ui.value, ui.value) + '€');
        },
    });

    /* eslint-disable */
    Dropzone.options.myDropzone = {
        url: 'url', 
        maxFilesize: 5,
        acceptedFiles: ".jpg, .jpeg, .png, .svg, .ai",
        previewsContainer: '#dropzone-previews',
        autoProcessQueue: false,
    };

    const myDropzone = new Dropzone("#dropzone-previews", Dropzone.options.myDropzone);


    const dropZone = $('#uploadContainer');
    const fileInput = $('#fileInput');

    dropZone.on('dragover', function(event) {
        event.preventDefault();
        $(this).addClass('highlight');
    });

    dropZone.on('dragleave', function(event) {
        $(this).removeClass('highlight');
    });

    dropZone.on('drop', function(event) {
        event.preventDefault();
        $(this).removeClass('highlight');

        const files = event.originalEvent.dataTransfer.files;

        // Добавляем файлы в input
        const newInput = $('<input type="file" id="fileInput" name="uploaded_files[]" accept=".jpg, .jpeg, .png, .svg, .ai" multiple />');
        newInput[0].files = files;
    
        // Заменяем старый input на новый
        fileInput.replaceWith(newInput);
    

        handleFiles(files);
    });

    fileInput.on('change', function() {
        const files = $(this)[0].files;
        handleFiles(files);
    });

    function handleFiles(files) {
        myDropzone.removeAllFiles()
        
        for (const file of files) {
            console.log('Uploaded file:', file.name);
        }
        
        for (let i = 0; i < files.length; i++) {
            myDropzone.addFile(files[i]);
        }
    }

    const sendQuote = function() {
    let formData = new FormData();
        formData.append('action', 'send_quote_form');
        formData.append('quote-type', sessionStorage.getItem('quoteType'));
        formData.append('company', $('#quote-company').val());
        formData.append('name', $('#quote-name').val());
        formData.append('email', $('#quote-email').val());
        formData.append('phone', $('#quote-phone').val());
        formData.append('country', $('#quote-country').val());
        formData.append('reference', $('#quote-reference').val());
        formData.append('description', $('#quote-description').val());
        formData.append('mounting', $('#quote-mounting').val());
        formData.append('size', $("#slider").slider("value"));
        formData.append('type', $('#quote-indoor-outdoor').val());
        formData.append('quantity', $('#quote-quantity').val());
        formData.append('deadline', $('#quote-date').val());
        
        let files = $('#fileInput')[0].files;
        for (let i = 0; i < files.length; i++) {
            formData.append('uploaded_files[]', files[i]);
        }

        const email = emailInput.value.trim();
    
        if (email === "") {
            $('.error-email').hide()
            $('.email-empty').show()
            $('.get-a-quote__part-one').css('display', 'none')
            $('.get-a-quote__part-two').css('display', 'block')
            $('.get-a-quote__part-three').css('display', 'none')
            return;
        } else if(!emailRegex.test(email)) {
            $('.error-email').hide()
            $('.email-incorrect').show()
            $('.get-a-quote__part-one').css('display', 'none')
            $('.get-a-quote__part-two').css('display', 'block')
            $('.get-a-quote__part-three').css('display', 'none')
            return;
        } else {
            $('.error-email').hide()

            $.ajax({
                type: 'POST',
                url: themeVars.ajaxUrl,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response)
                    $('.get-a-quote__part-one').css('display', 'none')
                    $('.get-a-quote__part-two').css('display', 'none')
                    $('.get-a-quote__part-three').css('display', 'none')
                    $('.get-a-quote__part-four').css('display', 'block')
                },
            })
        }
    }

    $('#submit-quote').click(function(e){
        e.preventDefault()
        sendQuote()
    })

    // $.ajax({
    //     type: 'POST',
    //     url: themeVars.ajaxUrl,
    //     data: {
    //         action: 'neon_editor_get_template',
    //         post_type: 'relevant-templates',
    //     },
    //     success: function(response) {
    //         console.log(response)
    //     },
    // })
})  