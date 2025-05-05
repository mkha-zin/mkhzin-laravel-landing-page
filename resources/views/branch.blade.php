@php

    $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';

@endphp

@extends('layouts.app')
@section('content')

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
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
            background-color: #232323;
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
                            <a href="{{route('branch.offers', $branch->id)}}"
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


            <!-- Map Section -->
            <div class="col-md-12" style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }} !important">
                <h4 class="mb-2">{{ __('landing.branch location details') }}</h4>
                @if($branch->address_ar || $branch->address_en)
                    <p class="mb-2">{{ $direction === 'rtl' ? $branch->address_ar ?? $branch->address_en: $branch->address_en ?? $branch->address_ar }}</p>
                @endif
                <div id="map" style="height: 400px;" class="rounded shadow-sm"></div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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
