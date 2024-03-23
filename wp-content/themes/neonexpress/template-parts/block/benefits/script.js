jQuery(document).ready(($) => {
    const benefitsContainer = $('.benefits ul')

    function benefitsGap(container) {
        const elems = container.children()
        let columnGap
        let elemsQuantity
        let elemWidth
        let maxHeight = 0
        let maxHeightItem

        elems.each(function(){
            let currentHeight = $(this).outerHeight()

            if (currentHeight > maxHeight) {
                maxHeight = currentHeight;
                maxHeightItem = $(this);
            }
        })

        elems.not(maxHeightItem).css('height', maxHeight + 'px');

        if(elems.length != 3) {
            if($(window).width() >= 768) {
                elemsQuantity = 2
                columnGap = 30
            }

            if($(window).width() >= 1200) {
                elemsQuantity = 4
                columnGap = 30 * 3
            }
    
        } else if(elems.length == 3) {
            if($(window).width() >= 768) {
                elemsQuantity = elems.length
                columnGap = 30 * 2
            }
        }

        if($(window).width() <= 767) {
            elemWidth = 100 + '%'
        } else {
            elemWidth = (container.width() - columnGap) / elemsQuantity
        }

        elems.each(function(){
            $(this).css('width', elemWidth)
        })

        console.log(elems.length)
    }

    benefitsGap(benefitsContainer)

    $(window).resize(() => {
        benefitsGap(benefitsContainer)
    })
});
