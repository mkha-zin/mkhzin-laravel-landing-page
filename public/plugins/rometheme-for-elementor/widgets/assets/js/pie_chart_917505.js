jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-pie-chart.default', function ($scope, $) {
        var ctx = $scope.find("#pieChart")[0].getContext("2d");
        var labels = $scope.find('#pieChart').data('label');
        var datasets = $scope.find('#pieChart').data('datasets');
        var legend = $scope.find('#pieChart').data('legend');
        var type = $scope.find('#pieChart').data('type');

        var data = {
            labels: labels,
            datasets: [datasets]
        };

        var options = {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: legend
            }
        };

        var myChart = new Chart(ctx, {
            type: type,
            data: data,
            options: options
        });
    });
});
