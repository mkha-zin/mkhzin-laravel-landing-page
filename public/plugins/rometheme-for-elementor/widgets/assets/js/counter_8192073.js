jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-counter.default', function ($scope, $) {
        var counter = $scope.find('.rkit-counter');
        var count = counter.data('start');
        var targetCount = counter.data('value'); // Target value
        var animationDuration = counter.data('duration'); // in milliseconds
        var dataSeparator = counter.data('separator');
        var step = (counter.data('step')) ? counter.data('step') : 1;

        var separator;

        switch (dataSeparator.separator) {
            case 'comma':
                separator = ",";
                break;
            case 'dot':
                separator = ".";
                break;
            case 'underline':
                separator = "_";
                break;
            case 'space':
                separator = " ";
                break;
            case 'apostrophe':
                separator = "'";
                break;
            default:
                separator = "";
                break;
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, separator);
        }

        function animateCounter() {
            var currentNumber = count;
            var interval = setInterval(function () {
                currentNumber += step;
                var text = (dataSeparator.thousand_separator) ? numberWithCommas(currentNumber) : currentNumber ; 
                var targetText =  (dataSeparator.thousand_separator) ? numberWithCommas(targetCount) : targetCount ;
                if (currentNumber <= targetCount) {
                    counter.find(".count").text(text);
                } else {
                    counter.find(".count").text(targetText);
                    clearInterval(interval); // Stop the interval when reaching targetCount
                }
            }, animationDuration / ((targetCount - count) / step));
        }

        // Use Intersection Observer to trigger animation when element is in viewport
        var options = {
            root: null,
            rootMargin: "0px",
            threshold: 0.75 // Intersection ratio required to trigger the callback
        };

        var observer = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter();
                    observer.unobserve(entry.target); // Stop observing after triggering once
                }
            });
        }, options);

        observer.observe(counter[0]);
    });
});