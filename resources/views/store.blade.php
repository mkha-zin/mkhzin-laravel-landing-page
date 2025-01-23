@php
    $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';
@endphp

    <!doctype html>
<html lang="{{ app()->currentLocale() }}" dir="{{ $direction }}">
<head>
    <title>Mkhazin Store</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{  config('app.name') }}">
    <meta name="keywords" content="HTML5, bootstrap, mobile, app, landing, ios, android, responsive">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Cairo:wght@200..1000&family=El+Messiri:wght@400..700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('store/css/bootstrap.min.css') }}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('store/css/themify-icons.css') }}">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="{{ asset('store/css/owl.carousel.min.css') }}">
    <!-- Main css -->
    <link href="{{ asset('store/css/style.css') }}" rel="stylesheet">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <!-- Demo styles -->
    <style>
        .swiper {
            width: 100%;
            height: 100px;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100px;
            object-fit: contain;
        }

        .phone {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin-top: -80px;
        }

        .app-interface {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Add additional styling for the app interface */
        }

        .swiper-slide-next .cat_img {
            height: 220%;
            width: 220%;
            margin-left: 60px;
            margin-right: 60px;
        }
    </style>
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="30">

<!-- Nav Menu -->
<div class="nav-menu fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-dark navbar-expand-lg">
                    <a class="navbar-brand" href="">
                        <img src="{{ asset('store/images/logo.png') }}" width="100" class="img-fluid" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav {{ $direction == 'rtl' ? 'mr-auto' : 'ml-auto' }}">
                            <li class="nav-item"><a class="nav-link active" href="#home">{{  __('landing.Home') }} <span
                                        class="sr-only">(current)</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="#features">{{ __('landing.features') }}</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#gallery">{{ __('landing.gallery') }}</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#pricing">{{ __('landing.Store') }}</a></li>
                            <li class="nav-item"><a href="#download"
                                                    class="btn btn-outline-light my-3 my-sm-0 ml-lg-3">{{ __('landing.Download') }}</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<header class="bg-gradient" id="home"
        style="background-image: url({{ asset('store/images/hero_bg.jpg') }}); background-size: cover">
    <div class="container mt-5">
        @if(!empty($storetextwelcome))
        <h1 style="font-weight: 500 ; margin-bottom: 40px ">
            {{ $direction == 'rtl' ? $storetextwelcome->title_ar : $storetextwelcome->title_en }}
        </h1>
        <p class="tagline" style="color: white">
            {{ $direction == 'rtl' ? $storetextwelcome->description_ar : $storetextwelcome->description_en }}
        </p>
        @endif
    </div>
    <div class="img-holder mt-3"><img src="{{ asset('store/images/store_variants.png') }}" alt="store_variants"
                                      style="object-fit: cover" class="img-fluid w-50"></div>
</header>

<!-- Swiper -->
@if(!empty($brands))
    <div class="swiper mySwiper my-3">
        <div class="swiper-wrapper">
            <!-- Brands -->
            @foreach($brands as $brand)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $brand->image) }}" alt="Brand {{  $brand->title_en }}">
                </div>
            @endforeach
        </div>
    </div>
@endif
<!-- // end .section -->

<div class="section" style="background-color: #f3f3f5; height: 500px">
    <div class="container">
        <div class="row flex align-items-center text-center items-center">
            <div class="col-lg-8 col-md-12 col-sm-12 mx-0">
                <div class="phone flex align-items-center text-center items-center">
                    <img src="{{ asset('store/images/cat_phone.png') }}" class="img-fluid" alt="Phone displaying app">
                    <div class="app-interface flex align-items-center text-center items-center">
                        <!-- Add app interface elements here -->
                        @if(!empty($categories))
                            <div class="swiper mySwiper2 my-3" style="height: 100%; ">
                                <div class="swiper-wrapper" style="margin-top: 120px;">
                                    <!-- Brands -->
                                    @foreach($categories as $category)
                                        <div class="swiper-slide">
                                            <img class="cat_img" src="{{ asset('storage/' . $category->image) }}"
                                                 alt="Category {{  $category->title_en }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
            @if(!empty($storetextcategories))
            <div class="col-lg-4 col-md-12 col-sm-10">
                <h3>
                    {{ $direction == 'rtl' ? $storetextcategories->title_ar : $storetextcategories->title_en }}
                </h3>
                <p>
                    {{ $direction == 'rtl' ? $storetextcategories->description_ar : $storetextcategories->description_en }}
                </p>
                <a href="#download" class="btn btn-outline-danger my-3 my-sm-0 ml-lg-3">{{ __('landing.go to store') }}</a>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- // end .section -->

