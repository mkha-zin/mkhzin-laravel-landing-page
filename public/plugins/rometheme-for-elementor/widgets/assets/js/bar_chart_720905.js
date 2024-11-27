jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-bar-chart.default', function ($scope, $) {
        var ctx = $scope.find("#barChart")[0].getContext("2d");
        var labels = $scope.find('#barChart').data('label');
        var datasets = $scope.find('#barChart').data('datasets');
        var scales = $scope.find('#barChart').data('scales');
        var legend = $scope.find('#barChart').data('legend');

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
            type: "bar",
            data: data,
            options: options
        });
    });
});
