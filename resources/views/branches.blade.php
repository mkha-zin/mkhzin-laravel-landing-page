@php
    use App\Models\Header;
    use Illuminate\Support\Facades\App;
    use Carbon\Carbon
@endphp
@extends('layouts.app')
@section('content')

    @php
        $direction = app()->currentLocale() == 'ar' ? 'rtl' : 'ltr';
        $branchHeader = Header::where('key', 'branches')->first();
    @endphp

    <!-- Add Leaflet CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Map Section for All Branches -->
    <div class="col-md-12" style="text-align: {{ $direction == 'rtl' ? 'right' : 'left' }} !important">
        <div id="map" style="height: 400px;" class="rounded shadow-sm"></div>
    </div>

    <div dir="{{$direction}}" data-elementor-type="wp-page" data-elementor-id="1222" class="elementor elementor-1222">
        <div data-elementor-type="wp-post" data-elementor-id="1244" class="elementor elementor-1244">
            <div class="elementor-element elementor-element-46f2bc0 e-flex e-con-boxed e-con e-parent" data-id="46f2bc0"
                data-element_type="container">

                <div class="container mt-5" style="margin-bottom: -100px;">
                    <!-- form start -->
                    <form method="get" action="">
                        <div class="card-body">
                            <div class="row"
                                style="display: flex; justify-content: center; align-items: center; text-align: center">
                                <div class="form-group col-5">
                                    <select name="city">
                                        <option value="all">{{ __('landing.All Cities') }}</option>
                                        @foreach($cities as $citiy)
                                            <option {{ (Request::get('city') == $citiy->id) ? 'selected' : '' }}
                                                value="{{ $citiy->id }}">
                                                {{ $direction == 'rtl' ? $citiy->name_ar : $citiy->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn text-white form-group col-2" type="submit"
                                    style="letter-spacing: 0 !important; border-radius: 5px">{{ __('landing.Search') }}</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>

                <style>
                    .card-wrapper {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 20px;
                        justify-content: center;
                    }

                    .card-container {
                        background-color: #fff;
                        border-radius: 10px;
                        overflow: hidden;
                        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
                        display: flex;
                        flex-direction: column;
                        position: relative;
                        height: 460px;
                        width: 100%;
                        max-width: 100%;
                        min-width: 350px;
                        border: 1px solid red;
                    }

                    .card-image {
                        height: 300px;
                        overflow: hidden;
                    }

                    .card-image img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }

                    .card-content {
                        padding: 10px;
                        flex-grow: 1;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                        text-align: center;
                        margin-top: -50px;
                    }

                    .card-content h4 {
                        margin: 0;
                        font-size: 1.25rem;
                    }

                    .card-content h6 {
                        margin: 5px 0 0;
                        color: #555;
                        font-size: 0.95rem;
                    }

                    .card-buttons {
                        display: flex;
                        position: absolute;
                        bottom: 0;
                        width: 100%;
                    }

                    .card-buttons a {
                        flex: 1;
                        text-align: center;
                        padding: 12px;
                        color: white;
                        text-decoration: none;
                        font-weight: bold;
                    }

                    .card-buttons a:hover {
                        color: white !important;
                    }

                    .card-buttons a:first-child {
                        background-color: #df2228;
                    }

                    .card-buttons a:last-child {
                        background-color: #a72828;
                    }

                    /* Responsive columns */
                    @media (min-width: 992px) {
                        .card-container {
                            flex: 0 0 calc(33.333% - 20px);
                            /* 3 per row */
                        }
                    }

                    @media (min-width: 768px) and (max-width: 991.98px) {
                        .card-container {
                            flex: 0 0 calc(50% - 20px);
                            /* 2 per row */
                        }
                    }

                    @media (max-width: 767.98px) {
                        .card-container {
                            flex: 0 0 100%;
                            /* 1 per row */
                        }
                    }
                </style>

                <div class="e-con-inner">
                    <div class="card-wrapper">
                        @if(!empty($branches))
                            @foreach($branches as $branch)
                                <div class="card-container">
                                    <!-- Image -->
                                    <div class="card-image">
                                        <img src="{{ asset('storage/' . $branch->image) }}" alt="">
                                    </div>

                                    <!-- Info -->
                                    <div class="card-content">
                                        <h4>
                                            {{ $direction == 'rtl' ? $branch->name_ar : $branch->name_en }}
                                        </h4>
                                        <h6>
                                            {{ $direction == 'rtl' ? $branch->city->name_ar : $branch->city->name_en }},
                                            {{ $direction == 'rtl' ? $branch->address_ar : $branch->address_en }}
                                        </h6>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="card-buttons">
                                        <a href="{{ route('branch.offers', $branch->id) }}">{{ __('landing.Offers') }}</a>
                                        <a href="{{ route('branch.details', $branch->id) }}">{{ __('landing.Know More') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Collect all branch coordinates
            @php
                            $branchMarkers = [];
                            foreach($branches as $branch) {
                                if ($branch->latitude && $branch->longitude) {
                                    $branchMarkers[] = [
                                        'lat' => $branch->latitude,
                                        'lng' => $branch->longitude,
                                        'popup' => 
                '<div style="min-width:180px;text-align:center;">' .
                    '<strong>' . ($direction == 'rtl' ? $branch->name_ar : $branch->name_en) . '</strong><br>' .
                    '<span>' . __('landing.Phone') . ': ' . $branch->phone . '</span><br>' .
                    '<a href="' . route('branch.details', $branch->id) . '" style="display:inline-block;margin:4px 0;width:100%;padding:4px 8px;background:#df2228;color:#fff;border-radius:3px;text-decoration:none;">' .
                        __('landing.Go to Branch') .
                    '</a><br>' .
                    '<a href="https://www.google.com/maps/search/?api=1&query=' . $branch->latitude . ',' . $branch->longitude . '" target="_blank" style="display:inline-block;margin:4px 0;width:100%;padding:4px 8px;background:#a72828;color:#fff;border-radius:3px;text-decoration:none;">' .
                        __('landing.Show on Google Map') .
                    '</a>' .
                '</div>'
                                    ];
                                }
                            }
            @endphp
            var markers = @json($branchMarkers);

            // Default center (first branch or fallback)
            var mapCenter = markers.length ? [markers[0].lat, markers[0].lng] : [24.7136, 46.6753]; // Riyadh fallback
            var map = L.map('map').setView(mapCenter, 6);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© ' +
                    '<a href="https://mkhzin.com">{{ config('app.name') }}</a>'
            }).addTo(map);

            var bounds = [];
            markers.forEach(function (markerData) {
                var marker = L.marker([markerData.lat, markerData.lng])
                    .addTo(map)
                    .bindPopup(markerData.popup);
                bounds.push([markerData.lat, markerData.lng]);
            });

            if (bounds.length) {
                map.fitBounds(bounds, {padding: [30, 30]});
            }
        });
    </script>
@endsection