@extends('layouts.app')

@php
    use Carbon\Carbon;use Filament\Support\Markdown;$lang = App::currentLocale();
    $dir = $lang == 'ar' ? 'rtl' : 'ltr';
    $settings = App\Models\JobsSetting::first();
@endphp

@section('content')

    <style>
        /* Custom Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-image: url({{ asset('images/svg/Sprinkle.svg') }});
            color: #333;
        }

        /* Welcome Section */
        .welcome-section {
            background-image: url({{ asset('images/svg/Overlay.svg') }});
            color: white;
            padding: 60px 0;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 40px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .welcome-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: -1;
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .welcome-section p {
            font-size: 1.25rem;
            margin-top: 20px;
        }

        .company-logo {
            width: 120px;
            height: auto;
            margin-top: 20px;
        }

        /* Button Styling */
        .btn-primary1 {
            background-color: #ec0015; /* Red */
            border-color: #ec0015;
            text-transform: uppercase;
            font-weight: bold;
            color: white;
            letter-spacing: 0.5px;
        }

        .btn-primary1:hover {
            background-color: #c82333;
            border-color: #c82333;
            color: white;
        }

        .btn-outline1-primary {
            border-color: #ec0015;
            color: #ec0015;
        }

        .btn-outline1-primary:hover {
            background-color: #ec0015 !important;
            color: white !important;
        }

        footer a:hover {
            color: #ec0015;
            text-decoration: underline;
        }

    </style>

    <!-- Welcome Section -->
    <div class="container welcome-section mt-3">
        <div class="container">
            <img src="{{ asset('store/images/logo.png') }}" alt="Company Logo" class="company-logo">
            <h2 class="mt-2 text-white">{{ $lang == 'ar' ? $settings->home_title_ar : $settings->home_title_en }}</h2>
            <p>{{ Markdown::block($lang == 'ar' ? $settings->home_description_ar : $settings->home_description_en) }}</p>
        </div>
    </div>

    <!-- Available Jobs Section -->
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('home.Available Jobs') }}</h2>
            <a href="https://mkhzin.com" target="_blank" class="btn btn-secondary text-white">{{ __('home.Back to Home') }}</a>
        </div>

        <div class="row">
            @forelse ($jobs as $job)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body" style="text-align: {{ $dir == 'ltr' ? 'left' : 'right' }}">
                            <h5 class="card-title">{{ $job->title }}</h5>
                            <div class="row">
                                <p class="card-text" style="font-size: 11px">
                                    {{ Carbon::parse($job->created_at)->translatedFormat('j F Y') }}
                                </p>
                                <p class="w-auto text-white m{{ $dir == 'rtl' ? 'r-3' : 'l-3' }} px-1 rounded badge-danger"
                                   style="background-color: #ec0015; margin-top: -15px;">
                                    {{ ucfirst(__('home.' . $job->type )) }}
                                </p>
                            </div>
                            <p class="card-text" style="margin-top: -20px">{{ Markdown::block(Str::limit($job->description, 100)) }}</p>
                            <a href="{{ route('jobs.apply', $job->id) }}" class="btn btn-primary1 text-white">
                                {{ __('home.Apply Now') }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-danger text-center">
                        {{ __('home.No jobs available at the moment. You can submit a general application using the button below.') }}
                    </div>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('jobs.general-application') }}" class="btn btn-outline1-primary">
                {{ __('home.Apply generally') }}
            </a>
        </div>
    </div>

    <!-- Bootstrap JS Bundle via CDN (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
