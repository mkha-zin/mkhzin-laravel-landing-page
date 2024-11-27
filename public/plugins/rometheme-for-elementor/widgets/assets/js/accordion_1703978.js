jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-accordion.default', function ($scope , $) {
        // Tambahkan event click pada header rkit-accordion
        $scope.find('.rkit-accordion-header').click(function () {
            // Tutup semua konten rkit-accordion kecuali yang sedang aktif
            $scope.find('.rkit-accordion-item').not($(this).closest('.rkit-accordion-item')).removeClass('open');
            // Toggle (sembunyikan/tampilkan) konten saat header di klik
            $(this).closest('.rkit-accordion-item').toggleClass('open');
        });
    });
});
