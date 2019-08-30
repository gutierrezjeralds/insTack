//Script for random pin post rotate
function postRotateView() {
    function shuffle(obj) {
        var l = obj.length,
            i = 0,
            rnd,
            tmp;

        while (i < l) {
            rnd = Math.floor(Math.random() * i);
            tmp = obj[i];
            obj[i] = obj[rnd];
            obj[rnd] = tmp;
            i += 1;
        }
    }

    // declare OUTSIDE the function for correct scope
    var rotate;
    var pinImage

    // Simple function to set up the classes variable and shuffle.
    function setUpRotate() {
        rotate = ["pin-post-rotate-clockwise", "pin-post-rotate-counterclockwise", "pin-post-rotate-none"];
        shuffle(rotate);
    }
    function setUpPinImage() {
        pinImage = ["/images/pin-img/pin-blue.png", "/images/pin-img/pin-green.png", "/images/pin-img/pin-red.png", "/images/pin-img/pin-yellow.png"];
        shuffle(pinImage);
    }

    jQuery(".div-pin-post-with-rotate").each(function() {
        // Check if classes is set / empty.  If so, set up the classes again.
        if (!rotate  || rotate.length < 1) {
            setUpRotate();
        }
        jQuery(this).addClass(rotate.pop());
    });

    jQuery(".pin-post-img").each(function() {
        // Check if classes is set / empty.  If so, set up the classes again.
        if (!pinImage  || pinImage.length < 1) {
            setUpPinImage();
        }
        jQuery(this).attr('src', pinImage.pop());
    });
}
//End script for random pin post rotate

//Scripts for corousel item number display
function postCarouselItem() {
    jQuery(".div-image-carousel").each(function() {
        var totalCarouselItems = jQuery(this).find(".carousel").find('.item').length;
        var currentCarouselIndex = jQuery(this).find(".carousel").find('div.active').index() + 1;
        jQuery(this).find('.num-carousel-items').html(''+currentCarouselIndex+'/'+totalCarouselItems+'');

        jQuery(this).find(".carousel").on('slid.bs.carousel', function() {
            currentCarouselIndex = jQuery(this).find('div.active').index() + 1;
            jQuery(this).find('.num-carousel-items').html(''+currentCarouselIndex+'/'+totalCarouselItems+'');
        });
    });
}
//End scripts for corousel item number display

//Script for all each function for ajax after success
postRotateView();
postCarouselItem();

$(document).ajaxSuccess(function() {
    postRotateView();
    postCarouselItem();
});
//End script for all each function for ajax after success