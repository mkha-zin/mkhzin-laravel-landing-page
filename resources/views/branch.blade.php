@php
    use App\Models\Header;use Illuminate\Support\Facades\App;
    use Carbon\Carbon;


    $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';
    $branch = \App\Models\Branch::first();
@endphp
@extends('layouts.app')
@section('content')

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <div class="container my-5">
        <div class="row">
            <!-- Branch Details and Images -->
            <div class="col-md-6">
                <h2 class="mb-3">{{ $branch->name }}</h2>
                <p>{{ $branch->description }}</p>

                <div class="row">{{--
                    @foreach ($branch->images as $image)
                        <div class="col-6 mb-3">
                            <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded shadow-sm" alt="Branch Image">
                        </div>
                    @endforeach--}}
                </div>
            </div>

            <!-- Map Section -->
            <div class="col-md-12">
                <h4 class="mb-2">Branch Location</h4>
                <div id="map" style="height: 400px;" class="rounded shadow-sm"></div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([24.696698, 46.780471], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.marker([24.696698, 46.780471])
                .addTo(map)
                .bindPopup("<strong style='color: #ff0000'>{{ $branch->name_ar }}</strong>")
                .openPopup();
        });
    </script>
@endsection
