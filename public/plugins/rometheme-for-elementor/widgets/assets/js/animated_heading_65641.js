jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-animated-heading.default', function ($scope, $) {
        $('.rkit-animated-heading').each(function () {
            var duration = $(this).data('duration');

            var Typing = function (el, toRotate, period) {
                this.toRotate = toRotate;
                this.el = el;
                this.loopNum = 0;
                this.period = parseInt(period, 10) || duration;
                this.txt = '';
                this.isDeleting = false;
                this.tick();
            };

            Typing.prototype.tick = function () {
                var self = this;
                var i = this.loopNum % this.toRotate.length;
                var fullTxt = this.toRotate[i];

                if (this.isDeleting) {
                    this.txt = fullTxt.substring(0, this.txt.length - 1);
                } else {
                    this.txt = fullTxt.substring(0, this.txt.length + 1);
                }

                this.el.html(this_txt.html);

                var delta = 200 - Math.random() * 100;

                if (this.isDeleting) {
                    delta /= 2;
                }

                if (!this.isDeleting && this.txt === fullTxt) {
                    delta = this.period;
                    this.isDeleting = true;
                } else if (this.isDeleting && this.txt === '') {
                    this.isDeleting = false;
                    this.loopNum++;
                    delta = 500;
                }

                setTimeout(function () {
                    self.tick();
                }, delta);
            };


            $('.text-writing').each(function () {
                var toRotate = $(this).attr('data-type');
                var period = $(this).attr('data-period');
                if (toRotate) {
                    new Typing($(this), JSON.parse(toRotate), period);
                }
            });

            $('.text-flipping').each(function () {
                var textElement = $(this);
                var data = JSON.parse(textElement.attr('data-type'));
                textElement.text(data[0]);
                var index = 1;

                function flipText() {
                    textElement.addClass('flip-out');

                    setTimeout(function () {
                        textElement.text(data[index]);
                        textElement.removeClass('flip-out');
                        textElement.addClass('flip-in');
                    }, 500);

                    setTimeout(function () {
                        textElement.removeClass('flip-in');
                        index = (index + 1) % data.length;
                    }, 1000);
                }

                setInterval(flipText, duration);
            });

            $('.text-sliding_down').each(function () {
                var textElement = $(this);
                var data = JSON.parse(textElement.attr('data-type'));
                textElement.text(data[0]);
                var index = 1;

                function slideUpText() {
                    textElement.addClass('slide-down_out');

                    setTimeout(function () {
                        textElement.text(data[index]);
                        textElement.removeClass('slide-down_out');
                        textElement.addClass('slide-down_in');
                    }, 500);

                    setTimeout(function () {
                        textElement.removeClass('slide-down_in');
                        index = (index + 1) % data.length;
                    }, 1000);
                }

                setInterval(slideUpText, duration);
            });

            $('.text-sliding_up').each(function () {
                var textElement = $(this);
                var data = JSON.parse(textElement.attr('data-type'));
                textElement.text(data[0]);
                var index = 1;

                function slideUpText() {
                    textElement.addClass('slide-up_out');

                    setTimeout(function () {
                        textElement.text(data[index]);
                        textElement.removeClass('slide-up_out');
                        textElement.addClass('slide-up_in');
                    }, 500);

                    setTimeout(function () {
                        textElement.removeClass('slide-up_in');
                        index = (index + 1) % data.length;
                    }, 1000);
                }

                setInterval(slideUpText, duration);
            });

            $('.rkit-highlighted').each(function () {
                var textElement = $(this);
                var data = JSON.parse(textElement.attr('data-type'));
                var txt = $('<p>' + data[0] + '</p>');
                textElement.append(txt);
                textElement.addClass('highlighted_in');
                var index = 1;

                function animation() {
                    setTimeout(function () {
                        textElement.removeClass('highlighted_in');
                        textElement.addClass('highlighted_out');
                    }, 1000);

                    setTimeout(function () {
                        textElement.find('p').remove();
                        var text = $('<p>' + data[index] + '</p>');
                        textElement.append(text);
                        textElement.removeClass('highlighted_out');
                        textElement.addClass('highlighted_in');
                    }, 1500);

                    setTimeout(function () {
                        index = (index + 1) % data.length;
                    }, 2000);

                }

                setInterval(animation, duration);
            });

            $('.text-drop-in').each(function () {
                var textElement = $(this);
                var data = JSON.parse(textElement.attr('data-type'));
                textElement.text(data[0]);
                var index = 1;

                function dropInText() {
                    textElement.addClass('drop-in_out');

                    setTimeout(function () {
                        textElement.text(data[index]);
                        textElement.removeClass('drop-in_out');
                        textElement.addClass('drop-in_in');
                    }, 500);

                    setTimeout(function () {
                        textElement.removeClass('drop-in_in');
                        index = (index + 1) % data.length;
                    }, 1000);
                }

                setInterval(dropInText, duration);
            });

            $('.text-drop-out').each(function () {
                var textElement = $(this);
                var data = JSON.parse(textElement.attr('data-type'));
                textElement.text(data[0]);
                var index = 1;

                function dropOutText() {
                    textElement.addClass('drop-out_out');

                    setTimeout(function () {
                        textElement.text(data[index]);
                        textElement.removeClass('drop-out_out');
                        textElement.addClass('drop-out_in');
                    }, 500);

                    setTimeout(function () {
                        textElement.removeClass('drop-out_in');
                        index = (index + 1) % data.length;
                    }, 1000);
                }

                setInterval(dropOutText, duration);
            });
        });
    });
});