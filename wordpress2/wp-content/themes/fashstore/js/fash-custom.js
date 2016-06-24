jQuery(document).ready(function($){
    
   $('.feature-cat-product').slick({
        infinite: false,
        centerMode: false,
        useCss: false,
        easing: 'linear',
        edgeFriction: '0.15',
        lazyLoad: 'ondemand',
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        cssEase: 'ease',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
            ]
    });
    
    $('.new-prod-slide').find('.add_to_cart_button').prepend('<i class="fa fa-shopping-cart"></i>');
    $('.fash-feat-product').find('.add_to_cart_button').prepend('<i class="fa fa-shopping-cart"></i>');
    $('.gridlist-buttonwrap').find('.add_to_cart_button').prepend('<i class="fa fa-shopping-cart"></i>');
    $('.related').find('.add_to_cart_button').prepend('<i class="fa fa-shopping-cart"></i>');
    $('.upsells.products').find('.add_to_cart_button').prepend('<i class="fa fa-shopping-cart"></i>');

    //$('.add_to_wishlist').html('<i class="fa fa-heart-o">');
    
});