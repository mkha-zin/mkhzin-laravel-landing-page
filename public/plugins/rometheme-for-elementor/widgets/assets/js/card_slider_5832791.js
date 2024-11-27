jQuery(window).on('elementor/frontend/init', function () {
  elementorFrontend.hooks.addAction('frontend/element_ready/rkit-card-slider.default', function ($scope, $) {

    const slider = $scope.find('.rkit-card-slider');
    var config = slider.data('config');

    console.log(config.initial_slide);

    var conf = {
      rtl: config.rtl,
      arrows: config.arrows,
      dots: config.dots,
      autoplay: config.autoplay,
      loop: config.loop,
      speed: config.speed,
      slidesPerView: config.slidesPerView,
      slidesPerGroup: config.slidesPerGroup,
      breakpoints: config.breakpoints,
      grabCursor : true,
      initialSlide : (config.initial_slide == null) ? 0 : config.initial_slide,
    }

    var pagination = {
      pagination: {
        enabled: config.dots,
        el: '.rkit-cardslider-pagination',
        type: 'bullets',
        clickable: true,
        bulletClass: 'rkit-cardslider-bullet',
        bulletActiveClass: 'rkit-cardslider-bullet-active',
        clickableClass: 'rkit-cardslider-bullet-clickable'
      }
    }

    var navigation = {
      navigation: {
        enabled: config.arrows,
        nextEl: '.rkit-swiper-button-next',
        prevEl: '.rkit-swiper-button-prev',
      }
    }

    var dataConfig = { ...conf, ...pagination, ...navigation }

    let container = $scope.find('.rkit-swiper');
    const swiper = new Swiper(container[0], dataConfig);
  });
});
