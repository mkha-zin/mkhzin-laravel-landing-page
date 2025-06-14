<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>503 &#8211; {{ config('app.name') }}</title>
    <style>
        * {
            position: relative;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Alexandria", sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom right, #EEE, #AAA);
        }

        h1 {
            margin: 40px 0 20px;
        }

        .lock {
            border-radius: 5px;
            width: 55px;
            height: 45px;
            background-color: #333;
            animation: dip 1s;
            animation-delay: 1.5s;
        }

        .lock::before, .lock::after {
            content: "";
            position: absolute;
            border-left: 5px solid #333;
            height: 20px;
            width: 15px;
            left: calc(50% - 12.5px);
        }

        .lock::before {
            top: -30px;
            border: 5px solid #333;
            border-bottom-color: transparent;
            border-radius: 15px 15px 0 0;
            height: 30px;
            animation: lock 2s, spin 2s;
        }

        .lock::after {
            top: -10px;
            border-right: 5px solid transparent;
            animation: spin 2s;
        }

        @keyframes lock {
            0% {
                top: -45px;
            }
            65% {
                top: -45px;
            }
            100% {
                top: -30px;
            }
        }

        @keyframes spin {
            0% {
                transform: scaleX(-1);
                left: calc(50% - 30px);
            }
            65% {
                transform: scaleX(1);
                left: calc(50% - 12.5px);
            }
        }

        @keyframes dip {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(10px);
            }
            100% {
                transform: translateY(0px);
            }
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Cairo:wght@200..1000&family=El+Messiri:wght@400..700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="lock mb-1"></div>
<div class="message my-1">
    <div class="flex justify-content-center text-center">
        <h1 class="my-3">503</h1>
        <h3 class="my-3">{{ __('landing.503') }}</h3>
        <p>{{ __('landing.check mistake') }}</p>
        <a href="mailto:admin@mkhzin.com" style="text-decoration: none">admin@mkhzin.com</a>

        <br>
        <br>

        <a href="{{ route('login.reset', 'home') }}" class="btn btn-danger">{{ __('landing.Back To Home') }}</a>
        <a href="{{ route('login.reset', 'login') }}" class="btn btn-dark">{{ __('landing.Back To Login') }}</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
