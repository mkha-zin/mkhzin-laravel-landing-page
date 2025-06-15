@if(!empty($images) && count($images) >= 1)
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .MultiCarousel {
            overflow: hidden;
            padding: 15px 0;
            width: 100%;
            position: relative;
            direction: rtl;
        }

        .MultiCarousel-inner {
            display: flex;
            transition: transform 0.5s ease;
        }

        .MultiCarousel .item {
            padding: 10px;
            box-sizing: border-box;
            flex: 0 0 33.3333%;
        }

        .MultiCarousel .item img {
            width: 100%;
            height: 380px;
            object-fit: cover;
            border-radius: 8px;
        }

        .MultiCarousel .leftLst,
        .MultiCarousel .rightLst {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #000;
            color: #fff;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            opacity: 0.7;
            z-index: 10;
        }

        .MultiCarousel .leftLst {
            right: 0;
        }

        .MultiCarousel .rightLst {
            left: 0;
        }

        @media (max-width: 767.98px) {
            .MultiCarousel .item {
                flex: 0 0 100%;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .MultiCarousel .item {
                flex: 0 0 50%;
            }
        }

        @media (min-width: 992px) {
            .MultiCarousel .item {
                flex: 0 0 33.3333%;
            }
        }
    </style>

    <div class="container">
        <div class="MultiCarousel" id="MultiCarousel" data-slide="1">
            <div class="MultiCarousel-inner">
                @foreach($images as $image)
                    <div class="item">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="image">
                    </div>
                @endforeach
            </div>
            <button class="leftLst">&lt;</button>
            <button class="rightLst">&gt;</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const $carousel = $("#MultiCarousel");
            const $inner = $carousel.find(".MultiCarousel-inner");
            let $items = $inner.children(".item");
            const slide = parseInt($carousel.attr("data-slide")) || 1;

            function getItemWidth() {
                const winWidth = $(window).width();
                if (winWidth >= 992) return $carousel.width() / 3;
                if (winWidth >= 768) return $carousel.width() / 2;
                return $carousel.width();
            }

            function cloneItems() {
                $items = $inner.children(".item"); // refresh items
                const visibleCount = getVisibleCount();
                const cloneCount = visibleCount + 1;

                // Remove any previous clones
                $inner.find(".clone").remove();

                // Clone first n to end
                $items.slice(0, cloneCount).clone(true).addClass("clone").appendTo($inner);
            }

            function getVisibleCount() {
                const width = $(window).width();
                if (width >= 992) return 3;
                if (width >= 768) return 2;
                return 1;
            }

            let itemWidth = getItemWidth();
            $inner.children(".item").outerWidth(itemWidth);
            cloneItems();

            $(window).resize(() => {
                itemWidth = getItemWidth();
                $inner.children(".item").outerWidth(itemWidth);
                cloneItems();
            });

            let translateX = 0;

            function move(direction) {
                const step = itemWidth * slide;
                const totalItems = $inner.children(".item").length;
                const maxOffset = itemWidth * (totalItems - getVisibleCount());

                if (direction === "left") {
                    translateX -= step;
                    if (Math.abs(translateX) >= maxOffset) {
                        translateX = 0;
                    }
                } else {
                    translateX += step;
                    if (translateX > 0) {
                        translateX = -itemWidth * ($items.length);
                    }
                }

                $inner.css("transform", `translateX(${translateX}px)`);
            }

            $(".leftLst").click(() => move("left"));
            $(".rightLst").click(() => move("right"));

            setInterval(() => move("left"), 5000);
        });
    </script>
@endif
