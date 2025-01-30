@php
    $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';
    $facebook = \App\Models\SocialLink::query()->where('title_en', 'Facebook')->where('is_active', 1)->first();
    $twitter = \App\Models\SocialLink::query()->where('title_en', 'Twitter(X)')->where('is_active', 1)->first();
    $linkedin = \App\Models\SocialLink::query()->where('title_en', 'Linkedin')->where('is_active', 1)->first();
    $youtube = \App\Models\SocialLink::query()->where('title_en', 'Youtube')->where('is_active', 1)->first();
    $instagram = \App\Models\SocialLink::query()->where('title_en', 'Instagram')->where('is_active', 1)->first();
    $snapchat = \App\Models\SocialLink::query()->where('title_en', 'Snapchat')->where('is_active', 1)->first();
    $tiktok = \App\Models\SocialLink::query()->where('title_en', 'TikTok')->where('is_active', 1)->first();
    $whatsChannel = \App\Models\SocialLink::query()->where('title_en', 'Whatsapp Channel')->where('is_active', 1)->first();
    $telegram = \App\Models\SocialLink::query()->where('title_en', 'Telegram')->where('is_active', 1)->first();
@endphp

    <!doctype html>
<html lang="{{ app()->currentLocale() }}" dir="{{ $direction }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{  config('app.name') }}">
    <meta name="keywords" content="Store, E-Commerce, eshop, delivery, mkhazin, mkhzin, makhazin, order, online, store, shopping, ecommerce, makhazin, grocery, grocery store, grocery online, online grocery">

    <title>
        {{  $header_title  ?? config('app.name') }}
    </title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/mkhazin/fav.png') }}">

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
        .categories-carousel {
            background-color: #f3f3f5;
            height: auto;
        }

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
            height: 100%;
            max-width: 500px;
            margin-top: -80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .app-interface {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Add additional styling for the app interface */
        }

        .swiper-slide .gallery_img {
            width: 50%;
            height: 50%;
        }

        .swiper-button-next, .swiper-button-prev {
            color: red;
        }

        .swiper-pagination-bullet {
            width: 30px;
            height: 6px;
            margin-top: 50px;
            border-radius: 10px;
            opacity: 1;
            background: rgba(255, 0, 0, 0.4);
        }

        .swiper-pagination-bullet-active {
            background: red;
        }

        .swiper-slide-next .screenshots {
            padding: 0 !important;
            margin: 0 !important;
            width: 100%;
            background-color: red;
            height: 800px;
            overflow-y: visible;
        }

        .swiper-slide-next .gallery_img {
            width: 100%;
            height: 100%;
        }

        /* Custom responsive styles */
        .responsive-img {
            width: 90%; /* Default for small screens */
        }

        .swiper-slide .brand_img {
            width: 50%;
            height: 100%;
        }

        .swiper-slide .cat_div {
            margin-top: -80px;
        }

        /*.cat_title {
            font-size: 14px;
            display: -webkit-box;
            word-break: keep-all;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
            color: black;
            overflow: hidden;
            text-overflow: ellipsis;
            text-decoration: none;
            width: 100%;
            text-align: center;
        }*/

        .swiper-slide .cat_img {
            width: 100%;
            height: 100%;
        }

        .swiper-slide-next .cat_img, .swiper-slide-next .cat_title {
            height: 200%;
            width: 200%;
        }

        .swiper-slide-next .cat_div {
            {{  $direction == 'rtl' ? 'margin-left: 56px;' : 'margin-right: 56px;' }}
        }

        @media (min-width: 768px) {
            /* Medium screens and above */
            .responsive-img {
                width: 80%;
            }

            .swiper-slide .brand_img {
                width: 50%;
                height: 100%;
            }

            .categories-carousel {
                background-color: #f3f3f5;
                height: auto;
            }

        }

        @media (min-width: 992px) {
            /* Large screens and above */
            .responsive-img {
                width: 80%;
            }

            .swiper-slide .brand_img {
                width: 80%;
                height: 100%;
            }

            .categories-carousel {
                background-color: #f3f3f5;
                height: 500px;
            }

        }

        @media (min-width: 1201px) {
            /* Larger screens and above */
            .responsive-img {
                width: 50%;
            }

            .swiper-slide .brand_img {
                width: 80%;
                height: 100%;
            }

            .categories-carousel {
                background-color: #f3f3f5;
                height: 500px;
            }

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
                        <ul class="navbar-nav {{ $direction == 'rtl' ? 'mr-auto' : 'ml-auto' }} d-flex align-items-center">
                            <li class="nav-item"><a class="nav-link active" href="#home">{{  __('landing.Home') }} <span
                                        class="sr-only">(current)</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="#features">{{ __('landing.features') }}</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#gallery">{{ __('landing.gallery') }}</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="https://mkhzin-store.com"
                                                    target="_blank">{{ __('landing.Store') }}</a></li>
                            <li class="nav-item"><a href="#download"
                                                    class="btn btn-outline-light my-3 my-sm-0 ml-lg-3 mx-2">{{ __('landing.Download') }}</a>
                            </li>
                            {{-- language dropdown --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if($direction == 'rtl')
                                        {{ __('landing.English') }}
                                        <img src="{{ asset('images/svg/flags/en.svg') }}">
                                    @else
                                        <img src="{{ asset('images/svg/flags/ar.svg') }}">
                                        {{ __('landing.Arabic') }}
                                    @endif
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('locale.setting', 'ar') }}">
                                        @if($direction == 'rtl')
                                            {{ __('landing.Arabic') }}
                                            <img src="{{ asset('images/svg/flags/ar.svg') }}">
                                        @else
                                            <img src="{{ asset('images/svg/flags/ar.svg') }}">
                                            {{ __('landing.Arabic') }}
                                        @endif
                                    </a>
                                    <a class="dropdown-item" href="{{ route('locale.setting', 'en') }}">
                                        @if($direction == 'rtl')
                                            {{ __('landing.English') }}
                                            <img src="{{ asset('images/svg/flags/en.svg') }}">
                                        @else
                                            <img src="{{ asset('images/svg/flags/en.svg') }}">
                                            {{ __('landing.English') }}
                                        @endif
                                    </a>
                                </div>
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
                                      style="object-fit: cover" class="img-fluid responsive-img"></div>
</header>

<!-- Swiper -->
@if(!empty($brands))
    <div class="swiper mySwiper my-3">
        <div class="swiper-wrapper">
            <!-- Brands -->
            @foreach($brands as $brand)
                <div class="swiper-slide">
                    <img class="brand_img" src="{{ asset('storage/' . $brand->image) }}"
                         alt="Brand {{  $brand->title_en }}">
                </div>
            @endforeach
        </div>
    </div>
@endif
<!-- // end .section -->

<div class="section categories-carousel">
    <div class="container">
        <div class="row flex align-items-center text-center items-center">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="phone">
                    <img style="object-fit: cover" src="{{ asset('store/images/cat_phone.png') }}" class="img-fluid"
                         alt="Phone displaying app">
                    <div class="app-interface flex align-items-center text-center items-center">
                        <!-- Add app interface elements here -->
                        @if(!empty($categories))
                            <div class="swiper mySwiper2 my-3" style="height: 100%; ">
                                <div class="swiper-wrapper" style="margin-top: 120px;">
                                    <!-- Brands -->
                                    @foreach($categories as $category)
                                        <div class="swiper-slide">
                                            <div class="cat_div flex align-items-center text-center items-center">
                                                <img class="cat_img"
                                                     src="{{ asset('storage/' . $category->image) }}"
                                                     alt="Category {{  $category->title_en }}">
                                                <h6 class="cat_title">
                                                    {{  $direction == 'rtl' ? $category->title_ar : $category->title_en }}
                                                </h6>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-10 col-sm-10 my-3 align-items-center">
                @if(!empty($storetextcategories))
                    <h3>
                        {{ $direction == 'rtl' ? $storetextcategories->title_ar : $storetextcategories->title_en }}
                    </h3>
                    <p>
                        {{ $direction == 'rtl' ? $storetextcategories->description_ar : $storetextcategories->description_en }}
                    </p>
                    <a href="#download"
                       class="btn btn-outline-danger my-3 my-sm-0 ml-lg-3">{{ __('landing.go to store') }}</a>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- // end .section -->

@if(!empty($features))
    <div class="position-relative section light-bg" id="features" style="background-color: white">
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
                                        <h4 class="card-title feature_title"
                                            style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 1; color: black; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $direction == 'rtl' ? $feature->title_ar : $feature->title_en }}
                                        </h4>
                                        <p class="card-text feature_desc"
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

