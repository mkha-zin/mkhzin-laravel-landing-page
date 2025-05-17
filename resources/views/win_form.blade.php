@php
    use Illuminate\Support\Facades\App;
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="responsive-iframe-wrapper">
            <iframe
                src="https://docs.google.com/forms/d/e/1FAIpQLSdx-Weegfan_v7AJQPtLT2hGmpco0cdH9O3i0c8u6sESgyqsA/viewform?embedded=true"
                frameborder="0"
                marginheight="0"
                marginwidth="0"
                allowfullscreen
                loading="lazy">
                Loading…
            </iframe>
        </div>
    </div>

    <style>
        .responsive-iframe-wrapper {
            position: relative;
            width: 100%;
            padding-top: 105%; /* Adjust for aspect ratio (around 640x1031) */
        }

        .responsive-iframe-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        @media (max-width: 767px) {
            .responsive-iframe-wrapper {
                padding-top: 180%;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .responsive-iframe-wrapper {
                padding-top: 150%;
            }
        }

        @media (min-width: 992px) and (max-width: 1199px) {
            .responsive-iframe-wrapper {
                padding-top: 120%;
            }
        }
    </style>
@endsection
