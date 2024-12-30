<!doctype html>
<html lang="{{ App::currentLocale() }}" dir="{{ App::currentLocale() === 'ar'? 'rtl': 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- Font -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">


    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/mkhazin/logo900.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .vouchers-logo {
            width: 300px;
            height: auto;
        }

        @media only screen and (max-width: 600px) {
            .vouchers-logo {
                width: 200px;
                height: auto;
            }
        }
    </style>

</head>
<body
    style="font-family: Cairo, sans-serif;background-image:url('{{ asset('uploads/mkhazin/offers_background.jpg') }}'); background-attachment:fixed; background-repeat: no-repeat; background-size: cover;">
<div class="container">
    <div class="container mt-5">

        <div class="row mt-5 justify-content-center">
            <img class="img img-fluid vouchers-logo" src="{{ asset('store/images/logo.png') }}">
        </div>
        <div class="card w-100 mt-5">
            <div class="card-header justify-content-center">
                <h5 class="card-title text-center">{{ __('landing.Mkhazin Vouchers') }}</h5>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="voucher_number" required name="voucher_number"
                                   placeholder="{{ __('landing.Enter Voucher Number') }}">
                        </div>
                        <div class="col-sm-3">
                            <button type="submit"
                                    class="btn btn-primary w-100">{{  __('landing.Check Voucher') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted">
                @include('includes._message')
                {{--            @dd( session()->has('success') . ' - ' .  session()->has('error') )--}}
                @if( session()->has('voucher') )
                    <form method="post" action="{{ url('use_voucher') }}">
                        @csrf
                        <div class="row g-3 mt-1">
                            <div class="col-sm-3">
                                <input type="text" class="form-control text-center" disabled id="voucher_number"
                                       value="{{ session()->get('voucher') }}" required name="voucher_number"
                                       placeholder="Enter Voucher Number">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="c_name" required name="c_name"
                                       placeholder="{{ __('landing.Enter Client Name') }}">
                            </div>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="phone" required name="phone"
                                       placeholder="{{ __('landing.Enter Client Phone') }}"
                                       min="0500000000" max="0599999999" oninput="validateLength(this)">
                            </div>
                            <script>
                                function validateLength(input) {
                                    if (input.value.length > 10) {
                                        input.value = input.value.slice(0, 10);
                                    }
                                }
                            </script>

                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-sm w-50">
                                <button type="submit"
                                        class="btn btn-success w-100">{{ __('landing.Use Voucher') }}</button>
                            </div>
                            <div class="col-sm w-50">
                                <a type="submit" href="{{  url('cancel_voucher')}}"
                                   class="btn btn-danger w-100">{{ __('landing.Cancel using') }}</a>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>


    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
