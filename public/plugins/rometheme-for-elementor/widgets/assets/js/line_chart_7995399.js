jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-line-chart.default', function ($scope, $) {
        var ctx = $scope.find("#lineChart")[0].getContext("2d");
        var labels = $scope.find('#lineChart').data('label');
        var datasets = $scope.find('#lineChart').data('datasets');
        var scales = $scope.find('#lineChart').data('scales');
        var legend = $scope.find('#lineChart').data('legend');

        var data = {
            labels: labels,
            datasets: [datasets]
        };

        var options = {
            responsive: true,
            maintainAspectRatio: true,
            scales: scales,
            plugins: {
                legend: legend
            }
        };

        var myChart = new Chart(ctx, {
            type: "line",
            data: data,
            options: options
        });
    });
});
