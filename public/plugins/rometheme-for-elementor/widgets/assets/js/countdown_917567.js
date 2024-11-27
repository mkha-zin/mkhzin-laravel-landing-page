jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-countdown.default', function ($scope, $) {

        function formatDate(dateString) {
            var parts = dateString.split(' ');
            if (parts.length === 2) {
                var datePart = parts[0];
                var timePart = parts[1];
                var timeParts = timePart.split(':');

                if (timeParts.length === 3) {
                    if (timeParts[2].length === 1) {
                        timeParts[2] = '0' + timeParts[2];
                    }
                }

                return datePart + 'T' + timeParts.join(':');
            }
            return '';
        }

        function updateCountdown($element, endDate) {
            if (!endDate) {
                console.error('Date attribute is missing or empty.');
                return;
            }

            var formattedDate = formatDate(endDate);
            console.log('Formatted date:', formattedDate);

            var countDownDate = new Date(formattedDate).getTime();
            console.log('Parsed countdown timestamp:', countDownDate);

            if (isNaN(countDownDate)) {
                console.error('Invalid countdown date:', formattedDate);
                return;
            }

            // Reset countdown display to '00'
            $element.find('.countdown-days').text('00');
            $element.find('.countdown-hours').text('00');
            $element.find('.countdown-minutes').text('00');
            $element.find('.countdown-seconds').text('00');

            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                var daysStr = (days < 10 ? '0' + days : days).toString();
                var hoursStr = (hours < 10 ? '0' + hours : hours).toString();
                var minutesStr = (minutes < 10 ? '0' + minutes : minutes).toString();
                var secondsStr = (seconds < 10 ? '0' + seconds : seconds).toString();
 
                if ($element.find('.countdown-days').text() !== daysStr) {
                    $element.find('.countdown-days').text(daysStr);
                }
                if ($element.find('.countdown-hours').text() !== hoursStr) {
                    $element.find('.countdown-hours').text(hoursStr);
                }
                if ($element.find('.countdown-minutes').text() !== minutesStr) {
                    $element.find('.countdown-minutes').text(minutesStr);
                }
                if ($element.find('.countdown-seconds').text() !== secondsStr) {
                    $element.find('.countdown-seconds').text(secondsStr);
                }

                if (distance < 0) {
                    clearInterval(x);
                    $element.find('.countdown-days').text('00');
                    $element.find('.countdown-hours').text('00');
                    $element.find('.countdown-minutes').text('00');
                    $element.find('.countdown-seconds').text('00');
                    
                    var expiredSection = $element.find('.expired-time-section');
                    var countdownWidget = $element.find('.count'); 

                    if (expiredSection.length && countdownWidget.length) {
                        expiredSection.show();
                        countdownWidget.hide();
                    }
                }
            }, 1000);
 
            $element.data('interval', x);
        }

        $scope.each(function() {
            var $element = $(this);
            var endDate = $element.find('#countdown').data('date');
            console.log('Initial end date:', endDate);

            var existingInterval = $element.data('interval');
            if (existingInterval) {
                clearInterval(existingInterval);
            }

            updateCountdown($element, endDate);
 
            $element.find('#countdown').on('change', function() {
                endDate = $(this).data('date');
                console.log('New end date:', endDate);
 
                existingInterval = $element.data('interval');
                if (existingInterval) {
                    clearInterval(existingInterval);
                }

                updateCountdown($element, endDate);
            });
        });
    });
});