<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Carousel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Carousel Styles -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .container {
            width: 100%;
            overflow: hidden;
            padding: 20px;
            box-sizing: border-box;
        }

        .MultiCarousel {
            position: relative;
            width: 100%;
        }

        .MultiCarousel-inner {
            display: flex;
            transition: transform 0.5s ease;
        }

        .MultiCarousel .item {
            flex: 0 0 auto;
            padding: 5px;
        }

        .MultiCarousel .item img {
            width: 100%;
            height: 370px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .MultiCarousel button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #000;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            z-index: 2;
            opacity: 0.7;
            font-size: 16px;
        }

        .MultiCarousel .leftLst {
            left: 0;
        }

        .MultiCarousel .rightLst {
            right: 0;
        }
    </style>
</head>
<body>

@if(!empty($images) && count($images) >= 1)
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
@endif
<!-- jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Carousel Script -->
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

        function getVisibleCount() {
            const width = $(window).width();
            if (width >= 992) return 3;
            if (width >= 768) return 2;

            return 1;
        }

        function cloneItems() {
            $inner.find(".clone").remove(); // remove old clones
            $items = $inner.children(".item"); // refresh items
            const visibleCount = getVisibleCount();
            const cloneCount = visibleCount + 1;

            $items.slice(0, cloneCount).clone(true).addClass("clone").appendTo($inner);
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

</body>
</html>
