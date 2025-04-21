@php
    use Filament\Support\Markdown;$lang = App::currentLocale();
    $dir = $lang == 'ar' ? 'rtl' : 'ltr';
    $settings = App\Models\JobsSetting::first();
@endphp

@extends('layouts.app')

@section('content')

    <style>
        /* Custom Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-image: url({{ asset('images/svg/Patterns.svg') }});
            color: #333;
        }

        /* Back Button */
        .back-btn {
            position: absolute;
            top: 20px;
            background-color: #ffffff;
            border: 1px solid #ec0015;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            color: #ec0015;
            z-index: 1;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: #ec0015;
            color: white !important;
            text-decoration: none;
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

        /* Form Card */
        .form-card {
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #ec0015; /* Add a red accent at the top */
        }

        /* Buttons */
        .btn-primary {
            background-color: #ec0015; /* Red */
            border-color: #ec0015;
            color: white !important;
            text-transform: uppercase;
            font-weight: bold;
            border-radius: 5px !important;
            letter-spacing: 0;
        }

        .btn-primary:hover {
            text-decoration: none;
            color: white;
            background-color: #c82333 !important;
            border-color: #c82333;
        }

        /* Inputs */
        .form-control {
            border-radius: 5px;
            padding: 15px;
            font-size: 1rem;
            border-color: #e0e0e0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: #ec0015;
            box-shadow: 0 0 5px rgba(216, 0, 19, 0.5);
        }

        .form-label {
            font-weight: bold;
        }

        /* Section Header */
        h2 {
            font-size: 2rem;
            color: #ec0015;
            font-weight: 600;
        }

        .text-muted {
            font-size: 1rem;
        }

        /* Card Padding */
        .card {
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 576px) {

            .welcome-section h1 {
                font-size: 2rem;
            }

            .welcome-section p {
                font-size: 1rem;
            }
        }
    </style>
    <!-- Welcome Section -->
    <div class="container welcome-section mt-3" >
        <!-- Back Button -->
        <a href="javascript:history.back()" class="back-btn" style="{{ $dir == 'ltr' ? 'left: 20px' : 'right: 20px' }}">
            {{ __('home.Back to Jobs') }}
        </a>
        <div class="container">
            <img src="{{ asset('store/images/logo.png') }}" alt="Company Logo" class="company-logo">
            <h2 class="mt-2 text-white">{{ $lang == 'ar' ? $settings->general_title_ar : $settings->general_title_en }}</h2>
            <p>{{ Markdown::block($lang == 'ar' ? $settings->general_description_ar : $settings->general_description_en) }}</p>
        </div>
    </div>

    <!-- Application Form Section -->
    <div class="container my-3">
        <div class="card form-card" style="{{ $dir == 'ltr' ? 'text-align: left' : 'text-align: right' }}">
            <h2 class="mb-3">{{ __('home.Send a General Application') }}</h2>
            <p class="text-muted">{{ __('home.title desc') }}</p>

            <form method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">{{ __('home.Your Name') }}</label>
                        <input type="text" name="name" style="background-color: transparent; color: black" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('home.Your Email') }}</label>
                        <input type="email" name="email" style="background-color: transparent; color: black" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('home.Phone Number') }}</label>
                        <input type="tel" name="phone" style="background-color: transparent; color: black" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}" required>
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('home.Address') }}</label>
                        <input type="text" name="address" style="background-color: transparent; color: black" class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address') }}" required>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Last Job -->
                    <div class="col-12">
                        <label class="form-label">{{ __('home.Last Job') }}</label>
                        <input type="text" name="last_job" style="background-color: transparent; color: black" class="form-control @error('last_job') is-invalid @enderror"
                               placeholder="{{ __('home.Last Job desc') }}" value="{{ old('last_job') }}" required>
                        @error('last_job')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- About You -->
                    <div class="col-12">
                        <label class="form-label">{{ __('home.why hire') }}</label>
                        <textarea name="about_you" style="background-color: transparent; color: black" class="form-control @error('about_you') is-invalid @enderror"
                                  rows="5"
                                  placeholder="{{ __('home.why hire desc') }}"
                                  required>{{ old('about_you') }}</textarea>
                        @error('about_you')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">{{ __('home.Upload Resume') }}</label>
                        <input type="file" name="resume" style="background-color: transparent; color: black" class="form-control @error('resume') is-invalid @enderror"
                               required>
                        @error('resume')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="sub-btn btn btn-primary px-4 py-2">{{ __('home.Submit Application') }}</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
