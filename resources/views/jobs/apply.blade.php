@php
    use Filament\Support\Markdown;$lang = App::currentLocale();
    $dir = $lang == 'ar' ? 'rtl' : 'ltr';
@endphp

@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        background-image: url({{ asset('images/svg/Shapes.svg') }});
        color: #343a40;
    }

    /* Primary Color */
    .primary-color {
        color: #ec0015;
    }

    .bg-primary-color {
        background-color: #ec0015;
    }

    /* Custom Button Styles */
    .btn-primary1 {
        background-color: #ec0015;
        border-color: #ec0015;
        border-radius: 5px !important;
        font-weight: bold;
        text-transform: uppercase;
        color: white !important;
        padding: 10px 20px;
    }

    .btn-primary1:hover {
        background-color: #c82333 !important;
        border-color: #c82333;
        color: white;
    }

    /* Custom Outlined Button */
    .btn-outline1-primary {
        border-color: #ec0015;
        color: #ec0015;
        border-radius: 5px;
        font-weight: bold;
    }

    .btn-outline1-primary:hover {
        background-color: #ec0015 !important;
        color: white !important;
    }

    /* Form Card */
    .form-card {
        padding: 30px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-top: 5px solid #ec0015; /* Add a red accent at the top */
    }

    /* Form Input Styles */
    .form-control, .form-select {
        border-radius: 5px;
        box-shadow: none;
        border: 1px solid rgba(0, 0, 0, 0.34);
    }

    .form-control:focus, .form-select:focus {
        border-color: #c82333;
        box-shadow: 0 0 0 0.25rem rgba(236, 0, 21, 0.25);
    }

    .form-label {
        font-weight: 500;
    }

    /* Job Details Card */
    .job-details-card {
        text-align: {{ $dir == 'rtl' ? 'right' : 'left' }};
        background-image: url({{ asset('images/svg/Overlay.svg') }});
        color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px;
    }

    .job-details-card h2 {
        color: white;
        font-size: 2rem;
        font-weight: bold;
    }

    .job-details-card p {
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .job-details-card .btn {
        background-color: white;
        color: #ec0015;
        border-radius: 20px;
        font-weight: bold;
        padding: 10px 25px;
    }

    .job-details-card .btn:hover {
        background-color: #c82333;
        color: white;
    }

    /* Section Titles */
    .section-title {
        font-size: 1.25rem;
        margin-top: 30px;
        margin-bottom: 15px;
        font-weight: 600;
        color: #343a40;
    }

    .text-primary-color {
        color: #ec0015;
    }

    /* Spacing */
    .mb-4, .my-5 {
        margin-bottom: 30px;
    }
</style>

<div class="container my-3" style="text-align: {{ $dir == 'rtl' ? 'right' : 'left' }}">
    <div class="mb-2">
        <a href="{{ route('jobs.index') }}" class="btn btn-outline1-primary">{{ __('home.Back to Jobs') }}</a>
    </div>

    <!-- Job Details Card -->
    <div class="card job-details-card">
        <h2 class="mb-2">{{ $job->title }}</h2>
        <p class="mb-3">{{ Markdown::block($job->description) }}</p>
        <ul class="list-unstyled">
            <li><strong>{{ __('home.Job Type:') }}</strong> {{ ucfirst(__('home.' . $job->type )) }} </li>
            <li><strong>{{ __('home.Published on:') }}</strong> {{ $job->created_at->translatedFormat('j F Y') }} </li>
            <li><strong>{{ __('home.Applicants so far:') }}</strong> {{ $job->applicants }}</li>
        </ul>
    </div>

    <!-- Application Form -->
    <div class="form-card">
        <form method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            {{--<!-- Display Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif--}}

            <div class="section-title">{{ __('home.Personal Information') }}</div>
            <div class="row g-3">
                <!-- Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">{{ __('home.Your Name') }}</label>
                    <input type="text" name="name" style="background-color: transparent; color: black" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">{{ __('home.Your Email') }}</label>
                    <input type="email" name="email" style="background-color: transparent; color: black" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required>
                    @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <label for="phone" class="form-label">{{ __('home.Phone Number') }}</label>
                    <input type="tel" name="phone" style="background-color: transparent; color: black" class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone') }}" required>
                    @error('phone')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="col-md-6">
                    <label for="address" class="form-label">{{ __('home.Address') }}</label>
                    <input type="text" name="address" style="background-color: transparent; color: black" class="form-control @error('address') is-invalid @enderror"
                           value="{{ old('address') }}" required>
                    @error('address')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Resume -->
                <div class="col-12">
                    <label for="resume" class="form-label">{{ __('home.Upload Resume') }}</label>
                    <input type="file" name="resume" style="background-color: transparent; color: black" class="form-control @error('resume') is-invalid @enderror"
                           accept=".pdf,.doc,.docx" required>
                    @error('resume')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            @if (!empty($job->questions))
                <div class="section-title">{{ __('home.Job Questions') }}</div>

                <div class="row g-3">
                    @foreach ($job->questions as $index => $question)
                        <div class="{{ count($job->questions) > 1 ? 'col-md-6' : 'col-12' }}">
                            <label class="form-label">{{ $question['question'] }}</label>
                            @if ($question['type'] === 'text')
                                <input required style="background-color: transparent; color: black" type="text" name="questions[{{ $index }}][answer]"
                                       class="form-control @error("questions.$index.answer") is-invalid @enderror"
                                       value="{{ old("questions.$index.answer") }}">
                                @error("questions.$index.answer")
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            @elseif ($question['type'] === 'yes_no')
                                <select required style="background-color: transparent; color: black" name="questions[{{ $index }}][answer]"
                                        class="form-select @error("questions.$index.answer") is-invalid @enderror">
                                    <option value="">{{ __('home.Choose...') }}</option>
                                    <option
                                        value="yes" {{ old("questions.$index.answer") === 'yes' ? 'selected' : '' }}>{{ __('home.Yes') }}</option>
                                    <option
                                        value="no" {{ old("questions.$index.answer") === 'no' ? 'selected' : '' }}>{{ __('home.No') }}</option>
                                </select>
                                @error("questions.$index.answer")
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            @elseif ($question['type'] === 'choices')
                                <select required style="background-color: transparent; color: black" name="questions[{{ $index }}][answer]"
                                        class="form-select @error("questions.$index.answer") is-invalid @enderror">
                                    <option value="">{{ __('home.Choose...') }}</option>
                                    @foreach (explode(',', $question['options']) as $choice)
                                        <option
                                            value="{{ trim($choice) }}" {{ old("questions.$index.answer") === trim($choice) ? 'selected' : '' }}>{{ trim($choice) }}</option>
                                    @endforeach
                                </select>
                                @error("questions.$index.answer")
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            @elseif ($question['type'] === 'number')
                                <input required style="background-color: transparent; color: black" type="number" name="questions[{{ $index }}][answer]"
                                       class="form-control @error("questions.$index.answer") is-invalid @enderror"
                                       value="{{ old("questions.$index.answer") }}">
                                @error("questions.$index.answer")
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            @endif

                            <!-- Hidden fields -->
                            <input required type="hidden" name="questions[{{ $index }}][question]"
                                   value="{{ $question['question'] }}">
                            <input required type="hidden" name="questions[{{ $index }}][type]"
                                   value="{{ $question['type'] }}">
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="text-{{  $dir == 'ltr' ? 'right' : 'left' }} mt-4">
                <button type="submit" class="btn btn-primary1 text-white">{{ __('home.Submit Application') }}</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS CDN (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
