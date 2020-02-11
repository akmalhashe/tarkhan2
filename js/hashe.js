jQuery(function(){
    jQuery("#mbItems").slick({
        arrows: false,
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        mobileFirst: true,
        speed: 700
    })

    jQuery("#latProds").slick({
        arrows: false,
        dots: true,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        mobileFirst: true,
        speed: 700,
        responsive: [{
                breakpoint: 767,
                settings: {
                    centerPadding: '0px',
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 6
                }
            }
        ]
    })


    /* Ready Ends */
})