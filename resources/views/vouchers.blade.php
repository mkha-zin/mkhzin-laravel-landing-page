<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/mkhazin/logo900.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="container mt-5">
    <div class="card w-100 mt-5 ">
        <div class="card-header">
            <h5 class="card-title">Mkhazin Vouchers</h5>
        </div>
        <div class="card-body">
            <form method="post" action="">
                @csrf
                <div class="row g-3">
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="voucher_number" required name="voucher_number" placeholder="Enter Voucher Number">
                    </div>
                    <div class="col-sm w-100">
                        <button type="submit" class="btn btn-primary">Check Voucher</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted">
            @include('_message')
{{--            @dd( session()->has('success') . ' - ' .  session()->has('error') )--}}
            @if( session()->has('voucher') )
                <form method="post" action="{{ url('use_voucher') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" disabled id="voucher_number" value="{{ session()->get('voucher') }}" required name="voucher_number" placeholder="Enter Voucher Number">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="c_name" required name="c_name" placeholder="Enter Client Name">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="phone" required name="phone" placeholder="Enter Client Phone">
                        </div>
                        <div class="col-sm w-100">
                            <button type="submit" class="btn btn-primary">Use Voucher</button>
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
