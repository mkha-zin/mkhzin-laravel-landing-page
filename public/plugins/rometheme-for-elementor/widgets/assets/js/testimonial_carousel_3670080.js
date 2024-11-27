jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-testimonial-carousel.default', function ($scope, $) {

        var testimonial = $scope.find('.rkit-testimonial-carousel');

        var config = testimonial.data('config');

        var testimonialSwiper = new Swiper(".rkit-testimonial-carousel .testimonial-container", {
            rtl: config.rtl,
            arrows: config.arrows,
            dots: config.dots,
            pauseOnHover: config.pauseOnHover,
            autoplay: config.autoplay,
            loop: config.loop,
            speed: config.speed,
            slidesPerView: config.slidesPerView,
            slidesPerGroup: config.slidesPerGroup,
            breakpoints: config.breakpoints,
            pagination: {
                enabled : config.dots,
                el: ".rkit-testimonial-carousel .rkit-testimonial-pagination",
                clickable: true,
                bulletClass : 'rkit-pagination-bullet',
                bulletActiveClass : 'rkit-pagination-bullet-active',
                clickableClass : 'rkit-pagination-bullet-clickable'
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              },
        });
    });
});