@if(!empty($features))
    <div class="section light-bg" id="features" style="background-color: white">
        <div class="container">
            <div class="section-title">
                <small>{{ __('landing.features') }}</small>
                <h3>{{ __('landing.features_for_you') }}</h3>
            </div>
            <div class="row">
                @foreach($features as $feature)
                    <div class="col-12 col-lg-4">
                        <div class="card features">
                            <div class="card-body" style="height: 140px; background-color: #fbeaec">
                                <div class="media">
                                    {{-- https://themify.me/themify-icons --}}
                                    <span class="{{ $feature->icon }} gradient-fill ti-3x mx-3"></span>
                                    <div class="media-body">
                                        <h4 class="card-title"
                                            style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 1; color: black; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $direction == 'rtl' ? $feature->title_ar : $feature->title_en }}
                                        </h4>
                                        <p class="card-text"
                                           style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 3; color: black; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $direction == 'rtl' ? $feature->description_ar : $feature->description_en }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endif
<!-- // end .section -->

<div class="section light-bg">

    <div class="container">
        <div class="row">
            <div class="col-md-8 d-flex align-items-center">
                <ul class="list-unstyled ui-steps">
                    <li class="media">
                        <div class="circle-icon mr-4">1</div>
                        <div class="media-body">
                            <h5>Create an Account</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu
                                pellentesque pretium obcaecati vel exercitationem </p>
                        </div>
                    </li>
                    <li class="media my-4">
                        <div class="circle-icon mr-4">2</div>
                        <div class="media-body">
                            <h5>Share with friends</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu
                                pellentesque pretium obcaecati vel exercitationem eveniet</p>
                        </div>
                    </li>
                    <li class="media">
                        <div class="circle-icon mr-4">3</div>
                        <div class="media-body">
                            <h5>Enjoy your life</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu
                                pellentesque pretium obcaecati vel exercitationem </p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('store/images/dualphone.png') }}" alt="iphone" class="img-fluid">
            </div>

        </div>

    </div>

</div>
<!-- // end .section -->

<div class="section light-bg" id="gallery">
    <div class="container">
        <div class="section-title">
            <small>GALLERY</small>
            <h3>App Screenshots</h3>
        </div>

        <div class="img-gallery owl-carousel owl-theme">
            <img src="{{ asset('store/images/screen1.jpg') }}" alt="image">
            <img src="{{ asset('store/images/screen2.jpg') }}" alt="image">
            <img src="{{ asset('store/images/screen3.jpg') }}" alt="image">
            <img src="{{ asset('store/images/screen1.jpg') }}" alt="image">
        </div>

    </div>

</div>
<!-- // end .section -->

<div class="section bg-gradient" id="download">
    <div class="container">
        <div class="call-to-action">

            <div class="box-icon"><span class="ti-mobile gradient-fill ti-3x"></span></div>
            <h2>Download Anywhere</h2>
            <p class="tagline">Available for all major mobile and desktop platforms. Rapidiously visualize optimal ROI
                rather than enterprise-wide methods of empowerment. </p>
            <div class="my-4">

                <a href="#" class="btn btn-light"><img src="{{ asset('store/images/appleicon.png') }}" alt="icon"> App
                    Store</a>
                <a href="#" class="btn btn-light"><img src="{{ asset('store/images/playicon.png') }}" alt="icon"> Google
                    play</a>
            </div>
            <p class="text-primary"><small><i>*Works on iOS 10.0.5+, Android Kitkat and above. </i></small></p>
        </div>
    </div>

</div>
<!-- // end .section -->

<div class="light-bg py-5" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <p class="mb-2"><span class="ti-location-pin mr-2"></span> 1485 Pacific St, Brooklyn, NY 11216 USA</p>
                <div class=" d-block d-sm-inline-block">
                    <p class="mb-2">
                        <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@mobileapp.com">support@mobileapp.com</a>
                    </p>
                </div>
                <div class="d-block d-sm-inline-block">
                    <p class="mb-0">
                        <span class="ti-headphone-alt mr-2"></span> <a href="tel:51836362800">518-3636-2800</a>
                    </p>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="social-icons">
                    <a href="#"><span class="ti-facebook"></span></a>
                    <a href="#"><span class="ti-twitter-alt"></span></a>
                    <a href="#"><span class="ti-instagram"></span></a>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- // end .section -->

<footer class="my-5 text-center">
    <!-- Copyright removal is not prohibited! -->
    <p class="mb-2"><small>COPYRIGHT © 2017. ALL RIGHTS RESERVED. MOBAPP TEMPLATE BY <a href="https://colorlib.com">COLORLIB</a></small>
    </p>

    <small>
        <a href="#" class="m-2">PRESS</a>
        <a href="#" class="m-2">TERMS</a>
        <a href="#" class="m-2">PRIVACY</a>
    </small>
</footer>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: true,
        slidesPerView: 5,
        spaceBetween: 10,
        freeMode: true,
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 6,
            }
        },
    });
</script>

<!-- Initialize Swiper2 -->
<script>
    var swiper2 = new Swiper(".mySwiper2", {
        loop: true,
        autoplay: true,
        slidesPerView: 3,
        spaceBetween: 120,
    });
</script>


<script src="{{ asset('store/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('store/js/bootstrap.bundle.min.js') }}"></script>
<!-- Plugins JS -->
<script src="{{ asset('store/js/owl.carousel.min.js') }}"></script>
<!-- Custom JS -->
<script src="{{ asset('store/js/script.js') }}"></script>

</body>

</html>
