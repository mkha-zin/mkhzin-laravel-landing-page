@extends('layouts.app')

@section('content')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title>Material Design for Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"/>
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}"/>
</head>
<body>
<!--Main Navigation-->
<header class="container my-4">
    @if(!empty($images))
        <!-- Gallery -->
        <div class="row">
            @if($images->count() > 0)
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <img
                        src="{{ asset('storage/' . $images[0]->image) }}"
                        class="w-100 shadow-1-strong rounded mb-4"
                        alt="Boat on Calm Water"
                    />

                    @if($images->count() > 1)
                        <img
                            src="{{ asset('storage/' . $images[1]->image) }}"
                            class="w-100 shadow-1-strong rounded mb-4"
                            alt="Wintry Mountain Landscape"
                        />
                    @endif
                </div>
            @endif
            @if($images->count() > 2)
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <img
                        src="{{ asset('storage/' . $images[2]->image) }}"
                        class="w-100 shadow-1-strong rounded mb-4"
                        alt="Mountains in the Clouds"
                    />

                    @if($images->count() > 3)
                        <img
                            src="{{ asset('storage/' . $images[3]->image) }}"
                            class="w-100 shadow-1-strong rounded mb-4"
                            alt="Boat on Calm Water"
                        />
                    @endif
                </div>
            @endif
            @if($images->count() > 4)
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <img
                        src="{{ asset('storage/' . $images[4]->image) }}"
                        class="w-100 shadow-1-strong rounded mb-4"
                        alt="Waves at Sea"
                    />

                    @if($images->count() > 5)
                        <img
                            src="{{ asset('storage/' . $images[5]->image) }}"
                            class="w-100 shadow-1-strong rounded mb-4"
                            alt="Yosemite National Park"
                        />
                    @endif
                </div>
            @endif
        </div>
        <!-- Gallery -->
    @endif
</header>
<!--Main Navigation-->

<!--Main layout-->
<main class="mt-5">
    <div class="container">
        @if($videos->isNotEmpty())
            <!--Section: Gallery-->
            <section>
                <!-- Carousel wrapper -->
                <div
                    id="carouselVideoExample"
                    data-mdb-carousel-init class="carousel slide carousel-fade"
                    data-mdb-ride="carousel"
                >
                    <!-- Inner -->
                    <div class="carousel-inner">
                        @if($images->count() > 0)
                            <!-- Single item -->
                            <div class="carousel-item active">
                                <video class="img-fluid" autoplay loop muted>
                                    <source src="{{ asset('storage/' . $videos[0]->image) }}" type="video/mp4"/>
                                </video>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>
                                        Nulla vitae elit libero, a pharetra augue mollis interdum.
                                    </p>
                                </div>
                            </div>
                        @endif

                        @foreach($videos as $video)
                            <!-- Single item -->
                            <div class="carousel-item">
                                <video class="img-fluid" autoplay loop muted>
                                    <source src="{{ asset('storage/' . $video->image) }}" type="video/mp4"/>
                                </video>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Inner -->

                    <!-- Controls -->
                    <button data-mdb-button-init
                            class="carousel-control-prev"
                            type="button"
                            style="background: none !important;"
                            data-mdb-target="#carouselVideoExample"
                            data-mdb-slide="prev"
                    >
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button data-mdb-button-init
                            class="carousel-control-next"
                            type="button"
                            style="background: none !important;"
                            data-mdb-target="#carouselVideoExample"
                            data-mdb-slide="next"
                    >
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- Carousel wrapper -->
            </section>
            <!--Section: Gallery-->
        @endif
    </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="container my-4 bg-light text-lg-start">
    <!-- Gallery -->
    @if(!empty($images))
        <!-- Gallery -->
        <div class="row">
            @if($images->count() > 6)
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <img
                        src="{{ asset('storage/' . $images[6]->image) }}"
                        class="w-100 shadow-1-strong rounded mb-4"
                        alt="Boat on Calm Water"
                    />

                    @if($images->count() > 7)
                        <img
                            src="{{ asset('storage/' . $images[7]->image) }}"
                            class="w-100 shadow-1-strong rounded mb-4"
                            alt="Wintry Mountain Landscape"
                        />
                    @endif
                </div>
            @endif
            @if($images->count() > 8)
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <img
                        src="{{ asset('storage/' . $images[8]->image) }}"
                        class="w-100 shadow-1-strong rounded mb-4"
                        alt="Mountains in the Clouds"
                    />

                    @if($images->count() > 9)
                        <img
                            src="{{ asset('storage/' . $images[9]->image) }}"
                            class="w-100 shadow-1-strong rounded mb-4"
                            alt="Boat on Calm Water"
                        />
                    @endif
                </div>
            @endif
            @if($images->count() > 10)
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <img
                        src="{{ asset('storage/' . $images[10]->image) }}"
                        class="w-100 shadow-1-strong rounded mb-4"
                        alt="Waves at Sea"
                    />

                    @if($images->count() > 11)
                        <img
                            src="{{ asset('storage/' . $images[11]->image) }}"
                            class="w-100 shadow-1-strong rounded mb-4"
                            alt="Yosemite National Park"
                        />
                    @endif
                </div>
            @endif
        </div>
        <!-- Gallery -->
    @endif
    <!-- Gallery -->
</footer>
<!--Footer-->

<!-- Time Counter -->
<script type="text/javascript">
    // Set the date we're counting down to
    var countDownDate = new Date();
    countDownDate.setDate(countDownDate.getDate() + 30);

    // Update the count down every 1 second
    var x = setInterval(function () {
        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById('time-counter').innerHTML =
            days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's ';

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById('time-counter').innerHTML = 'EXPIRED';
        }
    }, 1000);
</script>
<!-- MDB -->
<script type="text/javascript" src="{{ asset('mdb/js/mdb.umd.min.js') }}"></script>
</body>
</html>

@endsection