<div class="section" style="background-color: #e7d9d9">
    <div class="container">
        <div class="row">
            @if(!empty($steps))
                <div class="col-md-8 d-flex align-items-center">
                    <ul class="list-unstyled ui-steps">
                        @foreach($steps as $step)
                            <li class="media">
                                <div class="circle-icon mx-4">{{ $step->order }}</div>
                                <div
                                    class="media-body row d-flex align-self-center {{ $direction == 'rtl' ? 'text-right' : 'text-left' }}">
                                    <h5 class="w-full col-12">{{ $direction == 'rtl' ? $step->title_ar : $step->title_en }}</h5>
                                    <p class="w-full col-12"
                                       style="display: -webkit-box; text-align:justify; word-break:keep-all; -webkit-box-orient: vertical; -webkit-line-clamp: 3; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $direction == 'rtl' ? $step->description_ar : $step->description_en }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-4">
                <img src="{{ asset('store/images/steps_img.png') }}" style="height: auto; width: 100%" alt="iphone"
                     class="img-fluid">
            </div>

        </div>

    </div>

</div>
<!-- // end .section -->

@if(!empty($screens))
    <div class="section" style="background-color: #f8ebed" id="gallery">
        <div class="container">
            <div class="section-title my-0">
                <small>{{ __('landing.gallery') }}</small>
                <h3>{{  __('landing.app_screens') }}</h3>
            </div>
            <!-- Swiper -->
            <div class="swiper mySwiper3 my-0" style="height: 500px">
                <div class="swiper-wrapper d-flex align-items-center">
                    @foreach($screens as $screen)
                        <div class="swiper-slide">
                            <img class="gallery_img" src="{{  asset('storage/' . $screen->image) }}"/>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
