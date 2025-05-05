@php

    $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';

@endphp

@extends('layouts.app')
@section('content')

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .social-icon {
            width: 40px;
            border-radius: 0.375rem;
            padding: 0.3rem;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.5);
            transition: transform 0.2s ease-in-out;
        }

        .social-icon:hover {
            transform: scale(1.05);
        }

        .tiktok-icon {
            background-color: #474747;
        }

        .snapchat-icon {
            background-color: #f4ef00;
        }

        .instagram-icon {
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
        }
    </style>

    <div class="container mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('branches.index') }}">{{ __('dashboard.branches') }}</a>
                </li>
                @if($branch->name_ar || $branch->name_en)
                    <li class="breadcrumb-item active" aria-current="page">
                        &nbsp;{{ $direction == 'rtl' ? $branch->name_ar : $branch->name_en }}
                    </li>
                @endif
            </ol>
        </nav>
    </div>

    <div class="container mb-5">
        <div class="row">
            <!-- Branch Image and social media icons -->
            <div class="col-md-6 position-relative">
                @if(!empty($branch->image))
                    <img src="{{ asset('storage/' . $branch->image) }}" alt="Branch Image"
                         class="img-fluid w-100 rounded">
                @endif

            </div>

            <!-- Branch Details and Images -->
            <div class="col-md-6" style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }} !important">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-3">
                    @if($branch->name_ar || $branch->name_en)
                        <h3 class="mb-2 mb-md-0" style="color: black">
                            {{ $direction == 'rtl' ? $branch->name_ar : $branch->name_en }}
                        </h3>
                    @endif
                    @if($branch->id)
                        <div class="d-flex gap-2">
                            <a href="{{ route('branch.offers', $branch->id)}}"
                               class="btn btn-danger text-white btn-sm">{{ __('dashboard.offers') }}</a>
                            <a href="{{ route('jobs.index') }}" target="_blank"
                               class="btn btn-dark text-white btn-sm">{{ __('dashboard.jobs') }}</a>
                        </div>
                    @endif
                </div>
                @if($branch->description_ar || $branch->description_en)
                    <p style="word-break: keep-all; text-align:justify; ">
                        {{ \Filament\Support\Markdown::inline(
                            $direction == 'rtl' ? $branch->description_ar ?? '': $branch->description_en ?? '' ) }}
                    </p>
                @endif
                <!-- Social Media Icons Overlay -->
                <div
                    class="position-relative bottom-0 start-50 translate-middle-x d-flex gap-3 justify-content-center">
                    @if($branch->snapchat)
                        <a href="{{ $branch->snapchat }}" target="_blank">
                            <img class="social-icon snapchat-icon" src="{{ asset('images/icons/snapchat.png') }}">
                        </a>
                    @endif
                    @if($branch->tiktok)
                        <a href="{{ $branch->tiktok }}" target="_blank">
                            <img class="social-icon tiktok-icon" src="{{ asset('images/icons/tik-tok.png') }}">
                        </a>
                    @endif
                    @if($branch->instagram)
                        <a href="{{ $branch->instagram }}" target="_blank">
                            <img class="social-icon instagram-icon" src="{{ asset('images/icons/instagram.png') }}">
                        </a>
                    @endif
                </div>
            </div>

            @if($reviews->isNotEmpty())
                <!-- Reviews Section -->
                <div class="col-md-12" style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }} !important">
                    <h4 class="mb-2">{{ __('dashboard.customer reviews') }}</h4>
                    <style>
                        .slider-wrapper {
                            overflow: hidden;
                            max-width: 1500px !important;
                            margin: 0 50px 55px;
                            padding: 30px;
                        }

                        .card-list .card-item {
                            height: auto;
                            color: #fff;
                            user-select: none;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            backdrop-filter: blur(30px);
                            background: rgb(231, 234, 237, 0.80);

                        }

                        .card-list .card-item .user-image {
                            width: 150px;
                            height: 150px;
                            border-radius: 50%;
                            margin-bottom: 40px;
                            border: 3px solid #fff;
                            padding: 4px;
                        }

                        .card-list .card-item .user-profession {
                            font-size: 1.15rem;
                            color: #e3e3e3;
                            font-weight: 500;
                            margin: 14px 0 40px;
                        }

                        .card-list .card-item .message-button {
                            font-size: 1.25rem;
                            padding: 10px 35px;
                            color: #030728;
                            border-radius: 6px;
                            font-weight: 500;
                            cursor: pointer;
                            background: #fff;
                            border: 1px solid transparent;
                            transition: 0.2s ease;
                        }

                        .card-list .card-item .message-button:hover {
                            background: rgba(255, 255, 255, 0.1);
                            border: 1px solid #fff;
                            color: #fff;
                        }

                        .slider-wrapper .swiper-pagination-bullet {
                            background: #fff;
                            height: 13px;
                            width: 13px;
                            opacity: 0.5;
                        }

                        .slider-wrapper .swiper-pagination-bullet-active {
                            opacity: 1;
                        }

                        .slider-wrapper .swiper-slide-button {
                            color: black;
                            margin-top: -55px;
                            transition: 0.2s ease;
                        }

                        .slider-wrapper .swiper-slide-button:hover {
                            color: var(--e-global-color-7cfaca3);
                        }

                        @media (max-width: 768px) {
                            .slider-wrapper {
                                margin: 0 10px 40px;
                            }

                            .slider-wrapper .swiper-slide-button {
                                display: none;
                            }
                        }
                    </style>
                    <div class="swiper">
                        <div class="slider-wrapper">
                            <div class="card-list swiper-wrapper">
                                @foreach($reviews as $review)
                                    <div class="card-item swiper-slide"
                                         style="padding: 15px; border: 1px solid #b5b5b5;
                                     border-radius: 10px; background-color: rgba(231,234,237,0.55);">
                                        <div class="card-body">
                                            <!-- Platform Logo and Name + Stars -->
                                            <div class="d-flex align-items-center mb-3">
                                                @php
                                                    if (empty($review->platform))
                                                         $image = asset('uploads/mkhazin/logo900.png');
                                                     else
                                                         if($review->platform == 'google maps')
                                                             $image = asset('images/icons/google maps.png');
                                                         elseif($review->platform == 'google play')
                                                             $image = asset('images/icons/google play.png');
                                                         elseif ($review->platform == 'facebook')
                                                             $image = asset('images/icons/facebook.png');
                                                         elseif ($review->platform == 'twitter')
                                                             $image = asset('images/icons/twitter.png');
                                                         elseif ($review->platform == 'instagram')
                                                             $image = asset('images/icons/instagram.png');
                                                         elseif ($review->platform == 'snapchat')
                                                             $image = asset('images/icons/snapchat.png');
                                                         elseif ($review->platform == 'tiktok')
                                                             $image = asset('images/icons/tik-tok-1.png');
                                                         elseif ($review->platform == 'whatsapp')
                                                             $image = asset('images/icons/whatsapp.png');
                                                         elseif ($review->platform == 'telegram')
                                                             $image = asset('images/icons/telegram.png');
                                                         elseif ($review->platform == 'linkedin')
                                                             $image = asset('images/icons/linkedin.png');
                                                         elseif ($review->platform == 'youtube')
                                                             $image = asset('images/icons/youtube.png');
                                                @endphp
                                                <img src="{{ $image }}"
                                                     alt="{{ $review->platform }}"
                                                     style="width: 50px; object-fit: contain; height: 50px; padding: 5px;
                                                 border-radius: 50%; background-color: rgb(255,255,255);
                                                 margin-{{ $direction == 'rtl' ? 'left' : 'right' }}: 10px;">
                                                <div>
                                                    <strong
                                                        style="display: block; color: #0C0C0C">{{ $review->name }}</strong>
                                                    <b style="color: #ffc107;">
                                                        @for ($i = 0; $i < (int)$review->stars; $i++)
                                                            ★
                                                        @endfor
                                                        @for ($i = (int)$review->stars; $i < 5; $i++)
                                                            ☆
                                                        @endfor
                                                        <span
                                                            style="font-weight: normal; color: #0C0C0C; font-size: 12px;">
                                                            ({{ $review->stars }})
                                                        </span>
                                                    </b>
                                                </div>
                                            </div>

                                            <!-- Review Text -->
                                            <p class="card-text"
                                               style="display: -webkit-box; text-align:justify; word-break:keep-all;
                                               -webkit-box-orient: vertical; -webkit-line-clamp: 4; color: #333;
                                               overflow: hidden; text-overflow: ellipsis;">
                                                {{ \Filament\Support\Markdown::inline($review->review) }}
                                            </p>

                                            <!-- Know More Link -->
                                            @if($review->link)
                                                <a target="_blank"
                                                   href="{{ $review->link }}"
                                                   style="letter-spacing: 0 !important;">
                                                    @if($direction == 'rtl')
                                                        <i aria-hidden="true"
                                                           class="rkit-icon-readmore rtmicon rtmicon-chevrons-left"></i>
                                                    @elseif($direction == 'ltr')
                                                        <i aria-hidden="true"
                                                           class="rkit-icon-readmore rtmicon rtmicon-chevrons-right"></i>
                                                    @endif
                                                    {{ __('landing.Know More') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="swiper-pagination"></div>
                            <div class="swiper-slide-button swiper-button-prev"></div>
                            <div class="swiper-slide-button swiper-button-next"></div>
                        </div>
                    </div>
                    <script>
                        const swiper = new Swiper('.slider-wrapper', {
                            loop: true,
                            autoplay: true,
                            grabCursor: true,
                            spaceBetween: 30,

                            // Pagination bullets
                            pagination: {
                                el: '.swiper-pagination',
                                clickable: true,
                                dynamicBullets: true
                            },

                            // Navigation arrows
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },

                            // Responsive breakpoints
                            breakpoints: {
                                0: {
                                    slidesPerView: 1
                                },
                                768: {
                                    slidesPerView: 2
                                },
                                1024: {
                                    slidesPerView: 3
                                }
                            }
                        });
                    </script>
                </div>
            @endif

            <!-- Map Section -->
            <div class="col-md-12 mt-2" style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }} !important">
                <h4 class="my-2">{{ __('landing.branch location details') }}</h4>
                @if($branch->address_ar || $branch->address_en)
                    <p class="mb-2">{{ $direction === 'rtl' ? $branch->address_ar ?? $branch->address_en: $branch->address_en ?? $branch->address_ar }}</p>
                @endif
                <div id="map" style="height: 400px;" class="rounded shadow-sm"></div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if ({{ $branch->latitude && $branch->longitude }}) {
                var map = L.map('map').setView([{{ $branch->latitude }}, {{ $branch->longitude }}], 16);
            }

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Example array of markers
            if ({{ !empty($markers) }}) {
                var markers = @json($markers);

                // Loop to add markers
                markers.forEach(function (markerData) {
                    L.marker([markerData.lat, markerData.lng])
                        .addTo(map)
                        .bindPopup(markerData.popup);
                });
            }
        });
    </script>
@endsection
