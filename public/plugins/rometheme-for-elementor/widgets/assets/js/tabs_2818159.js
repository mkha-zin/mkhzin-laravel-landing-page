jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-tabs.default', function ($scope, $) {
        var container = $scope.find('.rkit-tab-container');
        var tabBtn = container.find('.rkit-tab-btn-item');
        var tabContent = container.find('.rkit-tab-content');

        tabBtn.click(function () {
            var tabContentId = $(this).data('tab');
            tabBtn.removeClass('active');
            tabContent.removeClass('active');
            var tabContentTarget = container.find('#' + tabContentId);
            tabContentTarget.addClass('active');
            $(this).addClass('active');
        });

    });
});