@endif
<!-- // end .section -->

<div class="section bg-gradient" id="download">
    <div class="container">
        <div class="call-to-action">
            <div class="box-icon bold"><span class="ti-mobile gradient-fill ti-3x"></span></div>
            @if(!empty($storetextdownload))
                <h2 style="color: white; font-weight: 600">{{  $direction == 'rtl' ? $storetextdownload->title_ar : $storetextdownload->title_en }}</h2>
                <h4 style="color: white">
                    {{  $direction == 'rtl' ? $storetextdownload->description_ar : $storetextdownload->description_en }}
                </h4>
            @endif
            <div class="my-4">
                <a href="https://mkhzin-store.com" target="_blank">
                    <img width="200px" src="{{ asset('store/images/3.png') }}" alt="shop now">
                </a>
                <a {{--href="#"--}}>
                    <img width="200px" src="{{ asset('store/images/1.png') }}" alt="play store">
                </a>
                <a {{--href="#"--}}>
                    <img width="200px" src="{{ asset('store/images/2.png') }}" alt="app store">
                </a>
            </div>
            <p class="text-primary"><small><i>*Works on iOS 10.0.5+, Android 8(Oreo) and above.</i></small></p>
        </div>
    </div>
</div>
<!-- // end .section -->

<div class="light-bg py-5" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <p class="mb-2">
                    <span class="ti-location-pin mx-2"></span>
                    Omar Bin Abdulaziz St., Al-Rabwah, Riyadh 14215 Saudi Arabia
                </p>
                <div class=" d-block d-sm-inline-block">
                    <p class="mb-2">
                        <span class="ti-email mx-2"></span> <a class="mr-4" href="mailto:support@mkhzin.com">support@mkhzin.com</a>
                    </p>
                </div>
                <div class="d-block d-sm-inline-block">
                    <p class="mb-0">
                        <span class="ti-headphone-alt mx-2"></span> <a href="tel:+966558888381">(+966) 55-888-8381</a>
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="social-icons">
                    <div class="social-icons1">
                        <!-- Whatsapp -->
                        @if(!empty($whatsChannel))
                            <a href="{{  $whatsChannel->link }}" style="margin-left: 1px; margin-right: 1px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                                </svg>
                            </a>
                        @endif
                        <!-- Snapchat -->
                        @if(!empty($snapchat))
                            <a href="{{  $snapchat->link }}" style="margin-left: 1px; margin-right: 1px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M496.9 366.6c-3.4-9.2-9.8-14.1-17.1-18.2-1.4-.8-2.6-1.5-3.7-1.9-2.2-1.1-4.4-2.2-6.6-3.4-22.8-12.1-40.6-27.3-53-45.4a102.9 102.9 0 0 1 -9.1-16.1c-1.1-3-1-4.7-.2-6.3a10.2 10.2 0 0 1 2.9-3c3.9-2.6 8-5.2 10.7-7 4.9-3.2 8.8-5.7 11.2-7.4 9.4-6.5 15.9-13.5 20-21.3a42.4 42.4 0 0 0 2.1-35.2c-6.2-16.3-21.6-26.4-40.3-26.4a55.5 55.5 0 0 0 -11.7 1.2c-1 .2-2.1 .5-3.1 .7 .2-11.2-.1-22.9-1.1-34.5-3.5-40.8-17.8-62.1-32.7-79.2A130.2 130.2 0 0 0 332.1 36.4C309.5 23.5 283.9 17 256 17S202.6 23.5 180 36.4a129.7 129.7 0 0 0 -33.3 26.8c-14.9 17-29.2 38.4-32.7 79.2-1 11.6-1.2 23.4-1.1 34.5-1-.3-2-.5-3.1-.7a55.5 55.5 0 0 0 -11.7-1.2c-18.7 0-34.1 10.1-40.3 26.4a42.4 42.4 0 0 0 2 35.2c4.1 7.8 10.7 14.7 20 21.3 2.5 1.7 6.4 4.2 11.2 7.4 2.6 1.7 6.5 4.2 10.3 6.7a11.1 11.1 0 0 1 3.3 3.3c.8 1.6 .8 3.4-.4 6.6a102 102 0 0 1 -8.9 15.8c-12.1 17.7-29.4 32.6-51.4 44.6C32.4 348.6 20.2 352.8 15.1 366.7c-3.9 10.5-1.3 22.5 8.5 32.6a49.1 49.1 0 0 0 12.4 9.4 134.3 134.3 0 0 0 30.3 12.1 20 20 0 0 1 6.1 2.7c3.6 3.1 3.1 7.9 7.8 14.8a34.5 34.5 0 0 0 9 9.1c10 6.9 21.3 7.4 33.2 7.8 10.8 .4 23 .9 36.9 5.5 5.8 1.9 11.8 5.6 18.7 9.9C194.8 481 217.7 495 256 495s61.3-14.1 78.1-24.4c6.9-4.2 12.9-7.9 18.5-9.8 13.9-4.6 26.2-5.1 36.9-5.5 11.9-.5 23.2-.9 33.2-7.8a34.6 34.6 0 0 0 10.2-11.2c3.4-5.8 3.3-9.9 6.6-12.8a19 19 0 0 1 5.8-2.6A134.9 134.9 0 0 0 476 408.7a48.3 48.3 0 0 0 13-10.2l.1-.1C498.4 388.5 500.7 376.9 496.9 366.6zm-34 18.3c-20.7 11.5-34.5 10.2-45.3 17.1-9.1 5.9-3.7 18.5-10.3 23.1-8.1 5.6-32.2-.4-63.2 9.9-25.6 8.5-42 32.8-88 32.8s-62-24.3-88.1-32.9c-31-10.3-55.1-4.2-63.2-9.9-6.6-4.6-1.2-17.2-10.3-23.1-10.7-6.9-24.5-5.7-45.3-17.1-13.2-7.3-5.7-11.8-1.3-13.9 75.1-36.4 87.1-92.6 87.7-96.7 .6-5 1.4-9-4.2-14.1-5.4-5-29.2-19.7-35.8-24.3-10.9-7.6-15.7-15.3-12.2-24.6 2.5-6.5 8.5-8.9 14.9-8.9a27.6 27.6 0 0 1 6 .7c12 2.6 23.7 8.6 30.4 10.2a10.7 10.7 0 0 0 2.5 .3c3.6 0 4.9-1.8 4.6-5.9-.8-13.1-2.6-38.7-.6-62.6 2.8-32.9 13.4-49.2 26-63.6 6.1-6.9 34.5-37 88.9-37s82.9 29.9 88.9 36.8c12.6 14.4 23.2 30.7 26 63.6 2.1 23.9 .3 49.5-.6 62.6-.3 4.3 1 5.9 4.6 5.9a10.6 10.6 0 0 0 2.5-.3c6.7-1.6 18.4-7.6 30.4-10.2a27.6 27.6 0 0 1 6-.7c6.4 0 12.4 2.5 14.9 8.9 3.5 9.4-1.2 17-12.2 24.6-6.6 4.6-30.4 19.3-35.8 24.3-5.6 5.1-4.8 9.1-4.2 14.1 .5 4.2 12.5 60.4 87.7 96.7C468.6 373 476.1 377.5 462.9 384.9z"/>
                                </svg>
                            </a>
                        @endif
                        <!-- Tiktok -->
                        @if(!empty($tiktok))
                            <a href="{{  $tiktok->link }}" style="margin-left: 1px; margin-right: 1px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"/>
                                </svg>
                            </a>
                        @endif
                        <!-- Instagram -->
                        @if(!empty($instagram))
                            <a href="{{  $instagram->link }}" style="margin-left: 1px; margin-right: 1px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                                </svg>
                            </a>
                        @endif
                        <!-- Facebook -->
                        @if(!empty($facebook))
                            <a href="{{  $facebook->link }}" style="margin-left: 1px; margin-right: 1px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"/>
                                </svg>
                            </a>
                        @endif
                        <!-- Twitter X -->
                        @if(!empty($twitter))
                            <a href="{{  $twitter->link }}" style="margin-left: 1px; margin-right: 1px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                                </svg>
                            </a>
                        @endif
                        <!-- Linkedin -->
                        @if(!empty($linkedin))
                            <a href="{{  $linkedin->link }}" style="margin-left: 1px; margin-right: 1px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/>
                                </svg>
                            </a>
                        @endif
                        <!-- Youtube -->
                        @if(!empty($youtube))
                            <a href="{{  $youtube->link }}" style="margin-left: 1px; margin-right: 1px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/>
                                </svg>
                            </a>
                        @endif
                        <!-- Telegram -->
                        @if(!empty($telegram))
                            <a href="{{  $telegram->link }}" style="margin-left: 1px; margin-right: 1px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                    <path
                                        d="M248 8C111 8 0 119 0 256S111 504 248 504 496 393 496 256 385 8 248 8zM363 176.7c-3.7 39.2-19.9 134.4-28.1 178.3-3.5 18.6-10.3 24.8-16.9 25.4-14.4 1.3-25.3-9.5-39.3-18.7-21.8-14.3-34.2-23.2-55.3-37.2-24.5-16.1-8.6-25 5.3-39.5 3.7-3.8 67.1-61.5 68.3-66.7 .2-.7 .3-3.1-1.2-4.4s-3.6-.8-5.1-.5q-3.3 .7-104.6 69.1-14.8 10.2-26.9 9.9c-8.9-.2-25.9-5-38.6-9.1-15.5-5-27.9-7.7-26.8-16.3q.8-6.7 18.5-13.7 108.4-47.2 144.6-62.3c68.9-28.6 83.2-33.6 92.5-33.8 2.1 0 6.6 .5 9.6 2.9a10.5 10.5 0 0 1 3.5 6.7A43.8 43.8 0 0 1 363 176.7z"/>
                                </svg>
                                <!-- https://fontawesome.com/search?q=tele&o=r -->
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- // end .section -->

<footer class="my-5 text-center">
    <h6>
        {{  __('dashboard.copyright') }}
        <a href="https://mkhzin.com" class="hover:underline">{{ __('dashboard.app_name') }}</a>
        © 2024
    </h6>

    <small>
        <a href="https://mkhzin-store.com/terms/" class="m-2">{{  __('landing.terms & conditions') }}</a>
        <a href="https://mkhzin-store.com/usage-policy/" class="m-2">{{  __('landing.usage policy') }}</a>
        <a href="https://mkhzin-store.com/privacy" class="m-2">{{  __('landing.privacy policy') }}</a>
    </small>
</footer>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper1 -->
<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: true,
        slidesPerView: 5,
        spaceBetween: 10,
        freeMode: true,
        breakpoints: {
            320: {
                slidesPerView: 2,
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

<!-- Initialize Swiper3 -->
<script>
    var swiper = new Swiper(".mySwiper3", {
        grabCursor: true,
        loop: true,
        autoplay: true,
        slidesPerView: 3,
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 3,
            }
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            renderBullet: function (index, className) {
                return '<span class="' + className + '"></span>';
            },
        },
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
