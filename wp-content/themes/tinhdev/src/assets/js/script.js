$(document).ready(function () {
    $('.slick').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 4,
        arrows: true,
        nextArrow: '<button type="button" class="custom-next"><i class="fa-solid fa-chevron-right"></i></button>',
        prevArrow: '<button type="button" class="custom-prev"><i class="fa-solid fa-chevron-left"></i></button>',
        responsive: [{
            breakpoint: 1024, settings: {
                slidesToShow: 3, slidesToScroll: 3, infinite: true, dots: true
            }
        }, {
            breakpoint: 600, settings: {
                slidesToShow: 2, slidesToScroll: 2
            }
        }, {
            breakpoint: 480, settings: {
                slidesToShow: 1, slidesToScroll: 1
            }
        }]
    });
    $('.slick-certifications').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        responsive: [{
            breakpoint: 1024, settings: {
                slidesToShow: 2, slidesToScroll: 1, infinite: true, dots: true
            }
        }, {
            breakpoint: 600, settings: {
                slidesToShow: 1, slidesToScroll: 1
            }
        }, {
            breakpoint: 480, settings: {
                slidesToShow: 1, slidesToScroll: 1
            }
        }]
    });

    $('.contact-slick').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 1024, settings: {
                slidesToShow: 3, slidesToScroll: 1, infinite: true, dots: true
            }
        }, {
            breakpoint: 600, settings: {
                slidesToShow: 2, slidesToScroll: 2
            }
        }, {
            breakpoint: 480, settings: {
                slidesToShow: 1, slidesToScroll: 1
            }
        }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    $(window).resize(function () {
        // Kiểm tra nếu màn hình lớn hơn 1024px (màn hình máy tính)
        if ($(window).width() > 1024) {
            $('.slider .slide-right').css('max-height', $('.slider .n2-section-smartslider').height() + 'px');
            $('.slider .box-content').css('max-height', $('.slider .n2-section-smartslider').height() + 'px');
        }
        else {
            // Reset lại max-height khi màn hình nhỏ hơn 1024px
            $('.slider .slide-right').css('max-height', '');
            $('.slider .box-content').css('max-height', '');
        }
    });

// Chạy hàm này ngay khi trang tải xong
    $(document).ready(function () {
        // Kiểm tra nếu màn hình lớn hơn 1024px (màn hình máy tính)
        if ($(window).width() > 1024) {
            $('.slider .slide-right').css('max-height', $('.slider .n2-section-smartslider').height() + 'px');
            $('.slider .box-content').css('max-height', $('.slider .n2-section-smartslider').height() + 'px');
        }
    });

    Fancybox.bind("[data-fancybox]", {
        // Your custom options
    });

});

